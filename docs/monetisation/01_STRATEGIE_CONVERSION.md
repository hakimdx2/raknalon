# 01 - Stratégie de Conversion : Le Tunnel Psychologique

> **Contexte Projet** : Site `raknalon.se` - Calculateur de salaire suédois avec données SCB (Statistiska centralbyrån)
> 
> **Pages cibles** : `/lon/{slug}` → Template `profession.twig` (785 lignes)

---

## 🎯 Objectif Principal

**Transformer le trafic informatif (données SCB) en revenu d'affiliation (CPA)**

Le site génère du trafic qualifié via des pages de données salariales. Ce trafic est composé de visiteurs en phase de **recherche d'information** sur leur valeur professionnelle.

Notre mission : **activer des besoins latents** pour les convertir en leads qualifiés.

### 🔌 Principe Fondamental : Widgets Autonomes

> **Chaque widget est indépendant et désactivable à volonté.**

| Règle                 | Description                                                        |
| --------------------- | ------------------------------------------------------------------ |
| **Autonomie totale**  | Widget 1, 2 et 3 fonctionnent sans dépendance mutuelle             |
| **Toggle individuel** | Un fichier `data/widgets_config.json` contrôle l'activation        |
| **Zéro impact**       | Désactiver un widget n'affecte ni le contenu ni les autres widgets |

---

## 🧠 Le Tunnel Psychologique en 4 Étapes

```
┌─────────────────────────────────────────────────────────────────────────┐
│  ÉTAPE 1: INFORMATION                                                    │
│  "Je veux savoir combien gagne un/une [profession]"                     │
│  → Le visiteur arrive via Google (requête informationnelle)              │
│  → Page: /lon/{slug} - Données SCB affichées                            │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  ÉTAPE 2: ACTIVATION DU BESOIN DE JUSTICE                               │
│  "Est-ce que JE suis payé à ma juste valeur ?"                          │
│  → Widget 1: Simulateur de Salaire Attendu                               │
│  → Emplacement: Après la section #lonestatistik                         │
│  → Variables dispo: profession.scb.salary_total, profession.median_salary│
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  ÉTAPE 3: ACTIVATION DU BESOIN DE PROTECTION                            │
│  "Si je suis sous-payé, comment améliorer ma situation ?"               │
│  → Widget 2: CTA Adhésion Syndicat (Unionen via Adtraction)             │
│  → Emplacement: Après la section #faq                                    │
│  → Trigger: Besoin de négociation collective                             │
└─────────────────────────────────────────────────────────────────────────┘
                                    │
                                    ▼
┌─────────────────────────────────────────────────────────────────────────┐
│  ÉTAPE 4: ACTIVATION DU BESOIN DE PROJET                                │
│  "Mon salaire me permet d'emprunter combien ?"                          │
│  → Widget 3: Comparateur de Prêt (Compricer via Adtraction)             │
│  → Emplacement: Avant la section "Liknande yrken" (related_professions) │
│  → Input pré-rempli: profession.median_salary                            │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## 📊 Structure Actuelle de la Page Profession

Basé sur l'analyse de `templates/profession.twig` :

| Section DOM     | ID/Classe                    | Contenu                             | Widget Potentiel |
| --------------- | ---------------------------- | ----------------------------------- | ---------------- |
| Hero            | `.text-center.mb-12`         | Titre H1 + badges                   | -                |
| Stats Grid      | `.grid.grid-cols-3`          | Snittlön, Medianlön, Löneutveckling | -                |
| Gender Gap      | `.bg-white.rounded-2xl`      | Barres hommes/femmes (si SCB)       | -                |
| Historique      | `#salaryHistoryChart`        | Chart.js 10 ans (si SCB)            | -                |
| Calculateur     | `.bg-indigo-900.rounded-2xl` | Calcul nettolön existant            | -                |
| Article         | `#om-yrket`                  | Description métier                  | -                |
| Utbildning      | `#utbildning`                | Formation requise                   | -                |
| Spécialisations | `#specialisering`            | Salaires par spécialité             | -                |
| Secteur         | `#sektor`                    | Public/Privé/Kommunal               | -                |
| **Facteurs**    | **`#lonestatistik`**         | Facteurs influençant le salaire     | **→ WIDGET 1**   |
| **FAQ**         | **`#faq`**                   | Questions fréquentes                | **→ WIDGET 2**   |
| Kommunal CTA    | `.bg-indigo-50`              | Lien vers /kommunal                 | -                |
| Blog Related    | Section conditionnelle       | Articles liés                       | -                |
| **Professions** | **`related_professions`**    | Métiers similaires                  | **→ WIDGET 3**   |

---

## 👤 Persona Type

| Attribut          | Valeur                                         |
| ----------------- | ---------------------------------------------- |
| **Qui**           | Salarié suédois, 25-55 ans                     |
| **Requête type**  | `[profession] lön`, `[profession] lön 2025`    |
| **Intention**     | Comparer son salaire, préparer une négociation |
| **État mental**   | Curieux → Comparatif → Potentiellement frustré |
| **Volume estimé** | 720 recherches/mois pour "unionen lön" seul    |

---

## 💰 Modèle de Revenus

### Partenaires Adtraction Ciblés

| Partenaire    | Type CPA          | Estimation/Lead | Pertinence Raknalon           |
| ------------- | ----------------- | --------------- | ----------------------------- |
| **Unionen**   | Adhésion syndicat | ~150-300 SEK    | ⭐⭐⭐⭐⭐ Parfait (même audience) |
| **Compricer** | Demande de prêt   | ~50-150 SEK     | ⭐⭐⭐⭐ Bon (contexte salarial)  |

### KPIs à Implémenter

1. **CTR Widget** : `data-affiliate="unionen"` / `data-affiliate="compricer"` pour tracking
2. **Conversion Rate** : Suivi via dashboard Adtraction
3. **Revenue per Visit (RPV)** : À calculer post-lancement
4. **Best Performing Pages** : Métiers à fort trafic + bon taux de conversion

---

## 🔄 Principe de Non-Interruption

> **Règle d'or** : Les widgets doivent **enrichir** l'expérience, pas l'interrompre.

| ❌ Interdit           | ✅ Recommandé                            |
| -------------------- | --------------------------------------- |
| Pop-up intrusif      | Intégration native dans le flux         |
| Contenu bloquant     | Design cohérent (Tailwind existant)     |
| CTA criards          | Valeur ajoutée perçue par l'utilisateur |
| Publicité dissimulée | Mention "Annons" claire                 |

---

## 📈 Potentiel de Scaling

Une fois le modèle validé sur `/lon/{slug}`, réplication possible sur :

1. **Toutes les pages professions** (~300+ métiers dans `professions.json`)
2. **Pages Kommunal** (`/lon/{slug}/kommunal` - template `profession_kommunal.twig`)
3. **Pages par Län** (`/lon/lan/{code}` - template `lan.twig`)
4. **Articles blog** (si section blog activée)

---

## 📁 Fichiers Projet Concernés

| Fichier            | Chemin                            | Modification Requise         |
| ------------------ | --------------------------------- | ---------------------------- |
| Template principal | `templates/profession.twig`       | Ajout des 3 widgets          |
| Layout/Footer      | `templates/home.twig` (L.368-416) | Ajout disclaimer affilié     |
| Données métiers    | `data/professions.json`           | Aucune (lecture seule)       |
| CSS                | `css/app.css`                     | Styles widgets si nécessaire |

---

*Document mis à jour le 2026-01-12 - Projet Raknalon.se - Stratégie Monétisation v2.0*
*Basé sur analyse réelle de `profession.twig` (785 lignes) et `home.twig` (420 lignes)*
