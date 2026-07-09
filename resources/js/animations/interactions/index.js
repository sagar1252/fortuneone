import { animate } from 'motion';
import VanillaTilt from 'vanilla-tilt';

export function initInteractions() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) return;

    // 1. Magnetic Buttons
    const magneticElements = document.querySelectorAll('[data-magnetic]');
    
    magneticElements.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const strength = btn.dataset.magnetic || 0.25;
            const x = (e.clientX - rect.left - rect.width / 2) * strength;
            const y = (e.clientY - rect.top - rect.height / 2) * strength;
            
            animate(btn, { x, y }, { type: "spring", stiffness: 150, damping: 15 });
        });
        
        btn.addEventListener('mouseleave', () => {
            animate(btn, { x: 0, y: 0 }, { type: "spring", stiffness: 150, damping: 15 });
        });
    });

    // 2. Card Lift / Tilt Effects
    const tiltCards = document.querySelectorAll('[data-tilt-card]');
    if (tiltCards.length > 0) {
        VanillaTilt.init(tiltCards, {
            max: 10,
            speed: 400,
            glare: true,
            "max-glare": 0.15,
            scale: 1.02
        });
    }

    // 3. Hover Micro-interactions (Motion One)
    const hoverElements = document.querySelectorAll('[data-hover-scale]');
    hoverElements.forEach(el => {
        const scale = el.dataset.hoverScale || 1.05;
        el.addEventListener('mouseenter', () => animate(el, { scale }, { type: "spring" }));
        el.addEventListener('mouseleave', () => animate(el, { scale: 1 }, { type: "spring" }));
    });
}
