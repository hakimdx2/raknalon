document.addEventListener('alpine:init', () => {
    Alpine.data('salaryCalculator', () => ({
        salary: '',
        taxRate: 32.37,
        selectedMunicipality: '',
        age: 30,
        result: null,
        loading: false,

        updateTaxRate(e) {
            const rate = parseFloat(e.target.value);
            if (!isNaN(rate)) {
                this.taxRate = rate;
            } else {
                this.taxRate = 32.37;
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
            } catch (error) {
                console.error('Error:', error);
            } finally {
                this.loading = false;
            }
        },

        formatMoney(amount) {
            if (!amount) return '0';
            return new Intl.NumberFormat('sv-SE').format(amount);
        }
    }))
});
