document.addEventListener('DOMContentLoaded', function () {
    // 1. Configuration des variantes
    const variants = [
        { id: 'variant_fomo', btnText: 'Se vad jag är värd' },
        { id: 'variant_loss', btnText: 'Skicka guiden till mig' },
        { id: 'variant_secret', btnText: 'Avslöja metoden' }
    ];

    // 2. Sélection aléatoire (A/B Testing)
    const selectedVariant = variants[Math.floor(Math.random() * variants.length)];

    // 3. Affichage du DOM
    const box = document.getElementById('newsletter-box');
    const textDiv = document.querySelector(`.newsletter-text[data-variant="${selectedVariant.id}"]`);
    const btnText = document.querySelector('.btn-text');

    if (textDiv && box) {
        textDiv.classList.add('active');
        if (btnText) btnText.textContent = selectedVariant.btnText;

        // Show after 60 seconds with heavy bounce animation
        setTimeout(() => {
            box.classList.add('mac-bounce');
            box.style.display = 'block';
            console.log('Newsletter: Triggered after 60s');
        }, 60000);
    }

    // 4. Gestion de la fermeture
    document.getElementById('newsletter-close').addEventListener('click', function () {
        box.style.display = 'none';
        // Enregistrer la fermeture en cookie pour ne pas réafficher tout de suite ? (Optionnel)
    });

    // 5. Soumission du formulaire
    const form = document.getElementById('newsletter-form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const email = document.getElementById('newsletter-email').value;
        const submitBtn = document.getElementById('newsletter-submit');
        const messageDiv = document.getElementById('newsletter-message');

        submitBtn.disabled = true;
        submitBtn.textContent = 'Skickar...';

        const payload = {
            email: email,
            variant_id: selectedVariant.id,
            url: window.location.pathname
        };

        fetch('/api/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
            .then(async response => {
                const text = await response.text();
                console.log('Server Response Raw:', text);

                if (response.ok) {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        throw new Error('Invalid JSON: ' + text);
                    }
                }
                throw new Error('Network response was not ok: ' + response.status + ' | ' + text);
            })
            .then(data => {
                messageDiv.textContent = 'Tack! Du är nu med på listan.';
                messageDiv.style.color = '#2f855a';
                form.reset();
                setTimeout(() => {
                    box.style.display = 'none';
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.textContent = 'Ett fel uppstod. Försök igen.';
                messageDiv.style.color = '#c53030';
                submitBtn.disabled = false;
                submitBtn.textContent = selectedVariant.btnText;
            });
    });
});
