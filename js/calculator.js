document.addEventListener('alpine:init', () => {
    Alpine.data('salaryCalculator', () => ({
        salary: '',
        taxRate: 32.37,
        selectedMunicipality: '',
        municipalityName: '',
        age: 30,
        result: null,
        loading: false,

        // History feature
        history: [],
        showHistory: false,
        showCompare: false,
        maxHistory: 5,
        storageKey: 'raknalon_history',

        // Similar professions feature
        allProfessions: [],
        similarProfessions: [],

        init() {
            this.loadHistory();
            this.loadProfessions();
        },

        // Load professions data from the page
        loadProfessions() {
            const dataEl = document.getElementById('professions-data');
            if (dataEl) {
                try {
                    this.allProfessions = JSON.parse(dataEl.textContent);
                } catch (e) {
                    console.error('Error loading professions:', e);
                }
            }
        },

        // Find professions with similar salary
        findSimilarProfessions(salary) {
            if (!this.allProfessions.length || !salary) {
                this.similarProfessions = [];
                return;
            }

            const targetSalary = parseInt(salary);

            // Calculate distance for each profession and sort
            const withDistance = this.allProfessions
                .filter(p => p.median_salary && p.median_salary > 0)
                .map(p => ({
                    ...p,
                    distance: Math.abs(p.median_salary - targetSalary)
                }))
                .sort((a, b) => a.distance - b.distance);

            // Take top 3
            this.similarProfessions = withDistance.slice(0, 3);
        },

        // Load history from localStorage
        loadHistory() {
            try {
                const stored = localStorage.getItem(this.storageKey);
                if (stored) {
                    this.history = JSON.parse(stored);
                    this.showHistory = this.history.length > 0;
                }
            } catch (e) {
                console.error('Error loading history:', e);
                this.history = [];
            }
        },

        // Save history to localStorage
        saveHistory() {
            try {
                localStorage.setItem(this.storageKey, JSON.stringify(this.history));
            } catch (e) {
                console.error('Error saving history:', e);
            }
        },

        // Add calculation to history
        addToHistory(calculation) {
            // Check if similar calculation already exists (same gross + municipality)
            const existingIndex = this.history.findIndex(h =>
                h.gross === calculation.gross &&
                h.municipalityName === calculation.municipalityName
            );

            if (existingIndex !== -1) {
                // Remove existing and add updated version at the beginning
                this.history.splice(existingIndex, 1);
            }

            // Add to beginning of array
            this.history.unshift(calculation);

            // Keep only max items
            if (this.history.length > this.maxHistory) {
                this.history = this.history.slice(0, this.maxHistory);
            }

            this.showHistory = true;
            this.saveHistory();
        },

        // Remove a single item from history
        removeFromHistory(index) {
            this.history.splice(index, 1);
            this.saveHistory();
            if (this.history.length === 0) {
                this.showHistory = false;
                this.showCompare = false;
            }
        },

        // Clear all history
        clearHistory() {
            this.history = [];
            this.showHistory = false;
            this.showCompare = false;
            localStorage.removeItem(this.storageKey);
        },

        // Load a previous calculation into the form
        loadCalculation(item) {
            this.salary = item.gross;
            this.taxRate = item.taxRate;
            this.age = item.age;

            // Find and select the municipality in the dropdown
            const select = document.getElementById('municipality');
            if (select) {
                for (let option of select.options) {
                    if (parseFloat(option.value) === item.taxRate && option.text === item.municipalityName) {
                        this.selectedMunicipality = option.value;
                        this.municipalityName = option.text;
                        break;
                    }
                }
            }

            // Also set the result immediately for a smooth experience
            this.result = {
                net_salary: item.net,
                total_tax: item.tax,
                employer_cost: item.employerCost
            };

            // Scroll to result
            setTimeout(() => {
                document.querySelector('.result-section')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        },

        // Get municipality name from select
        getMunicipalityName() {
            const select = document.getElementById('municipality');
            if (select && select.selectedIndex > 0) {
                return select.options[select.selectedIndex].text;
            }
            return 'Sverige';
        },

        updateTaxRate(e) {
            const rate = parseFloat(e.target.value);
            if (!isNaN(rate)) {
                this.taxRate = rate;
                this.municipalityName = this.getMunicipalityName();
            } else {
                this.taxRate = 32.37;
                this.municipalityName = '';
            }
        },

        async calculate() {
            if (!this.salary) return;

            this.loading = true;
            try {
                const response = await fetch('/api/calculate', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({
                        salary: this.salary,
                        tax_rate: this.taxRate,
                        age: this.age
                    })
                });

                this.result = await response.json();

                // Auto-save to history
                const calculation = {
                    id: Date.now(),
                    gross: parseInt(this.salary),
                    net: this.result.net_salary,
                    tax: this.result.total_tax,
                    employerCost: this.result.employer_cost,
                    taxRate: this.taxRate,
                    municipalityName: this.getMunicipalityName(),
                    age: this.age,
                    createdAt: new Date().toISOString()
                };

                this.addToHistory(calculation);

                // Find similar professions based on gross salary
                this.findSimilarProfessions(this.salary);

            } catch (error) {
                console.error('Error:', error);
            } finally {
                this.loading = false;

                // Ezoic: Refresh ads on dynamic content change
                if (typeof ezstandalone !== 'undefined' && ezstandalone.cmd) {
                    ezstandalone.cmd.push(function () {
                        ezstandalone.showAds();
                    });
                }
            }
        },

        formatMoney(amount) {
            if (!amount) return '0';
            return new Intl.NumberFormat('sv-SE').format(amount);
        },

        formatShortMoney(amount) {
            if (!amount) return '0';
            if (amount >= 1000) {
                return Math.round(amount / 1000) + 'k';
            }
            return amount.toString();
        },

        // Calculate difference between two calculations
        getDifference(index) {
            if (index === 0 || this.history.length < 2) return null;
            const current = this.history[index];
            const reference = this.history[0];
            return current.net - reference.net;
        },

        // Get percentage difference
        getPercentageDiff(index) {
            if (index === 0 || this.history.length < 2) return null;
            const current = this.history[index];
            const reference = this.history[0];
            return ((current.net - reference.net) / reference.net * 100).toFixed(1);
        }
    }))
});
