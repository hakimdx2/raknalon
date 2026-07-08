# 03 - Import Données Taxes

**Priorité**: 🔴 Haute  
**Durée estimée**: 2-3 heures  
**Statut**: [ ] À faire

---

## Objectif
Récupérer et structurer les taux de taxes pour les 290 communes suédoises

## Sources de Données

1. **Skatteverket** (officiel)
   - URL: https://www.skatteverket.se/privat/skatter/arbeteochinkomst/skattetabeller.html
   - Format: PDF/Excel

2. **SCB** (Statistiques)
   - Données salaires par métier
   - URL: https://www.scb.se/

## Sous-tâches

- [ ] Télécharger les taux de taxes 2026 de Skatteverket
- [ ] Parser les données en JSON
- [ ] Créer `data/kommuner.json`:
  ```json
  {
    "stockholm": {
      "name": "Stockholm",
      "rate": 29.98,
      "region": "Stockholm"
    },
    "goteborg": {
      "name": "Göteborg", 
      "rate": 32.12,
      "region": "Västra Götaland"
    }
  }
  ```
- [ ] Créer `data/tax_rules_2026.json`:
  ```json
  {
    "statlig_skatt_threshold": 540700,
    "statlig_skatt_rate": 0.20,
    "jobbskatteavdrag": {...}
  }
  ```
- [ ] Implémenter `TaxDataService.php`
- [ ] Tester avec 5 communes représentatives

## Validation

- [ ] Vérifier les calculs vs Skatteverket's calculator
- [ ] Test: Stockholm, 40 000 SEK brutto
- [ ] Test: Göteborg, 30 000 SEK brutto
