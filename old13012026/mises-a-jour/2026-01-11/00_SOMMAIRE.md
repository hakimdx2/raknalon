# 🚀 Mise à jour Raknalon.se - 11 Janvier 2026

## ✅ STATUT : TERMINÉ ET TESTÉ

> ⚠️ **IMPORTANT** : Ce projet est en PRODUCTION. Les modifications sont prêtes pour déploiement.

---

## 📋 Vue d'Ensemble

### Contexte
Suite à l'exploration de l'API SCB (Statistiska centralbyrån), nous avons extrait des données officielles qui peuvent enrichir considérablement Raknalon.se :

| Donnée                        | Source        | Fichier                          |
| ----------------------------- | ------------- | -------------------------------- |
| 151 professions avec salaires | SCB 2024      | `01_privat_tjansteman_2024.json` |
| Gender pay gap (H/F)          | SCB 2024      | `01_privat_tjansteman_2024.json` |
| Distribution (percentiles)    | SCB 2024      | `06_percentiles_2024.json`       |
| Historique 10 ans             | SCB 2014-2024 | `07_historique_2014_2024.json`   |

### Avantages
- ✅ **E-E-A-T** : Source officielle SCB = crédibilité maximale
- ✅ **Données fraîches** : Année 2024 disponible
- ✅ **Richesse** : Gender gap, percentiles, historique

---

## 📁 Fichiers de cette mise à jour

| Fichier                         | Description                         |
| ------------------------------- | ----------------------------------- |
| `00_SOMMAIRE.md`                | Ce fichier (vue d'ensemble)         |
| `01_PREPARATION.md`             | Étapes préparatoires                |
| `02_INTEGRATION_DONNEES.md`     | Intégration des données SCB         |
| `03_MODIFICATIONS_TEMPLATES.md` | Changements dans les templates Twig |
| `04_NOUVEAUX_CONTENUS.md`       | Nouveaux blocs de contenu           |
| `05_TESTS.md`                   | Checklist de tests                  |
| `06_DEPLOIEMENT.md`             | Procédure de déploiement            |

---

## ⏱️ Estimation du Travail

| Tâche                   | Temps estimé | Priorité    |
| ----------------------- | ------------ | ----------- |
| Préparation & backup    | 30 min       | 🔴 Critique  |
| Intégration données SCB | 2h           | 🔴 Critique  |
| Modification templates  | 3h           | 🟡 Important |
| Tests locaux            | 1h           | 🔴 Critique  |
| Déploiement             | 30 min       | 🔴 Critique  |

**Total estimé** : ~7 heures

---

## ✅ Décision Requise

Avant de procéder, confirme :

1. [ ] Veux-tu intégrer les données SCB officielles ?
2. [ ] Veux-tu ajouter le bloc "Gender Pay Gap" ?
3. [ ] Veux-tu ajouter les graphiques "Löneutveckling 10 ans" ?
4. [ ] Veux-tu ajouter les percentiles (P10, P25, P50, P75, P90) ?
5. [ ] Quel est le délai souhaité ?

---

## 🔗 Ressources

- Données extraites : `projets/draft/salaire-se/data/`
- API SCB : https://api.scb.se
- Documentation API : https://github.com/PxTools/PxApiSpecs
