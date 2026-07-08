# 01 - Setup Technique

**Priorité**: 🔴 Haute  
**Durée estimée**: 2-3 heures  
**Statut**: [ ] À faire

---

## Objectif
Configurer l'environnement de développement Slim PHP 4 + Tailwind CSS + Alpine.js

## Sous-tâches

- [ ] Créer le dossier projet `c:/laragon/www/raknalon`
- [ ] Initialiser Composer avec Slim 4
- [ ] Installer les dépendances PHP:
  - `slim/slim:^4.0`
  - `slim/psr7`
  - `slim/twig-view`
  - `php-di/php-di`
- [ ] Configurer Tailwind CSS (npm init + tailwindcss)
- [ ] Configurer Alpine.js (CDN ou npm)
- [ ] Créer la structure des dossiers:
  ```
  /raknalon
    /public
      index.php
      /css
      /js
    /src
      /Controllers
      /Services
      /Data
    /templates
    /config
  ```
- [ ] Configurer le virtual host Laragon (`raknalon.test`)
- [ ] Tester que la page d'accueil s'affiche

## Commandes

```bash
# Initialiser Composer
composer init
composer require slim/slim:^4.0 slim/psr7 slim/twig-view php-di/php-di

# Initialiser Tailwind
npm init -y
npm install -D tailwindcss
npx tailwindcss init
```

## Fichiers à créer
- `index.php` - Point d'entrée (Root)
- `config/routes.php` - Routes Slim
- `config/container.php` - DI Container
- `tailwind.config.js` - Config Tailwind
