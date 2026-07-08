# 📋 Tâche 09: Vérification Technique (HTTPS, Sitemap, Robots)

> **Priorité**: 🔴 CRITIQUE  
> **Durée estimée**: 15-30 min  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Vérifier que tous les prérequis techniques pour AdSense sont en place.

---

## 📋 Checklist Technique

### 1. HTTPS (SSL) ✅ OBLIGATOIRE

**Vérification** :
```bash
curl -I https://raknalon.se
```

**Critères** :
- [ ] Le site répond en HTTPS
- [ ] Pas de contenu mixte (HTTP + HTTPS)
- [ ] Redirection automatique de HTTP vers HTTPS
- [ ] Certificat SSL valide et non expiré

**Si non configuré** :
1. Activer SSL chez l'hébergeur
2. Configurer `.htaccess` pour redirection :
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

### 2. Sitemap XML ✅ OBLIGATOIRE

**Vérification** :
```bash
curl https://raknalon.se/sitemap.xml
```

**Critères** :
- [ ] Sitemap accessible à `/sitemap.xml`
- [ ] Format XML valide
- [ ] Inclut toutes les pages importantes :
  - Homepage `/`
  - Pages métiers `/lon/*`
  - Pages concepts `/brutto-netto`, `/jobbskatteavdrag`, etc.
  - Pages légales `/integritetspolicy`, `/om-oss`, etc.
  - Page liste des métiers `/yrken`
- [ ] Dates de modification (`<lastmod>`) présentes
- [ ] Pas de pages 404 dans le sitemap

**Controller existant** : `src/Controllers/SitemapController.php`

**À vérifier** : Les nouvelles pages légales sont-elles ajoutées ?

```php
// Exemple d'ajout dans SitemapController.php
$urls[] = [
    'loc' => 'https://raknalon.se/integritetspolicy',
    'lastmod' => date('Y-m-d'),
    'priority' => '0.3'
];
$urls[] = [
    'loc' => 'https://raknalon.se/om-oss',
    'lastmod' => date('Y-m-d'),
    'priority' => '0.3'
];
// ... autres pages légales
```

---

### 3. Robots.txt ✅ OBLIGATOIRE

**Vérification** :
```bash
curl https://raknalon.se/robots.txt
```

**Contenu requis** :
```txt
User-agent: *
Allow: /

Sitemap: https://raknalon.se/sitemap.xml
```

**À NE PAS FAIRE** :
```txt
# NE PAS bloquer les pages légales !
Disallow: /integritetspolicy
Disallow: /om-oss
```

**Critères** :
- [ ] Fichier robots.txt accessible
- [ ] Pas de `Disallow: /` général
- [ ] Sitemap référencé
- [ ] Pages légales NON bloquées

---

### 4. Vitesse de Chargement 🟡 IMPORTANT

AdSense préfère les sites rapides.

**Test** : https://pagespeed.web.dev/

**Critères** :
- [ ] Score Performance > 70 (mobile)
- [ ] Score Performance > 85 (desktop)
- [ ] LCP (Largest Contentful Paint) < 2.5s
- [ ] Pas de ressources bloquantes majeures

**Optimisations si nécessaire** :
1. Minifier CSS/JS
2. Compresser images (WebP)
3. Activer la compression gzip
4. Utiliser le cache navigateur

---

### 5. Mobile-Friendly 🟡 IMPORTANT

**Test** : https://search.google.com/test/mobile-friendly

**Critères** :
- [ ] Site "Mobile-Friendly" selon Google
- [ ] Texte lisible sans zoom
- [ ] Boutons/liens assez grands (48px min)
- [ ] Pas de scroll horizontal

---

### 6. Erreurs 404 🔴 CRITIQUE

AdSense rejette les sites avec beaucoup de 404.

**Vérification** :
1. Tester manuellement toutes les URLs du menu
2. Vérifier les liens du footer
3. Tester quelques pages métiers au hasard

**Critères** :
- [ ] Aucune page 404 dans le menu principal
- [ ] Aucune page 404 dans le footer
- [ ] Toutes les pages du sitemap répondent 200

---

## 🔧 Commandes de Vérification

```bash
# Vérifier HTTPS
curl -I https://raknalon.se

# Vérifier sitemap
curl https://raknalon.se/sitemap.xml | head -50

# Vérifier robots.txt
curl https://raknalon.se/robots.txt

# Tester une page légale
curl -I https://raknalon.se/integritetspolicy

# Tester plusieurs URLs
for url in "/" "/yrken" "/lon/sjukskoterska" "/integritetspolicy" "/om-oss"; do
  echo "Testing $url"
  curl -s -o /dev/null -w "%{http_code}" "https://raknalon.se$url"
  echo ""
done
```

---

## ✅ Critères d'Acceptation Globaux

- [ ] HTTPS actif avec redirection
- [ ] Sitemap valide et complet
- [ ] Robots.txt correct
- [ ] Score PageSpeed > 70 mobile
- [ ] Zéro erreur 404 visible
- [ ] Site mobile-friendly

---

## 📊 Tableau de Suivi

| Élément    | Statut | Notes                   |
| ---------- | ------ | ----------------------- |
| HTTPS      | ⬜      |                         |
| Sitemap    | ⬜      | Pages légales à ajouter |
| Robots.txt | ⬜      |                         |
| PageSpeed  | ⬜      | Score: ___/100          |
| Mobile     | ⬜      |                         |
| 404        | ⬜      |                         |
