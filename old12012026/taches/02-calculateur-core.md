# 02 - Calculateur Core (Homepage)

**Priorité**: 🔴 Haute  
**Durée estimée**: 4-5 heures  
**Statut**: [ ] À faire

---

## Objectif
Développer le calculateur principal Bruttolön → Nettolön pour la homepage

## Keywords Cibles

| Keyword                        | Volume |  KD   |
| :----------------------------- | -----: | :---: |
| räkna ut timlön                |  1,600 |   9   |
| räkna ut månadslön till timlön |    390 |   9   |
| nettolön kalkylator            |    210 |  13   |
| löneberäkning                  |    170 |  12   |

## Sous-tâches

### Logique Métier
- [ ] Créer `SalaryCalculatorService.php`
- [ ] Implémenter le calcul Bruttolön → Nettolön
- [ ] Intégrer les taux de taxes municipales (290+ kommuner)
- [ ] Gérer le jobbskatteavdrag (déduction fiscale)
- [ ] Gérer la statlig skatt (impôt d'État > 540 700 SEK)
- [ ] Calculateur Timlön ↔ Månadslön

### Interface
- [ ] Design du formulaire de calcul (Tailwind)
- [ ] Inputs: Bruttolön, Kommun (dropdown), Ålder
- [ ] Outputs: Nettolön, Skatt, Arbetsgivaravgift
- [ ] Animation résultats en temps réel (Alpine.js)
- [ ] Mobile-first responsive

### SEO On-Page
- [ ] H1: "Lönekalkylator - Räkna ut din lön efter skatt"
- [ ] Meta title: "Räkna Ut Lön | Lönekalkylator 2026 | raknalon.se"
- [ ] Meta description optimisée
- [ ] Schema.org WebApplication

## Données Requises
- Fichier JSON des taux de taxes par kommun
- Source: [Skatteverket](https://www.skatteverket.se/)

## Formule Simplifiée

```
Nettolön = Bruttolön - Kommunalskatt - (Statlig skatt si applicable) + Jobbskatteavdrag
```
