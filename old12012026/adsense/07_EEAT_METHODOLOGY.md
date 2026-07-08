# 📋 Tâche 07: Page Méthodologie "Så räknar vi"

> **Priorité**: 🟡 IMPORTANT (E-E-A-T)  
> **Durée estimée**: 20 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer une page expliquant la méthodologie de calcul. C'est un signal E-E-A-T très fort pour les sites financiers.

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/metodologi.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/sa-raknar-vi', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/metodologi.twig', [
        'title' => 'Så räknar vi | Raknalon.se',
        'meta_description' => 'Transparent förklaring av hur Raknalon.se beräknar din nettolön, skatter och jobbskatteavdrag.',
        'canonical' => 'https://raknalon.se/sa-raknar-vi'
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
        <h1 class="text-3xl font-bold text-slate-900 mb-4">Så räknar vi</h1>
        <p class="text-lg text-slate-600 mb-8">Vi tror på transparens. Här förklarar vi exakt hur våra beräkningar fungerar.</p>

        <!-- Quick Summary -->
        <div class="bg-gradient-to-r from-indigo-50 to-slate-50 rounded-xl p-6 mb-10 not-prose">
            <h2 class="text-xl font-semibold text-slate-900 mb-4">Grundformeln</h2>
            <div class="bg-white rounded-lg p-4 font-mono text-center text-lg border border-slate-200">
                <span class="text-emerald-600 font-bold">Nettolön</span> = 
                <span class="text-slate-700">Bruttolön</span> − 
                <span class="text-red-500">Kommunalskatt</span> − 
                <span class="text-red-500">Statlig skatt</span> + 
                <span class="text-green-500">Jobbskatteavdrag</span>
            </div>
            <p class="text-sm text-slate-500 mt-4 text-center">Låt oss gå igenom varje del steg för steg.</p>
        </div>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-600 font-bold text-sm">1</span>
                Kommunalskatt
            </h2>
            <p>Kommunalskatten är den största delen av din skatt. Den varierar beroende på var du bor, från cirka <strong>29%</strong> (Vellinge) till <strong>35%</strong> (Dorotea).</p>
            
            <div class="bg-slate-50 rounded-lg p-4 my-4 not-prose">
                <p class="text-sm font-semibold text-slate-700 mb-2">Formel:</p>
                <p class="font-mono text-slate-600">Kommunalskatt = Bruttolön × Kommunal skattesats</p>
            </div>
            
            <div class="bg-indigo-50 rounded-lg p-4 my-4 not-prose border-l-4 border-indigo-500">
                <p class="text-sm font-semibold text-indigo-800 mb-2">📝 Exempel: Stockholm kommun</p>
                <p class="text-indigo-700">Kommunal skattesats 2026: <strong>30,49%</strong></p>
                <p class="text-indigo-700 mt-2">Om du tjänar 40 000 kr/mån:</p>
                <p class="font-mono text-indigo-600">40 000 × 0,3049 = <strong>12 196 kr</strong> i kommunalskatt</p>
            </div>
            
            <p class="text-sm text-slate-500">
                <strong>Källa:</strong> 
                <a href="https://skr.se/skr/ekonomijuridik/ekonomi/statistikekonomi/skaborochskattesatser.1849.html" target="_blank" rel="noopener" class="text-indigo-600 underline">Sveriges Kommuner och Regioner (SKR)</a>
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-600 font-bold text-sm">2</span>
                Statlig inkomstskatt
            </h2>
            <p>Om din årsinkomst överstiger en viss nivå ("brytpunkten") betalar du även statlig inkomstskatt på <strong>20%</strong> av det överskjutande beloppet.</p>
            
            <div class="bg-amber-50 rounded-lg p-4 my-4 not-prose border-l-4 border-amber-500">
                <p class="text-amber-800 font-semibold">Brytpunkt 2026:</p>
                <p class="text-amber-700 text-2xl font-bold">615 300 kr/år</p>
                <p class="text-amber-600 text-sm">(motsvarar ca 51 275 kr/mån)</p>
            </div>
            
            <div class="bg-slate-50 rounded-lg p-4 my-4 not-prose">
                <p class="text-sm font-semibold text-slate-700 mb-2">Formel:</p>
                <p class="font-mono text-slate-600">Om årsinkomst > 615 300 kr:</p>
                <p class="font-mono text-slate-600">Statlig skatt = (Årsinkomst − 615 300) × 0,20</p>
            </div>
            
            <div class="bg-indigo-50 rounded-lg p-4 my-4 not-prose border-l-4 border-indigo-500">
                <p class="text-sm font-semibold text-indigo-800 mb-2">📝 Exempel: 60 000 kr/mån</p>
                <p class="text-indigo-700">Årsinkomst: 60 000 × 12 = <strong>720 000 kr</strong></p>
                <p class="text-indigo-700 mt-1">Överskjutande: 720 000 − 615 300 = <strong>104 700 kr</strong></p>
                <p class="text-indigo-700 mt-1">Statlig skatt per år: 104 700 × 0,20 = <strong>20 940 kr</strong></p>
                <p class="font-mono text-indigo-600 mt-2">Per månad: 20 940 ÷ 12 = <strong>1 745 kr</strong></p>
            </div>
            
            <p class="text-sm text-slate-500">
                <strong>Källa:</strong> 
                <a href="https://www.skatteverket.se/privat/skatter/arbeteochinkomst/sabeskattasdinlon.4.7459477810df5bccdd4800014540.html" target="_blank" rel="noopener" class="text-indigo-600 underline">Skatteverket</a>
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-600 font-bold text-sm">3</span>
                Jobbskatteavdrag
            </h2>
            <p>Jobbskatteavdraget är en <strong>skattereduktion</strong> som minskar din totala skatt. Det infördes för att göra det mer lönsamt att arbeta.</p>
            
            <p class="mt-4">Jobbskatteavdraget beräknas enligt en progressiv formel som beror på:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Din inkomst</li>
                <li>Din ålder (högre avdrag för 65+)</li>
                <li>Kommunalskattesatsen</li>
            </ul>
            
            <div class="bg-slate-50 rounded-lg p-4 my-4 not-prose">
                <p class="text-sm font-semibold text-slate-700 mb-2">Förenklad översikt (2026):</p>
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Månadslön</th>
                            <th class="text-left py-2">Ungefärligt jobbskatteavdrag</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-600">
                        <tr class="border-b"><td class="py-2">20 000 kr</td><td class="py-2">~2 100 kr/mån</td></tr>
                        <tr class="border-b"><td class="py-2">30 000 kr</td><td class="py-2">~2 700 kr/mån</td></tr>
                        <tr class="border-b"><td class="py-2">40 000 kr</td><td class="py-2">~3 100 kr/mån</td></tr>
                        <tr class="border-b"><td class="py-2">50 000 kr</td><td class="py-2">~3 200 kr/mån</td></tr>
                        <tr><td class="py-2">60 000 kr+</td><td class="py-2">~3 200 kr/mån (max)</td></tr>
                    </tbody>
                </table>
            </div>
            
            <p class="text-sm text-slate-500">
                <strong>Källa:</strong> 
                <a href="https://www.skatteverket.se/privat/skatter/arbeteochinkomst/jobbskatteavdrag.4.6a6688231259309ff1f800011402.html" target="_blank" rel="noopener" class="text-indigo-600 underline">Skatteverket − Jobbskatteavdrag</a>
            </p>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800">Komplett exempel</h2>
            
            <div class="bg-gradient-to-br from-slate-50 to-indigo-50 rounded-xl p-6 not-prose">
                <p class="font-semibold text-slate-800 mb-4">📊 Person: 35 år, bor i Stockholm, bruttolön 40 000 kr/mån</p>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-slate-200">
                        <span class="text-slate-600">Bruttolön</span>
                        <span class="font-mono font-semibold text-slate-900">40 000 kr</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-200">
                        <span class="text-slate-600">− Kommunalskatt (30,49%)</span>
                        <span class="font-mono text-red-600">−12 196 kr</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-200">
                        <span class="text-slate-600">− Statlig skatt</span>
                        <span class="font-mono text-slate-400">0 kr (under brytpunkten)</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-200">
                        <span class="text-slate-600">+ Jobbskatteavdrag</span>
                        <span class="font-mono text-green-600">+3 100 kr</span>
                    </div>
                    <div class="flex justify-between items-center py-3 bg-emerald-100 rounded-lg px-4 mt-2">
                        <span class="font-semibold text-emerald-800">= Nettolön (utbetalas)</span>
                        <span class="font-mono font-bold text-emerald-700 text-xl">30 904 kr</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800">Vad vi INTE räknar med</h2>
            <p>För att hålla kalkylatorn enkel, tar vi <strong>inte</strong> hänsyn till:</p>
            
            <div class="grid gap-3 md:grid-cols-2 mt-4 not-prose">
                <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                    <span class="text-xl">❌</span>
                    <div>
                        <p class="font-medium text-slate-700">Förmåner</p>
                        <p class="text-sm text-slate-500">Tjänstebil, lunch, friskvård</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                    <span class="text-xl">❌</span>
                    <div>
                        <p class="font-medium text-slate-700">Reseavdrag</p>
                        <p class="text-sm text-slate-500">Avdrag för arbetsresor</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                    <span class="text-xl">❌</span>
                    <div>
                        <p class="font-medium text-slate-700">Ränteavdrag</p>
                        <p class="text-sm text-slate-500">Avdrag för bolåneräntor</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg">
                    <span class="text-xl">❌</span>
                    <div>
                        <p class="font-medium text-slate-700">ROT/RUT</p>
                        <p class="text-sm text-slate-500">Skattereduktioner för hemtjänster</p>
                    </div>
                </div>
            </div>
            
            <p class="mt-4 text-slate-600">Därför kan din faktiska nettolön skilja sig något från vårt resultat.</p>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800">Våra källor</h2>
            
            <div class="grid gap-4 md:grid-cols-3 mt-4 not-prose">
                <a href="https://www.skatteverket.se" target="_blank" rel="noopener" class="block p-4 border border-slate-200 rounded-lg hover:border-indigo-300 hover:bg-indigo-50 transition-colors">
                    <p class="font-semibold text-indigo-600">Skatteverket</p>
                    <p class="text-sm text-slate-500">Skattesatser, jobbskatteavdrag</p>
                </a>
                <a href="https://www.scb.se" target="_blank" rel="noopener" class="block p-4 border border-slate-200 rounded-lg hover:border-indigo-300 hover:bg-indigo-50 transition-colors">
                    <p class="font-semibold text-indigo-600">SCB</p>
                    <p class="text-sm text-slate-500">Lönestatistik per yrke</p>
                </a>
                <a href="https://skr.se" target="_blank" rel="noopener" class="block p-4 border border-slate-200 rounded-lg hover:border-indigo-300 hover:bg-indigo-50 transition-colors">
                    <p class="font-semibold text-indigo-600">SKR</p>
                    <p class="text-sm text-slate-500">Kommunala skattesatser</p>
                </a>
            </div>
        </section>

        <div class="bg-slate-100 rounded-xl p-6 text-center not-prose">
            <p class="text-slate-600 mb-4">Redo att räkna ut din lön?</p>
            <a href="/" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                <span>🧮</span>
                <span>Till kalkylatorn</span>
            </a>
        </div>
    </article>
</div>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier créé à `templates/legal/metodologi.twig`
- [ ] Route ajoutée pour `/sa-raknar-vi`
- [ ] Formule principale expliquée
- [ ] Chaque composant détaillé avec exemples
- [ ] Sources officielles citées avec liens
- [ ] Limitations clairement mentionnées
- [ ] Design cohérent avec le site
