# 📋 Tâche 04: Page Cookiepolicy (Politique de Cookies)

> **Priorité**: 🟡 IMPORTANT  
> **Durée estimée**: 15 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer la page de politique de cookies. **Contenu suédois complet ci-dessous.**

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/cookies.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/cookies', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/cookies.twig', [
        'title' => 'Cookiepolicy | Raknalon.se',
        'meta_description' => 'Information om hur Raknalon.se använder cookies och hur du kan hantera dem.',
        'canonical' => 'https://raknalon.se/cookies'
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
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Cookiepolicy</h1>
        <p class="text-sm text-slate-500 mb-8">Senast uppdaterad: Januari 2026</p>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Vad är cookies?</h2>
            <p>Cookies är små textfiler som lagras på din dator, mobil eller surfplatta när du besöker en webbplats. De hjälper webbplatsen att komma ihåg information om ditt besök, vilket gör nästa besök enklare och webbplatsen mer användbar för dig.</p>
            <p>Cookies kan inte skada din enhet och innehåller ingen personlig information som namn eller bankuppgifter.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Vilka cookies använder vi?</h2>
            
            <p class="mb-4">Raknalon.se använder följande typer av cookies:</p>
            
            <div class="overflow-x-auto not-prose">
                <table class="min-w-full border border-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 border-b">Cookie</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 border-b">Leverantör</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 border-b">Syfte</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 border-b">Varaktighet</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <tr class="bg-green-50">
                            <td colspan="4" class="px-4 py-2 text-sm font-semibold text-green-800">Nödvändiga cookies</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">PHPSESSID</td>
                            <td class="px-4 py-2 text-sm">raknalon.se</td>
                            <td class="px-4 py-2 text-sm">Session-hantering</td>
                            <td class="px-4 py-2 text-sm">Session</td>
                        </tr>
                        
                        <tr class="bg-blue-50">
                            <td colspan="4" class="px-4 py-2 text-sm font-semibold text-blue-800">Analytiska cookies</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">_ga</td>
                            <td class="px-4 py-2 text-sm">Google Analytics</td>
                            <td class="px-4 py-2 text-sm">Identifierar unika besökare</td>
                            <td class="px-4 py-2 text-sm">2 år</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">_gid</td>
                            <td class="px-4 py-2 text-sm">Google Analytics</td>
                            <td class="px-4 py-2 text-sm">Identifierar unika besökare</td>
                            <td class="px-4 py-2 text-sm">24 timmar</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">_gat</td>
                            <td class="px-4 py-2 text-sm">Google Analytics</td>
                            <td class="px-4 py-2 text-sm">Begränsar förfrågningar</td>
                            <td class="px-4 py-2 text-sm">1 minut</td>
                        </tr>
                        
                        <tr class="bg-purple-50">
                            <td colspan="4" class="px-4 py-2 text-sm font-semibold text-purple-800">Annonscookies</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">__gads</td>
                            <td class="px-4 py-2 text-sm">Google AdSense</td>
                            <td class="px-4 py-2 text-sm">Visar relevanta annonser</td>
                            <td class="px-4 py-2 text-sm">13 månader</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-sm font-mono">__gpi</td>
                            <td class="px-4 py-2 text-sm">Google AdSense</td>
                            <td class="px-4 py-2 text-sm">Annonsoptimering</td>
                            <td class="px-4 py-2 text-sm">13 månader</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Tredjepartscookies</h2>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">Google Analytics</h3>
            <p>Vi använder Google Analytics för att förstå hur besökare interagerar med vår webbplats. Informationen hjälper oss att förbättra användarupplevelsen. Data anonymiseras innan den skickas till Google.</p>
            <p class="mt-2">
                <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener" class="text-indigo-600 underline">Ladda ner Google Analytics opt-out-tillägg</a>
            </p>
            
            <h3 class="text-lg font-medium text-slate-700 mt-6">Google AdSense</h3>
            <p>Vi visar annonser från Google AdSense. Google kan använda cookies för att visa annonser baserade på dina tidigare besök på denna och andra webbplatser.</p>
            <p class="mt-2">Du kan välja bort personanpassade annonser:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li><a href="https://www.google.com/settings/ads" target="_blank" rel="noopener" class="text-indigo-600 underline">Googles annonsinställningar</a></li>
                <li><a href="https://www.aboutads.info/choices/" target="_blank" rel="noopener" class="text-indigo-600 underline">Digital Advertising Alliance opt-out</a></li>
                <li><a href="https://www.youronlinechoices.eu/" target="_blank" rel="noopener" class="text-indigo-600 underline">Your Online Choices (EU)</a></li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Hur hanterar du cookies?</h2>
            <p>Du kan hantera eller radera cookies via din webbläsares inställningar. Här är instruktioner för de vanligaste webbläsarna:</p>
            
            <div class="grid gap-3 md:grid-cols-2 mt-4 not-prose">
                <a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">🌐</span>
                    <span class="text-indigo-600 font-medium">Google Chrome</span>
                </a>
                <a href="https://support.mozilla.org/sv/kb/aktivera-och-inaktivera-kakor" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">🦊</span>
                    <span class="text-indigo-600 font-medium">Mozilla Firefox</span>
                </a>
                <a href="https://support.apple.com/sv-se/guide/safari/sfri11471/mac" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">🧭</span>
                    <span class="text-indigo-600 font-medium">Safari</span>
                </a>
                <a href="https://support.microsoft.com/sv-se/microsoft-edge/ta-bort-cookies-i-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener" class="flex items-center gap-3 p-3 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <span class="text-2xl">🔷</span>
                    <span class="text-indigo-600 font-medium">Microsoft Edge</span>
                </a>
            </div>
            
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 mt-6 not-prose">
                <p class="text-amber-800">
                    <strong>⚠️ Observera:</strong> Om du blockerar alla cookies kan vissa funktioner på webbplatsen sluta fungera korrekt.
                </p>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Samtycke</h2>
            <p>Genom att fortsätta använda denna webbplats samtycker du till vår användning av cookies enligt denna policy.</p>
            <p>Du kan när som helst återkalla ditt samtycke genom att radera cookies via din webbläsare och lämna webbplatsen.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Ändringar i denna policy</h2>
            <p>Vi kan uppdatera denna cookiepolicy vid behov. Alla ändringar publiceras på denna sida med ett uppdaterat datum.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Kontakt</h2>
            <p>Om du har frågor om hur vi använder cookies, kontakta oss på <a href="mailto:info@raknalon.se" class="text-indigo-600 underline">info@raknalon.se</a>.</p>
        </section>
    </article>
</div>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier `templates/legal/cookies.twig` créé
- [ ] Route ajoutée dans `index.php`
- [ ] Page accessible à `/cookies`
- [ ] Tableau des cookies présent
- [ ] Liens vers opt-out de Google
- [ ] Instructions par navigateur
- [ ] Mention AdSense explicite
