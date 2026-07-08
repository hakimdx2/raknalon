# 📋 Tâche 06: Citer les Sources Officielles (E-E-A-T)

> **Priorité**: 🟡 IMPORTANT  
> **Durée estimée**: 45 min  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Ajouter des citations de sources officielles sur toutes les pages de contenu pour renforcer l'autorité (Authoritativeness) et la confiance (Trustworthiness) du site.

---

## 📝 Pourquoi c'est Crucial pour E-E-A-T

Google utilise **E-E-A-T** (Experience, Expertise, Authoritativeness, Trustworthiness) pour évaluer les sites YMYL :

| Signal            | Problème Actuel              | Solution                            |
| ----------------- | ---------------------------- | ----------------------------------- |
| Expertise         | Aucun expert cité            | Mentionner les sources officielles  |
| Authoritativeness | Nouveau domaine              | Liens vers Skatteverket, SCB        |
| Trustworthiness   | Origine inconnue des données | Afficher d'où viennent les chiffres |

---

## 📄 Fichiers à Modifier

### 1. Templates à mettre à jour
```
templates/home.twig (ajouter section sources)
templates/profession.twig (ajouter bloc sources par métier)
templates/concepts/*.twig (ajouter références)
```

### 2. Données à enrichir (optionnel)
```
data/professions.json (ajouter champ "source" si pertinent)
```

---

## 📋 Actions Requises

### A. Page d'Accueil (home.twig)

Ajouter un bloc "Sources" près du calculateur :

```html
<aside class="sources-box bg-slate-50 rounded-lg p-4 mt-6">
  <h3 class="text-sm font-semibold text-slate-700">Källor</h3>
  <ul class="text-xs text-slate-500 mt-2 space-y-1">
    <li>Skattesatser: <a href="https://www.skatteverket.se" class="text-indigo-600">Skatteverket</a></li>
    <li>Jobbskatteavdrag: <a href="https://www.skatteverket.se/jobbskatteavdrag" class="text-indigo-600">Skatteverket 2026</a></li>
    <li>Kommunalskatt: <a href="https://www.scb.se" class="text-indigo-600">SCB</a></li>
  </ul>
  <p class="text-xs text-slate-400 mt-2">Senast uppdaterad: Januari 2026</p>
</aside>
```

### B. Pages Métiers (profession.twig)

Ajouter un encadré sources pour chaque page métier :

```html
<div class="profession-sources border-l-4 border-indigo-500 pl-4 mt-8">
  <h4 class="text-sm font-semibold text-slate-700">Så har vi räknat</h4>
  <p class="text-sm text-slate-600">
    Lönestatistiken baseras på data från 
    <a href="https://www.scb.se/hitta-statistik/statistik-efter-amne/arbetsmarknad/loner-och-arbetskostnader/" 
       class="text-indigo-600 underline" rel="noopener" target="_blank">SCB Lönestatistik</a> 
    och kollektivavtal.
  </p>
  <p class="text-xs text-slate-400 mt-1">Data för 2025/2026.</p>
</div>
```

### C. Pages Concepts (brutto-netto.twig, etc.)

Ajouter des références inline et un bloc sources :

```html
<!-- Dans le texte -->
<p>Enligt <a href="https://www.skatteverket.se">Skatteverket</a>, är jobbskatteavdraget...</p>

<!-- En fin de page -->
<footer class="sources mt-8 pt-4 border-t border-slate-200">
  <p class="text-xs text-slate-500">
    <strong>Referenser:</strong> Skatteverket (2026), SCB Lönestatistik, 
    Ekonomifakta.
  </p>
</footer>
```

---

## ✅ Critères d'Acceptation

- [ ] Bloc "Källor" visible sur la homepage
- [ ] Lien vers Skatteverket sur chaque page de calcul
- [ ] Lien vers SCB sur les pages métiers
- [ ] Date de mise à jour des données visible
- [ ] Liens `rel="noopener"` et `target="_blank"` pour les externes
- [ ] Attribut `title` descriptif sur les liens

---

## 🔗 Sources à Citer

| Source       | URL                         | Utilisation                         |
| ------------ | --------------------------- | ----------------------------------- |
| Skatteverket | https://www.skatteverket.se | Taux d'imposition, jobbskatteavdrag |
| SCB          | https://www.scb.se          | Statistiques salariales             |
| SKR          | https://skr.se              | Taux de taxes communales            |
| Ekonomifakta | https://www.ekonomifakta.se | Contexte économique                 |

---

## 💡 Bonnes Pratiques

1. **Liens directs** : Pointez vers les pages spécifiques, pas juste la homepage
2. **Mise à jour** : Indiquez quand les données ont été mises à jour
3. **Disclaimer** : Précisez que ce sont des estimations basées sur ces sources
4. **Nofollow** : Non nécessaire pour les sites gouvernementaux officiels

---

## 📸 Exemple Visuel

```
┌─────────────────────────────────────────────────┐
│  CALCULATEUR DE SALAIRE                         │
│  [... interface du calculateur ...]             │
│                                                 │
│  ┌───────────────────────────────────────────┐  │
│  │ 📚 Källor                                 │  │
│  │ • Skattesatser: Skatteverket              │  │
│  │ • Lönestatistik: SCB                      │  │
│  │ • Kommunalskatt: SKR                      │  │
│  │                                           │  │
│  │ Uppdaterad: Januari 2026                  │  │
│  └───────────────────────────────────────────┘  │
└─────────────────────────────────────────────────┘
```

---

## 🎯 Impact Attendu

- **SEO** : Meilleur classement pour les requêtes YMYL
- **AdSense** : Site perçu comme plus fiable
- **Utilisateurs** : Confiance accrue dans les calculs
- **Juridique** : Protection en cas de contestation
