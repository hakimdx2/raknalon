# 07 - Design & UI Premium (Tailwind UI DNA)

**Priorité**: 🟡 Moyenne  
**Durée estimée**: 4-5 heures  
**Statut**: [ ] À faire

---

## Objectif
Créer un design "Tailwind UI Style" : propre, moderne, commercial et rassurant.

## 🎨 L'ADN Visuel (Design System)

### Typographie
- **Font**: `Inter` (Google Fonts) - Le standard moderne.
- **Headings**: `font-bold tracking-tight text-slate-900`.
- **Body**: `text-slate-600 leading-relaxed`.

### Palette de Couleurs (Slate & Indigo)
```css
/* Fond */
.bg-body { @apply bg-white; }
.bg-subtle { @apply bg-slate-50; }

/* Textes */
.text-primary { @apply text-slate-900; }
.text-secondary { @apply text-slate-600; }
.text-muted { @apply text-slate-400; }

/* Brand / Actions */
.btn-primary { 
  @apply bg-indigo-600 text-white hover:bg-indigo-700 
  focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
  shadow-sm font-medium rounded-lg px-4 py-2.5 transition-colors;
}

/* Formulaires (Tailwind Forms Plugin DNA) */
.input-field {
  @apply block w-full rounded-md border-gray-300 shadow-sm
  focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm;
}
```

### Principes UI
1.  **Ombres Douces**: Utiliser `shadow-sm` pour les cartes, `shadow-lg` pour les dropdowns/modales.
2.  **Bordures Subtiles**: `border-slate-200` pour délimiter sans alourdir.
3.  **Whitespace**: Marges généreuses (`py-12`, `gap-8`) pour laisser respirer le contenu.
4.  **Micro-Interactions**: États `hover:`, `focus:`, `active:` soignés sur tous les éléments interactifs.

## Sous-tâches

### Layout Global
- [ ] Header simple: Logo (gauche) + Nav (droite).
- [ ] Footer "SaaS style": Colonnes liens + Copyright + Social.
- [ ] Container centré: `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`.

### Calculateur (Hero Section)
- [ ] Style "Split Screen" ou "Centered Card" sur fond subtil.
- [ ] Card blanche avec `shadow-xl ring-1 ring-slate-900/5`.
- [ ] Inputs larges et lisibles.

### Composants Clés
- [ ] **Badge**: `bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-700/10`.
- [ ] **Stats**: Gros chiffres `text-3xl font-semibold text-slate-900`.
- [ ] **Prose**: Utiliser `@tailwindcss/typography` pour les articles de blog/pages métiers.

## Assets Requis
- [ ] Tailwind Forms Plugin (`@tailwindcss/forms`)
- [ ] Tailwind Typography Plugin (`@tailwindcss/typography`)
- [ ] Heroicons (SVG outline/solid)
