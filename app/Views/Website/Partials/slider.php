<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Outfit:wght@300;400;600;800;900&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">

<style>
/* COMMON SLIDER WRAPPER */
#hero-slider-wrapper { position: relative; width: 100%; height: 100vh; overflow: hidden; background-color: #000; }
.bg-slider { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; transition: opacity 2s ease-in-out, transform 8s ease-out; opacity: 0; transform: scale(1.08); }
#slider-back { z-index: 1; }
#slider-front { z-index: 2; }
.bg-slider.active { opacity: 1; transform: scale(1); }
.vignette-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: radial-gradient(circle at center, transparent 15%, rgba(0,0,0,0.85) 100%); z-index: 3; pointer-events: none; }
.slider-content-section { position: absolute; top: 0; left: 0; z-index: 4; width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; perspective: 1200px; pointer-events: none; }

/* REUSABLE BASE COMPONENTS */
.animated-gold-divider-line { position: absolute; top: 50%; left: 0; width: 100%; height: 1.5px; transform: translateY(-50%); background: linear-gradient(90deg, transparent 0%, #8C5C20 15%, #E3AE57 35%, #B57F32 50%, #E3AE57 65%, #8C5C20 85%, transparent 100%); background-size: 200% 100%; animation: goldFlow 4s linear infinite; z-index: 1; box-shadow: 0 0 10px rgba(227, 174, 87, 0.6); }
.divider-icon { position: relative; z-index: 2; display: flex; align-items: center; justify-content: center; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.8)); }
@keyframes goldFlow { 0% { background-position: 200% 0; } 100% { background-position: 0% 0; } }
.sub-line { display: block; width: 40px; height: 1.5px; background: linear-gradient(90deg, transparent 0%, #E3AE57 50%, transparent 100%); -webkit-text-fill-color: initial; }
.slider-btn-appointment { background: linear-gradient(90deg, #CE9D52 0%, #E6BA67 50%, #C59345 100%); color: #1A1A1A; padding: 0; font-weight: 800; font-family: 'DM Sans', sans-serif; border: none; border-radius: 50px; cursor: pointer; position: relative; overflow: hidden; transition: all 0.6s cubic-bezier(0.25, 1, 0.22, 1); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); display: inline-flex; align-items: center; pointer-events: auto; }
.btn-content-wrap { display: flex; align-items: stretch; position: relative; z-index: 2; width: 100%; transition: transform 0.4s cubic-bezier(0.25, 1, 0.22, 1); }
.btn-icon { display: flex; align-items: center; justify-content: center; border-right: 1px solid rgba(26, 26, 26, 0.2); }
.btn-text { display: flex; align-items: center; }
.slider-btn-appointment::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: #FAFAF8; transform: scaleY(0); transform-origin: bottom; transition: transform 0.6s cubic-bezier(0.25, 1, 0.22, 1); z-index: 1; }
.slider-btn-appointment:hover { transform: translateY(-4px); color: #1A1A1A; box-shadow: 0 15px 40px rgba(223, 171, 84, 0.5); }
.slider-btn-appointment:hover::before { transform: scaleY(1); transform-origin: top; }
.slider-btn-appointment:hover .btn-content-wrap { transform: scale(1.03); }

/* CINEMATIC TEXT & PARTICLES */
.cinematic-title-wrapper { display: flex; flex-direction: column; align-items: center; margin-bottom: 10px; z-index: 5; position: relative; }
.cinematic-logo-wrap { width: 160px; height: 160px; margin-bottom: 20px; filter: drop-shadow(0px 0px 25px rgba(223, 171, 84, 0.5)); }
.cinematic-logo-mask { width: 100%; height: 100%; background: linear-gradient(110deg, #8C5C20 0%, #E3AE57 15%, #FFF9EB 25%, #E3AE57 35%, #8C5C20 50%, #E3AE57 65%, #FFF9EB 75%, #E3AE57 85%, #8C5C20 100%); background-size: 200% auto; -webkit-mask-size: contain; -webkit-mask-repeat: no-repeat; -webkit-mask-position: center; mask-size: contain; mask-repeat: no-repeat; mask-position: center; animation: shineCinematic 6s linear infinite; }
.desk-title-row { display: flex; flex-direction: row; gap: 25px; }
.cinematic-gold-text { font-family: 'Cinzel', serif; font-size: 6.5rem; line-height: 1; text-transform: uppercase; background: linear-gradient(110deg, #8C5C20 0%, #E3AE57 15%, #FFF9EB 25%, #E3AE57 35%, #8C5C20 50%, #E3AE57 65%, #FFF9EB 75%, #E3AE57 85%, #8C5C20 100%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0px 12px 24px rgba(0,0,0,0.95)); font-weight: 550; text-align: center; animation: shineCinematic 6s linear infinite; }
@keyframes shineCinematic { 0% { background-position: 200% center; } 100% { background-position: 0% center; } }
.particle { position: absolute; border-radius: 50%; background: radial-gradient(circle, rgba(253,251,247,1) 0%, rgba(227,174,87,0.8) 40%, rgba(0,0,0,0) 80%); pointer-events: none; z-index: 3; box-shadow: 0 0 15px rgba(227,174,87,0.6); }

/* DESKTOP SPECIFIC CLASSES */
.slider-desktop { display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 90%; transform-style: preserve-3d; }
.desk-divider { position: relative; width: 100%; max-width: 600px; margin: 15px auto 25px auto; display: flex; align-items: center; justify-content: center; height: 28px; }
.desk-sub-wrap { margin-bottom: 40px; }
.desk-sub-1 { font-family: 'Cinzel', serif; font-size: 1.8rem; color: #FFFFFF; letter-spacing: 0.3em; margin-bottom: 15px; text-shadow: 0px 6px 12px rgba(0,0,0,0.8); text-align: center; }
.desk-sub-2 { display: flex; align-items: center; justify-content: center; gap: 20px; font-family: 'Outfit', sans-serif; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.35em; text-transform: uppercase; background: linear-gradient(90deg, #C18536 0%, #F8D68B 50%, #C18536 100%); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.8)); animation: goldFlow 5s linear infinite; }
.desk-btn { font-size: 0.95rem; letter-spacing: 0.15em; }
.desk-btn .btn-icon { padding: 1rem 1.2rem 1rem 1.8rem; }
.desk-btn .btn-text { padding: 1.1rem 2.2rem 1.1rem 1.2rem; }

/* MOBILE SPECIFIC CLASSES */
.slider-mobile { display: none; flex-direction: column; align-items: center; width: 100%; padding: 0 15px; pointer-events: auto; }
.mob-title-row { display: flex; flex-direction: row; gap: 12px; }
.mob-cinematic-logo-wrap { width: 90px; height: 90px; margin-bottom: 15px; filter: drop-shadow(0px 0px 15px rgba(223, 171, 84, 0.5)); }
.mob-cinematic-text { font-family: 'Cinzel', serif; font-size: 2.8rem; line-height: 1.1; text-transform: uppercase; background: linear-gradient(110deg, #8C5C20 0%, #E3AE57 15%, #FFF9EB 25%, #E3AE57 35%, #8C5C20 50%, #E3AE57 65%, #FFF9EB 75%, #E3AE57 85%, #8C5C20 100%); background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 550; text-align: center; animation: shineCinematic 6s linear infinite; }
.mob-divider { position: relative; width: 90%; max-width: 300px; margin: 10px auto 20px auto; display: flex; align-items: center; justify-content: center; height: 20px; }
.mob-divider .divider-icon svg { width: 40px; }
.mob-sub-wrap { margin-bottom: 30px; }
.mob-sub-1 { font-family: 'Cinzel', serif; font-size: 1.1rem; color: #FFFFFF; letter-spacing: 0.15em; margin-bottom: 10px; text-shadow: 0px 4px 8px rgba(0,0,0,0.8); text-align: center; }
.mob-sub-2 { display: flex; align-items: center; justify-content: center; gap: 8px; font-family: 'Outfit', sans-serif; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; background: linear-gradient(90deg, #C18536 0%, #F8D68B 50%, #C18536 100%); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; white-space: nowrap; }
.mob-sub-2 .sub-line { width: 25px; }
.mob-btn { font-size: 0.8rem; letter-spacing: 0.1em; margin-top: 10px; }
.mob-btn .btn-icon { padding: 0.8rem 1rem; }
.mob-btn .btn-icon svg { width: 18px; height: 18px; }
.mob-btn .btn-text { padding: 0.8rem 1.2rem; }

/* MEDIA QUERIES TO TOGGLE DISPLAY */
@media (max-width: 768px) {
  .slider-desktop { display: none !important; }
  .slider-mobile { display: flex !important; }
}
</style>

<div id="hero-slider-wrapper">
  <!-- Dual Background Layers -->
  <div id="slider-back" class="bg-slider"></div>
  <div id="slider-front" class="bg-slider active"></div>
  <div class="vignette-overlay"></div>

  <section class="slider-content-section">
    <!-- DESKTOP SLIDER HTML -->
    <div class="slider-desktop gs-group">
      <div class="cinematic-title-wrapper gs-cinematic">
        <div class="cinematic-logo-wrap">
          <div class="cinematic-logo-mask" style="-webkit-mask-image: url('<?= base_url('slider-logo.png') ?>'); mask-image: url('<?= base_url('slider-logo.png') ?>');"></div>
        </div>
        <h1 class="desk-title-row">
          <span class="cinematic-gold-text">FORTUNE</span>
          <span class="cinematic-gold-text">ONE</span>
        </h1>
      </div>
      <div class="desk-divider">
        <div class="animated-gold-divider-line gs-scale"></div>
        <div class="divider-icon gs-scale">
          <svg viewBox="0 0 60 24" width="70" height="28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="goldGradDesk" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#8C5C20"/><stop offset="35%" stop-color="#E3AE57"/><stop offset="50%" stop-color="#B57F32"/><stop offset="65%" stop-color="#E3AE57"/><stop offset="100%" stop-color="#8C5C20"/>
              </linearGradient>
            </defs>
            <path d="M30 0 L34 12 L30 24 L26 12 Z" fill="url(#goldGradDesk)"/>
            <path d="M30 12 C 18 -2, 2 -2, 2 12 C 2 26, 18 26, 30 12 C 42 -2, 58 -2, 58 12 C 58 26, 42 26, 30 12" stroke="url(#goldGradDesk)" stroke-width="1.5"/>
            <path d="M12 10 L14.5 12 L12 14 L9.5 12 Z" fill="url(#goldGradDesk)"/>
            <path d="M48 10 L50.5 12 L48 14 L45.5 12 Z" fill="url(#goldGradDesk)"/>
          </svg>
        </div>
      </div>
      <div class="desk-sub-wrap">
        <div class="desk-sub-1 gs-fade-up">Crafting Branded Spaces For The Next-Gen</div>
      <!--  <div class="desk-sub-2 gs-fade-up"><span class="sub-line"></span><span>PREMIUM VILLA COMMUNITY</span><span class="sub-line"></span></div>-->
      </div>
      <!--<button class="slider-btn-appointment desk-btn gs-fade-up" onclick="openBookingModalWrapper()">-->
      <!--  <span class="btn-content-wrap">-->
      <!--    <span class="btn-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>-->
      <!--    <span class="btn-text">EXPLORE PROJECT</span>-->
      <!--  </span>-->
      <!--</button>-->
      <button
    class="slider-btn-appointment desk-btn gs-fade-up"
    onclick="window.location.href='<?= base_url('portfolio') ?>'">
    <span class="btn-content-wrap">
        <span class="btn-icon">
            <!-- SVG -->
        </span>
        <span class="btn-text">EXPLORE PROJECT</span>
    </span>
</button>
    </div>

    <!-- MOBILE SLIDER HTML -->
    <div class="slider-mobile gs-group">
      <div class="cinematic-title-wrapper gs-cinematic">
        <div class="mob-cinematic-logo-wrap">
          <div class="cinematic-logo-mask" style="-webkit-mask-image: url('<?= base_url('slider-logo.png') ?>'); mask-image: url('<?= base_url('slider-logo.png') ?>');"></div>
        </div>
        <h1 class="mob-title-row">
          <span class="mob-cinematic-text">FORTUNE</span>
          <span class="mob-cinematic-text">ONE</span>
        </h1>
      </div>
      <div class="mob-divider">
        <div class="animated-gold-divider-line gs-scale"></div>
        <div class="divider-icon gs-scale">
          <svg viewBox="0 0 60 24" width="40" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="goldGradMob" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" stop-color="#8C5C20"/><stop offset="35%" stop-color="#E3AE57"/><stop offset="50%" stop-color="#B57F32"/><stop offset="65%" stop-color="#E3AE57"/><stop offset="100%" stop-color="#8C5C20"/>
              </linearGradient>
            </defs>
            <path d="M30 0 L34 12 L30 24 L26 12 Z" fill="url(#goldGradMob)"/>
            <path d="M30 12 C 18 -2, 2 -2, 2 12 C 2 26, 18 26, 30 12 C 42 -2, 58 -2, 58 12 C 58 26, 42 26, 30 12" stroke="url(#goldGradMob)" stroke-width="1.5"/>
          </svg>
        </div>
      </div>
      <div class="mob-sub-wrap">
        <div class="mob-sub-1 gs-fade-up">Karnataka's NewGen Builder</div>
        <div class="mob-sub-2 gs-fade-up"><span class="sub-line"></span><span>PREMIUM VILLA</span><span class="sub-line"></span></div>
      </div>
      <button class="slider-btn-appointment mob-btn gs-fade-up" onclick="openBookingModalWrapper()">
        <span class="btn-content-wrap">
          <span class="btn-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
          <span class="btn-text">BOOK VISIT</span>
        </span>
      </button>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.ripples@0.6.3/dist/jquery.ripples.min.js"></script>
<script>
function openBookingModalWrapper() {
  if (typeof openBookingModal === 'function') {
    openBookingModal();
  } else {
    window.location.href = '<?= base_url("contact") ?>';
  }
}

$(document).ready(function() {
  const isMobile = window.innerWidth <= 768;
  const images = isMobile ? [
    '<?= base_url("slider/mobile-baner-1.webp") ?>',
    '<?= base_url("slider/mobile-baner-2.webp") ?>',
    '<?= base_url("slider/mobile-baner-3.webp") ?>'
  ] : [
    '<?= base_url("slider/baner-1.webp") ?>',
    '<?= base_url("slider/baner-2.webp") ?>',
    '<?= base_url("slider/baner-3.webp") ?>'
  ];
  
  let currentIndex = 0;
  const $front = $('#slider-front');
  const $back = $('#slider-back');

  $front.css('background-image', `url('${images[0]}')`);
  $back.css('background-image', `url('${images[1]}')`);

  if (!isMobile) {
    setTimeout(() => {
      try {
        $front.ripples({ resolution: 512, dropRadius: 15, perturbance: 0.05, imageUrl: images[0], interactive: false });
        $back.ripples({ resolution: 512, dropRadius: 15, perturbance: 0.05, imageUrl: images[1], interactive: false });
      } catch (e) {}
    }, 100);
  }

  setInterval(() => {
    let prefetchIndex = (currentIndex + 2) % images.length;
    if ($front.hasClass('active')) {
      $front.removeClass('active');
      $back.addClass('active');
      setTimeout(() => {
        $front.css('background-image', `url('${images[prefetchIndex]}')`);
        if(!isMobile) { try { $front.ripples('set', 'imageUrl', images[prefetchIndex]); } catch(e) {} }
      }, 1500); 
    } else {
      $back.removeClass('active');
      $front.addClass('active');
      setTimeout(() => {
        $back.css('background-image', `url('${images[prefetchIndex]}')`);
        if(!isMobile) { try { $back.ripples('set', 'imageUrl', images[prefetchIndex]); } catch(e) {} }
      }, 1500);
    }
    currentIndex = (currentIndex + 1) % images.length;
  }, 4500); 

  if (!isMobile) {
    $('#hero-slider-wrapper').on('mousemove', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      try { $front.ripples('drop', x, y, 15, 0.005); $back.ripples('drop', x, y, 15, 0.005); } catch(err) {}
    });
  }

  // --- CINEMATIC PARTICLES ---
  const particleCount = isMobile ? 30 : 75;
  const wrapper = $('#hero-slider-wrapper');
  for (let i = 0; i < particleCount; i++) {
    const size = Math.random() * 4 + 1;
    const x = Math.random() * 100;
    const y = Math.random() * 100;
    const duration = Math.random() * 15 + 10;
    const delay = Math.random() * 10;
    const particle = $('<div class="particle"></div>').css({ width: size + 'px', height: size + 'px', left: x + '%', top: y + '%', opacity: Math.random() * 0.7 + 0.3 });
    wrapper.append(particle);
    gsap.to(particle, { y: '-=200', x: `+=${Math.random() * 60 - 30}`, opacity: 0, duration: duration, delay: delay, repeat: -1, ease: 'none' });
  }

  // --- DRAMATIC CINEMATIC GSAP ANIMATIONS ---
  if ($('#cinematic-overlay').length === 0) {
      $('#hero-slider-wrapper').append('<div id="cinematic-overlay" style="position:absolute; top:0; left:0; width:100%; height:100%; background:#0a0a0a; z-index: 3; pointer-events:none;"></div>');
  }
  
  gsap.set('.gs-cinematic', { opacity: 0, scale: 1.4, filter: 'blur(20px)', z: 200, rotationX: 20 });
  gsap.set('.cinematic-gold-text, .mob-cinematic-text', { letterSpacing: '0.6em' });
  gsap.set('.gs-scale', { opacity: 0, scaleX: 0, scale: 0 });
  gsap.set('.gs-fade-up', { opacity: 0, y: 40 });

  const tl = gsap.timeline({ delay: 0.2 });
  
  tl.to('#cinematic-overlay', { duration: 3, opacity: 0, ease: 'power2.inOut' })
    .to('.gs-cinematic', { duration: 5, opacity: 1, scale: 1, filter: 'blur(0px)', z: 0, rotationX: 0, ease: 'expo.out' }, '-=2.5')
    .to('.cinematic-gold-text', { duration: 5, letterSpacing: '0.1em', ease: 'expo.out' }, '-=5.0')
    .to('.mob-cinematic-text', { duration: 5, letterSpacing: '0.05em', ease: 'expo.out' }, '-=5.0')
    .to('.gs-scale', { duration: 2.5, scaleX: 1, scale: 1, opacity: 1, ease: 'power3.out', stagger: 0.3 }, '-=3.5')
    .to('.gs-fade-up', { duration: 2.5, y: 0, opacity: 1, ease: 'power3.out', stagger: 0.2 }, '-=3.0');

  gsap.to('.cinematic-title-wrapper', { y: -15, duration: 5, ease: 'sine.inOut', yoyo: true, repeat: -1 });

  if (!isMobile) {
    gsap.to('.slider-desktop', { scale: 1.03, duration: 15, ease: 'sine.inOut', yoyo: true, repeat: -1 });
    const deskContainer = $('.slider-desktop');
    $(document).on('mousemove', function(e) {
      const ax = -($(window).innerWidth() / 2 - e.pageX) / 80;
      const ay = ($(window).innerHeight() / 2 - e.pageY) / 80;
      deskContainer.css("transform", `rotateY(${ax}deg) rotateX(${ay}deg)`);
    });
  }
});
</script>
