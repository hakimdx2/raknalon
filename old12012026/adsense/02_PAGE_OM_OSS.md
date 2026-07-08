# 📋 Tâche 02: Page Om oss (À propos)

> **Priorité**: 🔴 CRITIQUE  
> **Durée estimée**: 20 min (contenu PRÊT ci-dessous)  
> **Statut**: ⬜ À faire

---

## 🎯 Objectif

Créer la page "À propos" pour établir la crédibilité E-E-A-T. **Contenu suédois complet ci-dessous.**

---

## 📄 Fichiers à Créer

### 1. Template Twig
```
templates/legal/om-oss.twig
```

### 2. Route à ajouter dans `index.php`
```php
$app->get('/om-oss', function ($request, $response) {
    return $this->get('view')->render($response, 'legal/om-oss.twig', [
        'title' => 'Om oss | Raknalon.se',
        'meta_description' => 'Lär känna Raknalon.se - din pålitliga källa för lönekalkylatorer och lönestatistik i Sverige.',
        'canonical' => 'https://raknalon.se/om-oss'
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
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Om Raknalon.se</h1>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-indigo-50 to-slate-50 rounded-xl p-6 mb-8 not-prose">
            <div class="flex items-start gap-4">
                <div class="text-4xl">🎯</div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900 mb-2">Vår mission</h2>
                    <p class="text-slate-600">Att hjälpa alla svenskar förstå sin lön, sina skatter och hur mycket de faktiskt får behålla. Vi gör komplexa skatteregler enkla att förstå.</p>
                </div>
            </div>
        </div>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Varför Raknalon.se?</h2>
            <p>Att förstå sin lön efter skatt borde inte vara komplicerat. Ändå finns det tusentals svenskar som varje månad undrar: "Vad blir kvar av min lön?"</p>
            <p>Raknalon.se skapades för att ge dig snabba, pålitliga svar. Vår kalkylator tar hänsyn till:</p>
            <ul class="list-disc pl-6 space-y-1">
                <li><strong>Din kommuns skattesats</strong> – vi har alla 290 kommuner</li>
                <li><strong>Jobbskatteavdraget</strong> – uppdaterat för 2026</li>
                <li><strong>Statlig inkomstskatt</strong> – om du tjänar över brytpunkten</li>
                <li><strong>Din ålder</strong> – för korrekt beräkning av jobbskatteavdrag</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Våra källor</h2>
            <p>Vi tar noggrannhet på allvar. Alla våra beräkningar och statistik baseras på officiella källor:</p>
            
            <div class="grid gap-4 md:grid-cols-2 mt-4 not-prose">
                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">🏛️</span>
                        <a href="https://www.skatteverket.se" target="_blank" rel="noopener" class="font-semibold text-indigo-600 hover:underline">Skatteverket</a>
                    </div>
                    <p class="text-sm text-slate-600">Officiella skattesatser, jobbskatteavdrag och brytpunkter för statlig skatt.</p>
                </div>
                
                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">📊</span>
                        <a href="https://www.scb.se" target="_blank" rel="noopener" class="font-semibold text-indigo-600 hover:underline">SCB</a>
                    </div>
                    <p class="text-sm text-slate-600">Statistiska Centralbyrån – lönestatistik per yrke och bransch.</p>
                </div>
                
                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">🏘️</span>
                        <a href="https://skr.se" target="_blank" rel="noopener" class="font-semibold text-indigo-600 hover:underline">SKR</a>
                    </div>
                    <p class="text-sm text-slate-600">Sveriges Kommuner och Regioner – kommunala skattesatser.</p>
                </div>
                
                <div class="border border-slate-200 rounded-lg p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-2xl">📋</span>
                        <span class="font-semibold text-slate-700">Kollektivavtal</span>
                    </div>
                    <p class="text-sm text-slate-600">Officiella lönetariffer och avtal för olika yrkesgrupper.</p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Så här räknar vi</h2>
            <p>Vår kalkylator följer Sveriges skatteregler för 2026:</p>
            
            <div class="bg-slate-100 rounded-lg p-4 font-mono text-sm my-4 not-prose">
                <p class="text-slate-700"><strong>Nettolön</strong> = Bruttolön − Kommunalskatt − Statlig skatt + Jobbskatteavdrag</p>
            </div>
            
            <p>Vi uppdaterar våra beräkningar varje år när Skatteverket publicerar nya regler. All data för 2026 är baserad på de senaste officiella siffrorna.</p>
            
            <p class="text-slate-600 italic">Vill du veta mer om hur vi räknar? Läs vår detaljerade <a href="/sa-raknar-vi" class="text-indigo-600 underline">metodbeskrivning</a>.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Viktigt att veta</h2>
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 not-prose">
                <p class="text-amber-800">
                    <strong>⚠️ Observera:</strong> Våra beräkningar är uppskattningar och ersätter inte professionell rådgivning. 
                    Din faktiska lön kan påverkas av förmåner, avdrag och andra faktorer som vårt verktyg inte beaktar.
                    För exakta uppgifter, kontakta <a href="https://www.skatteverket.se" class="text-amber-700 underline">Skatteverket</a> 
                    eller en auktoriserad revisor.
                </p>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-slate-800">Kontakta oss</h2>
            <p>Har du frågor, feedback eller hittat ett fel? Vi vill gärna höra från dig!</p>
            <div class="bg-slate-50 rounded-lg p-4 mt-4 not-prose">
                <p class="flex items-center gap-2">
                    <span>📧</span>
                    <a href="mailto:info@raknalon.se" class="text-indigo-600 underline">info@raknalon.se</a>
                </p>
                <p class="text-sm text-slate-500 mt-2">Vi svarar vanligtvis inom 24 timmar.</p>
            </div>
        </section>

        <!-- Trust Badges -->
        <section class="not-prose">
            <div class="flex flex-wrap justify-center gap-6 py-8 border-t border-slate-200">
                <div class="flex items-center gap-2 text-slate-600">
                    <span class="text-xl">🔒</span>
                    <span class="text-sm">HTTPS-krypterad</span>
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <span class="text-xl">🇸🇪</span>
                    <span class="text-sm">Svenskutvecklad</span>
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <span class="text-xl">📅</span>
                    <span class="text-sm">Uppdaterad 2026</span>
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <span class="text-xl">🆓</span>
                    <span class="text-sm">100% gratis</span>
                </div>
            </div>
        </section>
    </article>
</div>
{% endblock %}
```

---

## ✅ Critères d'Acceptation

- [ ] Fichier `templates/legal/om-oss.twig` créé
- [ ] Route ajoutée dans `index.php`
- [ ] Page accessible à `/om-oss`
- [ ] Sources officielles citées avec liens
- [ ] Disclaimer visible
- [ ] Contact email présent
- [ ] Design cohérent avec le site

---

## 🎯 Impact E-E-A-T

| Signal            | Élément de la Page                   |
| ----------------- | ------------------------------------ |
| Experience        | "Nous avons créé ce service pour..." |
| Expertise         | Sources officielles citées           |
| Authoritativeness | Liens vers Skatteverket, SCB         |
| Trustworthiness   | Disclaimer honnête, contact visible  |
