import '@splinetool/viewer';

export function initSpline() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const containers = document.querySelectorAll('[data-spline-url]');
    
    // Lazy load Spline components to protect main thread
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const url = el.dataset.splineUrl;
                if(!el.innerHTML.trim()) {
                    el.innerHTML = `<spline-viewer url="${url}" loading-anim></spline-viewer>`;
                }
                obs.unobserve(el);
            }
        });
    }, { rootMargin: '300px' }); // Load slightly before it comes into view

    containers.forEach(container => observer.observe(container));
}
