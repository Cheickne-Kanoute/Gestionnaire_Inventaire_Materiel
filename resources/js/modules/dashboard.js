/**
 * dashboard.js
 * Animations et interactions propres au tableau de bord.
 */

/**
 * Anime les barres de répartition par type au chargement.
 * Les barres partent de 0 puis atteignent leur largeur cible.
 */
export function animateTypeBars() {
    const bars = document.querySelectorAll('.type-bar-fill');

    if (!bars.length) return;

    bars.forEach((bar) => {
        const targetWidth = bar.getAttribute('data-width') || bar.style.width;
        bar.style.width = '0';

        // Déclenche l'animation après un court délai (pour que la transition CSS soit active)
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                bar.style.width = targetWidth;
            });
        });
    });
}

/**
 * Initialise toutes les animations du dashboard.
 */
export function initDashboard() {
    animateTypeBars();
}
