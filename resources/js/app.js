import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Toggle Menu Mobile
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    // Init AOS
    if (window.AOS) {
        AOS.init({
            duration: 800,
            once: true,
        });
    }
});
