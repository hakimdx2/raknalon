# 03 - Compliance Adtraction & Partenaires

> **DOCUMENT CRITIQUE** : Non-respect = Suspension du compte Adtraction
> 
> **Fichier footer** : `templates/home.twig` (lignes 368-416)

---

## ⚠️ Avertissement

> [!CAUTION]
> Ce document contient les exigences légales **OBLIGATOIRES**.
> 
> Tout manquement peut entraîner :
> - Suspension immédiate du compte Adtraction
> - Annulation des commissions en attente
> - Blacklist définitif du réseau
> - Poursuites légales (Konsumentkreditlagen pour Compricer)

---

## 📋 Checklist Compliance Globale

| Exigence                   | Fichier              | Position Exacte             | Statut          |
| -------------------------- | -------------------- | --------------------------- | --------------- |
| Disclaimer Footer          | `home.twig`          | Ligne 412 (avant copyright) | ⬜ À implémenter |
| Marquage "Annons" Widget 2 | `profession.twig`    | Widget Unionen              | ⬜ À implémenter |
| Marquage "Annons" Widget 3 | `profession.twig`    | Widget Compricer            | ⬜ À implémenter |
| Warning Crédit Compricer   | `profession.twig`    | Widget Compricer            | ⬜ À implémenter |
| Liens `rel="sponsored"`    | Tous widgets         | Tous liens affiliés         | ⬜ À implémenter |
| Page Cookies               | `/cookies`           | Existante                   | ✅ OK            |
| Page Intégrité             | `/integritetspolicy` | Existante                   | ✅ OK            |

---

## 1️⃣ Disclaimer Footer (Global)

### Exigence Légale

Mention obligatoire sur **toutes les pages** du site indiquant la nature commerciale des recommandations.

### Emplacement Exact dans le Code

```
Fichier: templates/home.twig
Position: Ligne 412, AVANT le bloc copyright existant:
   <div class="mt-10 border-t border-slate-100 pt-8">
```

### Texte Suédois Validé

> **Om denna webbplats:** Räkna Lön drivs av [NOM ÉDITEUR] och innehåller affiliatelänkar. Det innebär att vi kan få ersättning om du klickar på en länk och genomför ett köp eller registrering. Detta påverkar inte våra redaktionella bedömningar eller den information vi presenterar. Lönestatistik kommer från Statistiska centralbyrån (SCB) och är oberoende av våra kommersiella samarbeten.

### Traduction (Référence)

> "À propos de ce site : Räkna Lön est géré par [NOM] et contient des liens d'affiliation. Cela signifie que nous pouvons recevoir une commission si vous cliquez sur un lien et effectuez un achat ou une inscription. Cela n'affecte pas nos évaluations éditoriales ni les informations que nous présentons. Les statistiques salariales proviennent de l'Office central des statistiques (SCB) et sont indépendantes de nos partenariats commerciaux."

### Style Recommandé

| Propriété                  | Valeur                                   |
| -------------------------- | ---------------------------------------- |
| Container                  | `bg-slate-50 rounded-lg p-4 mt-8 mb-4`   |
| Texte                      | `text-xs text-slate-500 leading-relaxed` |
| Titre "Om denna webbplats" | `font-semibold text-slate-600`           |

---

## 2️⃣ Marquage Publicité (Widgets 2 & 3)

### Exigence Légale

Chaque contenu sponsorisé/affilié doit être **clairement identifié** comme tel selon la Marknadsföringslagen (2008:486).

### Position

En-tête de chaque widget affilié, **visible immédiatement** sans scroll.

### Textes Acceptés

| Option             | Texte                                                                      | Usage                 |
| ------------------ | -------------------------------------------------------------------------- | --------------------- |
| **A (Recommandé)** | Annons                                                                     | Badge discret, clair  |
| **B (Développé)**  | Inlägget innehåller reklam genom annonslänkar till våra samarbetspartners. | Paragraphe explicatif |

### Style Badge "Annons"

| Propriété  | Valeur                                           |
| ---------- | ------------------------------------------------ |
| Background | `bg-slate-100` ou `bg-slate-200`                 |
| Text       | `text-slate-600`                                 |
| Font       | `text-xs font-medium uppercase tracking-wide`    |
| Padding    | `px-2 py-0.5`                                    |
| Border     | `rounded`                                        |
| Position   | Coin supérieur droit du widget ou avant le titre |

---

## 3️⃣ Warning Crédit Compricer (Widget 3 UNIQUEMENT)

### Base Légale

**Konsumentkreditlagen (2010:1846)** exige un exemple représentatif chiffré pour toute publicité de crédit à la consommation en Suède.

### Position Obligatoire

**Sous** le bouton CTA du Widget 3, **avant** que l'utilisateur ne clique.

### Texte Légal Obligatoire

> ⚠️ **Räkneexempel:** Lån 150 000 kr, löptid 10 år, rörlig ränta 8,90%, uppläggningsavgift 495 kr, aviavgift 35 kr/mån. Effektiv ränta 10,44%. Totalt att betala 197 743 kr.

### Paramètres du Calcul

| Paramètre             | Valeur            | Note                       |
| --------------------- | ----------------- | -------------------------- |
| Montant emprunté      | 150 000 kr        | Exemple représentatif      |
| Durée                 | 10 ans (120 mois) | Standard                   |
| Taux nominal          | 8,90%             | ⚠️ À vérifier sur Compricer |
| Frais de dossier      | 495 kr            | ⚠️ À vérifier sur Compricer |
| Frais mensuels        | 35 kr/mois        | ⚠️ À vérifier sur Compricer |
| TAEG (Effektiv ränta) | 10,44%            | Calculé                    |
| Total à rembourser    | 197 743 kr        | Calculé                    |

> [!WARNING]
> Ces chiffres **doivent être mis à jour** régulièrement (minimum trimestriel) selon les conditions actuelles de Compricer. Un exemple obsolète = non-conformité légale.

### Style du Warning

| Propriété | Valeur                                             |
| --------- | -------------------------------------------------- |
| Container | `bg-amber-50 border-l-4 border-amber-400 p-4 mt-4` |
| Icône     | ⚠️ (emoji Unicode)                                  |
| Titre     | `font-semibold text-amber-800`                     |
| Texte     | `text-sm text-amber-700 leading-relaxed`           |

---

## 4️⃣ Attributs des Liens Affiliés

### Exigence SEO & Légale

Les liens affiliés doivent signaler leur nature commerciale à Google via l'attribut `rel`.

### Format Obligatoire

| Attribut         | Valeur                   | Raison                                  |
| ---------------- | ------------------------ | --------------------------------------- |
| `rel`            | `sponsored`              | Indique à Google que c'est un lien payé |
| `rel`            | `noopener`               | Sécurité (empêche `window.opener`)      |
| `target`         | `_blank`                 | UX : ouvre dans un nouvel onglet        |
| `data-affiliate` | `unionen` ou `compricer` | Analytics interne                       |

### Exemple Complet

```
href="[URL Adtraction]"
rel="sponsored noopener"
target="_blank"
data-affiliate="unionen"
```

---

## 5️⃣ Règles Spécifiques par Partenaire

### Unionen

| Règle            | Détail                                                 | Risque si non-respect |
| ---------------- | ------------------------------------------------------ | --------------------- |
| Mention "Annons" | Obligatoire et visible                                 | Suspension compte     |
| Promesses        | ❌ Ne jamais promettre d'augmentation garantie          | Suspension + litige   |
| Logo             | Uniquement versions officielles (Adtraction Creatives) | Suspension            |
| Liens            | Uniquement via dashboard Adtraction                    | Commissions annulées  |
| Contexte         | Ne pas associer à contenu négatif sur syndicats        | Suspension            |

### Compricer

| Règle            | Détail                                             | Risque si non-respect |
| ---------------- | -------------------------------------------------- | --------------------- |
| Warning Crédit   | **OBLIGATOIRE** avec exemple chiffré complet       | Illégal en Suède      |
| Mention "Annons" | Obligatoire                                        | Suspension            |
| "Meilleur taux"  | ❌ Ne jamais affirmer sans justification vérifiable | Litige commercial     |
| Actualisation    | Taux/exemples doivent être à jour                  | Non-conformité légale |
| Comparaison      | Ne pas dénigrer les banques                        | Suspension            |

---

## 6️⃣ Checklist Avant Mise en Production

### Vérifications Techniques

```
□ Footer disclaimer présent dans home.twig (L.412)
□ Disclaimer visible sur TOUTES les pages (extends home.twig)
□ Badge "Annons" en haut de chaque widget affilié
□ Warning crédit complet et visible sous le CTA Compricer
□ Tous les liens affiliés ont rel="sponsored noopener"
□ Tous les liens ont target="_blank"
□ Attributs data-affiliate présents pour analytics
```

### Vérifications Visuelles

```
□ Badge "Annons" lisible sans scroll
□ Warning crédit lisible (contraste suffisant)
□ Disclaimer footer visible sur mobile
□ Widgets ne masquent pas le contenu principal
```

### Vérifications Fonctionnelles

```
□ Cliquer sur lien Unionen → Tracking Adtraction fonctionne
□ Cliquer sur lien Compricer → Tracking Adtraction fonctionne
□ Vérifier dans dashboard Adtraction que les clics remontent
```

---

## 📞 Contacts en Cas de Doute

| Sujet                           | Contact                                       |
| ------------------------------- | --------------------------------------------- |
| Questions compliance Adtraction | publisher@adtraction.com                      |
| Mise à jour exemple crédit      | Vérifier dashboard Compricer                  |
| Logo/Assets Unionen             | Section "Creatives" dans dashboard Adtraction |
| Questions légales Suède         | Konsumentverket (référence)                   |

---

## 📚 Références Légales

| Loi                                  | Applicabilité                             |
| ------------------------------------ | ----------------------------------------- |
| **Marknadsföringslagen (2008:486)**  | Obligation de transparence publicitaire   |
| **Konsumentkreditlagen (2010:1846)** | Obligation d'exemple chiffré pour crédits |
| **IAB Sweden Guidelines**            | Bonnes pratiques affiliation              |
| **Google Webmaster Guidelines**      | Attribut `rel="sponsored"`                |

---

## 🔄 Maintenance Requise

| Tâche                                   | Fréquence                | Responsable |
| --------------------------------------- | ------------------------ | ----------- |
| Vérifier taux Compricer                 | Trimestriel              | À définir   |
| Vérifier statut partenariats Adtraction | Mensuel                  | À définir   |
| Audit visuel compliance                 | Avant chaque déploiement | À définir   |
| Backup des creatives partenaires        | Lors de mise à jour      | À définir   |

---

*Document mis à jour le 2026-01-12 - Projet Raknalon.se - Compliance v2.0*
*Basé sur analyse de `home.twig` (footer L.368-416) et législation suédoise en vigueur*

> [!IMPORTANT]
> Ce document doit être **relu avant chaque déploiement** pour s'assurer que les textes légaux sont correctement implémentés.
