# 🔄 02 - Intégration des Données SCB

## Objectif
Intégrer les données SCB dans le système existant de Raknalon.se sans casser le fonctionnement actuel.

---

## Structure Actuelle de Raknalon

### Fichier `data/professions.json` (actuel)
```json
{
    "category": "Vård & Hälsa",
    "slug": "psykolog",
    "title": "Psykolog",
    "keyword": "psykolog lön",
    "avg_salary": 44500,
    "median_salary": 43200,
    "ptp_salary": 35500,
    "specialist_salary": 52000,
    "description": "...",
    "kd": 11,
    "volume": 2900
}
```

### Données SCB Disponibles
```json
{
    "ssyk_code": "224",
    "profession": "Psykologer och psykoterapeuter",
    "sector": "privat_tjansteman",
    "salary_men": 50200,
    "salary_women": 49000,
    "salary_total": 49400,
    "gender_gap_percent": 97.6
}
```

---

## Option A : Enrichir `professions.json` (RECOMMANDÉ)

### Avantages
- ✅ Compatible avec le code existant
- ✅ Pas de refactoring majeur
- ✅ Rollback facile

### Nouvelle structure proposée
```json
{
    "category": "Vård & Hälsa",
    "slug": "psykolog",
    "title": "Psykolog",
    "keyword": "psykolog lön",
    
    // Données existantes (conserver pour backward compatibility)
    "avg_salary": 44500,
    "median_salary": 43200,
    
    // NOUVELLES données SCB
    "scb": {
        "ssyk_code": "224",
        "year": 2024,
        "salary_total": 49400,
        "salary_men": 50200,
        "salary_women": 49000,
        "gender_gap_percent": 97.6,
        "percentiles": {
            "p10": 38000,
            "p25": 42000,
            "p50": 47000,
            "p75": 54000,
            "p90": 62000
        },
        "history": {
            "2014": 40000,
            "2015": 41000,
            ...
            "2024": 49400
        }
    },
    
    // Autres champs existants
    "kd": 11,
    "volume": 2900
}
```

---

## Script d'Intégration

### Créer `scripts/integrate_scb_data.php`

```php
<?php
/**
 * Script d'intégration des données SCB dans professions.json
 * 
 * USAGE: php scripts/integrate_scb_data.php
 * 
 * ⚠️ TOUJOURS faire un backup avant d'exécuter !
 */

// Chemins
$professionsFile = __DIR__ . '/../data/professions.json';
$scbPrivatFile = __DIR__ . '/../data/scb/01_privat_tjansteman_2024.json';
$scbPercentilesFile = __DIR__ . '/../data/scb/06_percentiles_2024.json';
$scbHistoryFile = __DIR__ . '/../data/scb/07_historique_2014_2024.json';

// Mapping manuel slug → SSYK code
$mapping = [
    'lakare' => '221',
    'sjukskoterska' => '222',
    'psykolog' => '224',
    'tandlakare' => '226',
    'veterinar' => '225',
    'larare' => '233',
    'forskollarare' => '234',
    'ingenjor' => '214',
    'civilingenjor' => '214',
    'arkitekt' => '216',
    'advokat' => '261',
    'ekonom' => '241',
    'it-arkitekt' => '251',
    'systemutvecklare' => '251',
    'marknadsforare' => '243',
    'hr-specialist' => '242',
    // Ajouter les autres mappings...
];

// Charger les données
$professions = json_decode(file_get_contents($professionsFile), true);
$scbPrivat = json_decode(file_get_contents($scbPrivatFile), true);
$scbPercentiles = json_decode(file_get_contents($scbPercentilesFile), true);
$scbHistory = json_decode(file_get_contents($scbHistoryFile), true);

// Indexer les données SCB par code SSYK
$scbByCode = [];
foreach ($scbPrivat as $item) {
    $scbByCode[$item['ssyk_code']] = $item;
}

$percentilesByCode = [];
foreach ($scbPercentiles as $item) {
    $percentilesByCode[$item['ssyk_code']] = $item;
}

$historyByCode = [];
foreach ($scbHistory as $item) {
    $historyByCode[$item['ssyk_code']] = $item;
}

// Enrichir chaque profession
$updated = 0;
$notFound = [];

foreach ($professions as &$profession) {
    $slug = $profession['slug'];
    
    if (!isset($mapping[$slug])) {
        $notFound[] = $slug;
        continue;
    }
    
    $ssykCode = $mapping[$slug];
    
    // Ajouter données SCB
    $profession['scb'] = [
        'ssyk_code' => $ssykCode,
        'year' => 2024,
        'source' => 'SCB - Statistiska centralbyrån'
    ];
    
    // Salaires avec gender gap
    if (isset($scbByCode[$ssykCode])) {
        $scb = $scbByCode[$ssykCode];
        $profession['scb']['salary_total'] = $scb['salary_total'];
        $profession['scb']['salary_men'] = $scb['salary_men'];
        $profession['scb']['salary_women'] = $scb['salary_women'];
        $profession['scb']['gender_gap_percent'] = $scb['gender_gap_percent'] ?? null;
    }
    
    // Percentiles
    if (isset($percentilesByCode[$ssykCode])) {
        $perc = $percentilesByCode[$ssykCode];
        $profession['scb']['percentiles'] = [
            'p10' => $perc['p10'] ?? null,
            'p25' => $perc['p25'] ?? null,
            'p50' => $perc['median'] ?? null,
            'p75' => $perc['p75'] ?? null,
            'p90' => $perc['p90'] ?? null
        ];
    }
    
    // Historique
    if (isset($historyByCode[$ssykCode])) {
        $hist = $historyByCode[$ssykCode];
        $profession['scb']['history'] = $hist['history'] ?? [];
        $profession['scb']['evolution_10y_percent'] = $hist['evolution_10y_percent'] ?? null;
    }
    
    $updated++;
}

// Sauvegarder
$backupFile = $professionsFile . '.backup.' . date('Y-m-d-His');
copy($professionsFile, $backupFile);
echo "Backup créé: $backupFile\n";

file_put_contents(
    $professionsFile, 
    json_encode($professions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo "✅ $updated professions mises à jour\n";
echo "⚠️ " . count($notFound) . " professions sans mapping SSYK:\n";
foreach ($notFound as $slug) {
    echo "   - $slug\n";
}
```

---

## Étapes d'Exécution

### 1. Créer le dossier scripts
```bash
mkdir -p projets/raknalon/scripts
```

### 2. Créer le script
Copier le code ci-dessus dans `scripts/integrate_scb_data.php`

### 3. Compléter le mapping SSYK
Ouvrir `professions.json` et créer le mapping complet dans le script.

### 4. Exécuter en mode test
```bash
cd projets/raknalon
php scripts/integrate_scb_data.php
```

### 5. Vérifier le résultat
```bash
# Vérifier une profession
cat data/professions.json | grep -A 30 '"slug": "psykolog"'
```

---

## ✅ Checklist Intégration

- [ ] Script d'intégration créé
- [ ] Mapping SSYK complet (tous les slugs)
- [ ] Backup automatique vérifié
- [ ] Script exécuté sans erreur
- [ ] Données SCB présentes dans professions.json
- [ ] Format JSON valide

---

## ➡️ Étape suivante
Passer à `03_MODIFICATIONS_TEMPLATES.md`
