import { initGSAP } from './animations/gsap/index.js';
import { initScroll } from './animations/scroll/index.js';
import { initInteractions } from './animations/interactions/index.js';
import { initTextAnimations } from './animations/text/index.js';
import { initParticles } from './animations/particles/index.js';
import { initThree } from './animations/three/index.js';
import { initSpline } from './animations/spline/index.js';
import { initPageTransitions } from './animations/page-transitions/index.js';

// Also initialize Swiper, AOS, Lottie from previous setups if needed
import { initAOS } from './modules/aosSetup.js';
import { initSwiper } from './modules/swiperDemo.js';
import { initLottie } from './modules/lottieDemo.js';

document.addEventListener('DOMContentLoaded', () => {
    // Core Animation System
    initPageTransitions();
    initScroll();        // Lenis
    initGSAP();          // Core ScrollTrigger, Revealer, Parallax
    initInteractions();  // Magnetic buttons, Tilt, Hover
    initTextAnimations(); // SplitType text reveals
    
    // Background/Media Systems (Lazy loaded internally)
    initThree();
    initSpline();
    initParticles();
    
    // Additional Vendor Integrations
    initAOS();
    initSwiper();
    initLottie();

    console.log("Advanced Animation Architecture Initialized.");
});
