import { initLenis } from './modules/lenisSetup.js';
import { initGsap } from './modules/gsapAnimations.js';
import { initThree } from './modules/threeHero.js';
import { initSpline } from './modules/splineDemo.js';
import { initMotion } from './modules/motionOneDemo.js';
import { initParticles } from './modules/particlesDemo.js';
import { initAOS } from './modules/aosSetup.js';
import { initSplitText } from './modules/splitTextDemo.js';
import { initTilt } from './modules/tiltDemo.js';
import { initSwiper } from './modules/swiperDemo.js';
import { initLottie } from './modules/lottieDemo.js';

// Wait for DOM
document.addEventListener('DOMContentLoaded', () => {
    // 1. Lenis Smooth Scroll (Base for everything)
    initLenis();

    // 2. Initialize AOS (Animate on Scroll)
    initAOS();

    // 3. Initialize GSAP & ScrollTrigger with Lenis integration
    initGsap();

    // 4. Initialize Three.js Hero Background
    initThree();

    // 5. Particles Background
    initParticles();

    // 6. SplitType text animations
    initSplitText();

    // 7. Motion One animations
    initMotion();

    // 8. Vanilla Tilt
    initTilt();

    // 9. Swiper Carousel
    initSwiper();

    // 10. Lottie Animations
    initLottie();

    // 11. Spline 3D Viewer
    initSpline();

    console.log("Premium Animation Modules Initialized successfully.");
});
