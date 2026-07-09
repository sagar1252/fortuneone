import { tsParticles } from "@tsparticles/engine";

export async function initParticles() {
    const container = document.getElementById('tsparticles-container');
    if (!container) return;

    // Load basic preset or config
    // We will use a simple custom config since loading entire presets requires more packages
    await tsParticles.load({
        id: "tsparticles-container",
        options: {
            background: {
                color: { value: "transparent" }
            },
            particles: {
                number: { value: 50 },
                color: { value: "#C18A56" },
                links: {
                    enable: true,
                    color: "#C18A56",
                    distance: 150,
                    opacity: 0.2,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 1,
                    direction: "none",
                    outModes: { default: "bounce" }
                },
                size: { value: { min: 1, max: 3 } },
                opacity: { value: { min: 0.1, max: 0.5 } }
            },
            interactivity: {
                events: {
                    onHover: { enable: true, mode: "grab" },
                    onClick: { enable: true, mode: "push" }
                },
                modes: {
                    grab: { distance: 140, links: { opacity: 0.5 } },
                    push: { quantity: 4 }
                }
            }
        }
    });
}
