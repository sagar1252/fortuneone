import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export function initGsap() {
    gsap.registerPlugin(ScrollTrigger);

    // Staggered reveal for our premium demo cards
    const demoCards = gsap.utils.toArray('.premium-demo-card');
    
    if (demoCards.length > 0) {
        // Set initial state
        gsap.set(demoCards, { y: 100, opacity: 0, scale: 0.95 });

        ScrollTrigger.batch(demoCards, {
            onEnter: batch => gsap.to(batch, {
                opacity: 1, 
                y: 0, 
                scale: 1,
                duration: 1.2,
                stagger: 0.15,
                ease: 'power4.out',
                overwrite: true
            }),
            onLeaveBack: batch => gsap.set(batch, {
                opacity: 0, 
                y: 100, 
                scale: 0.95,
                overwrite: true
            }),
            start: "top 85%",
        });
    }

    // Parallax elements
    const parallaxElements = gsap.utils.toArray('[data-speed]');
    parallaxElements.forEach(el => {
        gsap.to(el, {
            y: (i, target) => -ScrollTrigger.maxScroll(window) * target.dataset.speed,
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
