import SplitType from 'split-type';
import gsap from 'gsap';

export function initSplitText() {
    const textElements = document.querySelectorAll('.split-text-demo');
    
    textElements.forEach(el => {
        const text = new SplitType(el, { types: 'chars, words' });
        
        gsap.from(text.chars, {
            opacity: 0,
            y: 20,
            duration: 1,
            stagger: 0.05,
            ease: 'back.out(1.7)',
            scrollTrigger: {
                trigger: el,
                start: 'top 80%',
            }
        });
    });
}
