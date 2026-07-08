# 🎨 03 - Modifications des Templates Twig

## Objectif
Modifier les templates Twig pour afficher les nouvelles données SCB sans casser l'existant.

---

## Fichiers à Modifier

| Fichier                                  | Modification      | Priorité    |
| ---------------------------------------- | ----------------- | ----------- |
| `templates/profession.twig`              | Ajouter blocs SCB | 🔴 Critique  |
| `templates/partials/salary_card.twig`    | Nouveau (créer)   | 🟡 Important |
| `templates/partials/gender_gap.twig`     | Nouveau (créer)   | 🟡 Important |
| `templates/partials/salary_history.twig` | Nouveau (créer)   | 🟢 Optionnel |

---

## 1. Modification de `profession.twig`

### Emplacement actuel du salaire
Localiser le bloc qui affiche le salaire actuel (probablement quelque chose comme) :
```twig
<div class="salary-display">
    <span class="salary-amount">{{ profession.avg_salary|number_format(0, ',', ' ') }}</span> kr/mån
</div>
```

### Ajouter les nouvelles données (après le bloc salaire existant)

```twig
{# ============================================ #}
{# BLOC 1: Source SCB (Crédibilité E-E-A-T)    #}
{# ============================================ #}
{% if profession.scb is defined and profession.scb.salary_total > 0 %}
<div class="scb-source-badge">
    <span class="badge badge-official">
        <svg><!-- icône officiel --></svg>
        Källa: SCB {{ profession.scb.year }}
    </span>
</div>
{% endif %}


{# ============================================ #}
{# BLOC 2: Gender Pay Gap                       #}
{# ============================================ #}
{% if profession.scb is defined and profession.scb.salary_men > 0 and profession.scb.salary_women > 0 %}
<div class="gender-gap-section">
    <h3>Löneskillnad mellan könen</h3>
    
    <div class="gender-bars">
        {# Barre Hommes #}
        <div class="gender-bar gender-men">
            <span class="gender-label">Män</span>
            <div class="bar-container">
                <div class="bar" style="width: 100%"></div>
            </div>
            <span class="salary">{{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr</span>
        </div>
        
        {# Barre Femmes #}
        <div class="gender-bar gender-women">
            <span class="gender-label">Kvinnor</span>
            <div class="bar-container">
                <div class="bar" style="width: {{ profession.scb.gender_gap_percent }}%"></div>
            </div>
            <span class="salary">{{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr</span>
        </div>
    </div>
    
    <p class="gap-text">
        {% if profession.scb.gender_gap_percent < 100 %}
            Kvinnor tjänar <strong>{{ profession.scb.gender_gap_percent }}%</strong> av mäns lön 
            ({{ (100 - profession.scb.gender_gap_percent)|round }}% lägre)
        {% else %}
            Kvinnor tjänar <strong>{{ (profession.scb.gender_gap_percent - 100)|round }}%</strong> mer än män
        {% endif %}
    </p>
</div>
{% endif %}


{# ============================================ #}
{# BLOC 3: Distribution (Percentiles)           #}
{# ============================================ #}
{% if profession.scb is defined and profession.scb.percentiles is defined %}
{% set p = profession.scb.percentiles %}
{% if p.p10 > 0 %}
<div class="salary-distribution-section">
    <h3>Lönefördelning för {{ profession.title }}</h3>
    
    <div class="percentile-chart">
        <div class="percentile-bar">
            <div class="percentile-segment p10" style="left: 0; width: 10%">
                <span class="value">{{ p.p10|number_format(0, ',', ' ') }}</span>
                <span class="label">P10</span>
            </div>
            <div class="percentile-segment p25" style="left: 10%; width: 15%">
                <span class="value">{{ p.p25|number_format(0, ',', ' ') }}</span>
                <span class="label">P25</span>
            </div>
            <div class="percentile-segment median" style="left: 25%; width: 25%">
                <span class="value">{{ p.p50|number_format(0, ',', ' ') }}</span>
                <span class="label">Median</span>
            </div>
            <div class="percentile-segment p75" style="left: 50%; width: 25%">
                <span class="value">{{ p.p75|number_format(0, ',', ' ') }}</span>
                <span class="label">P75</span>
            </div>
            <div class="percentile-segment p90" style="left: 75%; width: 25%">
                <span class="value">{{ p.p90|number_format(0, ',', ' ') }}</span>
                <span class="label">P90</span>
            </div>
        </div>
    </div>
    
    <ul class="percentile-explanation">
        <li><strong>10%</strong> av {{ profession.title|lower }} tjänar under {{ p.p10|number_format(0, ',', ' ') }} kr</li>
        <li><strong>50%</strong> (medianlön) tjänar {{ p.p50|number_format(0, ',', ' ') }} kr</li>
        <li><strong>10%</strong> av {{ profession.title|lower }} tjänar över {{ p.p90|number_format(0, ',', ' ') }} kr</li>
    </ul>
</div>
{% endif %}
{% endif %}


{# ============================================ #}
{# BLOC 4: Évolution Historique 10 ans          #}
{# ============================================ #}
{% if profession.scb is defined and profession.scb.history is defined %}
<div class="salary-history-section">
    <h3>Löneutveckling 2014-2024</h3>
    
    {# Graphique avec Chart.js ou simple HTML #}
    <canvas id="salaryHistoryChart" width="400" height="200"></canvas>
    
    <script>
    // Données pour Chart.js
    const historyData = {
        labels: [{% for year, salary in profession.scb.history %}'{{ year }}'{% if not loop.last %},{% endif %}{% endfor %}],
        datasets: [{
            label: 'Månadslön (kr)',
            data: [{% for year, salary in profession.scb.history %}{{ salary }}{% if not loop.last %},{% endif %}{% endfor %}],
            borderColor: '#4F46E5',
            backgroundColor: 'rgba(79, 70, 229, 0.1)',
            fill: true,
            tension: 0.3
        }]
    };
    
    // Initialiser le graphique
    if (typeof Chart !== 'undefined') {
        new Chart(document.getElementById('salaryHistoryChart'), {
            type: 'line',
            data: historyData,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }
    </script>
    
    {% if profession.scb.evolution_10y_percent is defined %}
    <p class="evolution-summary">
        Lönen för {{ profession.title|lower }} har ökat med 
        <strong>{{ profession.scb.evolution_10y_percent }}%</strong> sedan 2014
    </p>
    {% endif %}
</div>
{% endif %}
```

---

## 2. CSS à Ajouter

### Dans `assets/css/style.css` ou fichier similaire

```css
/* ================================ */
/* SCB Data Blocks                  */
/* ================================ */

/* Badge source officielle */
.scb-source-badge {
    margin: 1rem 0;
}

.badge-official {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Gender Gap Section */
.gender-gap-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 1.5rem;
    margin: 2rem 0;
}

.gender-gap-section h3 {
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.gender-bars {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.gender-bar {
    display: grid;
    grid-template-columns: 80px 1fr 100px;
    align-items: center;
    gap: 1rem;
}

.bar-container {
    background: #e2e8f0;
    height: 24px;
    border-radius: 4px;
    overflow: hidden;
}

.gender-men .bar {
    background: linear-gradient(90deg, #3b82f6, #60a5fa);
    height: 100%;
}

.gender-women .bar {
    background: linear-gradient(90deg, #ec4899, #f472b6);
    height: 100%;
}

.gap-text {
    margin-top: 1rem;
    color: #64748b;
}

/* Percentile Distribution */
.salary-distribution-section {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    border-radius: 12px;
    padding: 1.5rem;
    margin: 2rem 0;
}

.percentile-chart {
    position: relative;
    height: 60px;
    background: #e2e8f0;
    border-radius: 8px;
    margin: 1rem 0;
}

.percentile-explanation {
    list-style: none;
    padding: 0;
    margin: 1rem 0 0 0;
}

.percentile-explanation li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #e2e8f0;
}

/* History Chart */
.salary-history-section {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 1.5rem;
    margin: 2rem 0;
}

.evolution-summary {
    margin-top: 1rem;
    padding: 1rem;
    background: #ecfdf5;
    border-radius: 8px;
    color: #065f46;
}

.evolution-summary strong {
    color: #059669;
    font-size: 1.25rem;
}
```

---

## 3. JavaScript à Ajouter

### Pour Chart.js (graphique historique)

Ajouter dans le `<head>` du template base si pas déjà présent :
```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

---

## ✅ Checklist Templates

- [ ] Bloc Source SCB ajouté
- [ ] Bloc Gender Gap ajouté
- [ ] Bloc Percentiles ajouté
- [ ] Bloc Historique ajouté
- [ ] CSS copié
- [ ] Chart.js inclus
- [ ] Test en local effectué

---

## ➡️ Étape suivante
Passer à `04_NOUVEAUX_CONTENUS.md`
