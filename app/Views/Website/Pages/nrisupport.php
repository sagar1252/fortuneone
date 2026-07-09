<?= view('Website/Layouts/header') ?>

<!-- External CSS for NRI Support Page -->
<link rel="stylesheet" href="<?= base_url('assets/website/css/nrisupport.css') ?>">

<div class="cr-page">

<!-- ═══ S1: HERO ═══ -->
<section id="cr-hero">
  <canvas id="cr-hero-canvas"></canvas>
  <div class="cr-hero-overlay"></div>

  <div class="cr-hero-content" id="crHeroContent">
    <div class="cr-hero-eyebrow" id="crHeroEye">
    <span class="gold-flowing-text" style="white-space: nowrap;">NRI Support</span>
    </div>

    <p class="cr-hero-sub" id="crHeroSub">Specialized services for Non-Resident Indians looking to invest in premium real estate back home. We make your property investment journey seamless from anywhere in the world.</p>
    
    <button onclick="openBookingModal()" style="margin-top: 2rem; padding: 15px 40px; background: #D4A574; color: #1A2530; border: none; border-radius: 4px; font-size: 1.1rem; cursor: pointer; font-weight: 600; font-family: 'DM Sans', sans-serif; transition: background 0.3s; z-index: 10; position: relative;" onmouseover="this.style.background='#c3915f'" onmouseout="this.style.background='#D4A574'">Book an Appointment</button>
  </div>
</section>

<!-- ═══ S2: NRI SERVICES ═══ -->
<section id="cr-why-join">
  <div class="cr-container">
    <div class="cr-header-dark">
      <span class="cr-label cr-fade-up" style="text-transform: none; letter-spacing: 0.1em; font-size: 0.85rem;">Comprehensive support tailored for Non-Resident Indians</span>
      <h2 class="cr-title-dark cr-fade-up" style="color:var(--navy)">NRI <em>Services</em></h2>
    </div>
    
    <div class="cr-wj-grid nri-grid-4">
      <div class="cr-wj-card cr-fade-up">
        <span class="cr-wj-num">01</span>
        <div class="cr-wj-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
        <div class="cr-wj-line"></div>
        <h3 class="cr-wj-title">Global Reach</h3>
        <p class="cr-wj-body">Dedicated support for NRIs across the world with local expertise.</p>
      </div>
      <div class="cr-wj-card cr-fade-up" style="transition-delay:0.1s">
        <span class="cr-wj-num">02</span>
        <div class="cr-wj-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
        <div class="cr-wj-line"></div>
        <h3 class="cr-wj-title">Easy Financing</h3>
        <p class="cr-wj-body">Specialized NRI loan assistance and flexible payment options.</p>
      </div>
      <div class="cr-wj-card cr-fade-up" style="transition-delay:0.2s">
        <span class="cr-wj-num">03</span>
        <div class="cr-wj-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <div class="cr-wj-line"></div>
        <h3 class="cr-wj-title">Legal Assistance</h3>
        <p class="cr-wj-body">Complete documentation support and legal compliance guidance.</p>
      </div>
      <div class="cr-wj-card cr-fade-up" style="transition-delay:0.3s">
        <span class="cr-wj-num">04</span>
        <div class="cr-wj-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
        <div class="cr-wj-line"></div>
        <h3 class="cr-wj-title">24/7 Support</h3>
        <p class="cr-wj-body">Round-the-clock customer support across multiple time zones.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══ S3: HOW IT WORKS ═══ -->
<section id="cr-process">
  <div class="cr-container">
    <div class="cr-header-dark" style="text-align: center; margin-bottom: 4rem;">
      <span class="cr-label cr-fade-up" style="color:var(--bronze)">Your Investment Journey</span>
      <h2 class="cr-title-dark cr-fade-up" style="color:var(--white)">How It <em>Works</em></h2>
    </div>
    
    <div class="cr-process-steps nri-process-5">
      <div class="cr-p-step cr-fade-up">
        <div class="cr-p-step-circle">01</div>
        <h4 class="cr-p-step-title">Initial Consultation</h4>
        <p class="cr-p-step-body">Virtual meeting to understand your requirements and budget</p>
      </div>
      <div class="cr-p-step cr-fade-up" style="transition-delay:0.1s">
        <div class="cr-p-step-circle">02</div>
        <h4 class="cr-p-step-title">Property Selection</h4>
        <p class="cr-p-step-body">Curated property options based on your preferences</p>
      </div>
      <div class="cr-p-step cr-fade-up" style="transition-delay:0.2s">
        <div class="cr-p-step-circle">03</div>
        <h4 class="cr-p-step-title">Virtual Tours</h4>
        <p class="cr-p-step-body">High-quality virtual tours and video calls with our team</p>
      </div>
      <div class="cr-p-step cr-fade-up" style="transition-delay:0.3s">
        <div class="cr-p-step-circle">04</div>
        <h4 class="cr-p-step-title">Documentation</h4>
        <p class="cr-p-step-body">Complete paperwork assistance and legal verification</p>
      </div>
      <div class="cr-p-step cr-fade-up" style="transition-delay:0.4s">
        <div class="cr-p-step-circle">05</div>
        <h4 class="cr-p-step-title">Property Handover</h4>
        <p class="cr-p-step-body">Seamless property handover with quality assurance</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══ S4: CONTACT FORM ═══ -->
<section id="cr-apply">
  <div class="cr-container">
    <div class="cr-apply-wrap">
      <div class="cr-apply-info cr-fade-up">
        <span class="cr-label">Connect With Us</span>
        <h2 class="cr-title-dark" style="color:var(--white)">Get in <em>Touch</em></h2>
        <p class="cr-apply-desc">Distance shouldn't be a barrier to securing your dream property or investment. Fill out the form, and our specialized NRI desk will reach out to you within 24 hours.</p>
      </div>
      
      <div class="cr-apply-form-container cr-fade-up" style="transition-delay:0.2s">
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
        <form class="cr-form" action="<?= base_url('nrisupport/send') ?>" method="POST">
          <div class="cr-form-row">
            <div class="cr-input-group">
              <label for="cr-name">Full Name</label>
              <input type="text" id="cr-name" name="name" required placeholder="John Doe">
            </div>
            <div class="cr-input-group">
              <label for="cr-email">Email Address</label>
              <input type="email" id="cr-email" name="email" required placeholder="john@example.com">
            </div>
          </div>
          <div class="cr-form-row">
            <div class="cr-input-group">
              <label for="cr-phone">Phone Number (with Country Code)</label>
              <input type="tel" id="cr-phone" name="phone" required placeholder="+1 234 567 8900">
            </div>
            <div class="cr-input-group">
              <label for="cr-country">Current Country of Residence</label>
              <input type="text" id="cr-country" name="country" required placeholder="e.g. USA, UK, UAE">
            </div>
          </div>
          <div class="cr-input-group">
            <label for="cr-query">How can we help you?</label>
            <input type="text" id="cr-query" name="query" required placeholder="Investment, Property Management, Legal queries...">
          </div>
          <button type="submit" class="cr-submit-btn">Submit Enquiry</button>
        
    <?= csrf_field() ?>
</form>
      </div>
    </div>
  </div>
</section>

</div> <!-- end .cr-page -->

<!-- Re-using career JS for the animations and canvas hero -->
<script src="<?= base_url('assets/website/js/career.js') ?>"></script>

<?= view('Website/Layouts/footer') ?>
