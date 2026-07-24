/**
 * sidebar.js
 * Gestion de l'ouverture/fermeture de la sidebar sur mobile.
 */

/**
 * Bascule la visibilité de la sidebar et de l'overlay.
 */
export function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !overlay) return;

    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');
}

/**
 * Ferme la sidebar (utile depuis l'overlay ou la touche ESC).
 */
export function closeSidebar() {
    document.getElementById('sidebar')?.classList.remove('show');
    document.getElementById('sidebarOverlay')?.classList.remove('show');
}

/**
 * Initialise les écouteurs d'événements de la sidebar.
 */
export function initSidebar() {
    // Fermeture par touche ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSidebar();
    });

    // Fermeture sur clic de l'overlay
    document.getElementById('sidebarOverlay')
        ?.addEventListener('click', closeSidebar);

    // Fermeture automatique si on redimensionne en desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) closeSidebar();
    });
}

// Expose toggleSidebar globalement (utilisé dans les onclick Blade)
window.toggleSidebar = toggleSidebar;
