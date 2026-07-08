/**
 * Löne-Speedrunner 2026
 * Step-based salary progression model with GDPR-compliant tracking
 */

(function () {
    'use strict';

    // ===== CONSTANTS (Based on Swedish data sources) =====
    const CONFIG = {
        MARKE: 0.033,           // 3.3% (Industriavtalet 2025)
        LONEGLIDNING: 0.005,    // +0.5% average drift
        PROJECTION_YEARS: 5,
        HOP_INTERVAL: 2.5,      // Years between job hops

        // Sector-specific hop bonus (Sveriges Ingenjörer data)
        SECTORS: {
            tech: { name: 'IT/Tech', hopBonus: { conservative: 0.08, base: 0.10, aggressive: 0.15 } },
            vard: { name: 'Vård/Omsorg', hopBonus: { conservative: 0.06, base: 0.08, aggressive: 0.12 } },
            ekonomi: { name: 'Ekonomi/Juridik', hopBonus: { conservative: 0.08, base: 0.11, aggressive: 0.15 } },
            annat: { name: 'Annat', hopBonus: { conservative: 0.05, base: 0.07, aggressive: 0.10 } }
        },

        MODE_EXPLANATIONS: {
            conservative: '<strong>Konservativ:</strong> Jobbyte var 3 år med ~6-8% höjning. Tar hänsyn till friktionsrisk.',
            base: '<strong>Bas:</strong> Jobbyte var 2,5 år med ~8-11% höjning (baserat på Sveriges Ingenjörers statistik).',
            aggressive: '<strong>Aggressiv:</strong> Jobbyte var 2 år med ~10-15% höjning. Kräver hög efterfrågan på din profil.'
        }
    };

    const LOYAL_RATE = CONFIG.MARKE + CONFIG.LONEGLIDNING; // 3.8%

    // ===== STATE =====
    let currentMode = 'base';
    let chartInstance = null;

    // ===== CALCULATION ENGINE (Step Model) =====

    /**
     * Calculate salary progression using step model
     * Instead of compound annual growth, simulates:
     * - Loyal: steady 3.8%/year
     * - Speedrunner: 3.8%/year + big jump every HOP_INTERVAL years
     */
    function calculateProgression(startSalary, sector, mode, years) {
        const hopBonus = CONFIG.SECTORS[sector].hopBonus[mode];
        const hopInterval = mode === 'aggressive' ? 2 : (mode === 'conservative' ? 3 : 2.5);

        const loyalProgression = [];
        const speedrunnerProgression = [];

        let loyalSalary = startSalary;
        let speedrunnerSalary = startSalary;

        for (let year = 0; year <= years; year++) {
            loyalProgression.push(Math.round(loyalSalary));
            speedrunnerProgression.push(Math.round(speedrunnerSalary));

            // Loyal: steady growth
            loyalSalary *= (1 + LOYAL_RATE);

            // Speedrunner: steady growth + hop bonus at intervals
            speedrunnerSalary *= (1 + LOYAL_RATE);

            // Check if this year is a hop year (approximation)
            if (year > 0 && year % hopInterval < 1) {
                speedrunnerSalary *= (1 + hopBonus);
            }
        }

        return { loyalProgression, speedrunnerProgression };
    }

    /**
     * Calculate total "loyalty tax" (cumulative difference over years)
     */
    function calculateLoyaltyTax(loyalProgression, speedrunnerProgression) {
        let totalTax = 0;

        for (let i = 1; i < loyalProgression.length; i++) {
            const monthlyDiff = speedrunnerProgression[i] - loyalProgression[i];
            totalTax += monthlyDiff * 12; // Annual difference
        }

        return Math.round(totalTax);
    }

    // ===== UI FUNCTIONS =====

    function getInputValues() {
        const salary = parseInt(document.getElementById('salary').value) || 40000;
        const tenure = parseInt(document.getElementById('tenure').value) || 3;
        const sector = document.querySelector('input[name="sector"]:checked')?.value || 'tech';

        return { salary, tenure, sector };
    }

    function validateInputs(salary) {
        if (salary < 15000) {
            alert('Ange en rimlig månadslön (min 15 000 kr)');
            return false;
        }
        if (salary > 200000) {
            alert('VD-löner hanteras separat. Max 200 000 kr.');
            return false;
        }
        return true;
    }

    function updateModeExplanation(mode) {
        const el = document.getElementById('modeExplanation');
        if (el) {
            el.innerHTML = CONFIG.MODE_EXPLANATIONS[mode];
        }
    }

    function formatCurrency(value) {
        return new Intl.NumberFormat('sv-SE').format(value);
    }

    /**
     * Animate a number counting up from 0 to target value
     */
    function animateCounter(element, targetValue, prefix = '', suffix = '', duration = 1500) {
        const startTime = performance.now();
        const startValue = 0;

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function (ease-out cubic)
            const easedProgress = 1 - Math.pow(1 - progress, 3);
            const currentValue = Math.round(startValue + (targetValue - startValue) * easedProgress);

            element.textContent = prefix + formatCurrency(currentValue) + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

    function renderChart(loyalProgression, speedrunnerProgression) {
        const ctx = document.getElementById('salaryChart').getContext('2d');

        // Destroy previous chart if exists
        if (chartInstance) {
            chartInstance.destroy();
        }

        const labels = loyalProgression.map((_, i) => `År ${i}`);

        // Create Gradients
        const gradientLoyal = ctx.createLinearGradient(0, 0, 0, 400);
        gradientLoyal.addColorStop(0, 'rgba(148, 163, 184, 0.4)');
        gradientLoyal.addColorStop(1, 'rgba(148, 163, 184, 0.0)');

        const gradientSpeed = ctx.createLinearGradient(0, 0, 0, 400);
        gradientSpeed.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
        gradientSpeed.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

        chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Lojal',
                        data: loyalProgression,
                        borderColor: '#94a3b8',
                        backgroundColor: gradientLoyal,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#94a3b8',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Speedrunner',
                        data: speedrunnerProgression,
                        borderColor: '#10b981',
                        backgroundColor: gradientSpeed,
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8,
                            font: { family: "'Inter', sans-serif", size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { family: "'Inter', sans-serif", size: 13 },
                        bodyFont: { family: "'Inter', sans-serif", size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + formatCurrency(context.raw) + ' kr';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Inter', sans-serif" } }
                    },
                    y: {
                        border: { display: false },
                        grid: { color: '#f1f5f9', borderDash: [2, 4] },
                        ticks: {
                            font: { family: "'Inter', sans-serif" },
                            callback: function (value) {
                                return value >= 1000 ? (value / 1000) + 'k' : value;
                            }
                        }
                    }
                }
            }
        });
    }

    function updateResults(salary, sector, mode) {
        const { loyalProgression, speedrunnerProgression } = calculateProgression(
            salary, sector, mode, CONFIG.PROJECTION_YEARS
        );

        const loyaltyTax = calculateLoyaltyTax(loyalProgression, speedrunnerProgression);
        const finalLoyal = loyalProgression[loyalProgression.length - 1];
        const finalSpeed = speedrunnerProgression[speedrunnerProgression.length - 1];
        const monthlyDiff = finalSpeed - finalLoyal;

        // Update DOM with Animation for the Tax
        document.getElementById('loyalSalary').textContent = formatCurrency(finalLoyal) + ' kr/mån';
        document.getElementById('speedrunnerSalary').textContent = formatCurrency(finalSpeed) + ' kr/mån';

        // Animate the big number (Loyalty Tax)
        const taxEl = document.getElementById('loyaltyTax');
        animateCounter(taxEl, loyaltyTax, '-', ' kr');

        document.getElementById('monthlyDiff').textContent = formatCurrency(monthlyDiff);

        // Update assumptions
        const hopBonus = CONFIG.SECTORS[sector].hopBonus[mode];
        const hopPercent = Math.round(hopBonus * 100);
        const hopInterval = mode === 'aggressive' ? 2 : (mode === 'conservative' ? 3 : 2.5);

        document.getElementById('assumptionsList').innerHTML = `
      <li><strong>Lojal:</strong> +${(LOYAL_RATE * 100).toFixed(1)}%/år (märket + löneglidning)</li>
      <li><strong>Speedrunner:</strong> +${hopPercent}% vid byte (var ${hopInterval} år), +${(LOYAL_RATE * 100).toFixed(1)}% mellan byten</li>
      <li><strong>Källa:</strong> Sveriges Ingenjörer visar 10-11% höjning vid externt byte (snitt)</li>
    `;

        // Render chart
        renderChart(loyalProgression, speedrunnerProgression);

        // Show results section
        document.getElementById('resultsSection').style.display = 'block';
        document.getElementById('resultsSection').scrollIntoView({ behavior: 'smooth' });

        // Track event (if GA4 available)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'calculator_complete', {
                'salary_input': salary,
                'sector': sector,
                'mode': mode,
                'loyalty_tax': loyaltyTax
            });
        }
    }

    // ===== ACCORDION FUNCTIONS =====

    function initAccordion() {
        const headers = document.querySelectorAll('.accordion-header');

        headers.forEach(header => {
            header.addEventListener('click', function () {
                const item = this.parentElement;
                const content = item.querySelector('.accordion-content');
                const icon = item.querySelector('.icon');
                const isOpen = !content.classList.contains('hidden');

                // Close all
                document.querySelectorAll('.accordion-item').forEach(i => {
                    const c = i.querySelector('.accordion-content');
                    const ic = i.querySelector('.icon');
                    if (c) c.classList.add('hidden');
                    if (ic) ic.textContent = '+';
                });

                // Open clicked if was closed
                if (!isOpen) {
                    content.classList.remove('hidden');
                    if (icon) icon.textContent = '×';
                }
            });
        });
    }

    // ===== COPY TO CLIPBOARD =====

    function initCopyButtons() {
        document.querySelectorAll('.copy-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const scriptBox = this.previousElementSibling;
                const text = scriptBox.innerText;

                navigator.clipboard.writeText(text).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Kopierat!';

                    setTimeout(() => {
                        this.textContent = originalText;
                    }, 2000);

                    // Track
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'script_copied', { 'script_id': this.dataset.script });
                    }
                });
            });
        });
    }

    // ===== LEAD FORM (GDPR-Safe) =====

    function initLeadForm() {
        const form = document.getElementById('leadForm');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const marketingConsent = document.getElementById('marketingConsent').checked;

            // Prepare payload
            const payload = {
                email: email,
                marketing_consent: marketingConsent,
                consent_timestamp: new Date().toISOString(),
                consent_text: marketingConsent
                    ? 'Ja, jag vill även få tips om lön, karriär och arbetsmarknad via e-post.'
                    : null,
                source: 'lone-speedrunner'
            };

            // Send to backend (replace with your endpoint)
            fetch('/api/subscribe', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        form.style.display = 'none';
                        const successDiv = document.getElementById('formSuccess');
                        successDiv.style.display = 'block';
                        successDiv.innerHTML = `
                            <div class="mb-4">
                                <svg class="w-12 h-12 text-emerald-500 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <h3 class="text-lg font-bold text-slate-900">Tack! Här är din mall</h3>
                                <p class="text-sm text-slate-600">Mallen öppnas i en ny flik. Välj "Skriv ut" och spara som PDF.</p>
                            </div>
                            <a href="/static/files/brag-sheet.html" target="_blank" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="-ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Öppna mall (Spara som PDF)
                            </a>
                        `;

                        // Track
                        if (typeof gtag !== 'undefined') {
                            gtag('event', 'email_submitted', { 'marketing_consent': marketingConsent });
                        }
                    } else {
                        alert('Något gick fel. Försök igen.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Kunde inte skicka. Kontrollera din anslutning.');
                });
        });
    }

    // ===== SHARE FUNCTIONALITY =====

    // ===== SHARE FUNCTIONALITY =====

    function initShare() {
        const shareBtn = document.getElementById('shareBtn');
        if (!shareBtn) return;

        shareBtn.addEventListener('click', function () {
            const loyaltyTax = document.getElementById('loyaltyTax').textContent;
            const text = `Jag beräknade min lojalitetsskatt: ${loyaltyTax} på 5 år! Testa själv:`;

            // Construct URL with params
            const { salary, tenure, sector } = getInputValues();
            const url = new URL(window.location.href);
            url.searchParams.set('salary', salary);
            url.searchParams.set('tenure', tenure);
            url.searchParams.set('sector', sector);
            url.searchParams.set('mode', currentMode);

            const shareUrl = url.toString();

            if (navigator.share) {
                navigator.share({ title: 'Löne-Speedrunner', text: text, url: shareUrl });
            } else {
                navigator.clipboard.writeText(text + ' ' + shareUrl).then(() => {
                    this.textContent = 'Länk kopierad!';
                    setTimeout(() => { this.textContent = 'Dela resultat'; }, 2000);
                });
            }

            if (typeof gtag !== 'undefined') {
                gtag('event', 'share_clicked');
            }
        });
    }

    // ===== INIT =====

    function init() {
        // Mode toggle buttons
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                // Reset all buttons to inactive state
                document.querySelectorAll('.toggle-btn').forEach(b => {
                    b.classList.remove('active', 'border-indigo-600', 'bg-indigo-600', 'text-white');
                    b.classList.add('border-slate-200', 'bg-slate-50', 'text-slate-600');
                });
                // Set clicked button to active state
                this.classList.add('active', 'border-indigo-600', 'bg-indigo-600', 'text-white');
                this.classList.remove('border-slate-200', 'bg-slate-50', 'text-slate-600');
                currentMode = this.dataset.mode;
                updateModeExplanation(currentMode);
            });
        });

        // Calculate button
        const calcBtn = document.getElementById('calculateBtn');
        if (calcBtn) {
            calcBtn.addEventListener('click', function () {
                const { salary, tenure, sector } = getInputValues();

                if (!validateInputs(salary)) return;

                updateResults(salary, sector, currentMode);
            });
        }

        // Show scripts button
        const showScriptsBtn = document.getElementById('showScriptsBtn');
        if (showScriptsBtn) {
            showScriptsBtn.addEventListener('click', function () {
                const scriptsSection = document.getElementById('scriptsSection');
                const leadSection = document.getElementById('leadSection');

                if (scriptsSection) scriptsSection.style.display = 'block';
                if (leadSection) leadSection.style.display = 'block';

                scriptsSection.scrollIntoView({ behavior: 'smooth' });
            });
        }

        initAccordion();
        initCopyButtons();
        initLeadForm();
        initShare();

        // Check URL params for auto-fill
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('salary')) {
            const salary = urlParams.get('salary');
            const tenure = urlParams.get('tenure');
            const sector = urlParams.get('sector');
            const mode = urlParams.get('mode');

            if (salary) document.getElementById('salary').value = salary;
            if (tenure) document.getElementById('tenure').value = tenure;

            if (sector) {
                const sectorRadio = document.querySelector(`input[name="sector"][value="${sector}"]`);
                if (sectorRadio) sectorRadio.checked = true;
            }

            if (mode) {
                const modeBtn = document.querySelector(`.toggle-btn[data-mode="${mode}"]`);
                if (modeBtn) modeBtn.click(); // Trigger click to set styles and global state
            }

            // Auto-calculate
            setTimeout(() => {
                if (calcBtn) calcBtn.click();
            }, 500);
        } else {
            // Initial mode explanation (only if not handled by modeBtn.click above)
            updateModeExplanation(currentMode);
        }
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
