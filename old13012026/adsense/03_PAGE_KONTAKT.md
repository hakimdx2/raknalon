# 📋 Tâche 03: Page Kontakt (Contact)

> **Priorité**: 🔴 CRITIQUE  
> **Durée estimée**: 15 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer une page de contact professionnelle. **Contenu suédois complet ci-dessous.**

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/kontakt.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/kontakt', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/kontakt.twig', [
        'title' => 'Kontakta oss | Raknalon.se',
        'meta_description' => 'Kontakta Raknalon.se för frågor om löneberäkningar, feedback eller hjälp. Vi svarar inom 24 timmar.',
        'canonical' => 'https://raknalon.se/kontakt'
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
        <h1 class="text-3xl font-bold text-slate-900 mb-4">Kontakta oss</h1>
        <p class="text-lg text-slate-600 mb-8">Har du frågor, feedback eller vill rapportera ett problem? Vi hjälper dig gärna!</p>

        <div class="grid gap-6 md:grid-cols-2 not-prose mb-12">
            <!-- Email Contact Card -->
            <div class="bg-gradient-to-br from-indigo-50 to-white border border-indigo-100 rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-2xl">📧</span>
                </div>
                <h2 class="text-lg font-semibold text-slate-900 mb-2">E-post</h2>
                <a href="mailto:info@raknalon.se" class="text-indigo-600 font-medium hover:underline text-lg">
                    info@raknalon.se
                </a>
                <p class="text-sm text-slate-500 mt-2">Vi svarar vanligtvis inom 24 timmar.</p>
            </div>

            <!-- Response Time Card -->
            <div class="bg-gradient-to-br from-emerald-50 to-white border border-emerald-100 rounded-xl p-6 shadow-sm">
                <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
                    <span class="text-2xl">⏱️</span>
                </div>
                <h2 class="text-lg font-semibold text-slate-900 mb-2">Svarstid</h2>
                <p class="text-emerald-700 font-medium text-lg">Inom 24 timmar</p>
                <p class="text-sm text-slate-500 mt-2">Måndag till fredag, svensk tid.</p>
            </div>
        </div>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Vanliga ärenden</h2>
            
            <div class="space-y-4 not-prose">
                <details class="border border-slate-200 rounded-lg overflow-hidden">
                    <summary class="px-4 py-3 bg-slate-50 cursor-pointer hover:bg-slate-100 font-medium text-slate-700">
                        🔢 Frågor om beräkningar
                    </summary>
                    <div class="px-4 py-3 text-slate-600">
                        <p>Om du har frågor om hur vår kalkylator fungerar eller om resultatet verkar fel, beskriv gärna:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Vilken lön du angav</li>
                            <li>Vilken kommun</li>
                            <li>Vilket resultat du fick</li>
                            <li>Vad du förväntade dig</li>
                        </ul>
                    </div>
                </details>
                
                <details class="border border-slate-200 rounded-lg overflow-hidden">
                    <summary class="px-4 py-3 bg-slate-50 cursor-pointer hover:bg-slate-100 font-medium text-slate-700">
                        💡 Förslag på förbättringar
                    </summary>
                    <div class="px-4 py-3 text-slate-600">
                        <p>Vi uppskattar alla förslag! Berätta gärna vad du skulle vilja se på sidan, t.ex.:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Nya funktioner</li>
                            <li>Fler yrken</li>
                            <li>Designförbättringar</li>
                        </ul>
                    </div>
                </details>
                
                <details class="border border-slate-200 rounded-lg overflow-hidden">
                    <summary class="px-4 py-3 bg-slate-50 cursor-pointer hover:bg-slate-100 font-medium text-slate-700">
                        🐛 Rapportera ett fel
                    </summary>
                    <div class="px-4 py-3 text-slate-600">
                        <p>Har du hittat en bugg eller något som inte fungerar? Beskriv gärna:</p>
                        <ul class="list-disc pl-5 mt-2 space-y-1">
                            <li>Vilken sida problemet uppstod på</li>
                            <li>Vad du försökte göra</li>
                            <li>Vilken webbläsare du använder</li>
                            <li>En skärmbild om möjligt</li>
                        </ul>
                    </div>
                </details>
                
                <details class="border border-slate-200 rounded-lg overflow-hidden">
                    <summary class="px-4 py-3 bg-slate-50 cursor-pointer hover:bg-slate-100 font-medium text-slate-700">
                        🔒 Frågor om integritet/GDPR
                    </summary>
                    <div class="px-4 py-3 text-slate-600">
                        <p>För frågor om hur vi hanterar personuppgifter, läs vår <a href="/integritetspolicy" class="text-indigo-600 underline">integritetspolicy</a>.</p>
                        <p class="mt-2">Om du vill utöva dina GDPR-rättigheter (t.ex. radering av data), kontakta oss via e-post med ämnesraden "GDPR-förfrågan".</p>
                    </div>
                </details>
            </div>
        </section>

        <section class="mb-10">
            <h2 class="text-xl font-semibold text-slate-800 mb-4">Vanliga frågor (FAQ)</h2>
            <p class="mb-4">Innan du kontaktar oss, kolla om ditt svar finns här:</p>
            
            <div class="space-y-4 not-prose">
                <div class="border-l-4 border-indigo-500 pl-4">
                    <p class="font-medium text-slate-800">Hur exakt är kalkylatorn?</p>
                    <p class="text-slate-600 text-sm mt-1">Våra beräkningar är uppskattningar baserade på officiella källor. Din faktiska lön kan variera beroende på individuella faktorer.</p>
                </div>
                
                <div class="border-l-4 border-indigo-500 pl-4">
                    <p class="font-medium text-slate-800">Varifrån kommer lönestatistiken?</p>
                    <p class="text-slate-600 text-sm mt-1">Statistiken kommer från SCB (Statistiska Centralbyrån) och officiella kollektivavtal.</p>
                </div>
                
                <div class="border-l-4 border-indigo-500 pl-4">
                    <p class="font-medium text-slate-800">Är tjänsten gratis?</p>
                    <p class="text-slate-600 text-sm mt-1">Ja, alla våra kalkylatorer är 100% gratis att använda.</p>
                </div>
            </div>
            
            <p class="mt-4">Se fler frågor på vår <a href="/#faq" class="text-indigo-600 underline">FAQ-sektion</a>.</p>
        </section>

        <div class="bg-slate-50 rounded-xl p-6 not-prose">
            <h2 class="text-lg font-semibold text-slate-800 mb-2">📬 Skriv till oss</h2>
            <p class="text-slate-600 mb-4">Skicka ett mail så hör vi av oss inom 24 timmar.</p>
            <a href="mailto:info@raknalon.se" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                <span>📧</span>
                <span>Skicka e-post</span>
            </a>
        </div>
    </article>
</div>

<!-- Schema.org ContactPage -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Kontakta Raknalon.se",
  "description": "Kontakta oss för frågor om löneberäkningar och feedback",
  "url": "https://raknalon.se/kontakt",
  "mainEntity": {
    "@type": "Organization",
    "name": "Raknalon.se",
    "email": "info@raknalon.se",
    "url": "https://raknalon.se"
  }
}
</script>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier `templates/legal/kontakt.twig` créé
- [ ] Route ajoutée dans `index.php`
- [ ] Page accessible à `/kontakt`
- [ ] Email cliquable (mailto:)
- [ ] Schema.org ContactPage présent
- [ ] FAQ commune visible
- [ ] Design cohérent
