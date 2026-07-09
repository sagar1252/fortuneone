import { animate } from 'motion';

export function initMotion() {
    const boxes = document.querySelectorAll('.motion-box');
    
    boxes.forEach(box => {
        // Initial entry animation
        animate(
            box,
            { scale: [0, 1], rotate: [90, 0] },
            { duration: 1, type: "spring", stiffness: 100 }
        );

        // Hover effect
        box.addEventListener('mouseenter', () => {
            animate(box, { scale: 1.1, rotate: 5 }, { type: "spring", stiffness: 200 });
        });
        box.addEventListener('mouseleave', () => {
            animate(box, { scale: 1, rotate: 0 }, { type: "spring", stiffness: 200 });
        });
    });
}
