# 📋 Tâche 05: Page Ansvarsfriskrivning (Disclaimer)

> **Priorité**: 🟡 IMPORTANT  
> **Durée estimée**: 15 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer la page de disclaimer pour protéger le site juridiquement. **Contenu suédois complet ci-dessous.**

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/ansvarsfriskrivning.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/ansvarsfriskrivning', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/ansvarsfriskrivning.twig', [
        'title' => 'Ansvarsfriskrivning | Raknalon.se',
        'meta_description' => 'Viktig information om begränsningar och ansvarsfriskrivning för Raknalon.se lönekalkylatorer.',
        'canonical' => 'https://raknalon.se/ansvarsfriskrivning'
    ]);
});
```

---

## 📝 CONTENU SUÉDOIS COMPLET (Copier-coller)

```html
{% extends "layout.twig" %}

{% block content %}
<div class="max-w-4xl mx-auto px-4 py-12">
    <article class="prose prose-slate max-w-none">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Ansvarsfriskrivning</h1>
        <p class="text-sm text-slate-500 mb-8">Gäller från: Januari 2026</p>

        <!-- Important Notice -->
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-8 not-prose">
            <div class="flex gap-4">
                <span class="text-3xl">⚠️</span>
                <div>
                    <h2 class="text-lg font-semibold text-amber-800 mb-2">Viktigt att läsa</h2>
                    <p class="text-amber-700">Alla beräkningar på raknalon.se är <strong>uppskattningar</strong> och ska inte betraktas som finansiell eller juridisk rådgivning. Din faktiska lön kan skilja sig från våra beräkningar.</p>
                </div>
            </div>
        </div>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">1. Allmänt</h2>
            <p>Raknalon.se tillhandahåller onlineverktyg för att beräkna lön efter skatt, jämföra löner mellan yrken och förstå det svenska skattesystemet.</p>
            <p>All information och alla beräkningar som presenteras på denna webbplats är avsedda endast för informationsändamål och utgör <strong>inte</strong> professionell finansiell, skattemässig eller juridisk rådgivning.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">2. Uppskattningar, inte garantier</h2>
            <p>Våra lönekalkylatorer ger <strong>uppskattningar</strong> baserade på:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Officiella skattesatser publicerade av Skatteverket</li>
                <li>Kommunala skattesatser från SKR</li>
                <li>Jobbskatteavdragsregler för aktuellt inkomstår</li>
                <li>Lönestatistik från SCB</li>
            </ul>
            <p class="mt-4">Din faktiska nettolön kan <strong>avvika</strong> från våra beräkningar på grund av:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Personliga skatteavdrag (ränteavdrag, ROT/RUT, etc.)</li>
                <li>Förmåner (tjänstebil, lunch, friskvård)</li>
                <li>Särskilda skatteregler (t.ex. expertskatt)</li>
                <li>Fackliga avgifter och andra löneavdrag</li>
                <li>Individuella beslut från Skatteverket</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">3. Lönestatistik</h2>
            <p>Löneuppgifterna för olika yrken på raknalon.se baseras på officiell statistik och kollektivavtal, men representerar <strong>genomsnitt och medianer</strong>.</p>
            <p>Din faktiska lön påverkas av:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Erfarenhet och utbildning</li>
                <li>Arbetsgivare och bransch</li>
                <li>Geografisk plats</li>
                <li>Förhandlingsförmåga</li>
                <li>Konjunktur och arbetsmarknad</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">4. Ingen finansiell rådgivning</h2>
            <p>Informationen på raknalon.se ska <strong>inte</strong> betraktas som:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Finansiell rådgivning</li>
                <li>Skatterådgivning</li>
                <li>Juridisk rådgivning</li>
                <li>Investeringsrådgivning</li>
            </ul>
            
            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 mt-4 not-prose">
                <p class="text-indigo-800">
                    <strong>Rekommendation:</strong> För beslut som rör din ekonomi, konsultera alltid en kvalificerad expert som en auktoriserad revisor, skattejurist eller Skatteverket direkt.
                </p>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">5. Ansvarsbegränsning</h2>
            <p>Raknalon.se och dess ägare:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Garanterar inte att informationen är korrekt, fullständig eller aktuell</li>
                <li>Ansvarar inte för eventuella fel i beräkningar eller statistik</li>
                <li>Ansvarar inte för ekonomiska beslut baserade på webbplatsens innehåll</li>
                <li>Ansvarar inte för skador som kan uppstå till följd av användningen av webbplatsen</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">6. Externa länkar</h2>
            <p>Vår webbplats innehåller länkar till externa webbplatser, inklusive:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Skatteverket (skatteverket.se)</li>
                <li>Statistiska Centralbyrån (scb.se)</li>
                <li>Sveriges Kommuner och Regioner (skr.se)</li>
            </ul>
            <p class="mt-2">Vi ansvarar inte för innehållet på dessa externa webbplatser. Länkarna tillhandahålls för din bekvämlighet.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">7. Uppdateringar</h2>
            <p>Skatteregler, avdrag och lönestatistik kan ändras årligen. Vi strävar efter att hålla informationen uppdaterad, men kan inte garantera att alla uppgifter alltid är aktuella vid tidpunkten för ditt besök.</p>
            <p>Senaste uppdatering av skattedata: <strong>Januari 2026</strong></p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">8. Officiella källor</h2>
            <p>För officiell och juridiskt bindande information, vänd dig alltid till:</p>
            
            <div class="grid gap-4 md:grid-cols-2 mt-4 not-prose">
                <a href="https://www.skatteverket.se" target="_blank" rel="noopener" class="flex items-center gap-3 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">🏛️</span>
                    <div>
                        <p class="font-semibold text-indigo-600">Skatteverket</p>
                        <p class="text-sm text-slate-500">Officiella skatteregler</p>
                    </div>
                </a>
                <a href="https://www.scb.se" target="_blank" rel="noopener" class="flex items-center gap-3 p-4 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">📊</span>
                    <div>
                        <p class="font-semibold text-indigo-600">SCB</p>
                        <p class="text-sm text-slate-500">Officiell lönestatistik</p>
                    </div>
                </a>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">9. Kontakt</h2>
            <p>Om du har frågor om denna ansvarsfriskrivning, kontakta oss på <a href="mailto:info@raknalon.se" class="text-indigo-600 underline">info@raknalon.se</a>.</p>
        </section>

        <section class="not-prose">
            <div class="bg-slate-100 rounded-lg p-4 text-center">
                <p class="text-sm text-slate-600">Genom att använda raknalon.se godkänner du villkoren i denna ansvarsfriskrivning.</p>
            </div>
        </section>
    </article>
</div>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier `templates/legal/ansvarsfriskrivning.twig` créé
- [ ] Route ajoutée dans `index.php`
- [ ] Page accessible à `/ansvarsfriskrivning`
- [ ] Disclaimer visible en haut de page
- [ ] Mention que ce ne sont que des estimations
- [ ] Recommandation de consulter Skatteverket
- [ ] Liens vers sources officielles
