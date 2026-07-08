# 06 - SEO Technique

**Priorité**: 🟡 Moyenne  
**Durée estimée**: 3-4 heures  
**Statut**: [ ] À faire

---

## Objectif
Implémenter toutes les optimisations SEO techniques

## Sous-tâches

### Meta & Headers
- [ ] Template de base avec meta tags dynamiques
- [ ] OpenGraph tags
- [ ] Twitter Cards
- [ ] Canonical URLs
- [ ] Hreflang (si multi-langue future)

### Structured Data
- [ ] Schema.org WebSite
- [ ] Schema.org WebApplication (calculateur)
- [ ] Schema.org FAQPage (pages concepts)
- [ ] Schema.org Occupation (pages métiers)
- [ ] Schema.org BreadcrumbList

### Performance
- [ ] Minification CSS (Tailwind purge)
- [ ] Minification JS
- [ ] Lazy loading images
- [ ] Compression gzip (.htaccess)
- [ ] Cache headers
- [ ] PageSpeed Insights > 90

### Technical
- [ ] Sitemap XML dynamique (`/sitemap.xml`)
- [ ] Robots.txt
- [ ] 404 page personnalisée
- [ ] Redirections 301 si nécessaire
- [ ] HTTPS forcé (.htaccess)
- [ ] WWW → non-WWW redirect

### Analytics
- [ ] Google Analytics 4
- [ ] Google Search Console setup
- [ ] Suivi événements calculateur

## Fichiers à Créer

```
/public
  robots.txt
  sitemap.xml (dynamique via route)
/.htaccess
```

## Validation

- [ ] Test Schema avec Rich Results Test
- [ ] Test PageSpeed mobile > 90
- [ ] Test Lighthouse accessibility > 90
- [ ] Vérifier indexation GSC
