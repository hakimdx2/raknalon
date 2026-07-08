# 04 - Pages Métiers (Programmatic SEO)

**Priorité**: 🟡 Moyenne  
**Durée estimée**: 6-8 heures  
**Statut**: [ ] À faire

---

## Objectif
Générer 50+ pages métiers ciblant les keywords "[profession] lön"

## URL Pattern
`/lon/[slug]` → ex: `/lon/psykolog`, `/lon/lakare`

## Top 25 Prioritaires (KD < 16)

| Slug                | Keyword                 | Volume |  KD   |
| :------------------ | :---------------------- | -----: | :---: |
| psykolog            | psykolog lön            |  2,900 |  11   |
| audionom            | audionom lön            |    720 |  11   |
| controller          | controller lön          |  1,300 |  12   |
| cnc-operator        | cnc operatör lön        |  1,900 |  12   |
| enhetschef          | enhetschef lön          |  1,000 |  12   |
| vvs-ingenjor        | vvs ingenjör lön        |  1,000 |  12   |
| apotekstekniker     | apotekstekniker lön     |  1,900 |  13   |
| bibliotekarie       | bibliotekarie lön       |  1,900 |  13   |
| buschauffor         | busschaufför lön        |  1,900 |  13   |
| elevassistent       | elevassistent lön       |  1,900 |  13   |
| fastighetsskotare   | fastighetsskötare lön   |  1,900 |  13   |
| rormokare           | rörmokare lön           |  1,900 |  13   |
| hemtjanst           | hemtjänst lön           |    880 |  13   |
| automationsingenjor | automationsingenjör lön |  1,000 |  13   |
| vvs-montor          | vvs montör lön          |  1,000 |  13   |
| dietist             | dietist lön             |    720 |  13   |
| elkraftsingenjor    | elkraftsingenjör lön    |    720 |  13   |
| lokforare           | lokförare lön           |  4,400 |  14   |
| ekonomiassistent    | ekonomiassistent lön    |  2,400 |  14   |
| ambulansforare      | ambulansförare lön      |  1,000 |  14   |
| maskinoperator      | maskinoperatör lön      |    720 |  14   |
| barnmorska          | barnmorska lön          |  2,900 |  15   |
| frisor              | frisör lön              |    880 |  15   |
| arbetsledare        | arbetsledare lön        |    880 |  15   |

## Sous-tâches

### Données Métiers
- [ ] Créer `data/professions.json` avec:
  - Nom, slug, salaire median, salaire moyen
  - Description courte
  - Formation requise
- [ ] Source: SCB.se statistiques salaires

### Template `/lon/[slug]`
- [ ] Créer `templates/profession.twig`
- [ ] H1: "Hur mycket tjänar en [Profession] 2026?"
- [ ] Stats box: Median, Medel, Évolution
- [ ] Calculateur intégré: "Räkna ut din lön som [Profession]"
- [ ] Section: Utbildning, Arbetsuppgifter
- [ ] Section: Jämför med andra yrken
- [ ] Schema.org Occupation

### Routes
- [ ] Route dynamique `/lon/{slug}`
- [ ] Controller `ProfessionController.php`
- [ ] 404 si métier non trouvé

### SEO
- [ ] Meta title: "[Profession] Lön 2026 - Medellön & Statistik"
- [ ] Meta description dynamique
- [ ] Sitemap pour toutes les pages métiers
