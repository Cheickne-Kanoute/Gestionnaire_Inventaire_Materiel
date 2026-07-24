/**
 * app.js — Point d'entrée JavaScript
 * IT Assets Manager
 *
 * Importe les modules et initialise l'application
 * une fois le DOM prêt.
 */

import { initSidebar } from './modules/sidebar.js';
import { initDashboard } from './modules/dashboard.js';

document.addEventListener('DOMContentLoaded', () => {
    // ── Sidebar (toutes les pages) ──
    initSidebar();

    // ── Dashboard (seulement si on est sur la page dashboard) ──
    if (document.querySelector('.kpi-grid')) {
        initDashboard();
    }
});
