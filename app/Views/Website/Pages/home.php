<?= view('Website/Layouts/header') ?>
<!-- HERO -->

<?= view('Website/Partials/slider') ?>


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

<!-- ABOUT -->
<section id="about">
  <div class="about-grid">
    <div class="about-visual" style="position: relative; height: 100%; min-height: 400px; overflow: hidden;">
      <video autoplay loop muted playsinline src="<?= base_url('assets/website/images/home/about.mp4') ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"></video>
    </div>

    <div class="about-content">
      <span class="section-label" data-reveal>Our Purpose</span>
      <h2 class="section-title" data-split="chars">We care about how <br>you <em>Live</em>.</h2>
      <p class="about-copy reveal">At Fortune One, we believe every home tells a story — of people, purpose, and progress. Guided by decades of experience and a forward-thinking vision, we create spaces where design meets integrity and innovation shapes everyday living.</p>
      <p class="about-copy reveal">Each development reflects our commitment to quality, sustainability, and human connection — transforming land into living experiences that stand the test of time. Because we don't just construct buildings; we craft environments that help people live better, grow stronger, and feel truly at home.</p>

      <div class="about-highlight-box" data-reveal style="--logo-url: url('<?= base_url('assets/website/images/logo.png') ?>')">
        <div class="glow-overlay"></div>
        <div class="watermark-logo"></div>
        <p class="highlight-quote">
          <span class="quote-top" data-split="words">We don't just build homes.</span>
          <span class="quote-accent" data-split="words">We build how people feel at home.</span>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- STANDALONE STATS BAND -->
<section class="counter-section">
  <div class="counter-bg-glow"></div>
  <div class="counter-container">
    <div class="premium-counters-grid">
      
      <div class="premium-counter-card reveal">
        <div class="counter-card-inner">
          <div class="counter-icon">
            <svg viewBox="0 0 100 100" class="gold-svg-icon" xmlns="http://www.w3.org/2000/svg">
              <rect x="25" y="25" width="50" height="50" fill="none" stroke="url(#goldGradient)" stroke-width="1.5" transform="rotate(45 50 50)" />
              <rect x="35" y="35" width="30" height="30" fill="none" stroke="url(#goldGradient)" stroke-width="1" />
              <circle cx="50" cy="50" r="4" fill="url(#goldGradient)" />
            </svg>
          </div>
          <div class="premium-counter-num">
            <span class="stat-num" data-target="15">15</span><span class="stat-suffix">+</span>
          </div>
          <div class="premium-counter-label">Years of Mastery</div>
        </div>
      </div>

      <div class="premium-counter-card reveal">
        <div class="counter-card-inner">
          <div class="counter-icon">
            <svg viewBox="0 0 100 100" class="gold-svg-icon" xmlns="http://www.w3.org/2000/svg">
              <polygon points="20,70 30,30 50,55 70,30 80,70" fill="none" stroke="url(#goldGradient)" stroke-width="1.5" />
              <line x1="20" y1="75" x2="80" y2="75" stroke="url(#goldGradient)" stroke-width="1" />
              <circle cx="50" cy="30" r="3" fill="url(#goldGradient)" />
            </svg>
          </div>
          <div class="premium-counter-num">
            <span class="stat-num" data-target="500">500</span><span class="stat-suffix">+</span>
          </div>
          <div class="premium-counter-label">Happy Families</div>
        </div>
      </div>

      <div class="premium-counter-card reveal">
        <div class="counter-card-inner">
          <div class="counter-icon">
            <svg viewBox="0 0 100 100" class="gold-svg-icon" xmlns="http://www.w3.org/2000/svg">
              <path d="M50,15 L80,80 L20,80 Z" fill="none" stroke="url(#goldGradient)" stroke-width="1.5" />
              <line x1="50" y1="15" x2="50" y2="80" stroke="url(#goldGradient)" stroke-width="1" stroke-dasharray="2,2" />
              <circle cx="50" cy="15" r="3" fill="url(#goldGradient)" />
            </svg>
          </div>
          <div class="premium-counter-num">
            <span class="stat-num" data-target="5">5</span><span class="stat-suffix">+</span>
          </div>
          <div class="premium-counter-label">Ongoing Landmarks</div>
        </div>
      </div>

    </div>
  </div>
  
  <!-- Reusable SVG Gradients -->
  <svg width="0" height="0" style="position: absolute;">
    <defs>
      <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#FAFAF8" />
        <stop offset="50%" stop-color="#C18A56" />
        <stop offset="100%" stop-color="#9E693D" />
      </linearGradient>
    </defs>
  </svg>
</section>

<!-- PHILOSOPHY -->
<section id="philosophy" style="background:var(--white);">
  <div class="about-grid">
    <div class="about-visual">
      <div class="about-image-grid">
         <div class="about-img about-img-1 reveal" style="background-image: url('<?= base_url('assets/website/images/about_hq.webp') ?>');"></div>
         <div class="about-img about-img-2 reveal" style="background-image: url('<?= base_url('assets/website/images/interiors_sanctuary.webp') ?>'); transition-delay: 0.15s;"></div>
         <div class="about-img about-img-3 reveal" style="background-image: url('<?= base_url('assets/website/images/details_craft.webp') ?>'); transition-delay: 0.3s;"></div>
      </div>
      <div class="about-visual-inner">
      </div>
    </div>

    <div class="about-content">
      <span class="section-label reveal">Building with Integrity</span>
      <h2 class="section-title reveal">Growing with <em>Purpose</em></h2>
      <p class="about-copy reveal">Fortune One is a Bengaluru-based real estate development company built on the principles of trust, transparency, and thoughtful design. We create spaces that seamlessly blend functionality with aesthetics, delivering enduring value to landowners, investors, and communities alike.</p>
      <p class="about-copy reveal">Driven by a team with deep industry expertise, Fortune One specializes in premium plotted developments, luxury farmlands, and commercial projects across key growth corridors. Every project reflects our commitment to quality execution, legal clarity, and timely delivery.</p>
      <p class="about-copy reveal">Our approach is simple — we build relationships before we build spaces. Through collaboration, innovation, and a long-term vision, Fortune One continues to shape developments that inspire confidence and contribute meaningfully to urban growth.</p>
      <a href="<?= base_url('about') ?>" class="btn btn-gold-solid reveal">Discover More <span>&#8594;</span></a>
    </div>
  </div>
</section>

<!-- VIDEO CAROUSEL -->
<section id="video-showcase" class="video-showcase">
  <div class="video-header">
    <span class="section-label reveal">Visual Showcase</span>
    <h2 class="section-title reveal">Discover Our <em>Ongoing Projects</em></h2>
    <p class="about-copy reveal" style="max-width: 700px; margin: 1rem auto 0; color: #fff;">Take a virtual tour of our premium developments and see the quality craftsmanship firsthand.</p>
  </div>
  
  <div class="video-carousel-wrapper reveal">
    <button class="carousel-btn prev-btn" onclick="scrollCarousel(-1)">&#10094;</button>
    <div class="video-carousel" id="vidCarousel">
      <div class="video-card">
        <iframe loading="lazy" src="https://www.youtube.com/embed/12mQyseZJs8?rel=0&showinfo=0&autoplay=1&mute=1&loop=1&playlist=12mQyseZJs8" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="video-card">
        <iframe loading="lazy" src="https://www.youtube.com/embed/73dOxTPWfRA?rel=0&showinfo=0&autoplay=1&mute=1&loop=1&playlist=73dOxTPWfRA" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="video-card">
        <iframe loading="lazy" src="https://www.youtube.com/embed/M6wjiuBEOuU?rel=0&showinfo=0&autoplay=1&mute=1&loop=1&playlist=M6wjiuBEOuU" title="YouTube video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
    <button class="carousel-btn next-btn" onclick="scrollCarousel(1)">&#10095;</button>
  </div>
</section>

<!-- DISTINCTIVE SPACES -->
<section id="distinctive-spaces" style="background-color: #f6f5f2; background-image: linear-gradient(rgba(246,245,242,0.85), rgba(246,245,242,0.85)), url('<?= base_url('crm-baloon.webp') ?>'); background-position: left center, left center; background-size: cover, contain; background-repeat: no-repeat, no-repeat; padding: 4rem 2rem;">
  <div class="about-grid" style="align-items: center; max-width: 1400px; margin: 0 auto; gap: 4rem;">
    <div class="distinctive-images-wrapper reveal">
      <img loading="lazy" src="<?= base_url('assets/website/images/hero_arrival.webp') ?>" alt="Distinctive Space 1" class="distinctive-img-1 reveal">
      <img loading="lazy" src="<?= base_url('assets/website/images/amenities_club.webp') ?>" alt="Distinctive Space 2" class="distinctive-img-2 reveal" style="transition-delay: 0.15s;">
    </div>
    
    <div class="about-content" style="padding: 2rem 0;">
      <span class="section-label reveal">Luxury Redefined</span>
      <h2 class="section-title reveal">Distinctive Spaces,<br><em>Elevated Living</em></h2>
      <p class="about-copy reveal">At Fortune One Group, we create more than just properties — we craft distinctive spaces that embody luxury, comfort, and purpose. Every project is a testament to our commitment to design excellence, where thoughtful details and timeless sophistication come together to shape landmarks of lifestyle.</p>
      <p class="about-copy reveal">From serene residences that feel like personal retreats to dynamic commercial spaces that inspire success and hospitality destinations that captivate every guest, our creations reflect a legacy of innovation and refinement. With Fortune One, every space is beautifully designed to elevate not just how you live, but how you experience life.</p>
      <a href="<?= base_url('portfolio') ?>" class="btn btn-gold-solid reveal">Discover More <span>&#8594;</span></a>
    </div>
  </div>
</section>

<!-- WHY US -->
<section id="why">
  <div class="geo-ring" style="width:800px;height:800px;top:-400px;right:-200px"></div>
  <div class="geo-ring" style="width:400px;height:400px;bottom:-200px;left:10%"></div>

  <div class="why-header">
    <span class="section-label reveal">Why Fortune One</span>
    <h2 class="section-title reveal">The Standard of <em>Distinction</em></h2>
  </div>

  <div class="why-grid">
    <div class="why-card reveal">
      <span class="why-card-num">01</span>
      <div class="why-card-line"></div>
      <h3>Uncompromising Quality</h3>
      <p>Every project is crafted with a relentless pursuit of perfection, using premium materials and world-class construction standards. We accept nothing less than excellence.</p>
    </div>
    <div class="why-card reveal">
      <span class="why-card-num">02</span>
      <div class="why-card-line"></div>
      <h3>Prime Locations</h3>
      <p>We carefully select the most desirable and strategically connected locations, ensuring high appreciation value and an elevated lifestyle for our residents.</p>
    </div>
    <div class="why-card reveal">
      <span class="why-card-num">03</span>
      <div class="why-card-line"></div>
      <h3>Innovative Design</h3>
      <p>Our architectural philosophy blends timeless aesthetics with modern functionality, creating expansive spaces that inspire and enhance the way you live.</p>
    </div>
    <div class="why-card reveal">
      <span class="why-card-num">04</span>
      <div class="why-card-line"></div>
      <h3>Customer-Centric Focus</h3>
      <p>Your satisfaction is our foundation. We prioritize transparency, timely delivery, and dedicated support to make your property acquisition journey entirely seamless.</p>
    </div>
    <div class="why-card reveal">
      <span class="why-card-num">05</span>
      <div class="why-card-line"></div>
      <h3>Sustainable Development</h3>
      <p>We purposefully integrate eco-friendly practices and smart technologies into our projects, building sustainable communities for a better, greener future.</p>
    </div>
    <div class="why-card reveal">
      <span class="why-card-num">06</span>
      <div class="why-card-line"></div>
      <h3>Trusted Legacy</h3>
      <p>With a proven track record and a portfolio of landmark developments, we have built an enduring reputation founded on trust, absolute reliability, and enduring value.</p>
    </div>
  </div>
</section>

<!-- PORTFOLIO -->
<section id="portfolio">
  <div class="portfolio-header">
    <span class="section-label reveal">Selected Work</span>
    <h2 class="section-title reveal">Landmark <em>Achievements</em></h2>
  </div>

  
  
  <div class="portfolio-carousel-wrapper reveal">
    <button class="carousel-btn prev-btn" onclick="scrollPortfolioCarousel(-1)">&#10094;</button>
    <div class="portfolio-scroll" id="portfolioScroll">
      
      <!-- CARD 1: EshaVana -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/EEsha/1.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Prelaunch · Hesaragatta</span>
          <h3>Fortune One EshaVana</h3>
          <p>Premium Farm Lands (6000-12000 sft) featuring OOP Grassland, Club House, and Gated Community. Starts at 93L.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Fortune One EshaVana offers premium farm lands designed for those seeking a serene and luxurious lifestyle.</p>
              <p>At Fortune One EshaVana, the Havana Clubhouse is designed as a serene retreat where nature and community come together. With sloped roofs and open spaces, it seamlessly blends with the lush surroundings, creating shaded areas where families can relax and children can play under tree canopies-reviving the charm of nature-filled childhoods. Beyond relaxation, Havana offers thoughtfully designed recreation spaces, including yoga decks, basketball courts, and cricket nets, all set within greenery. Whether unwinding in peaceful corners or engaging in outdoor activities, Havana is more than a clubhouse-it's a sanctuary for wellness and togetherness.</p>
              <p><strong>Location:</strong> Hesaragatta, Bengaluru Rural<br><strong>Status:</strong> Pre-Launch</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 2: Vista -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/vista/2.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Selling Fast · Bengaluru Rural</span>
          <h3>Fortune One Vistaa</h3>
          <p>Premium Villa Plots (1200-1500 sft) in a fully equipped Gated Community. Starts at 33.5L.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Nestled near the peaceful Isha Foundation in Chikkaballapur, North Bengaluru, Fortune One Vistaa is an exclusive plotted development featuring just 55 premium villa plots ranging from 1200 sqft. to 1500 sqft. Set against the stunning backdrop of Nandi Hills, this project is thoughtfully designed for those who desire a harmonious blend of nature, comfort, and modern living. With thematic landscaped greenery that inspires a sense of calm and a fully equipped clubhouse for recreation and relaxation, Fortune One Vistaa offers a rare opportunity to own a piece of tranquility in an upscale setting. Limited to only 55 plots, it ensures exclusivity while promising a lifestyle of elegance and serenity.</p>
              <p><strong>RERA No:</strong> PRM/KA/RERA/1254/460/PR/280325/007638<br><strong>Location:</strong> Bengaluru Rural<br><strong>Status:</strong> Selling Fast</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 3: Skylark -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/skylark/1.webp') ?>'); background-size: 135%; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Sold Out · Devanahalli</span>
          <h3>Skylark</h3>
          <p>Special Agri Plots featuring Smart Home tech, exclusive Gym & Pool, and dedicated Parking.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Skylark offers special agricultural plots perfectly blended with smart home technology, providing a unique lifestyle proposition. Experience the best of both worlds with modern conveniences in a serene environment.</p>
              <p><strong>Location:</strong> Devanahalli, Bangalore<br><strong>Status:</strong> Sold Out</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 4: Pyramid -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/pyramid/1.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Ongoing · Bengaluru</span>
          <h3>Pyramid</h3>
          <p>Premium residential developments designed for modern, luxurious, and spacious living.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Pyramid represents the pinnacle of modern residential development. These premium living spaces are designed for those who seek luxury, space, and unmatched quality in the heart of the city.</p>
              <p><strong>Location:</strong> Bengaluru<br><strong>Status:</strong> Ongoing</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- DUPLICATE FOR INFINITE LOOP -->
      <!-- CARD 1: EshaVana -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/EEsha/1.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Prelaunch · Hesaragatta</span>
          <h3>Fortune One EshaVana</h3>
          <p>Premium Farm Lands (6000-12000 sft) featuring OOP Grassland, Club House, and Gated Community. Starts at 93L.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Fortune One EshaVana offers premium farm lands designed for those seeking a serene and luxurious lifestyle.</p>
              <p>At Fortune One EshaVana, the Havana Clubhouse is designed as a serene retreat where nature and community come together. With sloped roofs and open spaces, it seamlessly blends with the lush surroundings, creating shaded areas where families can relax and children can play under tree canopies-reviving the charm of nature-filled childhoods. Beyond relaxation, Havana offers thoughtfully designed recreation spaces, including yoga decks, basketball courts, and cricket nets, all set within greenery. Whether unwinding in peaceful corners or engaging in outdoor activities, Havana is more than a clubhouse-it's a sanctuary for wellness and togetherness.</p>
              <p><strong>Location:</strong> Hesaragatta, Bengaluru Rural<br><strong>Status:</strong> Pre-Launch</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 2: Vista -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/vista/2.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Selling Fast · Bengaluru Rural</span>
          <h3>Fortune One Vistaa</h3>
          <p>Premium Villa Plots (1200-1500 sft) in a fully equipped Gated Community. Starts at 33.5L.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Nestled near the peaceful Isha Foundation in Chikkaballapur, North Bengaluru, Fortune One Vistaa is an exclusive plotted development featuring just 55 premium villa plots ranging from 1200 sqft. to 1500 sqft. Set against the stunning backdrop of Nandi Hills, this project is thoughtfully designed for those who desire a harmonious blend of nature, comfort, and modern living. With thematic landscaped greenery that inspires a sense of calm and a fully equipped clubhouse for recreation and relaxation, Fortune One Vistaa offers a rare opportunity to own a piece of tranquility in an upscale setting. Limited to only 55 plots, it ensures exclusivity while promising a lifestyle of elegance and serenity.</p>
              <p><strong>RERA No:</strong> PRM/KA/RERA/1254/460/PR/280325/007638<br><strong>Location:</strong> Bengaluru Rural<br><strong>Status:</strong> Selling Fast</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 3: Skylark -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/skylark/1.webp') ?>'); background-size: 135%; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Sold Out · Devanahalli</span>
          <h3>Skylark</h3>
          <p>Special Agri Plots featuring Smart Home tech, exclusive Gym & Pool, and dedicated Parking.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Skylark offers special agricultural plots perfectly blended with smart home technology, providing a unique lifestyle proposition. Experience the best of both worlds with modern conveniences in a serene environment.</p>
              <p><strong>Location:</strong> Devanahalli, Bangalore<br><strong>Status:</strong> Sold Out</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

      <!-- CARD 4: Pyramid -->
      <div class="portfolio-card" style="background-image: url('<?= base_url('assets/website/images/portfolio/pyramid/1.webp') ?>'); background-size: cover; background-position: center;">
        <div class="portfolio-card-overlay" style="background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
        <div class="portfolio-card-content">
          <span class="portfolio-card-tag">Ongoing · Bengaluru</span>
          <h3>Pyramid</h3>
          <p>Premium residential developments designed for modern, luxurious, and spacious living.</p>
          <div class="portfolio-card-desc-html" style="display:none;">
              <p>Pyramid represents the pinnacle of modern residential development. These premium living spaces are designed for those who seek luxury, space, and unmatched quality in the heart of the city.</p>
              <p><strong>Location:</strong> Bengaluru<br><strong>Status:</strong> Ongoing</p>
          </div>
          <button class="btn-primary" style="margin-top: 15px; font-size: 13px; padding: 8px 16px;" onclick="openPortfolioModal(this.closest('.portfolio-card'))">View More</button>
        </div>
      </div>

    </div>
    <button class="carousel-btn next-btn" onclick="scrollPortfolioCarousel(1)">&#10095;</button>
  </div>

  <?= view('Website/Partials/portfolio_modal') ?>
</section>



<!-- OUR ASSOCIATES -->
<section id="associates" style="background: #121b21; padding: 4rem 2rem;">
  <div class="associates-header" style="text-align: center; margin-bottom: 4rem;">
    <span class="section-label reveal" style="color: #D4A574;">Partnerships</span>
    <h2 class="section-title reveal" style="color: #ffffff;">Our <em>Associates</em></h2>
  </div>
  
  <div class="associates-grid reveal" style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; align-items: center; justify-items: center;">
    
    <!-- Associate 1 -->
    <a href="https://www.bharathimeraki.com/" target="_blank" class="associate-card" style="text-decoration: none; text-align: center; display: flex; flex-direction: column; align-items: center; transition: transform 0.3s;">
      <div class="associate-logo-wrap" style="background: #ffffff; padding: 1.5rem; border-radius: 8px; width: 220px; height: 140px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: all 0.3s;">
        <img loading="lazy" src="<?= base_url('associates/bharathimeraki.png') ?>" alt="Bharathi Meraki" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
      <span class="associate-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Bharathi Meraki</span>
    </a>

    <!-- Associate 2 -->
    <a href="https://ronliving.in/" target="_blank" class="associate-card" style="text-decoration: none; text-align: center; display: flex; flex-direction: column; align-items: center; transition: transform 0.3s;">
      <div class="associate-logo-wrap" style="background: #ffffff; padding: 1.5rem; border-radius: 8px; width: 220px; height: 140px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: all 0.3s;">
        <img loading="lazy" src="<?= base_url('associates/elementsseniorliving.png') ?>" alt="Elements Senior Living" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
      <span class="associate-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Elements Senior Living</span>
    </a>

    <!-- Associate 3 -->
    <a href="https://www.tajskyviewresidences.com/" target="_blank" class="associate-card" style="text-decoration: none; text-align: center; display: flex; flex-direction: column; align-items: center; transition: transform 0.3s;">
      <div class="associate-logo-wrap" style="background: #ffffff; padding: 1.5rem; border-radius: 8px; width: 220px; height: 140px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: all 0.3s;">
        <img loading="lazy" src="<?= base_url('associates/ronliving.png') ?>" alt="Republic Of Nature" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
      <span class="associate-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Republic Of Nature</span>
    </a>

    <!-- Associate 4 -->
    <a href="https://www.elementsseniorliving.com/" target="_blank" class="associate-card" style="text-decoration: none; text-align: center; display: flex; flex-direction: column; align-items: center; transition: transform 0.3s;">
      <div class="associate-logo-wrap" style="background: #ffffff; padding: 1.5rem; border-radius: 8px; width: 220px; height: 140px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; transition: all 0.3s;">
        <img loading="lazy" src="<?= base_url('associates/tajskyviewresidences.png') ?>" alt="Taj Sky View Residences" style="max-width: 100%; max-height: 100%; object-fit: contain;">
      </div>
      <span class="associate-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.5px;">Taj Sky View Residences</span>
    </a>

  </div>
  
  <style>
    .associate-card:hover { transform: translateY(-5px) !important; }
    .associate-card:hover .associate-logo-wrap { box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 15px rgba(212, 165, 116, 0.3) !important; transform: scale(1.02); }
    .associate-name { transition: color 0.3s; }
    .associate-card:hover .associate-name { color: #D4A574 !important; }
    
    /* Center the title divider */
    .associates-header .section-title::after { left: 50%; transform: translateX(-50%); }
    
    @media (max-width: 992px) {
      .associates-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 576px) {
      .associates-grid { grid-template-columns: 1fr !important; }
    }
  </style>
</section>


<!-- TESTIMONIALS -->
<section id="testimonials">
  <div class="testi-header">
    <span class="section-label reveal">Client Voices</span>
    <h2 class="section-title reveal">Words from <em>Leaders</em></h2>
  </div>

  <div class="testi-carousel-wrapper reveal">
    <button class="carousel-btn prev-btn" onclick="scrollTestiCarousel(-1)">&#10094;</button>
    <div class="testi-carousel" id="testiCarousel">
      <div class="testi-card">
        <p class="testi-quote">"Fortune One operates at a level of strategic clarity that I have rarely encountered. Their counsel on our most consequential decisions proved decisive in ways we are still discovering."</p>
        <div class="testi-author">
          <div class="testi-avatar">JL</div>
          <div>
            <div class="testi-name">James Lockwood</div>
            <div class="testi-role">Chairman, Meridian Holdings plc</div>
            <div class="testi-rating"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
          </div>
        </div>
      </div>

      <div class="testi-card">
        <p class="testi-quote">"In twenty years of working with advisors globally, none have matched the combination of intellectual rigor, operational mastery, and genuine partnership that Fortune One delivers."</p>
        <div class="testi-author">
          <div class="testi-avatar">SR</div>
          <div>
            <div class="testi-name">Sophia Reinholt</div>
            <div class="testi-role">CEO, Vantage Global Group</div>
            <div class="testi-rating"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
          </div>
        </div>
      </div>

      <div class="testi-card">
        <p class="testi-quote">"The transformation they orchestrated was not merely strategic — it was architectural. They redesigned the very foundations upon which our organization now stands."</p>
        <div class="testi-author">
          <div class="testi-avatar">AK</div>
          <div>
            <div class="testi-name">Alexei Kovalenko</div>
            <div class="testi-role">Managing Director, Aurora Capital</div>
            <div class="testi-rating"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
          </div>
        </div>
      </div>

      <div class="testi-card">
        <p class="testi-quote">"Fortune One's network access and geopolitical insight opened doors that simply did not exist before. They are not consultants — they are architects of possibility."</p>
        <div class="testi-author">
          <div class="testi-avatar">NM</div>
          <div>
            <div class="testi-name">Nadia Marchetti</div>
            <div class="testi-role">President, Nexus Infrastructure Fund</div>
            <div class="testi-rating"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-btn next-btn" onclick="scrollTestiCarousel(1)">&#10095;</button>
  </div>
</section>

<!-- LATEST INSIGHTS -->
<section id="insights" style="background: #ffffff; padding: 4rem 2rem; border-top: 1px solid rgba(193, 138, 86, 0.12);">
  <div class="insights-header" style="text-align: center; margin-bottom: 4rem;">
    <span class="section-label reveal">Latest Insights</span>
    <h2 class="section-title reveal">Evolution of <em>Construction</em></h2>
  </div>
  
  <div class="blog-grid reveal" style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
    <a href="<?= base_url('blog/smart-homes') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #f6f5f2; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img loading="lazy" src="<?= base_url('assets/website/images/blog/post1.webp') ?>" alt="Smart Homes" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Modern Tech</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">The Evolution of Smart Homes</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">How technology and automation are redefining luxury living and modern construction trends.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
    <a href="<?= base_url('blog/sustainable-building') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #f6f5f2; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img loading="lazy" src="<?= base_url('assets/website/images/blog/post2.webp') ?>" alt="Sustainable Building" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Green Architecture</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">Sustainable Building Materials</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">Discover the rise of eco-friendly construction materials and the future of green architecture.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
    <a href="<?= base_url('blog/virtual-reality') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #f6f5f2; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img loading="lazy" src="<?= base_url('assets/website/images/blog/post3.webp') ?>" alt="Virtual Reality" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Real Estate Tech</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">Virtual Reality in Design</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">How virtual reality and 3D modeling are reshaping architectural design and real estate planning.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
  </div>
  
  <div style="text-align: center; margin-top: 4rem;">
      <a href="<?= base_url('blog') ?>" class="btn btn-gold-solid reveal">View All Articles <span>&#8594;</span></a>
  </div>
</section>
<style>
.blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>

<!-- CONTACT -->
<section id="contact">
  <div class="contact-inner">
    <div class="contact-left reveal">
      <span class="section-label">Begin the Conversation</span>
      <h2 class="section-title">Let's Create Something <em>Extraordinary</em></h2>
      <p class="contact-desc">Exceptional outcomes begin with a single conversation. We engage selectively, ensuring every mandate receives the depth of attention it deserves. Reach out to begin.</p>

      <div class="contact-info">
        <div class="contact-info-item" style="display: none;">
          <div class="contact-info-icon">↗</div>
          <div>
            <span class="contact-info-label">Headquarters</span>
            <div class="contact-info-text">1st.floor, kfc building Billor’s Pladium,<br>19/3, Cunningham Rd, Bengaluru,<br>Karnataka 560001</div>
          </div>
        </div>
        <div class="contact-info-item" style="display: none;">
          <div class="contact-info-icon">✆</div>
          <div>
            <span class="contact-info-label">Phone</span>
            <div class="contact-info-text">+91 79960 00533</div>
          </div>
        </div>
        <div class="contact-info-item">
          <div class="contact-info-icon">@</div>
          <div>
            <span class="contact-info-label">Email Enquiries</span>
            <div class="contact-info-text">
              <strong>Land & Collaboration:</strong> cbo@fortuneone.co<br>
              <strong>Sales & Support:</strong> reach@fortuneone.co<br>
              <strong>Career:</strong> hr@fortuneone.co
            </div>
          </div>
        </div>
      </div>
    </div>

    <form class="contact-form reveal" action="<?= base_url('home/send') ?>" method="POST">
      <?php if(session()->getFlashdata('success')): ?>
          <div style="background: rgba(46, 204, 113, 0.1); color: #2ecc71; padding: 1rem; border: 1px solid #2ecc71; border-radius: 4px; margin-bottom: 1.5rem; font-family: var(--sans); font-size: 0.9rem;">
              <?= session()->getFlashdata('success') ?>
          </div>
      <?php endif; ?>
      <?php if(session()->getFlashdata('error')): ?>
          <div style="background: rgba(231, 76, 60, 0.1); color: #e74c3c; padding: 1rem; border: 1px solid #e74c3c; border-radius: 4px; margin-bottom: 1.5rem; font-family: var(--sans); font-size: 0.9rem;">
              <?= session()->getFlashdata('error') ?>
          </div>
      <?php endif; ?>
      <div class="form-row">
        <div class="form-group">
          <!--<label>First Name</label>-->
          <input type="text" name="first_name" placeholder="First Name" require>
        </div>
        <div class="form-group">
          <!--<label>Last Name</label>-->
          <input type="text" name="last_name" placeholder="Last Name" required>
        </div>
      </div>
      <div class="form-group">
        <!--<label>Organisation</label>-->
        <input type="text" name="organization" placeholder="Your Company">
      </div>
      <div class="form-group">
        <!--<label>Email Address</label>-->
        <input type="email" name="email" placeholder="a.pemberton@company.com" required>
      </div>
      <div class="form-group">
        <!--<label>Nature of Enquiry</label>-->
        <select name="enquiry_type" required>
          <option value="" disabled selected>Select engagement type</option>
          <option>Schedule a Site Visit</option>
          <option>Property Pricing & Details</option>
          <option>Investment Opportunities</option>
          <option>Project Brochures</option>
          <option>Speak to an Agent</option>
        </select>
      </div>
      <div class="form-group">
        <!--<label>Message</label>-->
        <textarea name="message" placeholder="Briefly describe your strategic objective..." required></textarea>
      </div>
      <button type="submit" class="form-submit">Submit Enquiry</button>
    
    <?= csrf_field() ?>
</form>
  </div>
</section>

<?= view('Website/Layouts/footer') ?>