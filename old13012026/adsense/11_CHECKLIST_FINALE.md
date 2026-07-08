# ✅ Tâche 11: Checklist Finale Avant Soumission AdSense (v2.0)

> **Priorité**: 🔴 FINALE  
> **Durée estimée**: 30 min (vérification)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Vérification complète et systématique avant de soumettre le site à Google AdSense.

---

## ⚠️ RAPPEL IMPORTANT

**Taux d'approbation estimé avec cette checklist complète : ~85%**

Même avec tout en vert, Google peut rejeter pour des raisons subjectives. Voir le Plan B (Tâche 12) si rejet.

---

## 📋 CHECKLIST COMPLÈTE

### Phase 0: Éligibilité (BLOQUANT)

| Élément                        | Vérifié | Notes              |
| ------------------------------ | ------- | ------------------ |
| Domaine actif depuis 30+ jours | ⬜       | Date création: ___ |
| Pas de ban AdSense antérieur   | ⬜       |                    |
| Propriétaire du domaine        | ⬜       |                    |
| Site accessible en HTTPS       | ⬜       |                    |

**⛔ Si un élément est NON → STOP. Résoudre d'abord.**

---

### Phase 1: Pages Légales Obligatoires

| Page                | URL                    | HTTP 200 | Lié dans Footer |
| ------------------- | ---------------------- | -------- | --------------- |
| Integritetspolicy   | `/integritetspolicy`   | ⬜        | ⬜               |
| Om oss              | `/om-oss`              | ⬜        | ⬜               |
| Kontakt             | `/kontakt`             | ⬜        | ⬜               |
| Cookies             | `/cookies`             | ⬜        | ⬜               |
| Ansvarsfriskrivning | `/ansvarsfriskrivning` | ⬜        | ⬜               |

**Test rapide** :
```bash
for page in integritetspolicy om-oss kontakt cookies ansvarsfriskrivning; do
  echo -n "$page: "
  curl -s -o /dev/null -w "%{http_code}\n" "https://raknalon.se/$page"
done
```

---

### Phase 2: Contenu du Site

| Critère                        | Minimum | Actuel                | OK  |
| ------------------------------ | ------- | --------------------- | --- |
| Nombre de pages contenu        | 10+     | 35 métiers + concepts | ✅   |
| Mots par page                  | 500+    | ~800                  | ✅   |
| Contenu 100% original          | Oui     | Oui                   | ✅   |
| Pas de placeholder/Lorem ipsum | 0       | ⬜                     |     |
| FAQ sur les pages clés         | ⬜       |                       |     |

**Vérification placeholder** :
```bash
grep -ri "lorem\|placeholder\|coming soon\|todo\|fixme" templates/
```

---

### Phase 3: E-E-A-T (Confiance)

| Élément                        | Présent | Lien             |
| ------------------------------ | ------- | ---------------- |
| Sources citées (Skatteverket)  | ⬜       |                  |
| Sources citées (SCB)           | ⬜       |                  |
| Date de mise à jour visible    | ⬜       |                  |
| Page méthodologie              | ⬜       | `/sa-raknar-vi`  |
| Email de contact professionnel | ⬜       | info@raknalon.se |

---

### Phase 4: Navigation & Footer

| Élément                          | Présent |
| -------------------------------- | ------- |
| Menu principal fonctionnel       | ⬜       |
| Section "Juridiskt" dans footer  | ⬜       |
| Tous les liens footer cliquables | ⬜       |
| Copyright © 2026                 | ⬜       |
| Pas de liens cassés              | ⬜       |

---

### Phase 5: Technique

| Élément                  | Statut | Action si NON              |
| ------------------------ | ------ | -------------------------- |
| HTTPS actif              | ⬜      | Activer SSL                |
| Redirection HTTP → HTTPS | ⬜      | Configurer .htaccess       |
| Sitemap.xml valide       | ⬜      | Vérifier SitemapController |
| Robots.txt correct       | ⬜      | Vérifier contenu           |
| ads.txt créé             | ⬜      | Créer `ads.txt`            |
| Score PageSpeed > 70     | ⬜      | Optimiser si besoin        |
| Mobile-friendly          | ⬜      | Tester responsive          |

**Tests techniques** :
```bash
# HTTPS
curl -I https://raknalon.se

# Sitemap
curl -s https://raknalon.se/sitemap.xml | head -20

# Robots
curl https://raknalon.se/robots.txt

# PageSpeed
# → https://pagespeed.web.dev/

# Mobile
# → https://search.google.com/test/mobile-friendly
```

---

### Phase 6: Vérification Manuelle (15 min)

#### Test 1: Navigation Complète
- [ ] Ouvrir la homepage
- [ ] Tester le calculateur avec plusieurs valeurs
- [ ] Cliquer sur "Alla yrken"
- [ ] Ouvrir 3 pages métiers différentes
- [ ] Vérifier que la FAQ fonctionne
- [ ] Retourner à la homepage

#### Test 2: Pages Légales
- [ ] Cliquer sur chaque lien du footer
- [ ] Vérifier que le contenu s'affiche
- [ ] Vérifier les liens externes (Skatteverket, etc.)

#### Test 3: Mobile
- [ ] Ouvrir le site sur mobile (ou DevTools)
- [ ] Naviguer sur 5 pages
- [ ] Vérifier la lisibilité
- [ ] Tester le calculateur

#### Test 4: Errors Check
- [ ] Ouvrir la Console du navigateur (F12)
- [ ] Naviguer sur 5 pages
- [ ] Vérifier qu'il n'y a pas d'erreurs JavaScript rouges

---

## 📊 Résumé Pré-Soumission

```
ÉLIGIBILITÉ:       [_/4] ⬜
PAGES LÉGALES:     [_/10] ⬜
CONTENU:           [_/5] ⬜
E-E-A-T:           [_/5] ⬜
NAVIGATION:        [_/5] ⬜
TECHNIQUE:         [_/7] ⬜
TESTS MANUELS:     [_/4] ⬜

TOTAL:             [__/40]
```

### Interprétation

| Score    | Décision                                      |
| -------- | --------------------------------------------- |
| 40/40    | 🟢 Soumettre maintenant                        |
| 35-39/40 | 🟡 Corriger les points mineurs, puis soumettre |
| 30-34/40 | 🟠 Corriger les points, attendre 1 semaine     |
| < 30/40  | 🔴 NE PAS soumettre, trop risqué               |

---

## 🚀 Étapes de Soumission

### Quand le score est ≥ 35/40 :

1. **Aller sur** [adsense.google.com](https://www.google.com/adsense/)

2. **Se connecter** ou créer un compte Google

3. **Ajouter le site** : `raknalon.se`

4. **Récupérer le code de vérification** :
```html
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
     crossorigin="anonymous"></script>
```

5. **Ajouter dans le `<head>`** de `templates/home.twig` (ou layout.twig)

6. **Déployer** les changements

7. **Retourner sur AdSense** et cliquer "Demander l'examen"

8. **Attendre** 1 à 4 semaines

---

## 📅 Suivi Post-Soumission

| Date | Action                    | Résultat          |
| ---- | ------------------------- | ----------------- |
| ___  | Soumission initiale       | En attente        |
| ___  | Réponse Google            | Approuvé / Rejeté |
| ___  | (Si rejeté) Re-soumission |                   |

---

## 🆘 En Cas de Rejet

→ Voir **Tâche 12: Plan B - En Cas de Rejet**

Points clés :
1. Lire l'email attentivement
2. Ne PAS re-soumettre immédiatement
3. Corriger les problèmes identifiés
4. Attendre 2-4 semaines
5. Re-soumettre

---

## ✅ Dernière Vérification Mentale

Avant de cliquer "Soumettre", demandez-vous :

- [ ] "Est-ce que j'utiliserais ce site moi-même ?"
- [ ] "Est-ce que les pages légales sont complètes et honnêtes ?"
- [ ] "Est-ce que le contenu est utile et original ?"
- [ ] "Est-ce que je serais fier de montrer ce site à un client ?"

Si toutes les réponses sont OUI → **Soumettez !** 🚀
