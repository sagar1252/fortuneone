import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import ScrollToPlugin from 'gsap/ScrollToPlugin';

export function initGSAP() {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
    
    // Global GSAP settings
    gsap.config({
        nullTargetWarn: false,
    });

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (prefersReducedMotion) {
        // Disable all GSAP animations globally for accessibility
        gsap.ticker.fps(1);
        ScrollTrigger.disable();
        return;
    }

    // Advanced reveal system using data-attributes
    const revealElements = document.querySelectorAll('[data-reveal]');
    
    if (revealElements.length > 0) {
        ScrollTrigger.batch(revealElements, {
            onEnter: batch => {
                gsap.fromTo(batch, 
                    { opacity: 0, y: 50 },
                    { 
                        opacity: 1, 
                        y: 0, 
                        stagger: 0.15, 
                        duration: 1.2, 
                        ease: 'power3.out',
                        overwrite: true
                    }
                );
            },
            start: "top 85%",
        });
    }

    // Parallax layers
    const parallaxElements = document.querySelectorAll('[data-parallax]');
    parallaxElements.forEach(el => {
        const speed = el.dataset.parallax || 0.5;
        gsap.to(el, {
            y: (i, target) => -ScrollTrigger.maxScroll(window) * speed,
            ease: "none",
            scrollTrigger: {
                trigger: el,
                start: "top bottom",
                end: "bottom top",
                scrub: 1
            }
        });
    });
}
