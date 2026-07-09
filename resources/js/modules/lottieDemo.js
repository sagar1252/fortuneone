import lottie from 'lottie-web';

export function initLottie() {
    const containers = document.querySelectorAll('.lottie-container');
    
    containers.forEach(container => {
        lottie.loadAnimation({
            container: container, // the dom element that will contain the animation
            renderer: 'svg',
            loop: true,
            autoplay: true,
            // Sample Lottie JSON from public domain
            path: 'https://assets2.lottiefiles.com/packages/lf20_Z9wY1A.json' 
        });
    });
}
