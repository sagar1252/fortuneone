// Career Page Scripts

document.addEventListener('DOMContentLoaded', () => {
  gsap.registerPlugin(ScrollTrigger);

  // Hero Animations
  if (document.querySelectorAll('.cr-eyebrow-char').length > 0) {
      const tlHero = gsap.timeline({ delay: 0.2 });

      // Setup initial states for 3D reveal
      gsap.set('.cr-eyebrow-char', { rotateX: -105, rotateY: 15, z: -150, opacity: 0, transformOrigin: "50% 50% -70px" });
      gsap.set('.cr-eyebrow-line', { scaleX: 0 });

      // Lines expand
      tlHero.to('.cr-eyebrow-line', { scaleX: 1, duration: 1.2, ease: 'power3.out', stagger: 0.2 })
            .to('.cr-eyebrow-char', {
              rotateX: 0,
              rotateY: 0,
              z: 0,
              opacity: 1,
              duration: 1.8,
              ease: 'expo.out',
              stagger: {
                each: 0.05,
                from: "center"
              }
            }, '-=0.8');

      // H1 words
      if (document.querySelectorAll('.cr-hero-char').length > 0) {
        tlHero.to('.cr-hero-char', {
          y: "0%",
          opacity: 1,
          duration: 1,
          stagger: 0.03,
          ease: "power4.out"
        }, "-=0.4");
      }

      // Subtitle
      if (document.getElementById('crHeroSub')) {
        tlHero.to('#crHeroSub', {
          y: 0,
          opacity: 1,
          duration: 1,
          ease: "power2.out"
        }, "-=0.6");
      }
  }

  // ScrollReveal for all sections
  const fadeUpElements = document.querySelectorAll('.cr-fade-up');
  fadeUpElements.forEach((el) => {
    ScrollTrigger.create({
      trigger: el,
      start: "top 85%",
      onEnter: () => el.classList.add('vis'),
      once: true
    });
  });

  // Simple Canvas Background Effect
  const cvs = document.getElementById('cr-hero-canvas');
  if (cvs) {
    const ctx = cvs.getContext('2d');
    let W, H;
    const resize = () => { W = cvs.width = window.innerWidth; H = cvs.height = window.innerHeight; };
    resize();
    window.addEventListener('resize', resize);
    
    // Some abstract points floating
    const pts = [];
    for(let i=0; i<60; i++) {
      pts.push({
        x: Math.random() * W,
        y: Math.random() * H,
        vx: (Math.random() - 0.5) * 0.3,
        vy: (Math.random() - 0.5) * 0.3,
        r: Math.random() * 1.5 + 0.5,
        a: Math.random() * 0.3 + 0.1
      });
    }

    function draw() {
      ctx.clearRect(0, 0, W, H);
      
      const bg = ctx.createLinearGradient(0,0,W,H);
      bg.addColorStop(0, '#15202B');
      bg.addColorStop(1, '#1A2B38');
      ctx.fillStyle = bg;
      ctx.fillRect(0,0,W,H);

      pts.forEach(p => {
        p.x += p.vx; p.y += p.vy;
        if(p.x < 0 || p.x > W) p.vx *= -1;
        if(p.y < 0 || p.y > H) p.vy *= -1;
        
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
        ctx.fillStyle = `rgba(158,105,61, ${p.a})`;
        ctx.fill();
      });

      requestAnimationFrame(draw);
    }
    draw();
  }
});
