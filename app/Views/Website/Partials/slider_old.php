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

/* DESKTOP SPECIFIC CLASSES */
.slider-desktop { display: flex; flex-direction: column; align-items: center; width: 100%; max-width: 90%; transform-style: preserve-3d; }
.desk-title { font-family: 'Outfit', sans-serif; font-size: 7.5rem; line-height: 1; margin: 0 0 15px 0; text-transform: uppercase; display: flex; flex-direction: column; align-items: center; }
.desk-word-solid { color: #FFFFFF; text-shadow: 0px 1px 0px #d9d9d9, 0px 6px 0px #595959, 0px 15px 30px rgba(0,0,0,0.95), 0px 0px 40px rgba(255,255,255,0.2); font-weight: 900; }
.desk-word-arise { background: linear-gradient(90deg, #C18536 0%, #DFAB54 20%, #F8D68B 50%, #DFAB54 80%, #C18536 100%); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0px 15px 30px rgba(0,0,0,0.85)); font-weight: 900; margin-top: 10px; animation: goldFlow 5s linear infinite; }
.desk-divider { position: relative; width: 100%; max-width: 600px; margin: 15px auto 25px auto; display: flex; align-items: center; justify-content: center; height: 28px; }
.desk-sub-wrap { margin-bottom: 40px; }
.desk-sub-1 { font-family: 'Cinzel', serif; font-size: 1.8rem; color: #FFFFFF; letter-spacing: 0.3em; margin-bottom: 15px; text-shadow: 0px 6px 12px rgba(0,0,0,0.8); text-align: center; }
.desk-sub-2 { display: flex; align-items: center; justify-content: center; gap: 20px; font-family: 'Outfit', sans-serif; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.35em; text-transform: uppercase; background: linear-gradient(90deg, #C18536 0%, #F8D68B 50%, #C18536 100%); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 2px 2px rgba(0,0,0,0.8)); animation: goldFlow 5s linear infinite; }
.desk-btn { font-size: 0.95rem; letter-spacing: 0.15em; }
.desk-btn .btn-icon { padding: 1rem 1.2rem 1rem 1.8rem; }
.desk-btn .btn-text { padding: 1.1rem 2.2rem 1.1rem 1.2rem; }

/* MOBILE SPECIFIC CLASSES */
.slider-mobile { display: none; flex-direction: column; align-items: center; width: 100%; padding: 0 15px; pointer-events: auto; }
.mob-title { font-family: 'Outfit', sans-serif; font-size: 3.5rem; line-height: 1.1; margin: 0 0 10px 0; text-transform: uppercase; display: flex; flex-direction: column; align-items: center; text-align: center; }
.mob-word-solid { color: #FFFFFF; text-shadow: 0px 1px 0px #d9d9d9, 0px 4px 8px rgba(0,0,0,0.95); font-weight: 900; }
.mob-word-arise { background: linear-gradient(90deg, #C18536 0%, #DFAB54 20%, #F8D68B 50%, #DFAB54 80%, #C18536 100%); background-size: 200% 100%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0px 4px 8px rgba(0,0,0,0.85)); font-weight: 900; margin-top: 5px; animation: goldFlow 5s linear infinite; }
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
      <h1 class="desk-title">
        <span class="desk-word-solid gs-fade">FORTUNE</span>
        <span class="desk-word-arise gs-fade">ONE</span>
      </h1>
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
        <div class="desk-sub-1 gs-fade-up">Karnataka's NewGen Builder</div>
        <div class="desk-sub-2 gs-fade-up"><span class="sub-line"></span><span>PREMIUM VILLA COMMUNITY</span><span class="sub-line"></span></div>
      </div>
      <button class="slider-btn-appointment desk-btn gs-fade-up" onclick="openBookingModalWrapper()">
        <span class="btn-content-wrap">
          <span class="btn-icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
          <span class="btn-text">BOOK A SITE VISIT</span>
        </span>
      </button>
    </div>

    <!-- MOBILE SLIDER HTML -->
    <div class="slider-mobile gs-group">
      <h1 class="mob-title">
        <span class="mob-word-solid gs-fade">FORTUNE</span>
        <span class="mob-word-arise gs-fade">ONE</span>
      </h1>
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
        $front.ripples({ resolution: 512, dropRadius: 20, perturbance: 0.01, imageUrl: images[0], interactive: false });
        $back.ripples({ resolution: 512, dropRadius: 20, perturbance: 0.01, imageUrl: images[1], interactive: false });
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
      try { $front.ripples('drop', x, y, 20, 0.015); $back.ripples('drop', x, y, 20, 0.015); } catch(err) {}
    });
  }

  // --- GSAP ANIMATIONS ---
  // Apply initial hidden states
  gsap.set('.gs-fade', { opacity: 0, scale: 1.05 });
  gsap.set('.gs-scale', { opacity: 0, scaleX: 0, scale: 0 });
  gsap.set('.gs-fade-up', { opacity: 0, y: 15 });

  // Only animate the visible container to prevent bugs
  const targetGroup = isMobile ? '.slider-mobile' : '.slider-desktop';
  
  const tl = gsap.timeline({ delay: 0.2 });
  tl.to(`${targetGroup} .gs-fade-up`, { duration: 1.5, y: 0, opacity: 1, ease: 'power2.out', stagger: 0.2 })
    .to(`${targetGroup} .gs-scale`, { duration: 1.5, scaleX: 1, scale: 1, opacity: 1, ease: 'power3.out', stagger: 0.1 }, '-=1.0')
    .to(`${targetGroup} .gs-fade`, { duration: 2.5, scale: 1, opacity: 1, ease: 'power2.out', stagger: 0.2 }, '-=1.2');

  gsap.to('.desk-title, .mob-title', { y: -10, duration: 4, ease: 'sine.inOut', yoyo: true, repeat: -1 });

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
