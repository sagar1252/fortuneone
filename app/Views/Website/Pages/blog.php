<?= view('Website/Layouts/header') ?>

<!-- Using about.css and about.js to ensure it looks completely identical to the other pages -->
<link rel="stylesheet" href="<?= base_url('assets/website/css/about.css') ?>">

<div class="ab-page" style="background: #ffffff;">

<!-- ═══ S1: HERO ═══ -->
<section id="ab-hero">
  <canvas id="ab-hero-canvas"></canvas>
  <div class="ab-hero-overlay"></div>

  <div class="ab-hero-content" id="abHeroContent">
    <div class="ab-hero-eyebrow" id="abHeroEye">
      <!--<div class="ab-eyebrow-line ab-line-left"></div>-->
      <!--<div class="ab-eyebrow-text">-->
      <!--  <span class="ab-eyebrow-char">O</span><span class="ab-eyebrow-char">u</span><span class="ab-eyebrow-char">r</span>-->
      <!--  &nbsp;-->
      <!--  <span class="ab-eyebrow-char">B</span><span class="ab-eyebrow-char">l</span><span class="ab-eyebrow-char">o</span><span class="ab-eyebrow-char">g</span>-->
      <!--</div>-->
      <!--<div class="ab-eyebrow-line ab-line-right"></div>-->
      <span class="gold-flowing-text" style="white-space: nowrap;">Blog</span>
    </div>
    <p class="ab-hero-sub" id="abHeroSub">Insights, perspectives, and news from the forefront of real estate and development.</p>
  </div>
</section>

<div class="blog-grid" style="max-width: 1200px; margin: 6rem auto; padding: 0 2rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
    <!-- Card 1 -->
    <a href="<?= base_url('blog/smart-homes') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img src="<?= base_url('assets/website/images/blog/post1.webp') ?>" alt="Smart Homes" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Modern Tech</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">The Evolution of Smart Homes</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">How technology and automation are redefining luxury living and modern construction trends.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
    <!-- Card 2 -->
    <a href="<?= base_url('blog/sustainable-building') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img src="<?= base_url('assets/website/images/blog/post2.webp') ?>" alt="Sustainable Building" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Green Architecture</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">Sustainable Building Materials</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">Discover the rise of eco-friendly construction materials and the future of green architecture.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
    <!-- Card 3 -->
    <a href="<?= base_url('blog/virtual-reality') ?>" class="blog-card" style="text-decoration: none; color: inherit; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; display: block;">
        <img src="<?= base_url('assets/website/images/blog/post3.webp') ?>" alt="Virtual Reality" style="width: 100%; height: 250px; object-fit: cover;">
        <div class="blog-card-content" style="padding: 1.5rem;">
            <div style="font-size: 0.8rem; color: #D4A574; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; font-weight: bold;">Real Estate Tech</div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; margin-bottom: 1rem; color: #1a1a1a;">Virtual Reality in Design</h3>
            <p style="font-size: 0.95rem; color: #666; line-height: 1.6; font-family: 'DM Sans', sans-serif;">How virtual reality and 3D modeling are reshaping architectural design and real estate planning.</p>
            <div style="margin-top: 1.5rem; font-size: 0.9rem; font-weight: bold; color: #1a1a1a;">Read Article &rarr;</div>
        </div>
    </a>
</div>
<style>
.blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; }
</style>

</div> <!-- end .ab-page -->

<script src="<?= base_url('assets/website/js/about.js') ?>"></script>

<?= view('Website/Layouts/footer') ?>
