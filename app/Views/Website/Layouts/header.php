<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($meta_title ?? 'Fortune One — Where Vision Creates Legacy') ?></title>
<meta name="description" content="<?= esc($meta_description ?? 'Fortune One is a premier real estate and advisory firm dedicated to architecting the future of enterprise and luxury developments.') ?>">
<link rel="canonical" href="<?= current_url() ?>">
<meta property="og:title" content="<?= esc($meta_title ?? 'Fortune One — Where Vision Creates Legacy') ?>">
<meta property="og:description" content="<?= esc($meta_description ?? 'Fortune One is a premier real estate and advisory firm dedicated to architecting the future of enterprise and luxury developments.') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= current_url() ?>">
<meta property="og:image" content="<?= base_url('assets/website/images/logo.png') ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@200;300;400;500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<link rel="stylesheet" href="<?= base_url('assets/website/css/style.css?v=' . time()) ?>">
<link rel="stylesheet" href="<?= base_url('assets/website/css/responsive.css') ?>">
<style>
@keyframes flowingColor {
  0% { background-position: 0% 50%; }
  100% { background-position: 200% 50%; }
}
h2 em, h3 em, .section-title em, .ab-title-dark em, .ab-title-light em, .ab-wwa-title em {
  background-image: linear-gradient(90deg, #C18A56, #FAFAF8, #9E693D, #C18A56) !important;
  background-size: 200% auto !important;
  color: transparent !important;
  -webkit-text-fill-color: transparent !important;
  -webkit-background-clip: text !important;
  background-clip: text !important;
  animation: flowingColor 4s linear infinite !important;
  display: inline-block;
  font-style: italic;
}
.gold-flowing-text {
  background-image: linear-gradient(90deg, #C18A56, #FAFAF8, #9E693D, #C18A56) !important;
  background-size: 200% auto !important;
  color: transparent !important;
  -webkit-text-fill-color: transparent !important;
  -webkit-background-clip: text !important;
  background-clip: text !important;
  animation: flowingColor 4s linear infinite !important;
  display: inline-block;
}
.nav-sub-dropdown {
  position: relative;
}
.nav-sub-dropdown-menu {
  position: absolute;
  top: 0;
  left: 100%;
  background: rgba(15, 20, 25, 0.98);
  border: 1px solid rgba(193, 138, 86, 0.3);
  border-radius: 4px;
  list-style: none;
  padding: 15px 0;
  display: flex;
  flex-direction: column;
  gap: 15px;
  min-width: 220px;
  opacity: 0;
  visibility: hidden;
  transform: translateX(10px);
  transition: all 0.3s ease;
  z-index: 1001;
}
.nav-sub-dropdown:hover > .nav-sub-dropdown-menu {
  opacity: 1;
  visibility: visible;
  transform: translateX(0);
}
.nav-sub-dropdown > a {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}
.nav-dropdown-menu li.nav-sub-dropdown {
  padding: 0;
}
.nav-dropdown-menu li.nav-sub-dropdown > a {
  padding: 0 20px;
}
</style>


<?php
// Vite Asset Loader
$viteManifestPath = FCPATH . 'dist/.vite/manifest.json'; // Vite 5+ path
$viteJs = '';
$viteCss = '';
if (file_exists($viteManifestPath)) {
    $manifest = json_decode(file_get_contents($viteManifestPath), true);
    if (isset($manifest['resources/js/app.js'])) {
        $viteJs = base_url('dist/' . $manifest['resources/js/app.js']['file']);
        if (isset($manifest['resources/js/app.js']['css'])) {
            $viteCss = base_url('dist/' . $manifest['resources/js/app.js']['css'][0]);
        }
    }
}
?>
<?php if($viteCss): ?>
<link rel="stylesheet" href="<?= $viteCss ?>">
<?php endif; ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QCHC58L0Y1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QCHC58L0Y1');
</script>

<!-- Schema.org Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "RealEstateAgent",
  "name": "Fortune One Group",
  "image": "<?= base_url('assets/website/images/logo.png') ?>",
  "@id": "<?= base_url() ?>",
  "url": "<?= base_url() ?>",
  "telephone": "+917996000533",
  "email": "reach@fortuneone.co",
  "description": "Fortune One is a premier real estate and advisory firm dedicated to architecting the future of enterprise and luxury developments.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "1st floor, kfc building Billor’s Pladium, 19/3, Cunningham Rd",
    "addressLocality": "Bengaluru",
    "addressRegion": "Karnataka",
    "postalCode": "560001",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 12.9840,
    "longitude": 77.5960
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ],
    "opens": "09:00",
    "closes": "18:00"
  },
  "sameAs": [
    "https://www.facebook.com/fortuneonebuildco",
    "https://www.instagram.com/fortuneone.official/",
    "https://www.linkedin.com/company/fortuneone",
    "https://www.youtube.com/@FORTUNE-ONE"
  ]
}
</script>
</head>
<body>

<!-- CURSOR -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- LOADER -->
<div id="loader">
  <div class="loader-badge">
    <div id="loaderCircle">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300">
          <defs>
              <path id="loaderCirclePath" d="M 150, 150 m -100, 0 a 100,100 0 0,1 200,0 a 100,100 0 0,1 -200,0 "/>
          </defs>
          <circle cx="150" cy="150" r="100" fill="none"/>
          <g>
              <use xlink:href="#loaderCirclePath" fill="none"/>
              <text fill="var(--bronze-light)">
                  <textPath xlink:href="#loaderCirclePath" textLength="610">FORTUNE ONE DEVELOPERS • LIVE BETTER, LIVE FORTUNE • FORTUNE ONE • </textPath>
              </text>
          </g>
      </svg>
      <div class="loader-center-logo">
        <div class="logo-mask" style="--logo-url: url('<?= base_url('assets/website/images/logo.png') ?>')"></div>
      </div>
    </div>
  </div>
  <!--<div class="l-logo">FORTUNE ONE</div>-->
  <div class="l-logo gold-flowing-text">FORTUNE ONE</div>
  <div class="l-line" id="loaderLine" style="width:0;max-width:320px;transition:width 2s ease"></div>
  <div class="l-text">Crafting Excellence</div>
  <div class="l-pct" id="loaderPct">0%</div>
</div>

<!-- NAV -->
<nav id="nav">
  <a href="<?= base_url() ?>" class="nav-logo"><img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One Logo" style="filter: brightness(0) invert(1) drop-shadow(0px 2px 5px rgba(0,0,0,0.6));"></a>

  <ul class="nav-links">
    <li><a href="<?= base_url('/') ?>">Home</a></li>
    <li><a href="<?= base_url('about') ?>">About Us</a></li>
    <li class="nav-dropdown">
      <a href="<?= base_url('portfolio') ?>" style="display:flex;align-items:center;gap:5px;">Portfolio <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
      <ul class="nav-dropdown-menu">
        <li class="nav-sub-dropdown">
          <a href="javascript:void(0)">Brands <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 5px; color: var(--bronze-light);"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
          <ul class="nav-sub-dropdown-menu">
            <li><a href="javascript:void(0)">Earth Neo - Exclusive Villas</a></li>
            <li><a href="javascript:void(0)">Live Infinity - Premium Apartments</a></li>
            <li><a href="javascript:void(0)">TieWell - Senior Living</a></li>
          </ul>
        </li>
        <li class="nav-sub-dropdown">
          <a href="javascript:void(0)">Our Associates <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left: 5px; color: var(--bronze-light);"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
          <ul class="nav-sub-dropdown-menu">
            <li><a href="https://www.bharathimeraki.com/" target="_blank">Bharathi Meraki</a></li>
            <li><a href="https://ronliving.in/" target="_blank">Republic of Nature</a></li>
            <li><a href="https://www.tajskyviewresidences.com/" target="_blank">Taj Skyview Residences</a></li>
            <li><a href="https://www.elementsseniorliving.com/" target="_blank">Elements Senior Living</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="<?= base_url('nrisupport') ?>">NRI Support</a></li>
    <li class="nav-dropdown">
      <a href="javascript:void(0)" style="display:flex;align-items:center;gap:5px;">Brochures <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
      <ul class="nav-dropdown-menu">
        <li><a href="javascript:void(0)" onclick="openBrochureModal('assets/Brochure/Essha vana COrrection Brochure check.pdf')">EshaVana - FarmLand</a></li>
        <li><a href="javascript:void(0)" onclick="openBrochureModal('assets/Brochure/Vistaa Brochure_Final_compressed.pdf')">Vistaa - Premium Villa Plots</a></li>
      </ul>
    </li>
    <li><a href="<?= base_url('career') ?>">Career</a></li>
    <li><a href="<?= base_url('blog') ?>">Blog</a></li>
    <li><a href="<?= base_url('contact') ?>">Contact</a></li>
  </ul>
  <button class="nav-cta" data-magnetic="0.3" onclick="openBookingModal()"><span>Book an Appointment</span></button>
  
  <!-- MOBILE HAMBURGER ICON -->
  <div class="mobile-menu-btn" id="mobileMenuBtn" onclick="toggleMobileMenu()">
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
  </div>
</nav>

<!-- MOBILE MENU OVERLAY -->
<div class="mobile-overlay" id="mobileOverlay">
  <div class="mobile-overlay-close" onclick="toggleMobileMenu()">&times;</div>
  <ul class="mobile-nav-links">
    <li><a href="<?= base_url('/') ?>">Home</a></li>
    <li><a href="<?= base_url('about') ?>">About</a></li>
    <li class="mobile-dropdown">
      <a href="javascript:void(0)" onclick="this.nextElementSibling.classList.toggle('active'); return false;">Portfolio &#9662;</a>
      <ul class="mobile-dropdown-menu">
        <li class="mobile-dropdown">
          <a href="javascript:void(0)" onclick="this.nextElementSibling.classList.toggle('active'); return false;" style="display:flex; justify-content:space-between; align-items:center;">Brands <span>&#9662;</span></a>
          <ul class="mobile-dropdown-menu" style="background:rgba(255,255,255,0.02); margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1); padding-top: 5px; padding-bottom: 5px; padding-left: 10px; text-align: left;">
            <li><a href="javascript:void(0)">Earth Neo - Exclusive Villas</a></li>
            <li><a href="javascript:void(0)">Live Infinity - Premium Apartments</a></li>
            <li><a href="javascript:void(0)">TieWell - Senior Living</a></li>
          </ul>
        </li>
        <li class="mobile-dropdown">
          <a href="javascript:void(0)" onclick="this.nextElementSibling.classList.toggle('active'); return false;" style="display:flex; justify-content:space-between; align-items:center;">Our Associates <span>&#9662;</span></a>
          <ul class="mobile-dropdown-menu" style="background:rgba(255,255,255,0.02); margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1); padding-top: 5px; padding-bottom: 5px; padding-left: 10px; text-align: left;">
            <li><a href="https://www.bharathimeraki.com/" target="_blank">Bharathi Meraki</a></li>
            <li><a href="https://ronliving.in/" target="_blank">Republic of Nature</a></li>
            <li><a href="https://www.tajskyviewresidences.com/" target="_blank">Taj Skyview Residences</a></li>
            <li><a href="https://www.elementsseniorliving.com/" target="_blank">Elements Senior Living</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="mobile-dropdown">
      <a href="javascript:void(0)" onclick="this.nextElementSibling.classList.toggle('active'); return false;">Brochures &#9662;</a>
      <ul class="mobile-dropdown-menu">
        <li><a href="javascript:void(0)" onclick="openBrochureModal('assets/Brochure/Essha vana COrrection Brochure check.pdf')">EshaVana - FarmLand</a></li>
        <li><a href="javascript:void(0)" onclick="openBrochureModal('assets/Brochure/Vistaa Brochure_Final_compressed.pdf')">Vistaa - Premium Villa Plots</a></li>
      </ul>
    </li>
    <li><a href="<?= base_url('contact') ?>">Contact</a></li>
  </ul>
  <button class="btn-primary" style="margin-top:2rem; width: 80%; max-width: 300px; padding: 1rem;" onclick="toggleMobileMenu(); openBookingModal();">Book an Appointment</button>
</div>

<!-- BROCHURE MODAL -->
<div class="booking-modal-overlay" id="brochureModalOverlay" onclick="closeBrochureModal(event)">
  <div class="bm-wrapper" id="brochureModal" onclick="event.stopPropagation()" style="max-width: 500px; margin: auto;">
    <div class="bm-top-bar">
        Fortune One <strong>Brochures</strong>
        <div class="bm-close" onclick="closeBrochureModal()">&times;</div>
    </div>
    <div class="booking-modal-card" style="min-height: auto;">
        <div class="bm-form-area" style="display: block; width: 100%; padding: 30px;">
            <div class="bm-form-header" style="margin-bottom: 10px;">
                <div class="bm-form-title" style="font-family: 'Cormorant Garamond', serif; font-size: 28px;">Download Brochure</div>
            </div>
            <p style="color: #666; margin-bottom: 25px; font-size: 15px;">Please fill out the details below to download the project brochure.</p>
            
            <form id="brochureForm" onsubmit="submitBrochureForm(event)">
                <input type="hidden" id="brochurePdfUrl" name="pdf_url" value="">
                
                <div class="bm-form-group">
                    <label>Full Name *</label>
                    <input type="text" class="bm-input" name="name" required placeholder="John Doe">
                </div>
                <div class="bm-form-group">
                    <label>Email Address *</label>
                    <input type="email" class="bm-input" name="email" required placeholder="john@example.com">
                </div>
                <div class="bm-form-group">
                    <label>Phone Number *</label>
                    <input type="tel" class="bm-input" name="phone" required placeholder="+91 9876543210">
                </div>
                
                <button type="submit" class="bm-btn" id="brochureSubmitBtn" style="margin-top: 15px;">Submit & Download</button>
            </form>
        </div>
    </div>
  </div>
</div>

<script>
function openBrochureModal(pdfUrl) {
    document.getElementById('brochurePdfUrl').value = pdfUrl;
    const modal = document.getElementById('brochureModalOverlay');
    modal.classList.add('active');
    // Close mobile menu if open
    document.getElementById('mobileOverlay').classList.remove('active');
}

function closeBrochureModal(e) {
    if(e && e.target !== document.getElementById('brochureModalOverlay') && e.target.className !== 'booking-modal-close') return;
    const modal = document.getElementById('brochureModalOverlay');
    modal.classList.remove('active');
}

function submitBrochureForm(e) {
    e.preventDefault();
    const form = e.target;
    const btn = document.getElementById('brochureSubmitBtn');
    const pdfUrl = document.getElementById('brochurePdfUrl').value;
    const formData = new FormData(form);
    
    btn.innerHTML = 'Submitting...';
    btn.disabled = true;

    fetch('<?= base_url("brochure/download") ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            closeBrochureModal();
            window.open('<?= base_url() ?>' + data.pdf_url, '_blank');
            form.reset();
        } else {
            alert(data.message || 'An error occurred. Please try again.');
        }
    })
    .catch(err => {
        alert('An error occurred. Please try again.');
    })
    .finally(() => {
        btn.innerHTML = 'Submit & Download';
        btn.disabled = false;
    });
}
</script>