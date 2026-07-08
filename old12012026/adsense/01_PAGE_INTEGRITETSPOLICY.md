# 📋 Tâche 01: Page Integritetspolicy (Privacy Policy)

> **Priorité**: 🔴 CRITIQUE  
> **Durée estimée**: 30 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer la page de politique de confidentialité. **Le contenu suédois complet est fourni ci-dessous - il suffit de copier-coller.**

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/integritetspolicy.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/integritetspolicy', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/integritetspolicy.twig', [
        'title' => 'Integritetspolicy | Raknalon.se',
        'meta_description' => 'Läs om hur Raknalon.se hanterar dina personuppgifter och din integritet enligt GDPR.',
        'canonical' => 'https://raknalon.se/integritetspolicy'
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
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Integritetspolicy</h1>
        <p class="text-sm text-slate-500 mb-8">Senast uppdaterad: Januari 2026</p>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">1. Introduktion</h2>
            <p>Raknalon.se ("vi", "oss", "vår") värnar om din integritet. Denna integritetspolicy förklarar hur vi samlar in, använder och skyddar dina personuppgifter när du besöker vår webbplats.</p>
            <p>Genom att använda raknalon.se godkänner du denna policy. Om du inte accepterar villkoren ber vi dig att inte använda webbplatsen.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">2. Vilka uppgifter samlar vi in?</h2>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">2.1 Uppgifter du ger oss</h3>
            <p>Raknalon.se är en lönekalkylatortjänst. Vi samlar <strong>inte</strong> in några personuppgifter som du aktivt lämnar. De löneuppgifter du anger i våra kalkylatorer sparas inte på våra servrar.</p>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">2.2 Automatiskt insamlade uppgifter</h3>
            <p>När du besöker vår webbplats kan följande information samlas in automatiskt:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>IP-adress (anonymiserad)</li>
                <li>Webbläsartyp och version</li>
                <li>Operativsystem</li>
                <li>Besökta sidor och tid på webbplatsen</li>
                <li>Hänvisande webbplats (referrer)</li>
            </ul>
            <p>Denna information används för att förbättra webbplatsens funktion och innehåll.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">3. Hur använder vi dina uppgifter?</h2>
            <p>Vi använder insamlad information för att:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li>Förbättra webbplatsens funktion och användarupplevelse</li>
                <li>Analysera besökstrafik och användarmönster</li>
                <li>Visa relevanta annonser via Google AdSense</li>
                <li>Förhindra missbruk och säkerhetshot</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">4. Cookies och spårningsteknik</h2>
            <p>Raknalon.se använder cookies för att förbättra din upplevelse. En cookie är en liten textfil som lagras på din enhet.</p>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">Typer av cookies vi använder:</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-slate-200 mt-2">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-slate-700">Typ</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-slate-700">Syfte</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-slate-700">Varaktighet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-2 text-sm">Nödvändiga</td>
                            <td class="px-4 py-2 text-sm">Webbplatsens grundfunktion</td>
                            <td class="px-4 py-2 text-sm">Session</td>
                        </tr>
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-2 text-sm">Analytiska (Google Analytics)</td>
                            <td class="px-4 py-2 text-sm">Förstå hur besökare använder sidan</td>
                            <td class="px-4 py-2 text-sm">2 år</td>
                        </tr>
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-2 text-sm">Annonsering (Google AdSense)</td>
                            <td class="px-4 py-2 text-sm">Visa relevanta annonser</td>
                            <td class="px-4 py-2 text-sm">13 månader</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="mt-4">Du kan hantera cookies i din webbläsares inställningar. Notera att vissa funktioner kanske inte fungerar om du blockerar alla cookies.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">5. Tredjepartstjänster</h2>
            <p>Vi använder följande tredjepartstjänster som kan samla in uppgifter:</p>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">Google AdSense</h3>
            <p>Vi visar annonser via Google AdSense. Google kan använda cookies för att visa annonser baserade på dina tidigare besök på denna och andra webbplatser. Du kan välja bort personliga annonser på <a href="https://www.google.com/settings/ads" class="text-indigo-600 underline" target="_blank" rel="noopener">Googles annonsinställningar</a>.</p>
            
            <h3 class="text-lg font-medium text-slate-700 mt-4">Google Analytics</h3>
            <p>Vi använder Google Analytics för webbplatsstatistik. Data anonymiseras innan den skickas till Google. Läs mer i <a href="https://policies.google.com/privacy" class="text-indigo-600 underline" target="_blank" rel="noopener">Googles integritetspolicy</a>.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">6. Dina rättigheter enligt GDPR</h2>
            <p>Som EU-medborgare har du enligt GDPR följande rättigheter:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li><strong>Rätt till tillgång:</strong> Du kan begära information om vilka uppgifter vi har om dig.</li>
                <li><strong>Rätt till rättelse:</strong> Du kan begära att felaktiga uppgifter korrigeras.</li>
                <li><strong>Rätt till radering:</strong> Du kan begära att vi raderar dina uppgifter ("rätten att bli glömd").</li>
                <li><strong>Rätt att invända:</strong> Du kan invända mot viss behandling av dina uppgifter.</li>
                <li><strong>Rätt till dataportabilitet:</strong> Du kan begära att få ut dina uppgifter i ett maskinläsbart format.</li>
            </ul>
            <p class="mt-4">För att utöva dessa rättigheter, kontakta oss på <a href="mailto:info@raknalon.se" class="text-indigo-600 underline">info@raknalon.se</a>.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">7. Datasäkerhet</h2>
            <p>Vi vidtar lämpliga tekniska och organisatoriska åtgärder för att skydda dina uppgifter mot obehörig åtkomst, förlust eller förstörelse. Vår webbplats använder HTTPS-kryptering.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">8. Ändringar i denna policy</h2>
            <p>Vi kan uppdatera denna integritetspolicy vid behov. Väsentliga ändringar kommer att kommuniceras på webbplatsen. Vi rekommenderar att du regelbundet granskar denna sida.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">9. Kontakt</h2>
            <p>Om du har frågor om denna integritetspolicy eller hur vi hanterar dina uppgifter, kontakta oss:</p>
            <div class="bg-slate-50 p-4 rounded-lg mt-2">
                <p><strong>E-post:</strong> <a href="mailto:info@raknalon.se" class="text-indigo-600 underline">info@raknalon.se</a></p>
                <p><strong>Webbplats:</strong> raknalon.se</p>
            </div>
        </section>
    </article>
</div>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier `templates/legal/integritetspolicy.twig` créé
- [ ] Route ajoutée dans `index.php`
- [ ] Page accessible à `/integritetspolicy`
- [ ] Page retourne HTTP 200
- [ ] Contenu affiché correctement
- [ ] Mobile-friendly vérifié

---

## 🔧 Commande de Test

```bash
# Après déploiement
curl -s -o /dev/null -w "%{http_code}" https://raknalon.se/integritetspolicy
# Doit retourner: 200
```
