<?= view('Website/Layouts/header') ?>

<!-- External CSS for About Page -->
<link rel="stylesheet" href="<?= base_url('assets/website/css/about.css') ?>?v=1.0.19">

<div class="ab-page">

<!-- ═══ S1: HERO ═══ -->
<section id="ab-hero">
  <canvas id="ab-hero-canvas"></canvas>
  <div class="ab-hero-overlay"></div>

  <div class="ab-hero-content" id="abHeroContent">
    <div class="ab-hero-eyebrow" id="abHeroEye">
      <div class="ab-eyebrow-line ab-line-left"></div>
      <!--<div class="ab-eyebrow-text">-->
      <!--  <span class="ab-eyebrow-char">A</span><span class="ab-eyebrow-char">b</span><span class="ab-eyebrow-char">o</span><span class="ab-eyebrow-char">u</span><span class="ab-eyebrow-char">t</span>-->
      <!--  &nbsp;-->
      <!--  <span class="ab-eyebrow-char">F</span><span class="ab-eyebrow-char">o</span><span class="ab-eyebrow-char">r</span><span class="ab-eyebrow-char">t</span><span class="ab-eyebrow-char">u</span><span class="ab-eyebrow-char">n</span><span class="ab-eyebrow-char">e</span>-->
      <!--  &nbsp;-->
      <!--  <span class="ab-eyebrow-char">O</span><span class="ab-eyebrow-char">n</span><span class="ab-eyebrow-char">e</span>-->
      <!--</div>-->
           <div class="ab-eyebrow-text"><span class="gold-flowing-text" style="white-space: nowrap;">About Fortune One</span></div>


      <div class="ab-eyebrow-line ab-line-right"></div>
    </div>


    <p class="ab-hero-sub" id="abHeroSub">A story of vision, innovation, and excellence — two decades in the making.</p>
  </div>
</section>

<!-- ═══ S6: MANIFESTO ═══ -->
<section id="ab-manifesto-letter-sec">
  <div class="ab-letter-paper">
    <div class="ab-letter-header">
      <div class="ab-letter-logo">FORTUNE ONE</div>
      <div class="ab-letter-date">Established 2004</div>
    </div>
    
    <h2 class="ab-letter-title">Building More Than Spaces.</h2>
    
    <div class="ab-letter-body">
      <p>Dear Friends and Partners,</p>
      <p>At Fortune One, we go beyond building structures &mdash; we craft meaningful spaces where design meets purpose and integrity drives every decision. Rooted in the principles of trust, transparency, and quality, our developments embody enduring value and thoughtful craftsmanship.</p>
      <p>Each project is a reflection of our commitment to elevate lifestyles, empower communities, and create investments that stand the test of time. Guided by vision and built with precision, Fortune One continues to redefine real estate with innovation, authenticity, and a human touch.</p>
      
      <div class="ab-letter-signoff">
        <p>Sincerely,</p>
        <span class="ab-letter-signature">Fortune One</span>
        <p class="ab-letter-title-small">Founders & Visionaries</p>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<div class="marquee-wrap">
  <div class="marquee-track" id="marqueeTrack">
    <span class="marquee-item">Luxury Residences</span>
    <span class="marquee-item">Premium Farm Lands</span>
    <span class="marquee-item">Exclusive Communities</span>
    <span class="marquee-item">Smart Home Tech</span>
    <span class="marquee-item">Prime Locations</span>
    <span class="marquee-item">Timeless Architecture</span>
    <span class="marquee-item">World-Class Amenities</span>
    <span class="marquee-item">Trusted Developers</span>
    <span class="marquee-item">Luxury Residences</span>
    <span class="marquee-item">Premium Farm Lands</span>
    <span class="marquee-item">Exclusive Communities</span>
    <span class="marquee-item">Smart Home Tech</span>
    <span class="marquee-item">Prime Locations</span>
    <span class="marquee-item">Timeless Architecture</span>
    <span class="marquee-item">World-Class Amenities</span>
    <span class="marquee-item">Trusted Developers</span>
  </div>
</div>

<!-- ═══ S1.5: WHO WE ARE ═══ -->
<section id="ab-who-we-are">
  <!-- Geometric background ornament -->
  <svg class="ab-wwa-bg-geo" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="100" cy="100" r="80" stroke="rgba(158, 105, 61, 0.05)" stroke-width="0.8"/>
    <circle cx="100" cy="100" r="50" stroke="rgba(158, 105, 61, 0.03)" stroke-width="0.4"/>
  </svg>

  <div class="ab-wwa-container">
    <div class="ab-wwa-left">
      <span class="ab-label ab-fade-up" data-delay="0">Who We Are</span>
      <h2 class="ab-wwa-title ab-fade-up" data-delay=".1">A Collaboration<br>With <em>Purpose.</em></h2>
      
      <!-- Framed image with gold offset outline -->
      <div class="ab-wwa-image-wrap ab-fade-up" data-delay=".25">
        <div class="ab-wwa-image-border"></div>
        <div class="ab-wwa-image-wrap-inner">
          <img src="<?= base_url('assets/website/images/about_hq.webp') ?>" alt="Fortune One Collaboration" class="ab-wwa-image">
        </div>
      </div>
    </div>
    <div class="ab-wwa-right">
      <p class="ab-wwa-lead ab-fade-up" data-delay=".2">Fortune One emerged from a natural progression &mdash; the uniting of long-term vision and thoughtful design.</p>
      <p class="ab-wwa-p ab-fade-up" data-delay=".3">What started as independent paths in the real estate space has grown into a single, clear mission: to craft homes that are durable, intelligently planned, and deeply connected to the way people live.</p>
      
      <div class="ab-wwa-divider ab-fade-up" data-delay=".4"></div>
      
      <h3 class="ab-wwa-subtitle ab-fade-up" data-delay=".4">A Union of Vision and Experience</h3>
      <p class="ab-wwa-p ab-fade-up" data-delay=".5">Born from aligned values and complementary strengths, Fortune One aims to shape homes that are enduring, well-planned, and intuitively connected to the needs of the people who live in them.</p>
    </div>
  </div>
</section>

<!-- ═══ S2: JOURNEY ═══ -->
<?= view('Website/Pages/Journey') ?>

<!-- ═══ S3: FOUNDATION ═══ -->
<section id="ab-foundation">
  <canvas id="ab-s3-canvas"></canvas>
  <div class="ab-header-dark">
    <span class="ab-label">Our Foundation</span>
    <h2 class="ab-title-dark">The principles that guide <em>everything we do</em></h2>
  </div>

  <div class="ab-s3-panels">
    <div class="ab-s3-panel">
      <span class="ab-s3-panel-num">I</span>
      <span class="ab-s3-panel-tag">Vision</span>
      <div class="ab-s3-panel-line"></div>
      <h3 class="ab-s3-panel-title">Our <em>Vision</em></h3>
      <p class="ab-s3-statement">Our vision is to be a <strong>global leader</strong> in real estate, setting new benchmarks in design, quality, and customer care. We aspire to create <strong>iconic properties</strong> that blend modern living with sustainable practices, transforming skylines and enriching lives. By embracing <strong>innovation, personalization, and integrity</strong>, we aim to build communities where dreams take root and prosperity grows.</p>
      <svg class="ab-s3-geo" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
        <polygon points="60,5 115,35 115,85 60,115 5,85 5,35" stroke="#C18A56" stroke-width="1"/>
        <polygon points="60,25 95,45 95,75 60,95 25,75 25,45" stroke="#9E693D" stroke-width=".5"/>
        <circle cx="60" cy="60" r="15" stroke="#C18A56" stroke-width="1"/>
      </svg>
    </div>

    <div class="ab-s3-panel">
      <span class="ab-s3-panel-num">II</span>
      <span class="ab-s3-panel-tag">Values</span>
      <div class="ab-s3-panel-line"></div>
      <h3 class="ab-s3-panel-title">Our <em>Values</em></h3>
      <p class="ab-values-subtitle">The principles that guide everything we do</p>
      
      <div class="ab-values-accordion">
        <details class="ab-value-item">
          <summary class="ab-value-summary">
            <div class="ab-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <h4 class="ab-value-title">Integrity</h4>
            <span class="ab-value-toggle">+</span>
          </summary>
          <div class="ab-value-desc-wrap">
            <p class="ab-value-desc">We uphold the highest ethical standards, ensuring honesty in every decision.</p>
          </div>
        </details>
        
        <details class="ab-value-item">
          <summary class="ab-value-summary">
            <div class="ab-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            <h4 class="ab-value-title">Customer First</h4>
            <span class="ab-value-toggle">+</span>
          </summary>
          <div class="ab-value-desc-wrap">
            <p class="ab-value-desc">Our clients' aspirations guide every step we take.</p>
          </div>
        </details>

        <details class="ab-value-item">
          <summary class="ab-value-summary">
            <div class="ab-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            </div>
            <h4 class="ab-value-title">Excellence</h4>
            <span class="ab-value-toggle">+</span>
          </summary>
          <div class="ab-value-desc-wrap">
            <p class="ab-value-desc">We pursue perfection, delivering unmatched quality and attention to detail.</p>
          </div>
        </details>

        <details class="ab-value-item">
          <summary class="ab-value-summary">
            <div class="ab-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </div>
            <h4 class="ab-value-title">Innovation</h4>
            <span class="ab-value-toggle">+</span>
          </summary>
          <div class="ab-value-desc-wrap">
            <p class="ab-value-desc">We embrace creativity, technology, and forward-thinking solutions.</p>
          </div>
        </details>

        <details class="ab-value-item">
          <summary class="ab-value-summary">
            <div class="ab-value-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
            </div>
            <h4 class="ab-value-title">Trust</h4>
            <span class="ab-value-toggle">+</span>
          </summary>
          <div class="ab-value-desc-wrap">
            <p class="ab-value-desc">We nurture lasting relationships built on transparency, reliability, and respect.</p>
          </div>
        </details>
      </div>
    </div>

    <div class="ab-s3-panel">
      <span class="ab-s3-panel-num">III</span>
      <span class="ab-s3-panel-tag">Mission</span>
      <div class="ab-s3-panel-line"></div>
      <h3 class="ab-s3-panel-title">Our <em>Mission</em></h3>
      <p class="ab-s3-statement">Our mission is to <strong>redefine the real estate experience</strong> by offering not just properties, but thoughtfully designed spaces that reflect luxury, trust, and innovation. We are committed to providing <strong>expert guidance</strong> and end-to-end services, ensuring every client's journey &mdash; from discovery to ownership &mdash; is smooth and rewarding. With a foundation built on customer satisfaction, transparency, and excellence, we strive to craft landmark developments that create <strong>lasting value</strong> and inspire future generations.</p>
      <svg class="ab-s3-geo" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="60" cy="60" r="52" stroke="#C18A56" stroke-width="1"/>
        <circle cx="60" cy="60" r="35" stroke="#9E693D" stroke-width=".5"/>
        <circle cx="60" cy="60" r="18" stroke="#C18A56" stroke-width="1"/>
        <line x1="8" y1="60" x2="112" y2="60" stroke="#9E693D" stroke-width=".4" stroke-dasharray="3,6"/>
        <line x1="60" y1="8" x2="60" y2="112" stroke="#9E693D" stroke-width=".4" stroke-dasharray="3,6"/>
      </svg>
    </div>
  </div>
</section>

<!-- ═══ S4: LEADERSHIP ═══ -->
<section id="ab-leadership">
  <div class="ab-header-light">
    <span class="ab-label">The Team</span>
    <h2 class="ab-title-light">Meet the <em>Leadership</em></h2>
  </div>

  <style>
    #ab-leadership .ab-lc-portrait { 
      height: 150px !important; 
      width: 150px !important;
      border-radius: 50% !important;
      overflow: hidden !important;
      margin: 0 auto 15px !important;
    }
    #ab-leadership .ab-lc-portrait-img {
      width: 100% !important;
      height: 100% !important;
      object-fit: cover !important;
    }
    #ab-leadership .ab-lc-name { margin-bottom: 0px !important; text-align: center !important; line-height: 1.1; }
    #ab-leadership .ab-lc-name em, #ab-modal-name em {
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
    #ab-leadership .ab-lc-role { margin-top: -3px !important; font-size: 0.65rem !important; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px !important; display: block; text-align: center !important; color: #888; transition: color 0.3s ease; }
    #ab-leadership .ab-leader-card:hover .ab-lc-role { color: #ffffff !important; }
  </style>
  <div class="ab-s4-grid">
    <!-- PRASHANT RAJ -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/Prashanth.webp') ?>" alt="Prashant Raj" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Prashant <em style="color: var(--bronze, #9E693D);">Raj</em></div>
        <span class="ab-lc-role">Chairman</span>
        <div class="ab-lc-bio">
          <p>Prashant Raj leads with a vision rooted in integrity, innovation, and long-term value creation. With over two decades of entrepreneurial experience, he has been a driving force behind Fortune One's growth and diversification across real estate, industrial ventures, and sustainable initiatives.</p>
          <p>His leadership approach combines strategic thinking with a deep focus on execution excellence. Known for his clarity of vision and commitment to quality, he has built teams and partnerships that consistently deliver impactful results.</p>
          <p>Guided by a belief that progress must serve both people and purpose, Prashant continues to inspire a culture of innovation, collaboration, and responsibility within the organization.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- NAVEEN RAJ -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/Naveen.webp') ?>" alt="Naveen Raj" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Naveen <em style="color: var(--bronze, #9E693D);">Raj</em></div>
        <span class="ab-lc-role">Managing Director</span>
        <div class="ab-lc-bio">
          <p>Naveen Raj leads with a strong focus on strategy, execution, and value creation in real estate development. With over a decade of entrepreneurial experience, he has been instrumental in building Fortune One into a trusted, performance-driven real estate brand known for integrity and partnership-led growth.</p>
          <p>His expertise lies in structuring successful Joint Ventures, Joint Development Agreements, and Development Management partnerships that create long-term value for landowners and investors. Naveen's clear approach to legal transparency, financial accountability, and project ownership ensures that every development upholds the highest standards of trust and delivery.</p>
          <p>He is deeply committed to transforming land into well-planned, sustainable communities that reflect Fortune One's vision &mdash; combining strong design, seamless execution, and responsible development.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- ARUN BHARThI -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/arun.webp') ?>" alt="Arun Bharti" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Arun <em style="color: var(--bronze, #9E693D);">Bharthi</em></div>
        <span class="ab-lc-role">Executive Chairman-Fortune Bharathi</span>
        <div class="ab-lc-bio">
          <p>Arun Bharathi Arunachalam, the Executive Chairman of Fortune-Bharathi & the Managing Director of Bharathi Group of Companies, leading a dynamic team in redefining real estate. With over a decade of experience, Arun is revered for his visionary approach, turning concepts into profitable ventures. As the driving force behind Bharathi Meraki, he prioritizes people-centric projects that leave a lasting impact. Arun's expertise extends beyond development to portfolio management, specializing in serving High-Net-Worth and Ultra High Net Worth Individuals with innovative strategies and thorough market analysis. His innovative strategies and systematic and in-depth market analysis have consistently delivered impressive returns on investment for his clients.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- DIEPU V REDDY -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/Deepu.webp') ?>" alt="Diepu V Reddy" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Dipu V <em style="color: var(--bronze, #9E693D);">Reddy</em></div>
        <span class="ab-lc-role">Director - Strategy & Development</span>
        <div class="ab-lc-bio">
          <p>Diepu V Reddy is a seasoned real estate professional with over 14 years of international experience. He possesses an entrepreneurial mindset, strong business acumen, and exceptional analytical skills, enabling him to manage large asset classes.</p>
          <p>In recognition of his achievements, he has received prestigious honors and awards, including the Smart Real Estate Project of the Year for Edge in 2018 and Township of the Year for Springs in 2019.</p>
          <p>Diepu has furthered his education at Cornell University and holds a degree in Marketing & Operations from Don Bosco University.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- VINITH PRASAD -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/Vinith.webp') ?>" alt="Vinith Prasad" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Vinith <em style="color: var(--bronze, #9E693D);">Prasad</em></div>
        <span class="ab-lc-role">Chief Business Officer</span>
        <div class="ab-lc-bio">
          <p>Vinith Prasad plays a key role in driving Fortune One's growth through strategic investment, land acquisition, and deal structuring. With over seven years of experience in real estate development, he combines an entrepreneurial mindset with a sharp understanding of market dynamics and financial strategy.</p>
          <p>Vinith's expertise lies in identifying high-value opportunities, building investor confidence, and structuring partnerships that create long-term value for all stakeholders. His hands-on approach and commitment to transparent transactions have been central to Fortune One's continued success in competitive markets.</p>
          <p>Focused on innovation and sustainable expansion, he works closely with partners, investors, and landowners to translate vision into tangible results. His leadership reflects a balance of financial acumen, strategic foresight, and a deep commitment to responsible growth.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- KISHAN RAMACHANDRIAN -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/kishan.webp') ?>" alt="Kishan Ramachandrian" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Kishan <em style="color: var(--bronze, #9E693D);">Ramachandriah</em></div>
        <span class="ab-lc-role">Executive Director -<br> Business Development & Expansion</span>
        <div class="ab-lc-bio">
          <p>Kishan Ramachandriah brings dynamic leadership to Fortune One, spearheading business development and strategic expansion initiatives. With a strong background in scaling operations, he plays a crucial role in identifying new market opportunities and driving the company's growth trajectory.</p>
          <p>His expertise in market analysis, partnership building, and execution strategy ensures that Fortune One continues to expand its footprint while maintaining the highest standards of quality and customer satisfaction.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- VANDANA PRASHANT -->
    <div class="ab-leader-card">
      <div class="ab-lc-portrait">
        <img src="<?= base_url('assets/website/images/team/Vandana.webp') ?>" alt="Vandana Prashant" class="ab-lc-portrait-img">
      </div>
      <div class="ab-lc-body">
        <div class="ab-lc-name">Vandana <em style="color: var(--bronze, #9E693D);">Prashant</em></div>
        <span class="ab-lc-role">Chief People Growth Officer</span>
        <div class="ab-lc-bio">
          <p>Vandana Prashant oversees human resources, sales strategy, and organizational initiatives at Fortune One. With over a decade of experience in business operations and people management, she plays a pivotal role in driving the company's growth and nurturing a strong, purpose-driven culture.</p>
          <p>Her leadership philosophy centers on collaboration, innovation, and continuous learning. Vandana believes that empowering people and aligning them with a shared vision is the key to sustained success. She works closely with teams across functions to ensure that every project reflects Fortune One's values of trust, transparency, and excellence.</p>
          <p>Passionate about building high-performing teams and fostering long-term relationships, Vandana brings both strategic clarity and empathy to her role &mdash; balancing business growth with people-centric leadership.</p>
        </div>
        <div class="ab-lc-cta">
          <span>View Profile</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ S5: WHY CHOOSE US ═══ -->
<section id="ab-why">
  <div class="ab-header-dark">
    <span class="ab-label">The Fortune One Standard</span>
    <h2 class="ab-title-dark">Why Leaders Choose <em>Fortune One</em></h2>
  </div>

  <div class="ab-s5-grid">
    <div class="ab-s5-card">
      <div class="ab-s5-streak"></div>
      <span class="ab-s5-num">01</span>
      <div class="ab-s5-icon"><svg viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg></div>
      <div class="ab-s5-line"></div>
      <h3 class="ab-s5-card-title">Investment Opportunities</h3>
      <p class="ab-s5-card-body">We are dedicated to helping you discover rewarding opportunities in real estate investment. Our team conducts in-depth research, analyzes market trends, and evaluates every project with precision to guide you toward informed and profitable investment decisions.</p>
    </div>

    <div class="ab-s5-card">
      <div class="ab-s5-streak" style="animation-delay:2s"></div>
      <span class="ab-s5-num">02</span>
      <div class="ab-s5-icon"><svg viewBox="0 0 24 24"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="ab-s5-line"></div>
      <h3 class="ab-s5-card-title">Client Satisfaction</h3>
      <p class="ab-s5-card-body">Building long-term relationships is at the heart of what we do. Your satisfaction is our top priority, and we strive to deliver personalized, high-quality service that exceeds expectations and earns your lasting trust.</p>
    </div>

    <div class="ab-s5-card">
      <div class="ab-s5-streak" style="animation-delay:4s"></div>
      <span class="ab-s5-num">03</span>
      <div class="ab-s5-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg></div>
      <div class="ab-s5-line"></div>
      <h3 class="ab-s5-card-title">Property Management</h3>
      <p class="ab-s5-card-body">Managing a property &mdash; whether residential, commercial, or mixed-use &mdash; can be complex. Our property management solutions simplify the process by handling tenant screening, rent collection, maintenance, and daily operations, giving you complete peace of mind and steady returns.</p>
    </div>
  </div>
</section>

</div> <!-- end .ab-page -->

<!-- ═══ LEADERSHIP MODAL ═══ -->
<div class="ab-modal" id="ab-leader-modal">
  <div class="ab-modal-overlay" id="ab-modal-overlay"></div>
  <div class="ab-modal-content">
    <button class="ab-modal-close" id="ab-modal-close">
      <svg viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="square"/></svg>
    </button>
    <div class="ab-modal-inner">
      <div class="ab-modal-img-wrap">
        <img src="" alt="" id="ab-modal-img" class="ab-modal-portrait">
      </div>
      <div class="ab-modal-text">
        <div class="ab-modal-role-wrap">
          <span class="ab-modal-role" id="ab-modal-role"></span>
        </div>
        <div class="ab-modal-name-wrap">
          <h3 class="ab-modal-name" id="ab-modal-name"></h3>
        </div>
        <div class="ab-modal-bio" id="ab-modal-bio"></div>
      </div>
    </div>
  </div>
</div>

<!-- External JS for About Page -->
<script src="<?= base_url('assets/website/js/about.js') ?>"></script>

<?= view('Website/Layouts/footer') ?>