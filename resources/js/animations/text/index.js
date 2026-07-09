import SplitType from 'split-type';
import gsap from 'gsap';

export function initTextAnimations() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const splitElements = document.querySelectorAll('[data-split]');
    
    // Defer initialization to ensure fonts are loaded
    document.fonts.ready.then(() => {
        splitElements.forEach(el => {
            const splitMode = el.dataset.split || 'chars, words';
            const text = new SplitType(el, { types: splitMode });
            
            const target = splitMode.includes('chars') ? text.chars : text.words;
            
            gsap.from(target, {
                opacity: 0,
                yPercent: 100,
                duration: 0.8,
                stagger: 0.02,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                }
            });
            
            // Mask the wrapper so text slides up cleanly
            el.style.clipPath = "polygon(0 0, 100% 0, 100% 120%, 0 120%)";
        });
    });
}
