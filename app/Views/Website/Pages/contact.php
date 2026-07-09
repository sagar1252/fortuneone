<?= view('Website/Layouts/header') ?>

<!-- External CSS for Contact Page -->
<link rel="stylesheet" href="<?= base_url('assets/website/css/contact.css') ?>">

<div class="cn-page">

<!-- ═══ S1: HERO ═══ -->
<section id="cn-hero">
  <canvas id="cn-hero-canvas"></canvas>
  <div class="cn-hero-overlay"></div>

  <div class="cn-hero-content" id="cnHeroContent">
    <div class="cn-hero-eyebrow" id="cnHeroEye">
      <span class="gold-flowing-text" style="white-space: nowrap;">Get In Touch</span>
    </div>

    <p class="cn-hero-sub" id="cnHeroSub">Reach out to discover how Fortune One can partner with you to build your vision and create lasting value.</p>
  </div>
</section>

<!-- ═══ S2: CONTACT INFO & FORM ═══ -->
<section id="cn-main">
  <div class="cn-container">
    <div class="cn-grid">
      <!-- Left side: Contact Info -->
      <div class="cn-info-panel cn-fade-up">
        <span class="cn-label">Our Offices</span>
        <h2 class="cn-title-dark">Connect With <em>Us</em></h2>
        <p class="cn-info-desc">Whether you're looking for investment opportunities, career paths, or general inquiries, our doors are always open.</p>

        <div class="cn-info-list">
          <div class="cn-info-item">
            <!--<div class="cn-info-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>-->
            <!--<div class="cn-info-content">-->
            <!--  <h4 class="cn-info-title">Headquarters</h4>-->
            <!--  <p class="cn-info-text">1st.floor, kfc building Billor’s Pladium,<br>19/3, Cunningham Rd,<br>Bengaluru, Karnataka 560001</p>-->
            <!--</div>-->
          </div>
          
          <div class="cn-info-item">
            <!--<div class="cn-info-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>-->
            <!--<div class="cn-info-content">-->
            <!--  <h4 class="cn-info-title">Phone</h4>-->
            <!--  <p class="cn-info-text"><a href="tel:7996000533">+91 79960 00533</a></p>-->
            <!--</div>-->
          </div>

          <div class="cn-info-item">
            <div class="cn-info-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div class="cn-info-content" style="width: 100%;">
              <h4 class="cn-info-title">Email Us</h4>
              <div class="cn-email-grid">
                <a href="mailto:cbo@fortuneone.co" class="cn-email-box">
                  <div class="cn-email-info">
                    <span class="cn-email-label">Land & Collaboration</span>
                    <span class="cn-email-link">cbo@fortuneone.co</span>
                  </div>
                  <div class="cn-email-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1.5" fill="none"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                  </div>
                </a>
                <a href="mailto:reach@fortuneone.co" class="cn-email-box">
                  <div class="cn-email-info">
                    <span class="cn-email-label">Sales & Support</span>
                    <span class="cn-email-link">reach@fortuneone.co</span>
                  </div>
                  <div class="cn-email-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1.5" fill="none"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                  </div>
                </a>
                <a href="mailto:hr@fortuneone.co" class="cn-email-box">
                  <div class="cn-email-info">
                    <span class="cn-email-label">Career</span>
                    <span class="cn-email-link">hr@fortuneone.co</span>
                  </div>
                  <div class="cn-email-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="1.5" fill="none"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right side: Contact Form -->
      <div class="cn-form-panel cn-fade-up" style="transition-delay:0.1s">
        <h3 class="cn-form-title">Fill the details</h3>
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
        <form class="cn-form" action="<?= base_url('contact/send') ?>" method="POST">
          <div class="cn-form-row">
            <div class="cn-input-group">
              <label for="cn-name">Full Name</label>
              <input type="text" id="cn-name" name="name" required placeholder="John Doe">
            </div>
            <div class="cn-input-group">
              <label for="cn-phone">Phone Number</label>
              <input type="tel" id="cn-phone" name="phone" required placeholder="+91 98765 43210">
            </div>
          </div>
          <div class="cn-input-group">
            <label for="cn-email">Email Address</label>
            <input type="email" id="cn-email" name="email" required placeholder="john@example.com">
          </div>
          <div class="cn-input-group">
            <label for="cn-subject">Subject</label>
            <input type="text" id="cn-subject" name="subject" required placeholder="How can we help you?">
          </div>
          <div class="cn-input-group">
            <label for="cn-message">Message</label>
            <textarea id="cn-message" name="message" rows="5" required placeholder="Enter your message here..."></textarea>
          </div>
          <button type="submit" class="cn-submit-btn">Send Message</button>
        
    <?= csrf_field() ?>
</form>
      </div>
    </div>
  </div>
</section>

<!-- ═══ S3: MAP ═══ -->
<!--<section id="cn-map" class="cn-fade-up">-->
<!--  <div class="cn-map-container">-->
<!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.7684531879972!2d77.5953541!3d12.9866563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1766faa45651%3A0x8728b0c9122daf38!2sFortune%20One%20Buildco%20Private%20Limited!5e0!3m2!1sen!2sin!4v1780480558587!5m2!1sen!2sin" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
<!--  </div>-->
<!--</section>-->

</div> <!-- end .cn-page -->

<!-- External JS for Contact Page -->
<script src="<?= base_url('assets/website/js/contact.js') ?>"></script>

<?= view('Website/Layouts/footer') ?>
