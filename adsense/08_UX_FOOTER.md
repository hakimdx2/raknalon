# 📋 Tâche 08: Footer Complet avec Liens Légaux

> **Priorité**: 🔴 CRITIQUE  
> **Durée estimée**: 30 min  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Modifier le footer du site pour inclure tous les liens légaux obligatoires. C'est ce que AdSense vérifie en premier !

---

## 📝 Pourquoi c'est Critique

- **AdSense vérifie le footer** : C'est l'emplacement standard des liens légaux
- **Toutes les pages** : Le footer est présent partout, donc liens visibles partout
- **Professionnalisme** : Un footer complet = site sérieux
- **Navigation** : Aide les utilisateurs à trouver les infos importantes

---

## 📄 Fichiers à Modifier

### 1. Template Principal
```
templates/home.twig (le layout de base avec le footer)
```

Si vous avez un layout séparé, modifier :
```
templates/layout.twig ou templates/base.twig
```

---

## 📋 Footer Actuel vs Footer Requis

### Footer Actuel (Incomplet)
```
Tjänster | Populära yrken | Information | Fler yrken
```

### Footer Requis (Complet)
```
Tjänster | Populära yrken | Information | Juridiskt | Fler yrken
```

Avec une nouvelle section **Juridiskt** contenant :
- Integritetspolicy
- Cookiepolicy
- Ansvarsfriskrivning
- Om oss
- Kontakt

---

## 🔧 Code à Implémenter

### Nouveau bloc à ajouter dans le footer

```html
<!-- Dans la grille du footer, ajouter cette colonne -->
<div>
    <h3 class="text-sm font-semibold text-slate-900">Juridiskt</h3>
    <ul role="list" class="mt-4 space-y-4">
        <li>
            <a href="/integritetspolicy" class="text-sm text-slate-600 hover:text-indigo-600">
                Integritetspolicy
            </a>
        </li>
        <li>
            <a href="/cookies" class="text-sm text-slate-600 hover:text-indigo-600">
                Cookiepolicy
            </a>
        </li>
        <li>
            <a href="/ansvarsfriskrivning" class="text-sm text-slate-600 hover:text-indigo-600">
                Ansvarsfriskrivning
            </a>
        </li>
        <li>
            <a href="/om-oss" class="text-sm text-slate-600 hover:text-indigo-600">
                Om oss
            </a>
        </li>
        <li>
            <a href="/kontakt" class="text-sm text-slate-600 hover:text-indigo-600">
                Kontakt
            </a>
        </li>
    </ul>
</div>
```

### Modifier la grille CSS

Passer de `grid-cols-4` à `grid-cols-5` :

```html
<!-- Avant -->
<div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4">

<!-- Après -->
<div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-5">
```

### Ligne de copyright mise à jour

```html
<div class="mt-8 border-t border-slate-100 pt-8 text-center">
    <p class="text-xs text-slate-500">
        © 2026 Raknalon.se. Alla rättigheter förbehållna.
        <span class="mx-2">|</span>
        <a href="/integritetspolicy" class="hover:text-indigo-600">Integritetspolicy</a>
        <span class="mx-2">|</span>
        <a href="/cookies" class="hover:text-indigo-600">Cookies</a>
    </p>
</div>
```

---

## ✅ Critères d'Acceptation

- [ ] Nouvelle colonne "Juridiskt" ajoutée au footer
- [ ] Lien vers `/integritetspolicy` présent
- [ ] Lien vers `/cookies` présent
- [ ] Lien vers `/ansvarsfriskrivning` présent
- [ ] Lien vers `/om-oss` présent
- [ ] Lien vers `/kontakt` présent
- [ ] Grille ajustée pour 5 colonnes sur desktop
- [ ] Liens visibles dans la ligne de copyright
- [ ] Footer cohérent sur toutes les pages du site

---

## 📸 Mockup du Nouveau Footer

```
┌────────────────────────────────────────────────────────────────────┐
│  raknalon.se                                                       │
│  Svensk lönekalkylator och lönestatistik.                         │
│                                                                    │
│  ┌──────────┬──────────────┬────────────┬──────────┬─────────────┐ │
│  │ Tjänster │ Populära     │Information │ Juridiskt│ Fler yrken  │ │
│  │          │ yrken        │            │          │             │ │
│  │ Räkna ut │ Sjuksköt. lön│ Brutto vs  │ Integ.pol│ Läkare lön  │ │
│  │ lön      │ Lärare lön   │ Netto      │ Cookies  │ Undersk. lön│ │
│  │ Alla     │ Polis lön    │ Jobbskatte-│ Ansvar.  │ Rörmokare   │ │
│  │ yrken    │ Elektr. lön  │ avdrag     │ Om oss   │ Lokförare   │ │
│  │          │              │ Statlig    │ Kontakt  │             │ │
│  │          │              │ skatt      │          │             │ │
│  └──────────┴──────────────┴────────────┴──────────┴─────────────┘ │
│                                                                    │
│  ──────────────────────────────────────────────────────────────── │
│  © 2026 Raknalon.se | Integritetspolicy | Cookies                 │
└────────────────────────────────────────────────────────────────────┘
```

---

## ⚠️ Points d'Attention

1. **Ordre des colonnes** : Juridiskt doit être clairement visible
2. **Mobile** : Vérifier que ça s'affiche bien en 2 colonnes sur mobile
3. **Liens actifs** : Les pages doivent exister avant d'y linker (sinon 404)
4. **Consistance** : Appliquer le même footer à TOUTES les pages

---

## 🔗 Dépendances

Cette tâche dépend de :
- [x] Tâche 01 : Page Integritetspolicy
- [x] Tâche 02 : Page Om oss
- [x] Tâche 03 : Page Kontakt
- [x] Tâche 04 : Page Cookies
- [x] Tâche 05 : Page Ansvarsfriskrivning

**Note** : Vous pouvez préparer le footer avec les liens même si les pages ne sont pas encore créées, mais attention aux erreurs 404 lors des tests AdSense.
