/**
 * Salary Chart Widget - Standalone JavaScript Component
 * 
 * This component provides a market salary visualization with:
 * - Yearly/Monthly toggle switch
 * - Bonus checkbox
 * - Q1, Q2 (median), Q3 quartile display
 * - Gaussian curve SVG visualization
 * 
 * Dependencies: Alpine.js (https://alpinejs.dev/)
 * 
 * Usage:
 * <div x-data="salaryChartWidget({q1: 41080, q2: 48800, q3: 58730, currency: 'kr'})">
 *   ... widget HTML ...
 * </div>
 */

// Make globally available for standalone usage
window.salaryChartWidget = function (config) {
    return {
        // Base salary values (yearly with bonus)
        q1: config.q1 || 0,
        q2: config.q2 || 0,
        q3: config.q3 || 0,

        // Configuration
        currency: config.currency || 'kr',
        locale: config.locale || 'sv-SE',
        hasData: config.hasData !== false && (config.q2 || 0) > 0,

        // UI State
        unit: config.defaultUnit || 'yearly',
        withBonus: config.defaultBonus !== false,

        // Labels (can be overridden for i18n)
        labels: Object.assign({
            perYear: 'Brutto/År',
            perMonth: 'Brutto/Månad',
            yearly: 'Årslön',
            monthly: 'Månadslön',
            withBonus: 'Med bonus',
            lessText: '25% tjänar mindre än',
            moreText: '25% tjänar mer än',
            noData: 'Inte tillräckligt med data',
            marketSalary: 'Marknadslön'
        }, config.labels || {}),

        // Bonus factor (typically 10% reduction without bonus)
        bonusFactor: config.bonusFactor || 0.9,

        // Computed: Display Q1
        get displayQ1() {
            let value = this.unit === 'yearly' ? this.q1 : Math.round(this.q1 / 12);
            return this.withBonus ? value : Math.round(value * this.bonusFactor);
        },

        // Computed: Display Q2 (median)
        get displayQ2() {
            let value = this.unit === 'yearly' ? this.q2 : Math.round(this.q2 / 12);
            return this.withBonus ? value : Math.round(value * this.bonusFactor);
        },

        // Computed: Display Q3
        get displayQ3() {
            let value = this.unit === 'yearly' ? this.q3 : Math.round(this.q3 / 12);
            return this.withBonus ? value : Math.round(value * this.bonusFactor);
        },

        // Format number with locale and currency
        formatNumber(num) {
            const formatted = num.toLocaleString(this.locale);
            return formatted + ' ' + this.currency;
        },

        // Formatted getters for template binding
        get formattedQ1() { return this.formatNumber(this.displayQ1); },
        get formattedQ2() { return this.formatNumber(this.displayQ2); },
        get formattedQ3() { return this.formatNumber(this.displayQ3); },

        // Unit label based on current selection
        get unitLabel() {
            return this.unit === 'yearly' ? this.labels.perYear : this.labels.perMonth;
        },

        // Toggle methods
        setUnit(newUnit) {
            this.unit = newUnit;
        },

        toggleBonus() {
            this.withBonus = !this.withBonus;
        }
    };
};

// Auto-initialize if Alpine is already loaded
document.addEventListener('alpine:init', () => {
    Alpine.data('salaryChartWidget', window.salaryChartWidget);
});
