document.addEventListener('DOMContentLoaded', function () {
    // Poll for the header controls (Mithril renders async)
    const checkHeader = setInterval(() => {
        const headerControls = document.querySelector('.Header-controls');
        const secondaryNav = document.querySelector('.Header-secondary'); // Better target

        // Target: Insert before the search box or items
        const target = secondaryNav || headerControls;

        if (target && !document.getElementById('back-to-site')) {
            // Stop polling once found
            // Don't clear interval immediately in case of re-render, but usually DOMContentLoaded + check is ok.
            // Actually, with Mithril, it might re-render. Flarum extends are better but this is a pure JS shim.
            clearInterval(checkHeader);

            const link = document.createElement('a');
            link.id = 'back-to-site';
            link.href = '/';
            link.className = 'Button Button--link';
            link.innerHTML = '← <span>Tillbaka till Raknalon.se</span>';

            // Insert at the beginning of the secondary nav (right side)
            target.prepend(link);
        }
    }, 200);

    // Stop checking after 10 seconds to save memory
    setTimeout(() => clearInterval(checkHeader), 10000);
});
