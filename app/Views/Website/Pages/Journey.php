<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=Inter:wght@300;400&display=swap');
.journey-wrapper *, .journey-wrapper *:before, .journey-wrapper *:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
.journey-wrapper {
  position: relative;
  height: 100vh;
  width: 100%;
  overflow: hidden;
  background: #000;
  font-size: 100%;
}
@media (max-width: 767px) { 
  .journey-wrapper { display: none !important; } 
}

.journey-scene {
  width: 100%;
  height: 100%;
}
.journey-page {
  z-index: 1;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  will-change: transform, opacity;
}
.journey-page:nth-child(1) .journey-left { background-image: url('<?= base_url('assets/website/images/jorney/2007.webp') ?>'); }
.journey-page:nth-child(1) .journey-right { background-image: url('<?= base_url('assets/website/images/jorney/2007-text.webp') ?>'); }
.journey-page:nth-child(2) .journey-left { background-image: url('<?= base_url('assets/website/images/jorney/2007–2020-text.jpeg') ?>'); }
.journey-page:nth-child(2) .journey-right { background-image: url('<?= base_url('assets/website/images/jorney/2007–2020.webp') ?>'); }
.journey-page:nth-child(3) .journey-left { background-image: url('<?= base_url('assets/website/images/jorney/2020.webp') ?>'); }
.journey-page:nth-child(3) .journey-right { background-image: url('<?= base_url('assets/website/images/jorney/2020-text.webp') ?>'); }
.journey-page:nth-child(4) .journey-left { background-image: url('<?= base_url('assets/website/images/jorney/today-text.webp') ?>'); }
.journey-page:nth-child(4) .journey-right { background-image: url('<?= base_url('assets/website/images/jorney/today.webp') ?>'); }
.journey-page:nth-child(5) .journey-left { background-image: url('<?= base_url('assets/website/images/jorney/future.webp') ?>'); }
.journey-page:nth-child(5) .journey-right { background-image: url('<?= base_url('assets/website/images/jorney/future-text.webp') ?>'); }

.journey-half {
  position: absolute;
  top: 0;
  width: 50%;
  height: 100%;
  background-size: cover;
  will-change: transform;
}
.journey-half.journey-left {
  left: 0;
}
.journey-half.journey-right {
  left: 50%;
}

.journey-half.withText {
  background-color: rgba(0, 0, 0, 0.45);
  background-blend-mode: multiply;
}

.journey-half.withText:after {
  content: "";
  position: absolute;
  display: block;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.95) 100%);
  z-index: 10;
}

.journey-content-box {
  position: absolute;
  z-index: 500;
  top: 50%;
  left: 50%;
  transform: translateX(-50%) translateY(-50%);
  width: 80%;
  max-width: 500px;
  text-align: center;
  color: #fff;
}
.journey-year {
  font-family: 'Cormorant Garamond', serif;
  font-size: 3rem;
  font-weight: 600;
  color: #E6C594;
  margin-bottom: 0.5rem;
  letter-spacing: 4px;
  text-shadow: 0 0 25px rgba(230, 197, 148, 0.7), 0 3px 8px rgba(0,0,0,0.9);
}
.journey-heading {
  font-size: 4.5rem;
  font-family: 'Cormorant Garamond', serif;
  margin-bottom: 1.5rem;
  text-transform: uppercase;
  font-weight: 700;
  letter-spacing: 0.05em;
  color: #FDFBF7;
  text-shadow: 
    0px 1px 0px #D5B487,
    0px 2px 0px #C19A6B,
    0px 3px 0px #AD804F,
    0px 4px 0px #996633,
    0px 5px 0px #854C17,
    0px 6px 0px #703300,
    0px 15px 25px rgba(0,0,0, 0.9),
    0px 25px 45px rgba(0,0,0, 0.7);
}
.journey-desc {
  font-size: 1.25rem;
  line-height: 1.8;
  font-family: 'Inter', sans-serif;
  font-weight: 450;
  color: #ffffff;
  text-shadow: 0 2px 12px rgba(0,0,0,1), 0 1px 4px rgba(0,0,0,1);
}

/* Staggered entrance initial states for pages 2+ */
.journey-page:nth-child(n+2) .journey-year,
.journey-page:nth-child(n+2) .journey-heading,
.journey-page:nth-child(n+2) .journey-desc {
  opacity: 0;
  transform: translateY(40px) scale(0.95);
}

/* Visible state by default for page 1 to prevent FOUC */
.journey-page.page-1 .journey-year,
.journey-page.page-1 .journey-heading,
.journey-page.page-1 .journey-desc {
  opacity: 1;
  transform: translateY(0) scale(1);
}

.journey-nav-panel {
  position: absolute;
  top: 50%;
  right: 2%;
  transform: translateY(-50%);
  z-index: 1000;
  transition: opacity 0.5s, transform 0.5s cubic-bezier(0.57, 1.2, 0.68, 2.6);
  will-change: transform, opacity;
}
.journey-nav-panel.invisible {
  opacity: 0;
  transform: translateY(-50%) scale(0.5);
}
.journey-nav-panel ul {
  list-style-type: none;
}
.journey-nav-btn {
  position: relative;
  overflow: hidden;
  width: 1rem;
  height: 1rem;
  margin-bottom: 0.5rem;
  border: 0.12rem solid #fff;
  border-radius: 50%;
  cursor: pointer;
  transition: border-color, transform 0.3s;
  will-change: border-color, transform;
}
.journey-nav-btn:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  transform: translateX(-50%) translateY(-50%) scale(0.3);
  background-color: #fff;
  opacity: 0;
  transition: transform, opacity 0.3s;
  will-change: transform, opacity;
}
.journey-nav-btn.j-active:after, .journey-nav-btn:hover:after {
  transform: translateX(-50%) translateY(-50%) scale(0.7);
  opacity: 1;
}
.journey-nav-btn:hover {
  border-color: #9E693D;
  transform: scale(1.2);
}
.journey-nav-btn:hover:after, .journey-nav-btn.j-active:after {
  background-color: #9E693D;
}

.journey-scroll-btn {
  position: absolute;
  left: 0;
  width: 1rem;
  height: 1rem;
  border: 0.2rem solid #fff;
  border-left: none;
  border-bottom: none;
  cursor: pointer;
  transform-origin: 50% 50%;
  transition: border-color 0.3s;
}
.journey-scroll-btn.up {
  top: -1.6rem;
  transform: rotate(-45deg);
}
.journey-scroll-btn.down {
  bottom: -1.2rem;
  transform: rotate(135deg);
}
.journey-scroll-btn:hover {
  border-color: #9E693D;
}
</style>

<div class="journey-wrapper">
  <div class="journey-scene">
    <div class="journey-page page-1">
      <div class="journey-half journey-left"></div>
      <div class="journey-half journey-right withText">
        <div class="journey-content-box">
          <div class="journey-year">2007</div>
          <h2 class="journey-heading">The Beginning</h2>
          <p class="journey-desc">Launched Namma Mane Apartments on Old Airport Road, Bangalore - marking the beginning of our journey in creating quality living spaces.</p>
        </div>
      </div>
    </div>
    <div class="journey-page page-2">
      <div class="journey-half journey-left withText">
        <div class="journey-content-box">
          <div class="journey-year">2007-2020</div>
          <h2 class="journey-heading">Growth Phase</h2>
          <p class="journey-desc">Successfully developed multiple projects under various brands, building a strong foundation of trust and excellence across Bangalore.</p>
        </div>
      </div>
      <div class="journey-half journey-right"></div>
    </div>
    <div class="journey-page page-3">
      <div class="journey-half journey-left"></div>
      <div class="journey-half journey-right withText">
        <div class="journey-content-box">
          <div class="journey-year">2020</div>
          <h2 class="journey-heading">Unification</h2>
          <p class="journey-desc">All visions came together under one unified identity — Fortune One, representing our commitment to excellence and innovation.</p>
        </div>
      </div>
    </div>
    <div class="journey-page page-4">
      <div class="journey-half journey-left withText">
        <div class="journey-content-box">
          <div class="journey-year">Today</div>
          <h2 class="journey-heading">Moving Forward</h2>
          <p class="journey-desc">With three decades of experience, we continue redefining urban living with design, transparency, and timely delivery.</p>
        </div>
      </div>
      <div class="journey-half journey-right"></div>
    </div>
    <div class="journey-page page-5">
      <div class="journey-half journey-left"></div>
      <div class="journey-half journey-right withText">
        <div class="journey-content-box">
          <div class="journey-year">FUTURE</div>
          <h2 class="journey-heading">Looking Ahead</h2>
          <p class="journey-desc">Expanding our vision to create sustainable, innovative communities that set new standards in real estate development.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="journey-nav-panel">
    <div class="journey-scroll-btn up"></div>
    <div class="journey-scroll-btn down"></div>
    <nav>
      <ul>
        <li data-target="1" class="journey-nav-btn nav-page1 j-active"></li>
        <li data-target="2" class="journey-nav-btn nav-page2"></li>
        <li data-target="3" class="journey-nav-btn nav-page3"></li>
        <li data-target="4" class="journey-nav-btn nav-page4"></li>
        <li data-target="5" class="journey-nav-btn nav-page5"></li>
      </ul>
    </nav>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    console.warn("GSAP or ScrollTrigger is not loaded. Scrolling features may be limited.");
    return;
  }
  
  gsap.registerPlugin(ScrollTrigger);

  var pages = $(".journey-page").length,
      curPage = 1;

  // Set initial states using GSAP - Keep all pages at full opacity and scale, layering them via zIndex
  gsap.set(".journey-page", { opacity: 1 });
  
  gsap.set(".page-1", { zIndex: 10 });
  gsap.set(".page-1 .journey-left", { x: "0%" });
  gsap.set(".page-1 .journey-right", { x: "0%" });
  gsap.set(".page-1 .journey-year, .page-1 .journey-heading, .page-1 .journey-desc", { opacity: 1, y: 0 });

  gsap.set(".page-2", { zIndex: 20 });
  gsap.set(".page-2 .journey-left", { x: "-100%" });
  gsap.set(".page-2 .journey-right", { x: "100%" });
  gsap.set(".page-2 .journey-year, .page-2 .journey-heading, .page-2 .journey-desc", { opacity: 0, y: 40 });

  gsap.set(".page-3", { zIndex: 30 });
  gsap.set(".page-3 .journey-left", { x: "-100%" });
  gsap.set(".page-3 .journey-right", { x: "100%" });
  gsap.set(".page-3 .journey-year, .page-3 .journey-heading, .page-3 .journey-desc", { opacity: 0, y: 40 });

  gsap.set(".page-4", { zIndex: 40 });
  gsap.set(".page-4 .journey-left", { x: "-100%" });
  gsap.set(".page-4 .journey-right", { x: "100%" });
  gsap.set(".page-4 .journey-year, .page-4 .journey-heading, .page-4 .journey-desc", { opacity: 0, y: 40 });

  gsap.set(".page-5", { zIndex: 50 });
  gsap.set(".page-5 .journey-left", { x: "-100%" });
  gsap.set(".page-5 .journey-right", { x: "100%" });
  gsap.set(".page-5 .journey-year, .page-5 .journey-heading, .page-5 .journey-desc", { opacity: 0, y: 40 });

  // Create GSAP timeline driven by ScrollTrigger
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".journey-wrapper",
      start: "top top",
      end: "+=4000",
      pin: true,
      scrub: 1,
      anticipatePin: 1,
      onUpdate: (self) => {
        const progress = self.progress;
        let page = 1;
        if (progress < 0.125) page = 1;
        else if (progress >= 0.125 && progress < 0.375) page = 2;
        else if (progress >= 0.375 && progress < 0.625) page = 3;
        else if (progress >= 0.625 && progress < 0.875) page = 4;
        else page = 5;
        
        if (page !== curPage) {
          curPage = page;
          $(".journey-nav-btn").removeClass("j-active");
          $(".nav-page" + page).addClass("j-active");
        }
      }
    }
  });

  const st = tl.scrollTrigger;

  // Transition 1 -> 2
  tl.to(".page-1 .journey-year, .page-1 .journey-heading, .page-1 .journey-desc", { opacity: 0, y: -40, duration: 0.5 }, 0)
    .to(".page-2 .journey-left", { x: "0%", duration: 1, ease: "power2.out" }, 0)
    .to(".page-2 .journey-right", { x: "0%", duration: 1, ease: "power2.out" }, 0)
    .to(".page-2 .journey-year", { opacity: 1, y: 0, duration: 0.5 }, 0.4)
    .to(".page-2 .journey-heading", { opacity: 1, y: 0, duration: 0.5 }, 0.5)
    .to(".page-2 .journey-desc", { opacity: 1, y: 0, duration: 0.5 }, 0.6);

  // Transition 2 -> 3
  tl.to(".page-2 .journey-year, .page-2 .journey-heading, .page-2 .journey-desc", { opacity: 0, y: -40, duration: 0.5 }, 1)
    .to(".page-3 .journey-left", { x: "0%", duration: 1, ease: "power2.out" }, 1)
    .to(".page-3 .journey-right", { x: "0%", duration: 1, ease: "power2.out" }, 1)
    .to(".page-3 .journey-year", { opacity: 1, y: 0, duration: 0.5 }, 1.4)
    .to(".page-3 .journey-heading", { opacity: 1, y: 0, duration: 0.5 }, 1.5)
    .to(".page-3 .journey-desc", { opacity: 1, y: 0, duration: 0.5 }, 1.6);

  // Transition 3 -> 4
  tl.to(".page-3 .journey-year, .page-3 .journey-heading, .page-3 .journey-desc", { opacity: 0, y: -40, duration: 0.5 }, 2)
    .to(".page-4 .journey-left", { x: "0%", duration: 1, ease: "power2.out" }, 2)
    .to(".page-4 .journey-right", { x: "0%", duration: 1, ease: "power2.out" }, 2)
    .to(".page-4 .journey-year", { opacity: 1, y: 0, duration: 0.5 }, 2.4)
    .to(".page-4 .journey-heading", { opacity: 1, y: 0, duration: 0.5 }, 2.5)
    .to(".page-4 .journey-desc", { opacity: 1, y: 0, duration: 0.5 }, 2.6);

  // Transition 4 -> 5
  tl.to(".page-4 .journey-year, .page-4 .journey-heading, .page-4 .journey-desc", { opacity: 0, y: -40, duration: 0.5 }, 3)
    .to(".page-5 .journey-left", { x: "0%", duration: 1, ease: "power2.out" }, 3)
    .to(".page-5 .journey-right", { x: "0%", duration: 1, ease: "power2.out" }, 3)
    .to(".page-5 .journey-year", { opacity: 1, y: 0, duration: 0.5 }, 3.4)
    .to(".page-5 .journey-heading", { opacity: 1, y: 0, duration: 0.5 }, 3.5)
    .to(".page-5 .journey-desc", { opacity: 1, y: 0, duration: 0.5 }, 3.6);

  // Click handler for navigation dots
  $(document).on("click", ".journey-nav-btn", function() {
    if (!st) return;
    const targetPage = +$(this).attr("data-target");
    const start = st.start;
    const end = st.end;
    const total = end - start;
    
    let targetProgress = 0;
    if (targetPage === 1) targetProgress = 0;
    else if (targetPage === 2) targetProgress = 0.25;
    else if (targetPage === 3) targetProgress = 0.5;
    else if (targetPage === 4) targetProgress = 0.75;
    else if (targetPage === 5) targetProgress = 1.0;
    
    const targetScroll = start + total * targetProgress;
    
    window.scrollTo({
      top: targetScroll + 1,
      behavior: "smooth"
    });
  });

  // Click handler for up/down arrow buttons
  $(document).on("click", ".journey-scroll-btn", function() {
    if (!st) return;
    let targetPage = curPage;
    if ($(this).hasClass("up")) {
      if (targetPage > 1) targetPage--;
    } else {
      if (targetPage < pages) targetPage++;
    }
    
    const start = st.start;
    const end = st.end;
    const total = end - start;
    
    let targetProgress = 0;
    if (targetPage === 1) targetProgress = 0;
    else if (targetPage === 2) targetProgress = 0.25;
    else if (targetPage === 3) targetProgress = 0.5;
    else if (targetPage === 4) targetProgress = 0.75;
    else if (targetPage === 5) targetProgress = 1.0;
    
    const targetScroll = start + total * targetProgress;
    window.scrollTo({
      top: targetScroll + 1,
      behavior: "smooth"
    });
  });
});
</script>
