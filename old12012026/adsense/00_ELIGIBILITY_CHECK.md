# 🔍 Tâche 00: Vérification d'Éligibilité (PREMIÈRE ÉTAPE)

> **Priorité**: 🔴 BLOQUANT  
> **Durée estimée**: 15 min  
> **Statut**: ⬜ À faire AVANT TOUT

---

## 🎯 Objectif

Vérifier que le site remplit les conditions préalables AVANT de commencer le travail.

---

## ⚠️ POURQUOI C'EST LA PREMIÈRE ÉTAPE

Si le domaine a été créé il y a moins de 30 jours, tout le travail sera inutile car Google rejettera automatiquement. Vérifions d'abord.

---

## 📋 Checklist de Pré-Éligibilité

### 1. Âge du Domaine

**Exigence** : Dans certains pays (dont la Suède), le domaine doit être actif depuis **au moins 30 jours**.

**Vérification** :
```bash
# Vérifier la date de création du domaine
whois raknalon.se | grep -i "created\|creation\|registered"
```

**Ou utiliser** : https://who.is/whois/raknalon.se

| Question                         | Réponse    | OK? |
| -------------------------------- | ---------- | --- |
| Date de création du domaine      | __________ | ⬜   |
| Domaine actif depuis 30+ jours ? | Oui / Non  | ⬜   |

**Si < 30 jours** : 
- ⏸️ STOP - Attendre que le délai soit passé
- Utiliser ce temps pour préparer les pages (sans soumettre)

---

### 2. Propriété du Domaine

**Exigence** : Vous devez être le propriétaire légal ou avoir les droits d'utilisation.

| Question                               | Réponse   |
| -------------------------------------- | --------- |
| Êtes-vous propriétaire du domaine ?    | Oui / Non |
| Avez-vous accès au DNS ?               | Oui / Non |
| Avez-vous accès à l'email du domaine ? | Oui / Non |

---

### 3. Historique du Domaine

**Exigence** : Le domaine ne doit pas avoir été banni d'AdSense auparavant.

**Vérification** :
1. Allez sur https://web.archive.org/
2. Entrez `raknalon.se`
3. Vérifiez l'historique

| Question                              | Réponse    |
| ------------------------------------- | ---------- |
| Le domaine a-t-il été utilisé avant ? | Oui / Non  |
| Si oui, pour quel type de site ?      | __________ |
| Traces de contenu interdit ?          | Oui / Non  |

---

### 4. Site Accessible

**Exigence** : Le site doit être en ligne et accessible publiquement.

**Vérification** :
```bash
# Tester l'accessibilité
curl -I https://raknalon.se
```

| Question                             | Réponse          |
| ------------------------------------ | ---------------- |
| Le site répond-il en HTTPS ?         | Oui / Non        |
| Code de réponse HTTP                 | 200 / Autre: ___ |
| Temps de réponse acceptable (< 3s) ? | Oui / Non        |

---

### 5. Pas de Compte AdSense Banni

**Exigence** : Le propriétaire ne doit pas avoir de compte AdSense banni.

| Question                                  | Réponse           |
| ----------------------------------------- | ----------------- |
| Avez-vous déjà eu un compte AdSense ?     | Oui / Non         |
| Si oui, est-il toujours actif ?           | Oui / Non / Banni |
| Avez-vous un autre compte AdSense actif ? | Oui / Non         |

**⚠️ Important** : Un seul compte AdSense par personne. Créer un deuxième compte = ban permanent.

---

## 📊 Résultat de l'Éligibilité

### Tableau de Décision

| Critère                        | Statut | Bloquant ?  |
| ------------------------------ | ------ | ----------- |
| Domaine > 30 jours             | ⬜      | 🔴 OUI       |
| Propriété confirmée            | ⬜      | 🔴 OUI       |
| Pas d'historique problématique | ⬜      | 🟡 Peut-être |
| Site accessible HTTPS          | ⬜      | 🔴 OUI       |
| Pas de ban AdSense             | ⬜      | 🔴 OUI       |

---

## 🚦 Décision

### ✅ Si TOUS les critères sont OK :
→ Passer à la **Tâche 01** (Integritetspolicy)

### ⏸️ Si le domaine a < 30 jours :
→ Noter la date d'éligibilité : `__________`
→ Préparer les pages en attendant (stockées localement)
→ Soumettre à la date calculée

### ❌ Si compte AdSense banni :
→ **STOP TOTAL**. Utiliser une alternative (voir Tâche 13)
→ Options : Ezoic, Mediavine, affiliation

### ⚠️ Si historique problématique :
→ Vérifier sur Google SafeBrowsing : https://transparencyreport.google.com/safe-browsing/search
→ Si clean, continuer avec prudence
→ Si flagué, attendre 6 mois ou changer de domaine

---

## 📝 Notes

```
Date de vérification : ___________
Éligible : Oui / Non / Attendre jusqu'au ___________
Notes : 
_________________________________________________
_________________________________________________
```
