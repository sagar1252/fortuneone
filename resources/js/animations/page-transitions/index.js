import gsap from 'gsap';

export function initPageTransitions() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // Create transition overlay
    const overlay = document.createElement('div');
    overlay.classList.add('page-transition-overlay');
    document.body.appendChild(overlay);

    // Fade in on page load
    gsap.to(overlay, { 
        yPercent: -100, 
        duration: 0.8, 
        ease: 'power4.inOut',
        delay: 0.2 // allow initial scripts to parse
    });

    // Intercept internal links for out-animation
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            
            // Ignore anchors, target="_blank", or external links
            if (!href || href.startsWith('#') || link.target === '_blank' || href.startsWith('mailto:') || href.startsWith('tel:')) return;
            
            // Check if it's the same origin
            try {
                const url = new URL(href, window.location.origin);
                if (url.origin === window.location.origin) {
                    e.preventDefault();
                    
                    gsap.fromTo(overlay, 
                        { yPercent: 100 },
                        { 
                            yPercent: 0, 
                            duration: 0.6, 
                            ease: 'power3.inOut',
                            onComplete: () => {
                                window.location.href = href;
                            }
                        }
                    );
                }
            } catch (err) {}
        });
    });
}
