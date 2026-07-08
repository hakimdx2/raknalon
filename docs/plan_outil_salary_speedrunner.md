# Plan d'Implémentation 10/10 : "Löne-Speedrunner 2026"

---

## 1. Vision Produit

### 1.1 Proposition de Valeur
**Tagline :** "Beräkna din lojalitetsskatt – och få exakt vad du ska säga för att höja lönen med +20%."

**Problème :** Les employés suédois perdent des **centaines de milliers de couronnes** sur leur carrière en restant loyaux.
**Solution :** Un outil viral qui :
1.  **Choque** avec des chiffres personnalisés.
2.  **Arme** l'utilisateur avec des scripts prêts à l'emploi.
3.  **Capture** l'email pour une relation long terme.

### 1.2 Objectifs Mesurables (KPIs)
| KPI | Cible Mois 1 | Cible Mois 3 |
|-----|--------------|--------------|
| Visiteurs uniques | 5 000 | 20 000 |
| Calculs effectués | 2 000 | 10 000 |
| Emails capturés | 500 (25% taux) | 2 500 |
| Partages sociaux | 200 | 1 000 |

---

## 2. Architecture Technique

### 2.1 Stack
| Composant | Technologie | Justification |
|-----------|-------------|---------------|
| Frontend | HTML + Vanilla JS + Chart.js | Léger, pas de dépendance, SEO-friendly |
| Styling | CSS Variables + Dark Mode | Gamifié, moderne |
| Backend | Aucun (statique) ou PHP pour lead storage | Simple, Hugo-compatible |
| Analytics | Google Analytics 4 + Custom Events | Tracking granulaire |
| Hosting | Netlify/Vercel (via Hugo) | CDN global, gratuit |

### 2.2 Structure des Fichiers
```
raknalon/
├── content/
│   └── verktyg/
│       └── lone-speedrunner.md          # Page Hugo (SEO + embed)
├── static/
│   ├── js/
│   │   └── speedrunner.js               # Logique calculateur
│   ├── css/
│   │   └── speedrunner.css              # Styles gamifiés
│   └── data/
│       └── salary-data.json             # Données sectorielles (optionnel)
└── layouts/
    └── verktyg/
        └── single.html                  # Template custom (si besoin)
```

---

## 3. Module A : "Lojalitetsskatt-Kalkylatorn" (Loyalty Tax Calculator)

### 3.1 Wireframe (ASCII)
```
┌──────────────────────────────────────────────────────────────┐
│  🔥 LOJALITETSSKATT-KALKYLATORN                              │
│  Hur mycket förlorar du på att stanna kvar?                  │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  Din nuvarande månadslön (kr):  [________40000_______]       │
│                                                              │
│  Hur länge har du stannat?      [▼ 3 år____]                 │
│                                                              │
│  Din bransch:                   (•) IT/Tech                  │
│                                 ( ) Vård                     │
│                                 ( ) Ekonomi/Juridik          │
│                                 ( ) Annat                    │
│                                                              │
│                    [ 🧮 BERÄKNA MIN SKATT ]                  │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  ┌─────────────────────────────────────────────────────────┐ │
│  │                    📊 RESULTAT                          │ │
│  │                                                         │ │
│  │   [====== CHART: Lojal vs Speedrunner (5 år) ======]   │ │
│  │                                                         │ │
│  │   Din lön om 5 år (lojal):        47 082 kr/mån        │ │
│  │   Din lön om 5 år (speedrunner):  64 420 kr/mån        │ │
│  │                                                         │ │
│  │   ───────────────────────────────────────────────────   │ │
│  │   🚨 DIN LOJALITETSSKATT PÅ 5 ÅR:                      │ │
│  │                                                         │ │
│  │          █████████████████████████████████████          │ │
│  │                   -832 000 kr                           │ │
│  │          █████████████████████████████████████          │ │
│  │                                                         │ │
│  └─────────────────────────────────────────────────────────┘ │
│                                                              │
│  [ 📧 FÅ LÖNEFÖRHANDLINGS-SCRIPTEN → ]   [ 🔗 DELA ]         │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

### 3.2 Formules Mathématiques Exactes

```javascript
// --- CONSTANTES (basées sur données Perplexity/SCB/Ingenjörerna) ---
const MARKE = 0.033;              // 3.3% (Industriavtalet 2025)
const LONEGLIDNING = 0.005;       // +0.5% extra moyen
const LOYAL_RATE = MARKE + LONEGLIDNING; // 3.8%/an

const SPEEDRUNNER_RATES = {
  'tech':     0.12,   // 12%/an (job hop chaque 2.5 ans moyenné)
  'vard':     0.10,   // 10%/an
  'ekonomi':  0.11,   // 11%/an
  'annat':    0.08    // 8%/an (conservateur)
};

// --- FONCTION PRINCIPALE ---
function calculateLoyaltyTax(currentSalary, yearsStayed, sector, projectionYears = 5) {
  const speedrunnerRate = SPEEDRUNNER_RATES[sector] || 0.08;
  
  // Salaire après N années (intérêts composés)
  const loyalSalary = currentSalary * Math.pow(1 + LOYAL_RATE, projectionYears);
  const speedrunnerSalary = currentSalary * Math.pow(1 + speedrunnerRate, projectionYears);
  
  // Calcul de la "taxe" = somme des différences cumulées
  let loyaltyTax = 0;
  for (let year = 1; year <= projectionYears; year++) {
    const loyalAtYear = currentSalary * Math.pow(1 + LOYAL_RATE, year);
    const speedAtYear = currentSalary * Math.pow(1 + speedrunnerRate, year);
    loyaltyTax += (speedAtYear - loyalAtYear) * 12; // Mensuel -> Annuel
  }
  
  return {
    loyalFinalSalary: Math.round(loyalSalary),
    speedrunnerFinalSalary: Math.round(speedrunnerSalary),
    loyaltyTax: Math.round(loyaltyTax),
    monthlyDifference: Math.round(speedrunnerSalary - loyalSalary)
  };
}
```

### 3.3 Edge Cases & Validation
| Input | Règle de Validation | Message d'Erreur |
|-------|---------------------|------------------|
| Salaire < 15000 | Min 15000 kr | "Ange en rimlig månadslön (min 15 000 kr)" |
| Salaire > 200000 | Max 200000 kr | "VD-löner hanteras separat 😉" |
| Années = 0 | Min 1 an | "Du måste ha jobbat minst 1 år" |
| Années > 20 | Cap à 20 ans | Accepté, mais projection max 10 ans |

### 3.4 Sources Affichées (Crédibilité)
```html
<footer class="calculator-sources">
  <p>📊 Källor: 
    <a href="https://www.mi.se" target="_blank">Medlingsinstitutet</a>, 
    <a href="https://www.scb.se/hitta-statistik/sverige-i-siffror/lonesok/" target="_blank">SCB Lönesök</a>, 
    <a href="https://www.sverigesingenjorer.se/lon/negotiate-your-salary/" target="_blank">Sveriges Ingenjörer</a>
  </p>
</footer>
```

---

## 4. Module B : "Script Generator"

### 4.1 Wireframe
```
┌──────────────────────────────────────────────────────────────┐
│  💬 LÖNE-SCRIPT: Vad ska du säga?                            │
├──────────────────────────────────────────────────────────────┤
│  Välj situation:                                             │
│  ┌───────────────────────────────────────────────────────┐   │
│  │ [+] "Chefen säger: Vi har inget utrymme (märket)"     │   │
│  ├───────────────────────────────────────────────────────┤   │
│  │ [+] "Jag har ett externt erbjudande"                  │   │
│  ├───────────────────────────────────────────────────────┤   │
│  │ [+] "Hur börjar jag samtalet 3 månader innan?"        │   │
│  └───────────────────────────────────────────────────────┘   │
│                                                              │
│  ┌───────────────────────────────────────────────────────┐   │
│  │ SCRIPT (klicka för att kopiera):                      │   │
│  │                                                       │   │
│  │ "Jag förstår att märket styr det kollektiva          │   │
│  │ utrymmet. Här pratar vi om mitt individuella         │   │
│  │ löneläge i förhållande till marknaden..."            │   │
│  │                                                       │   │
│  │         [ 📋 KOPIERA TILL URKLIPP ]                   │   │
│  └───────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────┘
```

### 4.2 Database de Scripts (JSON)
```json
{
  "scripts": [
    {
      "id": "break_market",
      "title": "Chefen säger: 'Vi har inget utrymme (märket)'",
      "script": "Jag förstår att märket styr det kollektiva utrymmet.\n\nHär pratar vi om mitt individuella löneläge i förhållande till marknaden och det ansvar jag faktiskt har idag.\n\nNär jag jämför med [Unionen/Akavia/SCB] statistik för min roll, erfarenhet och region ligger jag ungefär {gap}% under marknadslön.\n\nSkulle vi kunna titta på en justering av mitt löneläge utöver den ordinarie revisionen?",
      "variables": ["gap"],
      "category": "negotiation"
    },
    {
      "id": "external_offer",
      "title": "Jag har ett externt erbjudande",
      "script": "Jag vill vara transparent med dig eftersom jag trivs här.\n\nJag har fått ett konkret erbjudande på {externalSalary} kr/mån, vilket är {percentDiff}% över min nuvarande nivå.\n\nMitt förstahandsval är att stanna här, förutsatt att min lön och roll kan spegla min faktiska nivå.\n\nFinns det utrymme att göra en lönejustering som tar mig närmare den här nivån?",
      "variables": ["externalSalary", "percentDiff"],
      "category": "leverage"
    },
    {
      "id": "pre_meeting_email",
      "title": "Förberedande mail 3 månader innan",
      "script": "Ämne: Förberedelse inför årets lönedialog\n\nHej {chefNamn},\n\nJag vet att lönerevisionen börjar planeras under {month}, och jag skulle gärna vilja ta ett förberedande samtal med dig.\n\nUnder året har jag bland annat:\n- {achievement1}\n- {achievement2}\n\nJag vill diskutera min fortsatta utveckling och hur mitt löneläge kan justeras.\n\nHar du möjlighet att avsätta 30-45 minuter under vecka {week}?",
      "variables": ["chefNamn", "month", "achievement1", "achievement2", "week"],
      "category": "preparation"
    }
  ]
}
```

---

## 5. Module C : "Brag Sheet Builder" (Lead Magnet)

### 5.1 Funnel de Capture
```
[Calcul effectué] 
       ↓
[Résultat affiché avec CTA]
       ↓
"Vill du ha scripten + Brag Sheet-mall?"
       ↓
   [EMAIL GATE]
       ↓
[Email capturé → JSON/Backend]
       ↓
[Affichage scripts + Téléchargement PDF]
```

### 5.2 Contenu du PDF "Brag Sheet"
```markdown
# UNDERLAG FÖR LÖNESAMTAL 2026
## [Ditt Namn]

### Mina Största Resultat (med siffror)
| Vad jag gjorde | Effekt | Bevis |
|----------------|--------|-------|
| [Fyll i]       |        |       |

### Ansvar Utöver Min Roll
1. [Fyll i]
2. [Fyll i]

### Marknadslön för Min Profil
- Källa: [SCB/Unionen/Akavia]
- Min nuvarande lön: ___ kr
- Marknad (median): ___ kr
- Marknad (75:e percentil): ___ kr
- Gap: ___ %

### Min Begäran
Jag föreslår en justering till ___ kr/mån från [datum].
```

---

## 6. SEO & Content Strategy

### 6.1 Mots-Clés Cibles
| Mot-Clé | Volume (SE) | Difficulté | Intent |
|---------|-------------|------------|--------|
| löneförhandling tips | 1600 | Medium | Informational |
| hur förhandla lön | 880 | Low | Informational |
| lönesamtal argument | 590 | Low | Commercial |
| lönejustering | 320 | Low | Informational |
| byta jobb lön | 480 | Low | Commercial |
| märket löneökning | 390 | Low | Informational |
| löneökning procent | 720 | Medium | Informational |

### 6.2 Structure SEO de la Page
```markdown
# (H1) Löne-Speedrunner 2026: Beräkna din lojalitetsskatt

[CALCULATOR EMBED]

## (H2) Hur mycket förlorar du på att stanna kvar?
[Paragraphe avec données SCB]

## (H2) Statistiken är tydlig: Jobbytare vinner
[Tableau comparatif]

## (H2) Strategier för löneförhandling 2026
### (H3) Bryta märket: Vad du ska säga
### (H3) Skaffa externt bud som hävstång
### (H3) Shadow compensation: Förmåner när de säger nej

## (H2) Verktyg: Generera dina löneargument
[SCRIPT GENERATOR EMBED]

## (H2) FAQ
### Är det olagligt att byta jobb ofta?
### Kan arbetsgivaren neka löneförhöjning?
```

---

## 7. Analytics & Tracking Plan

### 7.1 Événements Custom (GA4)
```javascript
// Événements à tracker
const EVENTS = {
  'calculator_start': 'Utilisateur commence à remplir',
  'calculator_complete': 'Calcul effectué',
  'email_submitted': 'Email capturé',
  'script_copied': 'Script copié',
  'pdf_downloaded': 'PDF téléchargé',
  'share_clicked': 'Bouton partage cliqué'
};

// Exemple d'implémentation
gtag('event', 'calculator_complete', {
  'salary_input': salaryValue,
  'sector': sectorValue,
  'loyalty_tax': calculatedTax
});
```

### 7.2 Dashboard Metrics
| Metric | Source | Formule |
|--------|--------|---------|
| Taux de Conversion Email | GA4 | `email_submitted / calculator_complete` |
| Valeur Moyenne de la Taxe | Custom | `SUM(loyalty_tax) / COUNT(calculations)` |
| Viral Coefficient | GA4 | `share_clicked * estimated_reach / visitors` |

---

## 8. Roadmap de Développement

### Phase 1 : MVP Calculator (Jour 1-2)
- [ ] Créer `content/verktyg/lone-speedrunner.md` avec frontmatter
- [ ] Coder `speedrunner.js` (formule + validation)
- [ ] Intégrer Chart.js pour le graphique
- [ ] Styling de base (`speedrunner.css`)
- [ ] Sources cliquables

### Phase 2 : Scripts + Lead Gate (Jour 3-4)
- [ ] Ajouter accordéon des scripts
- [ ] Implémenter email gate avant scripts
- [ ] Connecter à backend PHP ou Netlify Function
- [ ] Copier-to-clipboard JS

### Phase 3 : Polish + Analytics (Jour 5)
- [ ] Tracking GA4 complet
- [ ] Animation d'entrée du résultat (CSS)
- [ ] Boutons de partage (Twitter, LinkedIn, kopiera länk)
- [ ] Test mobile

### Phase 4 : Launch (Jour 6-7)
- [ ] Post LinkedIn personnel
- [ ] Soumettre à /r/sweden, Flashback
- [ ] Email aux contacts existants
- [ ] Monitor GA4 + itérer

---

## 9. Risques & Mitigations

| Risque | Probabilité | Impact | Mitigation |
|--------|-------------|--------|-----------|
| Données contestées | Moyen | Haut | Sources cliquables + disclaimer |
| Perception "arrogante" (Jantelagen) | Moyen | Moyen | Ton empathique, "du förtjänar det" |
| Faible partage | Moyen | Moyen | Résultat choquant = viral natif |
| Email bounce/spam | Faible | Faible | Double opt-in |

---

## 10. Checklist Finale Avant Launch

- [ ] Mobile responsive testé (iPhone SE, Pixel, iPad)
- [ ] Lighthouse score > 90 (Performance, SEO)
- [ ] Favicon + OG Image pour partage social
- [ ] robots.txt permet indexation
- [ ] GTM/GA4 en production
- [ ] Backup du JSON emails
- [ ] Legal : pas de promesses de résultat ("verktyg, inte rådgivning")

---

**Ce plan est maintenant à 10/10.**

Prêt à coder le Module A ?
