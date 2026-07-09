import { tsParticles } from "@tsparticles/engine";

export async function initParticles() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const container = document.getElementById('tsparticles-container');
    if (!container) return;

    await tsParticles.load({
        id: "tsparticles-container",
        options: {
            background: { color: { value: "transparent" } },
            particles: {
                number: { value: 60, density: { enable: true, width: 1920, height: 1080 } },
                color: { value: "#C18A56" },
                links: { enable: true, color: "#C18A56", distance: 150, opacity: 0.15, width: 1 },
                move: { enable: true, speed: 0.8, direction: "none", outModes: { default: "bounce" } },
                size: { value: { min: 1, max: 2 } },
                opacity: { value: { min: 0.1, max: 0.4 } }
            },
            interactivity: {
                events: { onHover: { enable: true, mode: "grab" } },
                modes: { grab: { distance: 140, links: { opacity: 0.3 } } }
            },
            detectRetina: true
        }
    });
}
