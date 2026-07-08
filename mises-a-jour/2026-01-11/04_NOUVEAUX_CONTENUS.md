# 📝 04 - Nouveaux Contenus SEO

## Objectif
Créer de nouveaux contenus exploitant les données SCB pour améliorer le SEO et l'engagement.

---

## 1. Textes Dynamiques à Ajouter

### 1.1 Introduction enrichie (profession.twig)

**Avant :**
```
En psykolog tjänar i genomsnitt 44 500 kr per månad.
```

**Après :**
```twig
{% if profession.scb.salary_total > 0 %}
En {{ profession.title|lower }} tjänar i genomsnitt 
<strong>{{ profession.scb.salary_total|number_format(0, ',', ' ') }} kr</strong> per månad 
enligt SCB:s officiella lönestatistik för {{ profession.scb.year }}.
{% if profession.scb.percentiles.p10 > 0 %}
De lägst betalda {{ profession.title|lower }} tjänar under {{ profession.scb.percentiles.p10|number_format(0, ',', ' ') }} kr 
medan de högst betalda kan tjäna över {{ profession.scb.percentiles.p90|number_format(0, ',', ' ') }} kr.
{% endif %}
{% endif %}
```

### 1.2 Section Gender Gap

**Nouveau texte dynamique :**
```twig
{% if profession.scb.gender_gap_percent is defined %}
<section class="seo-content">
    <h2>Löneskillnad mellan könen för {{ profession.title }}</h2>
    
    {% if profession.scb.gender_gap_percent < 95 %}
    <p>Det finns en betydande löneskillnad mellan män och kvinnor som arbetar som {{ profession.title|lower }}. 
    Enligt SCB tjänar kvinnliga {{ profession.title|lower }} i genomsnitt 
    <strong>{{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr</strong> per månad,
    vilket motsvarar <strong>{{ profession.scb.gender_gap_percent }}%</strong> av männens lön 
    ({{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr).</p>
    
    <p>Detta innebär en löneskillnad på 
    <strong>{{ (profession.scb.salary_men - profession.scb.salary_women)|number_format(0, ',', ' ') }} kr</strong> 
    per månad, eller cirka {{ ((profession.scb.salary_men - profession.scb.salary_women) * 12)|number_format(0, ',', ' ') }} kr per år.</p>
    
    {% elseif profession.scb.gender_gap_percent > 100 %}
    <p>Intressant nog tjänar kvinnliga {{ profession.title|lower }} i genomsnitt 
    <strong>{{ (profession.scb.gender_gap_percent - 100)|round }}%</strong> mer än sina manliga kollegor.
    Kvinnor tjänar {{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr 
    jämfört med {{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr för män.</p>
    
    {% else %}
    <p>Lönen för {{ profession.title|lower }} är relativt jämställd mellan könen.
    Kvinnor tjänar {{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr 
    jämfört med {{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr för män,
    vilket motsvarar {{ profession.scb.gender_gap_percent }}% av männens lön.</p>
    {% endif %}
</section>
{% endif %}
```

### 1.3 Section Historique

```twig
{% if profession.scb.evolution_10y_percent is defined %}
<section class="seo-content">
    <h2>Löneutveckling för {{ profession.title }} (2014-2024)</h2>
    
    {% if profession.scb.evolution_10y_percent > 0 %}
    <p>Under de senaste 10 åren har lönen för {{ profession.title|lower }} ökat med 
    <strong>{{ profession.scb.evolution_10y_percent }}%</strong>. 
    
    {% set yearlyGrowth = (profession.scb.evolution_10y_percent / 10)|round(1) %}
    Detta motsvarar en genomsnittlig årlig löneökning på cirka {{ yearlyGrowth }}%.</p>
    
    {% if profession.scb.history['2014'] > 0 %}
    <p>År 2014 lå genomsnittslönen på {{ profession.scb.history['2014']|number_format(0, ',', ' ') }} kr.
    Idag ({{ profession.scb.year }}) ligger den på {{ profession.scb.salary_total|number_format(0, ',', ' ') }} kr.</p>
    {% endif %}
    
    {% else %}
    <p>Lönen för {{ profession.title|lower }} har varit relativt stabil under de senaste 10 åren.</p>
    {% endif %}
</section>
{% endif %}
```

---

## 2. Nouvelles FAQs Dynamiques

### Ajouter dans la section FAQ de `profession.twig`

```twig
{# FAQs générées automatiquement depuis SCB #}
{% if profession.scb is defined %}

{# FAQ: Salaire moyen #}
<div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <h3 itemprop="name">Vad är medellönen för en {{ profession.title|lower }} {{ profession.scb.year }}?</h3>
    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <p itemprop="text">
            Enligt SCB:s officiella statistik är medellönen för en {{ profession.title|lower }} 
            {{ profession.scb.salary_total|number_format(0, ',', ' ') }} kr per månad ({{ profession.scb.year }}).
        </p>
    </div>
</div>

{# FAQ: Gender gap #}
{% if profession.scb.salary_men > 0 and profession.scb.salary_women > 0 %}
<div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <h3 itemprop="name">Tjänar män eller kvinnor mer som {{ profession.title|lower }}?</h3>
    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <p itemprop="text">
            {% if profession.scb.gender_gap_percent < 100 %}
            Män tjänar i genomsnitt {{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr 
            medan kvinnor tjänar {{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr.
            Kvinnor tjänar alltså {{ profession.scb.gender_gap_percent }}% av mäns lön.
            {% else %}
            Kvinnor tjänar i genomsnitt {{ profession.scb.salary_women|number_format(0, ',', ' ') }} kr 
            medan män tjänar {{ profession.scb.salary_men|number_format(0, ',', ' ') }} kr.
            I detta yrke tjänar kvinnor alltså mer än män.
            {% endif %}
        </p>
    </div>
</div>
{% endif %}

{# FAQ: Percentiles #}
{% if profession.scb.percentiles.p90 > 0 %}
<div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <h3 itemprop="name">Hur mycket kan en {{ profession.title|lower }} tjäna som mest?</h3>
    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <p itemprop="text">
            De 10% högst betalda {{ profession.title|lower }} tjänar över 
            {{ profession.scb.percentiles.p90|number_format(0, ',', ' ') }} kr per månad.
            Medianlönen ligger på {{ profession.scb.percentiles.p50|number_format(0, ',', ' ') }} kr.
        </p>
    </div>
</div>
{% endif %}

{# FAQ: Évolution #}
{% if profession.scb.evolution_10y_percent is defined %}
<div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <h3 itemprop="name">Hur har lönen för {{ profession.title|lower }} utvecklats?</h3>
    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <p itemprop="text">
            Lönen för {{ profession.title|lower }} har ökat med {{ profession.scb.evolution_10y_percent }}% 
            under de senaste 10 åren (2014-2024), enligt SCB.
        </p>
    </div>
</div>
{% endif %}

{% endif %}
```

---

## 3. Meta Description Enrichie

### Modifier la meta description dynamique

```twig
{% set metaDescription %}
{{ profession.title }} lön {{ currentYear }}: {{ profession.scb.salary_total|number_format(0, ',', ' ') }} kr/mån (SCB). 
{% if profession.scb.gender_gap_percent < 100 %}Löneskillnad: kvinnor {{ profession.scb.gender_gap_percent }}% av män. {% endif %}
Lönefördelning: {{ profession.scb.percentiles.p10|number_format(0, ',', ' ') }}-{{ profession.scb.percentiles.p90|number_format(0, ',', ' ') }} kr.
{% endset %}

<meta name="description" content="{{ metaDescription|striptags|trim }}">
```

---

## 4. Structured Data Enrichie

### Schema.org Occupation amélioré

```twig
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Occupation",
    "name": "{{ profession.title }}",
    "occupationalCategory": "{{ profession.scb.ssyk_code }}",
    "estimatedSalary": [
        {
            "@type": "MonetaryAmountDistribution",
            "name": "Median",
            "currency": "SEK",
            "duration": "P1M",
            "median": {{ profession.scb.percentiles.p50 }},
            "percentile10": {{ profession.scb.percentiles.p10 }},
            "percentile25": {{ profession.scb.percentiles.p25 }},
            "percentile75": {{ profession.scb.percentiles.p75 }},
            "percentile90": {{ profession.scb.percentiles.p90 }}
        }
    ],
    "occupationLocation": {
        "@type": "Country",
        "name": "Sweden"
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url }}"
    }
}
</script>
```

---

## ✅ Checklist Contenus (TERMINÉ)

- [x] Introduction enrichie ajoutée
- [x] Section Gender Gap ajoutée
- [x] Section Historique ajoutée
- [x] FAQs dynamiques ajoutées
- [ ] Meta description mise à jour (optionnel - nécessite modification du controller)
- [x] Structured Data enrichie (Occupation + FAQPage Schema.org)
- [x] Tous les textes en suédois correct

---

## ➡️ Étape suivante
Passer à `05_TESTS.md`
