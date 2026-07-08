# 📋 Tâche 12: Plan B - En Cas de Rejet AdSense

> **Priorité**: 🟡 IMPORTANT (À lire AVANT soumission)  
> **Durée estimée**: Variable selon le problème  
> **Statut**: ⬜ Prêt à utiliser si nécessaire

---

## 🎯 Objectif

Avoir un plan d'action clair si Google rejette votre demande AdSense.

---

## ⚠️ RÉALITÉ DES REJETS

- **~40%** des sites sont rejetés la première fois
- Les rejets ne sont **pas permanents** (sauf ban de compte)
- Chaque re-soumission nécessite **2-4 semaines d'attente**
- Google donne rarement des raisons **précises**

---

## 📧 Types de Rejets et Solutions

### 1. "Insufficient Content" (Contenu Insuffisant)

**Message typique** :
> "Your site does not have enough original content..."

**Causes probables** :
- Pas assez de pages (< 10)
- Pages trop courtes
- Contenu trop similaire entre les pages

**Solutions** :
- [ ] Ajouter 10-20 pages métiers supplémentaires
- [ ] Enrichir les pages existantes (+500 mots par page)
- [ ] Ajouter des FAQ uniques par page
- [ ] Créer des guides (ex: "Guide complet du salaire en Suède")

**Avec raknalon.se** : Ce problème est peu probable (35 pages métiers).

---

### 2. "Site Under Construction" (Site en Construction)

**Message typique** :
> "Your site appears to be under construction..."

**Causes probables** :
- Pages avec placeholder ("Lorem ipsum")
- Liens cassés (404)
- Sections vides
- Template non personnalisé

**Solutions** :
- [ ] Vérifier qu'aucune page n'a de placeholder
- [ ] Tester tous les liens du site
- [ ] Remplir toutes les sections visibles
- [ ] Retirer les mentions "Coming soon"

**Commande de vérification** :
```bash
# Chercher des placeholders
grep -r "lorem ipsum\|coming soon\|under construction" templates/
```

---

### 3. "Policy Violations" (Violations de Politique)

**Message typique** :
> "We found policy violations on your site..."

**Causes probables** :
- Contenu interdit (adulte, violence, drogues)
- Contenus protégés par copyright
- Liens vers sites douteux
- Techniques SEO black hat

**Solutions** :
- [ ] Relire les [Politiques AdSense](https://support.google.com/adsense/answer/48182)
- [ ] Vérifier tous les liens sortants
- [ ] Supprimer tout contenu potentiellement problématique
- [ ] Vérifier que les images sont libres de droits

**Pour un site de salaires** : Ce problème est peu probable.

---

### 4. "Missing Pages" (Pages Manquantes)

**Message typique** :
> "Your site is missing required pages..."

**Causes probables** :
- Pas de Privacy Policy
- Pas de page About/Contact
- Pages légales non accessibles

**Solutions** :
- [ ] Vérifier que toutes les pages légales existent (Tâches 01-05)
- [ ] Vérifier qu'elles sont liées dans le footer
- [ ] Tester chaque URL manuellement

---

### 5. "Navigation Issues" (Problèmes de Navigation)

**Message typique** :
> "Your site has navigation issues..."

**Causes probables** :
- Menu principal cassé
- Pages orphelines
- Structure confuse

**Solutions** :
- [ ] Simplifier le menu principal
- [ ] Ajouter un breadcrumb
- [ ] Vérifier la cohérence de la navigation

---

## 🔄 Processus de Re-soumission

### Étape 1: Analyser le Rejet

1. Lire attentivement l'email de rejet
2. Identifier la raison principale (souvent vague)
3. Faire une auto-évaluation honnête du site

### Étape 2: Corriger les Problèmes

1. Appliquer les solutions correspondantes (voir ci-dessus)
2. Documenter les changements effectués
3. Tester le site de A à Z

### Étape 3: Attendre

⏳ **OBLIGATOIRE** : Attendre **minimum 2 semaines** avant de re-soumettre

### Étape 4: Re-soumettre

1. Reconnecter à AdSense
2. Demander une nouvelle révision
3. Attendre (peut prendre 1-4 semaines)

---

## ⛔ CAS OÙ IL FAUT ARRÊTER

### Rejet Définitif du Compte

Si vous recevez :
> "Your account has been disabled for policy violations"

**Cela signifie** :
- Votre compte AdSense est **banni définitivement**
- Vous ne pouvez **plus** créer de nouveau compte
- Essayer de contourner = ban permanent

**Solutions** :
- Utiliser une alternative (voir Tâche 13)
- Changer de modèle économique (affiliation, produits)

### Multiple Rejets (3+)

Si vous êtes rejeté 3 fois ou plus :
- Le site a probablement un problème fondamental
- Reconsidérer l'architecture ou le contenu
- Tester avec un expert AdSense

---

## 📊 Tableau de Suivi des Rejets

| Date | Raison du Rejet | Actions Prises | Date Re-soumission | Résultat |
| ---- | --------------- | -------------- | ------------------ | -------- |
|      |                 |                |                    |          |
|      |                 |                |                    |          |
|      |                 |                |                    |          |

---

## 💡 Conseils Pro

1. **Ne jamais spammer** : Attendre toujours 2-4 semaines entre les soumissions
2. **Documenter tout** : Noter les changements effectués après chaque rejet
3. **Être patient** : Certains sites sont approuvés au 3ème ou 4ème essai
4. **Demander de l'aide** : Forums AdSense, communautés SEO
5. **Avoir un Plan C** : Préparer des alternatives dès maintenant (voir Tâche 13)

---

## 🆘 Ressources en Cas de Rejet

- [Forum d'aide AdSense](https://support.google.com/adsense/community)
- [Centre d'aide AdSense](https://support.google.com/adsense)
- [Politiques AdSense](https://support.google.com/adsense/answer/48182)
- [Checklist Post-Rejet](https://support.google.com/adsense/answer/9724)
