# 08 - Déploiement Production

**Priorité**: 🟢 Basse (après dev)  
**Durée estimée**: 2-3 heures  
**Statut**: [ ] À faire

---

## Objectif
Déployer raknalon.se sur Hostinger (ou autre hébergeur)

## Prérequis
- [ ] Domaine raknalon.se acheté
- [ ] Hébergement configuré (PHP 8.2+)
- [ ] SSL/HTTPS activé

## Sous-tâches

### Préparation
- [ ] Build CSS Tailwind (production, purged)
- [ ] Minifier JS
- [ ] Créer `.env.production`
- [ ] Désactiver debug/error display

### Upload
- [ ] Structure fichiers sur hébergeur
- [ ] Configurer document root → `/public`
- [ ] Upload via FTP ou Git

### Configuration Serveur
- [ ] `.htaccess` production:
  ```apache
  RewriteEngine On
  RewriteCond %{HTTPS} off
  RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
  
  RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
  RewriteRule ^(.*)$ https://%1/$1 [R=301,L]
  ```
- [ ] Activer compression gzip
- [ ] Cache headers assets statiques

### Post-Déploiement
- [ ] Tester toutes les pages
- [ ] Soumettre sitemap à Google Search Console
- [ ] Vérifier SSL avec SSL Labs
- [ ] Test PageSpeed production
- [ ] Configurer Google Analytics

## Monitoring
- [ ] UptimeRobot (alertes down)
- [ ] Google Search Console (erreurs crawl)
- [ ] Analytics conversions

## Checklist Finale

- [ ] Homepage accessible
- [ ] Calculateur fonctionne
- [ ] 5+ pages métiers actives
- [ ] Sitemap soumis
- [ ] HTTPS + redirect fonctionnel
- [ ] PageSpeed > 90
