# 📋 Tâche 10: Intégration du Code AdSense

> **Priorité**: 🟢 FINALE  
> **Durée estimée**: 15 min  
> **Statut**: ⬜ À faire (APRÈS approbation)

---

## 🎯 Objectif

Intégrer correctement le code AdSense dans le site une fois l'approbation obtenue.

---

## ⚠️ IMPORTANT : Ordre des Étapes

1. **D'abord** : Compléter TOUTES les tâches précédentes (pages légales, E-E-A-T, technique)
2. **Ensuite** : Soumettre le site à AdSense pour approbation
3. **Après approbation** : Intégrer le code publicitaire

**Ne pas intégrer de publicités avant l'approbation !**

---

## 📋 Étape 1: Code de Vérification AdSense

Lors de la demande d'approbation, Google vous donne un code à placer dans le `<head>` :

```html
<!-- Google AdSense -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
     crossorigin="anonymous"></script>
```

### Où le placer ?

Dans `templates/home.twig` (ou votre layout de base), dans la section `<head>` :

```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    
    <!-- Google AdSense - Code de vérification -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
         crossorigin="anonymous"></script>
    
    <!-- Autres meta tags -->
</head>
```

---

## 📋 Étape 2: Blocs Publicitaires (Après Approbation)

Une fois approuvé, vous pouvez placer des unités publicitaires.

### Emplacements Recommandés

1. **Après le calculateur** (high visibility)
2. **Entre les sections de contenu**
3. **Sidebar sur les pages métiers**
4. **Avant le footer**

### Exemple de Bloc Display

```html
<!-- Bloc publicitaire après le calculateur -->
<div class="ad-container my-8">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
         data-ad-slot="YYYYYYYYYY"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
```

---

## 📋 Étape 3: Ads.txt

Créer un fichier `ads.txt` à la racine du site :

```txt
google.com, pub-XXXXXXXXXXXXXXXX, DIRECT, f08c47fec0942fa0
```

**Emplacement** : `public/ads.txt` ou racine du projet

**Vérification** : `https://raknalon.se/ads.txt`

---

## 🎨 Bonnes Pratiques de Placement

### ✅ Faire

- Placer les pubs après le contenu principal
- Laisser de l'espace autour des pubs
- Utiliser des formats responsifs
- Maximum 3-4 pubs par page
- Étiqueter clairement "Annons" si nécessaire

### ❌ Ne pas faire

- Pub au-dessus du fold qui pousse le contenu
- Trop de pubs (pénalité Google)
- Pub qui ressemble au contenu (trompeuse)
- Pub près des boutons/liens (clics accidentels)
- Pop-ups publicitaires

---

## 📐 Emplacements Suggérés pour raknalon.se

### Homepage

```
┌────────────────────────────────────┐
│  Header + Navigation               │
├────────────────────────────────────┤
│  Calculateur de salaire            │
│  [CONTENU PRINCIPAL]               │
├────────────────────────────────────┤
│  📢 ANNONCE (après calcul)         │
├────────────────────────────────────┤
│  Section "Populära yrken"          │
├────────────────────────────────────┤
│  Section "Så fördelas din lön"     │
├────────────────────────────────────┤
│  📢 ANNONCE (avant FAQ)            │
├────────────────────────────────────┤
│  FAQ Section                       │
├────────────────────────────────────┤
│  Footer                            │
└────────────────────────────────────┘
```

### Pages Métiers

```
┌────────────────────────────────────┐
│  Header + Navigation               │
├────────────────────────────────────┤
│  Titre du métier + Stats           │
├────────────────────────────────────┤
│  Calculateur contextuel            │
├──────────────────────┬─────────────┤
│  Contenu principal   │ Sidebar     │
│  [Description,       │ 📢 ANNONCE  │
│   Spécialités,       │             │
│   FAQ]               │             │
├──────────────────────┴─────────────┤
│  📢 ANNONCE (bas de page)          │
├────────────────────────────────────┤
│  Footer                            │
└────────────────────────────────────┘
```

---

## ✅ Critères d'Acceptation

- [ ] Code de vérification AdSense dans le `<head>`
- [ ] Fichier `ads.txt` créé et accessible
- [ ] Maximum 3-4 emplacements publicitaires identifiés
- [ ] Pubs placées APRÈS le contenu principal
- [ ] Formats responsifs utilisés
- [ ] Pas de placement trompeur

---

## 🚨 Avertissement

**Si le site est rejeté** :
1. Lire attentivement l'email de rejet
2. Corriger les problèmes identifiés
3. Attendre 2-4 semaines avant de re-soumettre
4. Ne PAS spammer les re-soumissions

**Raisons courantes de rejet** :
- Contenu insuffisant (35 pages devraient suffire ✓)
- Pages légales manquantes
- Site en construction
- Trop de publicités existantes (autres régies)
- Navigation confuse
