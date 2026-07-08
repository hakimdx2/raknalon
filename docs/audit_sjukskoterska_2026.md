# Audit SEO : Page "Sjuksköterska" (Lön 2026)

**URL Cible :** `/lon/sjukskoterska`
**Référentiel :** [Check-list SEO Leak 2024](docs/seo_leak_checklist_2024.md)

---

## 🟢 Points Forts (Conformes)

### 1. Signaux NavBoost & UX (Tier 1)
*   **Satisfying Intent (`goodClicks`)** : La page répond immédiatement à la question principale ("Combien on gagne") avec un **tableau récapitulatif** ("Stats Grid") visible sans scroller.
*   **Interactive Elements** : Le **calculateur de salaire** et la **Table des matières (ToC) sticky** encouragent l'interaction (Dwell Time positif).
*   **Call to Action (CTA)** : Les boutons "Hitta jobb" (Indeed, AF) apportent une utilité réelle (Utility Score).

### 2. Qualité du Contenu & Focus (Tier 2)
*   **Topical Focus (`siteFocusScore`)** : Le contenu est 100% aligné sur la thématique "Salaire & Carrière". Pas de dérive hors sujet.
*   **Sémantique (`pageEmbeddings`)** : Utilisation riche de termes connexes : "specialistsjuksköterska", "ob-tillägg", "legitimation", "norge".
*   **Structure FAQ** : 14 questions/réponses balisées avec `FAQPage` Schema, idéal pour les Featured Snippets.

### 3. Données Structurées (Partiel)
*   **Occupation Schema** : Implémentation correcte avec `estimatedSalary` (basé sur les percentiles SCB) et `occupationLocation`.

---

## 🔴 Points Critiques à Corriger (Non-Conformes)

### 1. Signal de Fraîcheur & Dates (Tier 2 - Critical) 🚨
*   **Problème :** Le titre et le texte promettent "Lön 2026", mais **aucune date explicite** n'est visible pour Google.
*   **Critère Manquant (`bylineDate` / `semanticDate`)** : Le template `profession.twig` n'inclut PAS le schema `Article` avec `datePublished` ou `dateModified`.
*   **Risque :** Google peut considérer le contenu comme "daté" malgré les chiffres mis à jour, car il ne voit pas de signal temporel fort ("Freshness Twiddler").
*   **Action :** Ajouter le Schema `Article` ou `TechArticle` avec les dates dynamiques.

### 2. Auteur & EEAT (Tier 2) 🚨
*   **Problème :** Aucun auteur humain ou organisationnel n'est explicitement lié à cette page via les données structurées.
*   **Critère Manquant (`authorSN` / `isAuthor`)** : Absence de la propriété `author` dans le balisage.
*   **Action :** Ajouter une propriété `author` (Organization: Raknalon) dans le Schema pour renforcer la crédibilité.

### 3. Cohérence du Titre (NavBoost)
*   **Observation :** Le mot clé principal est "Sjuksköterska Lön".
*   **Optimisation :** Vérifier que le `<title>` commence bien par le mot-clé principal pour maximiser le `titleMatchScore` (vecteur requête/titre).
    *   *Actuel (estimé)* : "Hur mycket tjänar en Sjuksköterska?" (H1)
    *   *Recommandé (Title Tag)* : "Sjuksköterska Lön 2026: Snittlön & Ingångslön (Statistik)"

---

## 📋 Plan d'Action Immédiat

1.  **Mise à jour Template (`profession.twig`)** :
    *   [ ] Injecter le Schema `Article` (en plus de `Occupation`).
    *   [ ] Définir `datePublished` (fixe ou dynamique année en cours) et `dateModified` (date de génération des données).
    *   [ ] Ajouter `author` : "Räkna Lön" (Organization).

2.  **Contenu Visible** :
    *   [ ] Ajouter une petite ligne sous le H1 : *"Senast uppdaterad: 14 januari 2026"* (Renforce le signal `bylineDate` visible).

3.  **Liens Internes** :
    *   [ ] Vérifier que la page reçoit des liens depuis la page d'accueil (Tier 1 link juice) pour booster son `PageRank`.
