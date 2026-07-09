import VanillaTilt from 'vanilla-tilt';

export function initTilt() {
    const elements = document.querySelectorAll('.tilt-card');
    if(elements.length > 0) {
        VanillaTilt.init(elements, {
            max: 15,
            speed: 400,
            glare: true,
            "max-glare": 0.2,
        });
    }
}
