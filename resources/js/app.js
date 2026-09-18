import './bootstrap';
import { createIcons, icons } from 'lucide';

// Attach lucide to window object
window.lucide = {
    createIcons: (options = {}) => createIcons({ icons, ...options }),
    icons: icons
};

// Automatically initialize icons
function autoInitLucide() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', autoInitLucide);
} else {
    autoInitLucide();
}
