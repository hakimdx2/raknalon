---
title: "Löne-Speedrunner 2026"
date: 2026-01-23T10:00:00+01:00
draft: false
description: "Beräkna din lojalitetsskatt och få exakta scripts för att höja din lön med +20%."
---

<link rel="stylesheet" href="/css/speedrunner.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="speedrunner-container">
  
  <!-- HERO -->
  <header class="speedrunner-hero">
    <h1>Löne-Speedrunner 2026</h1>
    <p class="tagline">Hur mycket förlorar du på att stanna kvar?</p>
  </header>

  <!-- CALCULATOR SECTION -->
  <section class="calculator-section">
    <div class="input-group">
      <label for="salary">Din nuvarande månadslön (kr)</label>
      <input type="number" id="salary" placeholder="40000" min="15000" max="200000" value="40000">
    </div>

    <div class="input-group">
      <label for="tenure">Hur länge har du stannat? (år)</label>
      <select id="tenure">
        <option value="1">1 år</option>
        <option value="2">2 år</option>
        <option value="3" selected>3 år</option>
        <option value="4">4 år</option>
        <option value="5">5 år</option>
        <option value="7">7+ år</option>
      </select>
    </div>

    <div class="input-group">
      <label>Din bransch</label>
      <div class="radio-group">
        <label><input type="radio" name="sector" value="tech" checked> IT/Tech</label>
        <label><input type="radio" name="sector" value="vard"> Vård/Omsorg</label>
        <label><input type="radio" name="sector" value="ekonomi"> Ekonomi/Juridik</label>
        <label><input type="radio" name="sector" value="annat"> Annat</label>
      </div>
    </div>

    <div class="input-group">
      <label>Scenario</label>
      <div class="toggle-group">
        <button class="toggle-btn" data-mode="conservative">Konservativ</button>
        <button class="toggle-btn active" data-mode="base">Bas</button>
        <button class="toggle-btn" data-mode="aggressive">Aggressiv</button>
      </div>
      <p class="mode-explanation" id="modeExplanation">
        <strong>Bas:</strong> Jobbyte var 2,5 år med ~10% höjning (baserat på Sveriges Ingenjörers statistik).
      </p>
    </div>

    <button id="calculateBtn" class="calculate-btn">Beräkna min skatt</button>
  </section>

  <!-- RESULTS SECTION (hidden initially) -->
  <section class="results-section" id="resultsSection" style="display:none;">
    <h2>Resultat (5 år framåt)</h2>
    
    <div class="chart-container">
      <canvas id="salaryChart"></canvas>
    </div>

    <div class="results-summary">
      <div class="result-card loyal">
        <span class="label">Din lön om 5 år (lojal)</span>
        <span class="value" id="loyalSalary">47 082 kr/mån</span>
      </div>
      <div class="result-card speedrunner">
        <span class="label">Din lön om 5 år (speedrunner)</span>
        <span class="value" id="speedrunnerSalary">64 420 kr/mån</span>
      </div>
    </div>

    <div class="loyalty-tax-box">
      <p>Din lojalitetsskatt på 5 år</p>
      <div class="tax-amount" id="loyaltyTax">-832 000 kr</div>
      <p class="tax-monthly">≈ <span id="monthlyDiff">17 338</span> kr mindre per månad</p>
    </div>

    <div class="assumptions-box" id="assumptionsBox">
      <p>Antaganden för detta scenario:</p>
      <ul id="assumptionsList">
        <li>Lojal: +3,8%/år (märket + löneglidning)</li>
        <li>Speedrunner: +10% vid byte (var 2,5 år), +3,8% mellan byten</li>
      </ul>
    </div>

    <div class="sources-box">
      <p><strong>Källor:</strong> 
        <a href="https://www.mi.se/app/uploads/loneutvecklingen-i-sverige-tom-augusti-2025.pdf" target="_blank">Medlingsinstitutet (2025)</a>, 
        <a href="https://www.sverigesingenjorer.se/lon/negotiate-your-salary/negotiate-your-salary-when-you-change-jobs/" target="_blank">Sveriges Ingenjörer</a>, 
        <a href="https://www.scb.se/hitta-statistik/sverige-i-siffror/lonesok/" target="_blank">SCB Lönesök</a>
      </p>
    </div>

    <div class="cta-buttons">
      <button id="showScriptsBtn" class="cta-btn primary">Visa löneförhandlings-script</button>
      <button id="shareBtn" class="cta-btn secondary">Dela resultat</button>
    </div>
  </section>

  <!-- SCRIPTS SECTION -->
  <section class="scripts-section" id="scriptsSection" style="display:none;">
    <h2>Löne-Script: Vad ska du säga?</h2>
    
    <div class="accordion">
      <div class="accordion-item">
        <button class="accordion-header">
          <span>"Chefen säger: Vi har inget utrymme (märket)"</span>
          <span class="icon">+</span>
        </button>
        <div class="accordion-content">
          <div class="script-box">
            <p>"Jag förstår att märket styr det <strong>kollektiva</strong> utrymmet.</p>
            <p>Här pratar vi om mitt <strong>individuella löneläge</strong> i förhållande till marknaden och det ansvar jag faktiskt har idag.</p>
            <p>När jag jämför med <a href="https://www.scb.se/hitta-statistik/sverige-i-siffror/lonesok/" target="_blank">SCB:s statistik</a> för min roll, erfarenhet och region ligger jag ungefär <strong>[X]%</strong> under marknadslön.</p>
            <p>Skulle vi kunna titta på en <strong>justering av mitt löneläge</strong> utöver den ordinarie revisionen?"</p>
          </div>
          <button class="copy-btn" data-script="market">Kopiera</button>
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-header">
          <span>"Jag har ett externt erbjudande"</span>
          <span class="icon">+</span>
        </button>
        <div class="accordion-content">
          <div class="script-box">
            <p>"Jag vill vara transparent med dig eftersom jag trivs här.</p>
            <p>Jag har fått ett konkret erbjudande på <strong>[X] kr/mån</strong>, vilket är ungefär <strong>[Y]%</strong> över min nuvarande nivå.</p>
            <p>Mitt <strong>förstahandsval är att stanna här</strong>, förutsatt att min lön och roll kan spegla min faktiska nivå.</p>
            <p>Finns det utrymme att göra en <strong>lönejustering</strong> som tar mig närmare den här nivån?"</p>
          </div>
          <button class="copy-btn" data-script="external">Kopiera</button>
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-header">
          <span>"Förberedande mail 3 månader innan"</span>
          <span class="icon">+</span>
        </button>
        <div class="accordion-content">
          <div class="script-box">
            <p><strong>Ämne:</strong> Förberedelse inför årets lönedialog</p>
            <p>Hej [Chef],</p>
            <p>Jag vet att lönerevisionen börjar planeras under [månad], och jag skulle gärna vilja ta ett <strong>förberedande samtal</strong> med dig.</p>
            <p>Under året har jag bland annat:</p>
            <ul>
              <li>[Resultat 1 med siffror]</li>
              <li>[Resultat 2 med siffror]</li>
            </ul>
            <p>Jag vill diskutera min <strong>fortsatta utveckling</strong> och hur mitt <strong>löneläge kan justeras</strong>.</p>
            <p>Har du möjlighet att avsätta 30-45 minuter?</p>
          </div>
          <button class="copy-btn" data-script="email">Kopiera</button>
        </div>
      </div>
    </div>
  </section>

  <!-- LEAD CAPTURE SECTION (GDPR-Compliant) -->
  <section class="lead-section" id="leadSection" style="display:none;">
    <h2>Få ditt "Brag Sheet" (PDF)</h2>
    <p>Ladda ner mallen för att dokumentera dina resultat inför lönesamtalet.</p>
    
    <form id="leadForm" class="lead-form">
      <div class="input-group">
        <label for="email">Din e-postadress</label>
        <input type="email" id="email" placeholder="namn@exempel.se" required>
      </div>

      <!-- GDPR: Separate checkbox for marketing - NOT pre-checked -->
      <div class="checkbox-group">
        <label>
          <input type="checkbox" id="marketingConsent" name="marketingConsent">
          <span>Ja, jag vill även få tips om lön, karriär och arbetsmarknad via e-post. (Valfritt)</span>
        </label>
      </div>

      <button type="submit" class="submit-btn">Skicka PDF till min e-post</button>

      <p class="privacy-notice">
        Vi skickar <strong>endast PDF:en</strong> till din adress. 
        Om du kryssar i rutan ovan får du också vårt nyhetsbrev (max 2 ggr/månad). 
        Du kan <a href="/integritetspolicy">avregistrera dig när som helst</a>. 
        Läs vår <a href="/integritetspolicy">integritetspolicy</a>.
      </p>
    </form>

    <div id="formSuccess" class="form-success" style="display:none;">
      Klart! Kolla din inkorg (och skräppost) för PDF:en.
    </div>
  </section>

  <!-- FAQ SECTION -->
  <section class="faq-section">
    <h2>Vanliga frågor</h2>
    
    <div class="faq-item">
      <h3>Är det olagligt att byta jobb ofta?</h3>
      <p>Nej. Du har full frihet att byta jobb när du vill i Sverige. Det finns ingen "lojalitetsplikt" som hindrar dig.</p>
    </div>

    <div class="faq-item">
      <h3>Kan arbetsgivaren neka löneförhöjning?</h3>
      <p>Ja, det finns ingen lagstadgad rätt till löneförhöjning. Men du har rätt att <strong>förhandla</strong>, och att söka dig till en arbetsgivare som betalar marknadslön.</p>
    </div>

    <div class="faq-item">
      <h3>Hur vet jag vad marknaden betalar?</h3>
      <p>Använd <a href="https://www.scb.se/hitta-statistik/sverige-i-siffror/lonesok/" target="_blank">SCB Lönesök</a>, <a href="https://www.unionen.se/rad-och-stod/om-lon/marknadsloner" target="_blank">Unionens lönestatistik</a>, eller din fackförenings data.</p>
    </div>
  </section>

  <!-- DISCLAIMER -->
  <footer class="speedrunner-footer">
    <p><strong>Disclaimer:</strong> Detta verktyg är ett simuleringsverktyg, inte individuell rådgivning. Faktiska löneökningar beror på många faktorer. Siffrorna baseras på aggregerad svensk statistik och publicerade studier.</p>
  </footer>

</div>

<script src="/js/speedrunner.js"></script>
