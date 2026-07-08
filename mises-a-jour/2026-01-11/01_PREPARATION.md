# 📦 01 - Préparation

## Objectif
Préparer l'environnement avant toute modification du projet en production.

---

## Étape 1 : Backup Complet

### 1.1 Backup Base de Données (si applicable)
```bash
# Si tu utilises une base de données
mysqldump -u root raknalon_db > backup_raknalon_2026-01-11.sql
```

### 1.2 Backup Fichiers
```bash
# Créer une copie complète du projet
cp -r projets/raknalon projets/raknalon_backup_2026-01-11
```

### 1.3 Backup sur Git
```bash
cd projets/raknalon
git add -A
git commit -m "Backup avant intégration SCB - 2026-01-11"
git push origin main
```

---

## Étape 2 : Copier les Données SCB

### 2.1 Créer le dossier de données
```bash
mkdir -p projets/raknalon/data/scb
```

### 2.2 Copier les fichiers extraits
```bash
cp projets/draft/salaire-se/data/01_privat_tjansteman_2024.json projets/raknalon/data/scb/
cp projets/draft/salaire-se/data/06_percentiles_2024.json projets/raknalon/data/scb/
cp projets/draft/salaire-se/data/07_historique_2014_2024.json projets/raknalon/data/scb/
```

### 2.3 Vérifier les fichiers
```bash
ls -la projets/raknalon/data/scb/
# Devrait afficher :
# 01_privat_tjansteman_2024.json (36 KB)
# 06_percentiles_2024.json (19 KB)
# 07_historique_2014_2024.json (64 KB)
```

---

## Étape 3 : Vérifier l'Environnement Local

### 3.1 Démarrer le serveur local
```bash
# Avec Laragon, le serveur devrait déjà être actif
# URL : http://raknalon.test ou http://localhost/raknalon
```

### 3.2 Vérifier que le site fonctionne
- [ ] Page d'accueil charge correctement
- [ ] Une page métier charge correctement (ex: `/yrke/lakare-lon`)
- [ ] Pas d'erreurs PHP dans les logs

### 3.3 Vérifier la structure actuelle
```bash
# Afficher la structure des données actuelles
cat projets/raknalon/data/professions.json | head -100
```

---

## Étape 4 : Analyser les Correspondances

### 4.1 Professions Raknalon vs SCB

| Raknalon (actuel) | Code SSYK SCB | Correspondance                          |
| ----------------- | ------------- | --------------------------------------- |
| lakare            | 221           | Läkare ✅                                |
| sjukskoterska     | 222           | Sjuksköterskor ✅                        |
| psykolog          | 224           | Psykologer och psykoterapeuter ✅        |
| elektriker        | 741           | Installations- och industrielektriker ❓ |
| ...               | ...           | ...                                     |

> ⚠️ **Action requise** : Créer un fichier de mapping entre les slugs Raknalon et les codes SSYK

### 4.2 Créer le fichier de mapping
Créer `data/scb/ssyk_mapping.json` :
```json
{
    "lakare": "221",
    "sjukskoterska": "222",
    "psykolog": "224",
    "tandlakare": "226",
    "larare": "233",
    "ingenjor": "214"
}
```

---

## ✅ Checklist Préparation

- [ ] Backup base de données effectué
- [ ] Backup fichiers effectué  
- [ ] Commit Git créé
- [ ] Données SCB copiées dans `data/scb/`
- [ ] Serveur local vérifié
- [ ] Fichier de mapping SSYK créé

---

## ➡️ Étape suivante
Passer à `02_INTEGRATION_DONNEES.md`
