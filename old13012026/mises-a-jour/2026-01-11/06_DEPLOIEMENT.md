# 🚀 06 - Déploiement en Production

## ⚠️ ATTENTION - PRODUCTION

Ce guide concerne le déploiement sur le site **LIVE** raknalon.se.
Toute erreur sera visible par les utilisateurs réels.

---

## Pré-requis

Avant de commencer :

- [ ] Tous les tests de `05_TESTS.md` passent ✅
- [ ] Backup local créé
- [ ] Accès FTP/SSH au serveur
- [ ] Horaire : éviter les heures de pointe (préférer 6h-8h ou 22h-00h)

---

## Méthode 1 : Déploiement Git (Recommandé)

### Étape 1 : Commit final local

```bash
cd projets/raknalon

# Vérifier les fichiers modifiés
git status

# Ajouter les fichiers
git add -A

# Commit avec message descriptif
git commit -m "feat: Intégration données SCB officielles 2024

- Ajout données salaires SCB (151 professions)
- Ajout gender pay gap
- Ajout percentiles (P10, P25, P50, P75, P90)
- Ajout historique 10 ans (2014-2024)
- Nouveaux blocs visuels dans profession.twig
- FAQs dynamiques générées depuis SCB
- Structured Data enrichie"
```

### Étape 2 : Push vers le repo

```bash
git push origin main
```

### Étape 3 : Pull sur le serveur

```bash
# Se connecter au serveur
ssh user@raknalon.se

# Aller dans le dossier du site
cd /var/www/raknalon

# Pull les changements
git pull origin main
```

### Étape 4 : Vider le cache (si applicable)

```bash
# Si tu utilises un système de cache
php artisan cache:clear  # Laravel
# ou
rm -rf cache/*  # Cache fichier
```

---

## Méthode 2 : Déploiement FTP

### Étape 1 : Identifier les fichiers à uploader

| Fichier/Dossier                  | Action                     |
| -------------------------------- | -------------------------- |
| `data/professions.json`          | Upload (ÉCRASER)           |
| `data/scb/`                      | Upload (NOUVEAU)           |
| `templates/profession.twig`      | Upload (ÉCRASER)           |
| `assets/css/style.css`           | Upload (ÉCRASER)           |
| `scripts/integrate_scb_data.php` | NE PAS uploader (dev only) |

### Étape 2 : Connexion FTP

```
Hôte : ftp.raknalon.se (ou ton hébergeur)
Utilisateur : [ton user]
Port : 21 (FTP) ou 22 (SFTP)
```

### Étape 3 : Backup serveur AVANT upload

```bash
# Via FTP, télécharger une copie de :
# - data/professions.json
# - templates/profession.twig
# Sauvegarder en local avec suffixe _prod_backup
```

### Étape 4 : Upload des fichiers

1. Uploader `data/scb/` (nouveau dossier)
2. Uploader `data/professions.json` (remplacer)
3. Uploader `templates/profession.twig` (remplacer)
4. Uploader `assets/css/style.css` (remplacer)

---

## Vérification Post-Déploiement

### Immédiatement après le déploiement (< 5 min)

| Vérification  | URL                                        | Statut |
| ------------- | ------------------------------------------ | ------ |
| Accueil       | https://raknalon.se/                       | ☐ OK   |
| Page métier 1 | https://raknalon.se/yrke/lakare-lon        | ☐ OK   |
| Page métier 2 | https://raknalon.se/yrke/sjukskoterska-lon | ☐ OK   |
| Calculateur   | https://raknalon.se/ (test calcul)         | ☐ OK   |

### Vérifications visuelles

- [ ] Bloc "Källa: SCB 2024" visible
- [ ] Gender gap bars affichées
- [ ] Graphique historique charge
- [ ] Pas d'erreur 500

### Vérification SEO

```bash
# Tester le structured data en production
curl -s https://raknalon.se/yrke/psykolog-lon | grep -o 'MonetaryAmountDistribution'
# Doit retourner: MonetaryAmountDistribution
```

---

## Rollback (En cas de problème)

### Si erreur critique détectée :

#### Option A : Rollback Git
```bash
ssh user@raknalon.se
cd /var/www/raknalon
git checkout HEAD~1  # Revenir au commit précédent
```

#### Option B : Rollback FTP
1. Uploader les fichiers `_prod_backup` téléchargés avant
2. Renommer pour écraser les fichiers problématiques

#### Option C : Restore backup
```bash
# Si tu as fait un backup complet
cp -r /backup/raknalon_2026-01-11/* /var/www/raknalon/
```

---

## Monitoring Post-Déploiement

### Les 24 premières heures

- [ ] Vérifier Google Search Console pour erreurs
- [ ] Vérifier les logs serveur pour erreurs 500
- [ ] Vérifier le trafic dans Google Analytics
- [ ] Tester 5 pages métiers différentes

### Les 7 premiers jours

- [ ] Vérifier l'indexation des pages mises à jour
- [ ] Surveiller les positions SEO (pas de chute)
- [ ] Vérifier les Core Web Vitals

---

## Communication

### Si tout va bien :
```
✅ Mise à jour SCB déployée avec succès sur raknalon.se
- 151 professions enrichies avec données SCB 2024
- Nouveaux blocs : Gender Gap, Percentiles, Historique
- Aucune erreur détectée
```

### Si problème :
```
⚠️ Problème détecté après déploiement raknalon.se
- Description : [décrire le problème]
- Action : Rollback effectué / En cours d'investigation
- Impact : [pages affectées]
```

---

## ✅ Checklist Déploiement Final

- [ ] Tests locaux tous passés
- [ ] Commit Git créé avec message descriptif
- [ ] Backup serveur téléchargé
- [ ] Fichiers uploadés
- [ ] Cache vidé
- [ ] Vérification post-déploiement OK
- [ ] Pas d'erreur 500
- [ ] Structured Data valide en prod
- [ ] Monitoring configuré

---

## 🎉 Félicitations !

Si tu lis ceci et que tout fonctionne, la mise à jour SCB est maintenant en production !

**Prochaines étapes potentielles :**
1. Ajouter les professions manquantes au mapping SSYK
2. Créer des pages programmatiques par commune
3. Ajouter un cron job pour mise à jour annuelle
4. Créer du contenu "Comparaison salaires par région"
