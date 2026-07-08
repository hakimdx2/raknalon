# 🧪 05 - Tests et Validation

## Objectif
Valider que toutes les modifications fonctionnent correctement avant le déploiement en production.

---

## 1. Tests Fonctionnels

### 1.1 Test du JSON

```bash
# Vérifier que le JSON est valide
cd projets/raknalon
php -r "json_decode(file_get_contents('data/professions.json')); echo json_last_error() === JSON_ERROR_NONE ? '✅ JSON valide' : '❌ JSON invalide';"
```

### 1.2 Test des pages métiers

Ouvrir dans le navigateur et vérifier visuellement :

| Page          | URL locale                                  | Vérifications                                  |
| ------------- | ------------------------------------------- | ---------------------------------------------- |
| Psykolog      | http://raknalon.test/yrke/psykolog-lon      | ☐ Affiche salaire SCB ☐ Gender gap ☐ Graphique |
| Läkare        | http://raknalon.test/yrke/lakare-lon        | ☐ Affiche salaire SCB ☐ Gender gap ☐ Graphique |
| Sjuksköterska | http://raknalon.test/yrke/sjukskoterska-lon | ☐ Affiche salaire SCB ☐ Gender gap ☐ Graphique |
| Ingenjör      | http://raknalon.test/yrke/ingenjor-lon      | ☐ Affiche salaire SCB ☐ Gender gap ☐ Graphique |

### 1.3 Test des professions SANS données SCB

Vérifier qu'aucune erreur n'apparaît pour les professions non mappées :

```bash
# Lister les professions sans données SCB
php -r "
\$data = json_decode(file_get_contents('data/professions.json'), true);
foreach(\$data as \$p) {
    if (!isset(\$p['scb']) || \$p['scb']['salary_total'] == 0) {
        echo '- ' . \$p['slug'] . PHP_EOL;
    }
}
"
```

Ces pages doivent continuer à fonctionner normalement (affichage des données existantes).

---

## 2. Tests Visuels

### 2.1 Desktop (>1024px)

- [ ] Bloc Gender Gap aligné correctement
- [ ] Barres de progression proportionnelles
- [ ] Graphique Chart.js s'affiche
- [ ] Pas de débordement horizontal

### 2.2 Tablet (768px-1024px)

- [ ] Mise en page responsive
- [ ] Textes lisibles
- [ ] Graphique redimensionné

### 2.3 Mobile (<768px)

- [ ] Blocs empilés verticalement
- [ ] Pas de scroll horizontal
- [ ] Boutons tactiles assez grands
- [ ] Textes pas trop petits

---

## 3. Tests SEO

### 3.1 Vérifier la meta description

```bash
# Afficher la meta description d'une page
curl -s http://raknalon.test/yrke/psykolog-lon | grep -o '<meta name="description"[^>]*>'
```

Vérifier que :
- [ ] Le salaire SCB est mentionné
- [ ] L'année (2024) est mentionnée
- [ ] Moins de 160 caractères

### 3.2 Vérifier le Structured Data

Utiliser : https://validator.schema.org/

1. Copier le HTML de la page
2. Coller dans le validateur
3. Vérifier que "Occupation" est détecté
4. Vérifier les percentiles dans estimatedSalary

### 3.3 FAQPage Schema

```bash
# Vérifier que le FAQPage schema est présent
curl -s http://raknalon.test/yrke/psykolog-lon | grep -o 'FAQPage'
```

---

## 4. Tests de Performance

### 4.1 Temps de chargement

```bash
# Mesurer le temps de réponse
curl -o /dev/null -s -w 'Time: %{time_total}s\n' http://raknalon.test/yrke/psykolog-lon
```

- [ ] Temps < 1 seconde : ✅ OK
- [ ] Temps 1-2 secondes : ⚠️ Acceptable
- [ ] Temps > 2 secondes : ❌ Optimiser

### 4.2 Lighthouse

1. Ouvrir Chrome DevTools (F12)
2. Onglet "Lighthouse"
3. Cocher : Performance, Accessibility, Best Practices, SEO
4. Cliquer "Analyze"

Objectifs :
- [ ] Performance > 80
- [ ] Accessibility > 90
- [ ] SEO > 90

### 4.3 Taille du fichier JSON

```bash
# Vérifier la taille
ls -lh data/professions.json

# Objectif : < 500 KB
# Si > 1 MB : envisager le lazy loading
```

---

## 5. Tests de Régression

### 5.1 Pages existantes

Vérifier que ces pages fonctionnent TOUJOURS :

| Page         | URL                                   | Fonctionne |
| ------------ | ------------------------------------- | ---------- |
| Accueil      | http://raknalon.test/                 | ☐          |
| Liste yrken  | http://raknalon.test/alla-yrken       | ☐          |
| Brutto/Netto | http://raknalon.test/brutto-netto     | ☐          |
| Skatteavdrag | http://raknalon.test/jobbskatteavdrag | ☐          |

### 5.2 Calculateur

- [ ] Le calculateur de salaire fonctionne
- [ ] Les résultats sont corrects
- [ ] Pas d'erreur JavaScript en console

### 5.3 Navigation

- [ ] Menu principal fonctionne
- [ ] Footer fonctionne
- [ ] Breadcrumbs corrects

---

## 6. Tests de Données

### 6.1 Cohérence des salaires

Vérifier que les salaires SCB sont cohérents :

```bash
php -r "
\$data = json_decode(file_get_contents('data/professions.json'), true);
foreach(\$data as \$p) {
    if (isset(\$p['scb']['salary_total']) && \$p['scb']['salary_total'] > 0) {
        \$diff = abs(\$p['avg_salary'] - \$p['scb']['salary_total']);
        if (\$diff > 10000) {
            echo '⚠️ Grande différence pour ' . \$p['slug'] . ': ';
            echo \$p['avg_salary'] . ' vs SCB ' . \$p['scb']['salary_total'] . PHP_EOL;
        }
    }
}
"
```

### 6.2 Gender gap valide

```bash
php -r "
\$data = json_decode(file_get_contents('data/professions.json'), true);
foreach(\$data as \$p) {
    if (isset(\$p['scb']['gender_gap_percent'])) {
        \$gap = \$p['scb']['gender_gap_percent'];
        if (\$gap < 50 || \$gap > 150) {
            echo '⚠️ Gender gap suspect pour ' . \$p['slug'] . ': ' . \$gap . '%' . PHP_EOL;
        }
    }
}
"
```

---

## ✅ Checklist Tests

### Tests obligatoires avant déploiement

- [ ] JSON valide
- [ ] 3+ pages métiers vérifiées visuellement
- [ ] Pages sans SCB ne crashent pas
- [ ] Mobile responsive vérifié
- [ ] Meta descriptions correctes
- [ ] Structured Data valide
- [ ] Temps < 2s
- [ ] Lighthouse SEO > 90
- [ ] Pages existantes fonctionnent
- [ ] Calculateur fonctionne

### Signature

```
Date du test : _______________
Testé par : _______________
Résultat : ☐ OK pour déploiement / ☐ Corrections nécessaires
```

---

## ➡️ Étape suivante
Si tous les tests passent, passer à `06_DEPLOIEMENT.md`
