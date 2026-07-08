# 📊 Top Employeurs Kommunal par Län (Suède)

> **Source principale** : Regionfakta / SCB Företagsregistret
> **Date de collecte** : 12 janvier 2026
> **Objectif** : Enrichir les pages `/lon/region/{slug}` avec les principaux employeurs publics

---

## ✅ Västra Götalands län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](https://www.regionfakta.com/vastra-gotalands-lan/arbete/storsta-arbetsgivare/)

```json
{
  "lan_slug": "vastra-gotalands-lan",
  "employers": [
    {"name": "Västra Götalandsregionen", "type": "region", "employees": 50525},
    {"name": "Göteborgs kommun", "type": "kommun", "employees": 44525},
    {"name": "Borås kommun", "type": "kommun", "employees": 12675},
    {"name": "Göteborgs universitet", "type": "universitet", "employees": 7775},
    {"name": "Uddevalla kommun", "type": "kommun", "employees": 6275},
    {"name": "Trollhättans kommun", "type": "kommun", "employees": 5775},
    {"name": "Mölndals kommun", "type": "kommun", "employees": 5625},
    {"name": "Chalmers tekniska högskola AB", "type": "högskola", "employees": 3175},
    {"name": "Försvarsmakten", "type": "myndighet", "employees": 3975}
  ]
}
```

---

## 🔄 Stockholms län (SQUELETTE)

**Source** : Region Stockholm ~45 000 anställda ([Funktionsrätt](https://funktionsrattstockholmslan.se/))

```json
{
  "lan_slug": "stockholms-lan",
  "employers": [
    {"name": "Stockholms stad", "type": "kommun", "employees": null},
    {"name": "Huddinge kommun", "type": "kommun", "employees": null},
    {"name": "Sollentuna kommun", "type": "kommun", "employees": null},
    {"name": "Region Stockholm", "type": "region", "employees": 45000},
    {"name": "Karolinska Universitetssjukhuset", "type": "sjukhus", "employees": null},
    {"name": "Södersjukhuset", "type": "sjukhus", "employees": null},
    {"name": "Stockholms universitet", "type": "universitet", "employees": null},
    {"name": "KTH Kungliga Tekniska högskolan", "type": "universitet", "employees": null},
    {"name": "Polismyndigheten", "type": "myndighet", "employees": null}
  ]
}
```

---

## 🔄 Skåne län (SQUELETTE)

**Source** : Malmö kommun = 23 525 anställda ([SKR Kommunrapport](https://filer.skane.se/kommunrapporter/Kommunrapport_Malmo.html))

```json
{
  "lan_slug": "skane-lan",
  "employers": [
    {"name": "Malmö kommun", "type": "kommun", "employees": 23525},
    {"name": "Helsingborgs stad", "type": "kommun", "employees": null},
    {"name": "Lunds kommun", "type": "kommun", "employees": null},
    {"name": "Region Skåne", "type": "region", "employees": null},
    {"name": "Skånes universitetssjukhus (SUS)", "type": "sjukhus", "employees": null},
    {"name": "Helsingborgs lasarett", "type": "sjukhus", "employees": null},
    {"name": "Lunds universitet", "type": "universitet", "employees": null}
  ]
}
```

---

## 🔄 Uppsala län (SQUELETTE)

**Source** : [SYNA Top 100](https://upplysningar.syna.se/nyheter/nyhet/100-storsta-arbetsgivarna-i-uppsala-lan) (effectifs non disponibles)

```json
{
  "lan_slug": "uppsala-lan",
  "employers": [
    {"name": "Uppsala kommun", "type": "kommun", "employees": null},
    {"name": "Enköpings kommun", "type": "kommun", "employees": null},
    {"name": "Älvkarleby kommun", "type": "kommun", "employees": null},
    {"name": "Region Uppsala", "type": "region", "employees": null},
    {"name": "Akademiska sjukhuset", "type": "sjukhus", "employees": null},
    {"name": "Lasarettet i Enköping", "type": "sjukhus", "employees": null},
    {"name": "Uppsala universitet", "type": "universitet", "employees": null},
    {"name": "SLU (Sveriges lantbruksuniversitet)", "type": "universitet", "employees": null}
  ]
}
```

---

## 🔄 Östergötlands län (SQUELETTE)

**Source** : [LargestCompanies](https://www.largestcompanies.se/topplistor/sverige/de-storsta-arbetsgivarna/ostergotlands-lan) (privé principalement)

```json
{
  "lan_slug": "ostergotlands-lan",
  "employers": [
    {"name": "Linköpings kommun", "type": "kommun", "employees": null},
    {"name": "Norrköpings kommun", "type": "kommun", "employees": null},
    {"name": "Motala kommun", "type": "kommun", "employees": null},
    {"name": "Region Östergötland", "type": "region", "employees": null},
    {"name": "Universitetssjukhuset i Linköping (US)", "type": "sjukhus", "employees": null},
    {"name": "Vrinnevisjukhuset (Norrköping)", "type": "sjukhus", "employees": null},
    {"name": "Linköpings universitet", "type": "universitet", "employees": null}
  ]
}
```

---

## ✅ Gotlands län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](https://www.regionfakta.com/gotlands-lan/arbete/storsta-arbetsgivare/)

```json
{
  "lan_slug": "gotlands-lan",
  "employers": [
    {"name": "Region Gotland", "type": "kommun/region", "employees": 6875},
    {"name": "Försvarsmakten", "type": "myndighet", "employees": 425},
    {"name": "Polismyndigheten", "type": "myndighet", "employees": 275},
    {"name": "Uppsala universitet", "type": "universitet", "employees": 175},
    {"name": "Centrala studiestödsnämnden (CSN)", "type": "myndighet", "employees": 125},
    {"name": "AB GotlandsHem", "type": "kommunalt bostadsbolag", "employees": 125}
  ]
}
```

---

## ✅ Norrbottens län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](http://www.regionfakta.com/Norrbottens-lan/Arbete/Storsta-arbetsgivare/)

```json
{
  "lan_slug": "norrbottens-lan",
  "employers": [
    {"name": "Luleå kommun", "type": "kommun", "employees": 7925},
    {"name": "Region Norrbotten", "type": "region", "employees": 7225},
    {"name": "Piteå kommun", "type": "kommun", "employees": 5225},
    {"name": "Bodens kommun", "type": "kommun", "employees": 2925},
    {"name": "Kiruna kommun", "type": "kommun", "employees": 2125},
    {"name": "Gällivare kommun", "type": "kommun", "employees": 1975},
    {"name": "Luleå tekniska universitet", "type": "universitet", "employees": 1675}
  ]
}
```

---

## ✅ Hallands län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](https://www.regionfakta.com/hallands-lan/arbete/storsta-arbetsgivare/)

```json
{
  "lan_slug": "hallands-lan",
  "employers": [
    {"name": "Halmstads kommun", "type": "kommun", "employees": 9575},
    {"name": "Region Halland", "type": "region", "employees": 9175},
    {"name": "Kungsbacka kommun", "type": "kommun", "employees": 8425},
    {"name": "Varbergs kommun", "type": "kommun", "employees": 5825},
    {"name": "Falkenbergs kommun", "type": "kommun", "employees": 4225},
    {"name": "Laholms kommun", "type": "kommun", "employees": 2625},
    {"name": "Hylte kommun", "type": "kommun", "employees": 1175},
    {"name": "Försvarsmakten", "type": "myndighet", "employees": 1975},
    {"name": "Polismyndigheten", "type": "myndighet", "employees": 825}
  ]
}
```

---

## ✅ Västmanlands län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](https://www.regionfakta.com/vastmanlands-lan/arbete/storsta-arbetsgivare/)

```json
{
  "lan_slug": "vastmanlands-lan",
  "employers": [
    {"name": "Västerås kommun", "type": "kommun", "employees": 9975},
    {"name": "Region Västmanland", "type": "region", "employees": 7475},
    {"name": "Köpings kommun", "type": "kommun", "employees": 3225},
    {"name": "Sala kommun", "type": "kommun", "employees": 3025},
    {"name": "Hallstahammars kommun", "type": "kommun", "employees": 1975},
    {"name": "Fagersta kommun", "type": "kommun", "employees": 1675},
    {"name": "Arboga kommun", "type": "kommun", "employees": 1375},
    {"name": "Kriminalvården", "type": "myndighet", "employees": 825}
  ]
}
```

---

## ✅ Värmlands län (COMPLET)

**Source** : [Regionfakta - Största arbetsgivare](https://www.regionfakta.com/varmlands-lan/arbete/storsta-arbetsgivare/)

```json
{
  "lan_slug": "varmlands-lan",
  "employers": [
    {"name": "Region Värmland", "type": "region", "employees": 10175},
    {"name": "Karlstads kommun", "type": "kommun", "employees": 8575},
    {"name": "Arvika kommun", "type": "kommun", "employees": 3125},
    {"name": "Kristinehamns kommun", "type": "kommun", "employees": 2525},
    {"name": "Säffle kommun", "type": "kommun", "employees": 1775},
    {"name": "Torsby kommun", "type": "kommun", "employees": 1725},
    {"name": "Hammarö kommun", "type": "kommun", "employees": 1625},
    {"name": "Filipstads kommun", "type": "kommun", "employees": 1475},
    {"name": "Kils kommun", "type": "kommun", "employees": 1375},
    {"name": "Forshaga kommun", "type": "kommun", "employees": 1275},
    {"name": "Karlstads universitet", "type": "universitet", "employees": null},
    {"name": "Polismyndigheten", "type": "myndighet", "employees": 775},
    {"name": "MSB", "type": "myndighet", "employees": 575}
  ]
}
```

---

## ⏳ Län restants (11)

| #   | Län                 | Status |
| --- | ------------------- | ------ |
| 6   | Jönköpings län      | ⏳      |
| 7   | Kronobergs län      | ⏳      |
| 8   | Kalmar län          | ⏳      |
| 10  | Blekinge län        | ⏳      |
| 13  | Örebro län          | ⏳      |
| 15  | Dalarnas län        | ⏳      |
| 16  | Gävleborgs län      | ⏳      |
| 17  | Västernorrlands län | ⏳      |
| 18  | Jämtlands län       | ⏳      |
| 19  | Västerbottens län   | ⏳      |
| 21  | Södermanlands län   | ⏳      |

---

## 📊 Résumé

| Status       | Count  | Län                                                                  |
| ------------ | ------ | -------------------------------------------------------------------- |
| ✅ COMPLET    | **6**  | Västra Götaland, Gotland, Norrbotten, Halland, Västmanland, Värmland |
| 🔄 SQUELETTE  | **4**  | Stockholm, Skåne, Uppsala, Östergötland                              |
| ⏳ EN ATTENTE | **11** | Restants                                                             |

---

## 📝 Notes

- **Source** : Regionfakta / SCB Företagsregistret 2023
- **Polismyndigheten** : Effectifs parfois non disponibles dans certains extraits
