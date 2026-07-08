# 02 - Spécifications Techniques des Widgets

> **Fichier cible** : `templates/profession.twig`
> 
> **Variables Twig disponibles** : `profession.title`, `profession.slug`, `profession.median_salary`, `profession.avg_salary`, `profession.scb.salary_total`, `profession.scb.salary_men`, `profession.scb.salary_women`

---

## 🔌 Principe d'Autonomie & Désactivation

> [!IMPORTANT]
> **Chaque widget DOIT être autonome et désactivable indépendamment.**

### Architecture Requise

| Principe                | Description                                                       |
| ----------------------- | ----------------------------------------------------------------- |
| **Autonomie**           | Chaque widget fonctionne seul, sans dépendance aux autres widgets |
| **Toggle On/Off**       | Désactivation possible sans toucher au code, via configuration    |
| **Fallback gracieux**   | Si désactivé, aucun espace vide ni erreur visible                 |
| **Pas d'effet de bord** | Désactiver Widget 2 ne casse pas Widget 1 ou 3                    |

### Mécanisme de Contrôle Recommandé

**Option A : Variable d'environnement / Config**

| Variable                    | Type    | Défaut | Description               |
| --------------------------- | ------- | ------ | ------------------------- |
| `WIDGET_SIMULATEUR_ENABLED` | boolean | `true` | Active/désactive Widget 1 |
| `WIDGET_UNIONEN_ENABLED`    | boolean | `true` | Active/désactive Widget 2 |
| `WIDGET_COMPRICER_ENABLED`  | boolean | `true` | Active/désactive Widget 3 |

**Option B : Fichier JSON de configuration**

```
data/widgets_config.json
{
  "simulateur": { "enabled": true },
  "unionen": { "enabled": true },
  "compricer": { "enabled": true }
}
```

### Implémentation Twig Attendue

Chaque widget doit être wrappé dans une condition :

```
{% if widgets.simulateur.enabled %}
    {# Widget 1 #}
{% endif %}

{% if widgets.unionen.enabled %}
    {# Widget 2 #}
{% endif %}

{% if widgets.compricer.enabled %}
    {# Widget 3 #}
{% endif %}
```

### Cas d'Usage de Désactivation

| Scénario                         | Widgets à désactiver | Raison               |
| -------------------------------- | -------------------- | -------------------- |
| Suspension Adtraction temporaire | Widget 2 & 3         | Éviter liens morts   |
| A/B Testing                      | Widget 1 seul        | Mesurer impact       |
| Problème légal Compricer         | Widget 3             | Conformité urgente   |
| Période de test initial          | Tous                 | Lancement progressif |

---

## Vue d'Ensemble des Emplacements

```
┌─────────────────────────────────────────────────────────────────────────┐
│  PAGE /lon/{slug}  (profession.twig)                                     │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│  [Hero + Stats Grid]                   ← Lignes 114-187                  │
│                                                                          │
│  [Gender Gap + Historique SCB]         ← Lignes 196-338 (si SCB)        │
│                                                                          │
│  [Calculateur Nettolön existant]       ← Lignes 340-382                  │
│                                                                          │
│  [Article #om-yrket]                   ← Lignes 384-548                  │
│      ├── #utbildning                                                     │
│      ├── #specialisering                                                 │
│      ├── #sektor                                                         │
│      └── #lonestatistik                ← Ligne 485                       │
│                                                                          │
│  ════════════════════════════════════════════════════════════════════   │
│  ▶ WIDGET 1: SIMULATEUR                                                  │
│    Insérer APRÈS la fermeture de </article> (ligne 548)                 │
│  ════════════════════════════════════════════════════════════════════   │
│                                                                          │
│  [Section #faq]                        ← Lignes 495-547 (dans article)  │
│                                                                          │
│  ════════════════════════════════════════════════════════════════════   │
│  ▶ WIDGET 2: CTA UNIONEN                                                 │
│    Insérer APRÈS le bloc Kommunal CTA (ligne 573)                       │
│  ════════════════════════════════════════════════════════════════════   │
│                                                                          │
│  [Related Blog Posts]                  ← Lignes 575-601 (si existe)     │
│                                                                          │
│  ════════════════════════════════════════════════════════════════════   │
│  ▶ WIDGET 3: COMPRICER                                                   │
│    Insérer AVANT "Liknande yrken" (ligne 604)                           │
│  ════════════════════════════════════════════════════════════════════   │
│                                                                          │
│  [Related Professions]                 ← Lignes 603-616                  │
│                                                                          │
│  [TOC Sidebar + Footer]                                                  │
│                                                                          │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## 🧮 Widget 1 : Simulateur "Tjänar du vad du är värd?"

### Emplacement Exact

| Critère                | Valeur                                                     |
| ---------------------- | ---------------------------------------------------------- |
| **Fichier**            | `templates/profession.twig`                                |
| **Position**           | Après `</article>` (ligne 548), avant le bloc Kommunal CTA |
| **Condition Twig**     | Toujours affiché                                           |
| **Classe CSS wrapper** | `.affiliate-widget.simulateur-widget`                      |

### Données Twig à Utiliser

| Variable                      | Description                  | Exemple         |
| ----------------------------- | ---------------------------- | --------------- |
| `profession.title`            | Nom du métier                | "Sjuksköterska" |
| `profession.median_salary`    | Salaire médian               | 38500           |
| `profession.scb.salary_total` | Salaire moyen SCB (si dispo) | 41200           |
| `profession.slug`             | URL slug                     | "sjukskoterska" |

### Logique Fonctionnelle

```
SI userSalary < salaireMoyen ALORS
    → Afficher message "sous la moyenne" + encouragement
    → CTA vers Widget 2 (Unionen)
SINON
    → Afficher message positif "au-dessus de la moyenne"
```

### Trigger Psychologique

> **"Et moi, où est-ce que je me situe ?"**
>
> Le visiteur vient de consulter les données objectives (SCB).
> On active maintenant la **comparaison personnelle** en lui demandant son propre salaire.
> Cela crée un **engagement actif** (input) et potentiellement une **dissonance cognitive** si sous-payé.

### Textes Suédois (Prêts à l'emploi)

| Élément                  | Texte                                                                                            |
| ------------------------ | ------------------------------------------------------------------------------------------------ |
| **Titre**                | Tjänar du vad du är värd?                                                                        |
| **Sous-titre**           | Jämför din lön med riksgenomsnittet för {{ profession.title\|lower }}                            |
| **Label Input**          | Din nuvarande månadslön (kr)                                                                     |
| **Bouton**               | Jämför nu                                                                                        |
| **Message SOUS moyenne** | Din lön ligger under genomsnittet. En facklig rådgivare kan hjälpa dig förhandla bättre villkor. |
| **Message AU-DESSUS**    | Bra jobbat! Din lön ligger över genomsnittet för {{ profession.title\|lower }}.                  |

### Design Guidelines

| Aspect      | Spécification                                                  |
| ----------- | -------------------------------------------------------------- |
| **Fond**    | `bg-white` ou `bg-slate-50` (cohérent avec le site)            |
| **Border**  | `ring-1 ring-slate-900/5 rounded-2xl` (comme les autres cards) |
| **Padding** | `p-6 sm:p-8`                                                   |
| **Bouton**  | `bg-indigo-600 hover:bg-indigo-500` (cohérent)                 |

---

## 🤝 Widget 2 : CTA Adhésion Unionen

### Emplacement Exact

| Critère                | Valeur                                      |
| ---------------------- | ------------------------------------------- |
| **Fichier**            | `templates/profession.twig`                 |
| **Position**           | Après le bloc Kommunal CTA (ligne 573)      |
| **Condition Twig**     | Toujours affiché (cible tous les visiteurs) |
| **Classe CSS wrapper** | `.affiliate-widget.unionen-widget`          |

### Données Twig à Utiliser

| Variable                      | Utilisation                 |
| ----------------------------- | --------------------------- |
| `profession.title`            | Personnalisation du message |
| `profession.scb.salary_total` | Contextualisation si dispo  |

### Trigger Psychologique

> **"Comment puis-je améliorer ma situation ?"**
>
> Après avoir consulté les données ET utilisé le simulateur,
> on propose une **solution concrète** : rejoindre un syndicat qui aide à négocier.
> Répond au besoin de **protection** et d'**empowerment**.

### Textes Suédois (Prêts à l'emploi)

| Élément            | Texte                                                                                                                                                   |
| ------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Badge**          | Annons                                                                                                                                                  |
| **Titre**          | Vill du ha hjälp att förhandla din lön?                                                                                                                 |
| **Corps**          | Som medlem i Unionen får du tillgång till lönestatistik, juridisk rådgivning och stöd vid löneförhandlingar. Över 700 000 medlemmar har redan gått med. |
| **Bouton CTA**     | Bli medlem idag →                                                                                                                                       |
| **Mention légale** | Annons i samarbete med Unionen                                                                                                                          |

### Attributs du Lien Affilié

| Attribut         | Valeur                 | Raison               |
| ---------------- | ---------------------- | -------------------- |
| `href`           | URL Adtraction générée | Tracking obligatoire |
| `rel`            | `sponsored noopener`   | Google compliance    |
| `target`         | `_blank`               | UX standard          |
| `data-affiliate` | `unionen`              | Analytics interne    |

### Design Guidelines

| Aspect             | Spécification                                             |
| ------------------ | --------------------------------------------------------- |
| **Fond**           | `bg-emerald-50` (différencié pour signaler sponsor)       |
| **Border**         | `ring-1 ring-emerald-100 rounded-2xl`                     |
| **Badge "Annons"** | `bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded` |
| **Bouton**         | `bg-emerald-600 hover:bg-emerald-500 text-white`          |

---

## 💳 Widget 3 : Comparateur Compricer

### Emplacement Exact

| Critère                | Valeur                                        |
| ---------------------- | --------------------------------------------- |
| **Fichier**            | `templates/profession.twig`                   |
| **Position**           | AVANT la section "Liknande yrken" (ligne 604) |
| **Condition Twig**     | Toujours affiché                              |
| **Classe CSS wrapper** | `.affiliate-widget.compricer-widget`          |

### Données Twig à Utiliser

| Variable                   | Utilisation                 |
| -------------------------- | --------------------------- |
| `profession.median_salary` | Pré-remplir l'input salaire |
| `profession.title`         | Personnalisation du titre   |

### Logique Fonctionnelle

```
Calcul capacité d'emprunt:
  capaciteEmprunt = salaireMensuel * 5

Affichage:
  "Med en månadslön på {X} kr kan du uppskattningsvis låna upp till {Y} kr."
```

### Trigger Psychologique

> **"Mon salaire me permet d'emprunter combien ?"**
>
> On capitalise sur le contexte salarial pour activer un **besoin projectif** :
> - Achat immobilier
> - Rénovation
> - Voiture
>
> Le visiteur voit concrètement ce que son salaire lui permet de financer.

### Textes Suédois (Prêts à l'emploi)

| Élément             | Texte                                                                              |
| ------------------- | ---------------------------------------------------------------------------------- |
| **Badge**           | Annons                                                                             |
| **Titre**           | Vad kan du låna med din lön?                                                       |
| **Sous-titre**      | Beräkna din lånepotential baserat på din inkomst som {{ profession.title\|lower }} |
| **Label Input**     | Din månadslön före skatt (kr)                                                      |
| **Bouton Calcul**   | Beräkna                                                                            |
| **Output Template** | Med en månadslön på {X} kr kan du uppskattningsvis låna upp till {Y} kr.           |
| **Bouton CTA**      | Jämför lån hos Compricer →                                                         |

### ⚠️ Warning Crédit OBLIGATOIRE

> **LÉGALEMENT REQUIS** par Konsumentkreditlagen (2010:1846)

| Élément     | Texte exact à afficher                                                                                                                                 |
| ----------- | ------------------------------------------------------------------------------------------------------------------------------------------------------ |
| **Icône**   | ⚠️                                                                                                                                                      |
| **Titre**   | Räkneexempel:                                                                                                                                          |
| **Contenu** | Lån 150 000 kr, löptid 10 år, rörlig ränta 8,90%, uppläggningsavgift 495 kr, aviavgift 35 kr/mån. Effektiv ränta 10,44%. Totalt att betala 197 743 kr. |

> ⚠️ **Note** : Ces chiffres doivent être mis à jour régulièrement selon les taux actuels de Compricer.

### Design Guidelines

| Aspect               | Spécification                                   |
| -------------------- | ----------------------------------------------- |
| **Fond widget**      | `bg-white` avec `ring-1 ring-slate-900/5`       |
| **Badge "Annons"**   | `bg-slate-100 text-slate-600 text-xs`           |
| **Bouton calcul**    | `bg-indigo-600` (cohérent calculateur existant) |
| **Warning crédit**   | `bg-amber-50 border-l-4 border-amber-400 p-4`   |
| **Bouton CTA final** | `bg-blue-600 hover:bg-blue-500` (différencié)   |

---

## 📐 Classes CSS Communes

Pour maintenir la cohérence avec le design existant du site :

| Élément            | Classes Tailwind                                                                                                           |
| ------------------ | -------------------------------------------------------------------------------------------------------------------------- |
| **Card container** | `bg-white rounded-2xl shadow-sm ring-1 ring-slate-900/5 p-6 sm:p-8`                                                        |
| **Titre widget**   | `text-lg font-bold text-slate-900 mb-4`                                                                                    |
| **Input field**    | `block w-full rounded-lg border-0 py-3 text-slate-900 ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-indigo-600` |
| **Primary button** | `w-full bg-indigo-600 text-white rounded-lg py-3 px-4 hover:bg-indigo-500 font-bold transition-colors`                     |
| **Secondary text** | `text-sm text-slate-600`                                                                                                   |
| **Badge sponsor**  | `inline-block bg-slate-100 text-slate-600 text-xs font-medium px-2 py-0.5 rounded uppercase tracking-wide`                 |

---

## 📱 Responsive Comportement

| Breakpoint              | Comportement                                           |
| ----------------------- | ------------------------------------------------------ |
| **Mobile (< 640px)**    | Widgets en full-width, stack vertical                  |
| **Tablet (640-1024px)** | Widgets en full-width avec padding ajusté              |
| **Desktop (> 1024px)**  | Widgets dans la grille principale (éviter sidebar TOC) |

---

*Document mis à jour le 2026-01-12 - Projet Raknalon.se - Spécifications Widgets v2.0*
*Basé sur analyse ligne par ligne de `profession.twig` (785 lignes)*
