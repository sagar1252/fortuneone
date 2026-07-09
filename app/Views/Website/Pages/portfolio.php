<?= view('Website/Layouts/header') ?>

<!-- Using about.css and about.js to ensure it looks completely identical to the other pages -->
<link rel="stylesheet" href="<?= base_url('assets/website/css/about.css') ?>">

<div class="ab-page">

<!-- ═══ S1: HERO ═══ -->
<section id="ab-hero">
  <canvas id="ab-hero-canvas"></canvas>
  <div class="ab-hero-overlay"></div>

  <div class="ab-hero-content" id="abHeroContent">
    <div class="ab-hero-eyebrow" id="abHeroEye">
      <div class="ab-eyebrow-line ab-line-left"></div>
     <div class="ab-eyebrow-text"><span class="gold-flowing-text" style="white-space: nowrap;">Portfolio</span></div>
      <div class="ab-eyebrow-line ab-line-right"></div>
    </div>
    <p class="ab-hero-sub" id="abHeroSub">A showcase of landmark achievements and distinctive spaces.</p>
  </div>
</section>

<!-- ═══ S2: INTRO ═══ -->
<section style="padding: 120px 20px; background: #ffffff; text-align: center; position: relative; overflow: hidden;">
  <div style="max-width: 900px; margin: 0 auto; position: relative; z-index: 2;">
    <h2 style="font-family: 'Cormorant Garamond', serif; font-weight: 300; margin-bottom: 30px; line-height: 1.1;">
      <span style="display: block; font-size: clamp(3rem, 6vw, 5rem); background: linear-gradient(135deg, #D4A574 0%, #9E693D 50%, #7A4E29 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 15px;">Welcome to Fortune One</span>
      <span style="display: block; font-size: clamp(1.8rem, 3vw, 2.5rem); color: #1A2530; font-style: italic;">— where living meets inspiration.</span>
    </h2>
    
    <div style="width: 60px; height: 1px; background: #9E693D; margin: 40px auto;"></div>
    
    <p style="font-family: 'DM Sans', sans-serif; font-size: 1.25rem; color: #555555; line-height: 1.8; margin-bottom: 25px; font-weight: 300;">
      Each home is built to elevate your lifestyle, offering the perfect balance of luxury, serenity, and connection.
    </p>
    
    <p style="font-family: 'DM Sans', sans-serif; font-size: 1.1rem; color: #9E693D; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;">
      Your journey to better living starts here.
    </p>
  </div>
</section>

<!-- ═══ S3: PROJECTS SHOWCASE (SPLIT SCREEN) ═══ -->
<style>
.split-proj-wrapper { display: flex; flex-direction: column; width: 100%; background: #F5F3F0;}
.split-proj { display: flex; width: 100%; min-height: 85vh; border-bottom: 1px solid #e0e0e0; }
.split-proj.reverse { flex-direction: row-reverse; }

.split-media { width: 50%; position: relative; overflow: hidden; background: #000; }
.split-media video, .split-media img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }

.split-content { width: 50%; padding: 80px 8%; display: flex; flex-direction: column; justify-content: center; background: #fff; }
.split-proj.reverse .split-content { background: #F5F3F0; } /* Subtle background alternation */

.sp-status { display: inline-block; padding: 6px 16px; background: #D4A574; color: #1A2530; font-weight: bold; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; border-radius: 50px; margin-bottom: 25px; align-self: flex-start;}
.sp-status.sold-out { background: #E74C3C; color: #fff; }

.sp-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(3rem, 5vw, 4.5rem); color: #1A2530; line-height: 1.1; margin-bottom: 15px; }
.sp-loc { color: #666; font-size: 1.1rem; margin-bottom: 25px; display: flex; align-items: center; letter-spacing: 1px; font-weight: 500;}

.sp-price-type { font-size: 1.25rem; color: #444; font-family: 'DM Sans', sans-serif; font-weight: 400; margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #eaeaea; }
.sp-price-type strong { font-weight: bold; color: #9E693D; font-size: 1.8rem; }
.split-proj.reverse .sp-price-type { border-color: #dcdcdc; }

.sp-specs { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 40px;}
.sp-spec-item { background: #F9F9F9; border: 1px solid #eaeaea; color: #444; padding: 8px 18px; border-radius: 50px; font-size: 0.95rem; font-weight: 500;}
.split-proj.reverse .sp-spec-item { background: #fff; border-color: #e0e0e0; }

.sp-gallery-title { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1.5px; color: #888; font-weight: bold; margin-bottom: 15px; }
.sp-gallery { display: flex; gap: 12px; flex-wrap: nowrap; overflow-x: auto; padding-bottom: 15px; scrollbar-width: thin; scrollbar-color: #D4A574 #f1f1f1; }
.sp-gallery::-webkit-scrollbar { height: 6px; }
.sp-gallery::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
.sp-gallery::-webkit-scrollbar-thumb { background: #D4A574; border-radius: 4px; }
.sp-gallery-img { flex: 0 0 auto; width: 100px; height: 75px; object-fit: cover; border-radius: 6px; cursor: zoom-in; transition: transform 0.3s, box-shadow 0.3s, border 0.3s; border: 2px solid transparent; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
.sp-gallery-img:hover { transform: translateY(-5px); border-color: #D4A574; box-shadow: 0 10px 25px rgba(0,0,0,0.15); }

.sp-btn { margin-top: 35px; background: #1A2530; color: #fff; padding: 15px 40px; border: none; border-radius: 4px; font-size: 0.95rem; text-transform: uppercase; font-weight: bold; cursor: pointer; transition: 0.3s; letter-spacing: 1px; align-self: flex-start;}
.sp-btn:hover { background: #9E693D; }

@media(max-width: 1000px) {
    .split-proj, .split-proj.reverse { flex-direction: column; }
    .split-media, .split-content { width: 100%; }
    .split-media { min-height: 40vh; }
    .split-content { padding: 50px 5%; }
}
</style>

<div class="split-proj-wrapper">

    <!-- Project 1: EshaVana -->
    <div class="split-proj">
        <div class="split-media">
            <video autoplay loop muted playsinline>
                <source src="<?= base_url('assets/website/images/portfolio/eeSHA vana.mp4') ?>" type="video/mp4">
            </video>
        </div>
        <div class="split-content">
            <div class="sp-status">Prelaunch</div>
            <h2 class="sp-title">EshaVana</h2>
            <div class="sp-loc">📍 Hesaragatta, Bengaluru Rural</div>
            <div class="sp-price-type"><strong>93L</strong> &nbsp;|&nbsp; Premium Farm Lands</div>
            
            <div class="sp-specs">
                <div class="sp-spec-item">6000-12000 sft</div>
                <div class="sp-spec-item">OOP.Grassland</div>
                <div class="sp-spec-item">Club House</div>
                <div class="sp-spec-item">Gated Community</div>
            </div>
            
            <div class="sp-gallery-title">Gallery Preview</div>
            <div class="sp-gallery">
                <?php
                $eesha_imgs = glob(FCPATH . 'assets/website/images/portfolio/EEsha/*.webp');
                if($eesha_imgs) {
                    foreach($eesha_imgs as $img) {
                        $imgUrl = base_url('assets/website/images/portfolio/EEsha/' . basename($img));
                        echo '<img class="sp-gallery-img" src="'.$imgUrl.'" onclick="openLightbox(this, event)">';
                    }
                }
                ?>
            </div>
            
            <div class="portfolio-card-desc-html" style="display:none;">
                <p>Fortune One EshaVana offers premium farm lands designed for those seeking a serene and luxurious lifestyle.</p>
                <p>At Fortune One EshaVana, the Havana Clubhouse is designed as a serene retreat where nature and community come together. With sloped roofs and open spaces, it seamlessly blends with the lush surroundings, creating shaded areas where families can relax and children can play under tree canopies-reviving the charm of nature-filled childhoods. Beyond relaxation, Havana offers thoughtfully designed recreation spaces, including yoga decks, basketball courts, and cricket nets, all set within greenery. Whether unwinding in peaceful corners or engaging in outdoor activities, Havana is more than a clubhouse-it's a sanctuary for wellness and togetherness.</p>
                <p><strong>Location:</strong> Hesaragatta, Bengaluru Rural<br><strong>Status:</strong> Pre-Launch</p>
            </div>
            
            <div style="display: flex; gap: 15px; margin-top: 35px;">
                <button class="sp-btn" style="margin-top: 0; background: #9E693D;" onclick="openPortfolioModal(this.closest('.split-proj'))">View More Info</button>
                <button class="sp-btn" style="margin-top: 0;" onclick="openBookingModal()">Book Appointment</button>
            </div>
        </div>
    </div>

    <!-- Project 2: Vista -->
    <div class="split-proj reverse">
        <div class="split-media">
            <img src="<?= base_url('assets/website/images/portfolio/vista/1.webp') ?>">
        </div>
        <div class="split-content">
            <div class="sp-status">Selling Fast</div>
            <h2 class="sp-title">Vistaa</h2>
            <div class="sp-loc">📍 Bengaluru Rural</div>
            <div class="sp-price-type"><strong>36L</strong>Onwards</strong> &nbsp;|&nbsp; Premium Villa Plots</div>
            
            <div class="sp-specs">
                <div class="sp-spec-item">1200-1500 sft</div>
                <div class="sp-spec-item">Gated Community</div>
            </div>
            
            <div class="sp-gallery-title">Gallery Preview</div>
            <div class="sp-gallery">
                <?php
                $vista_imgs = glob(FCPATH . 'assets/website/images/portfolio/vista/*.webp');
                if($vista_imgs) {
                    foreach($vista_imgs as $img) {
                        $imgUrl = base_url('assets/website/images/portfolio/vista/' . basename($img));
                        echo '<img class="sp-gallery-img" src="'.$imgUrl.'" onclick="openLightbox(this, event)">';
                    }
                }
                ?>
            </div>
            
            <div class="portfolio-card-desc-html" style="display:none;">
                <p>Nestled near the peaceful Isha Foundation in Chikkaballapur, North Bengaluru, Fortune One Vistaa is an exclusive plotted development featuring just 55 premium villa plots ranging from 1200 sqft. to 1500 sqft. Set against the stunning backdrop of Nandi Hills, this project is thoughtfully designed for those who desire a harmonious blend of nature, comfort, and modern living. With thematic landscaped greenery that inspires a sense of calm and a fully equipped clubhouse for recreation and relaxation, Fortune One Vistaa offers a rare opportunity to own a piece of tranquility in an upscale setting. Limited to only 55 plots, it ensures exclusivity while promising a lifestyle of elegance and serenity.</p>
                <p><strong>RERA No:</strong> PRM/KA/RERA/1254/460/PR/280325/007638<br><strong>Location:</strong> Bengaluru Rural<br><strong>Status:</strong> Selling Fast</p>
            </div>
            
            <div style="display: flex; gap: 15px; margin-top: 35px;">
                <button class="sp-btn" style="margin-top: 0; background: #9E693D;" onclick="openPortfolioModal(this.closest('.split-proj'))">View More Info</button>
                <button class="sp-btn" style="margin-top: 0;" onclick="openBookingModal()">Book Appointment</button>
            </div>
        </div>
    </div>

    <!-- Project 3: Skylark -->
    <div class="split-proj">
        <div class="split-media">
            <video autoplay loop muted playsinline>
                <source src="<?= base_url('assets/website/images/portfolio/Skylark Video.mp4') ?>" type="video/mp4">
            </video>
        </div>
        <div class="split-content">
            <div class="sp-status sold-out">Sold Out</div>
            <h2 class="sp-title">Skylark</h2>
            <div class="sp-loc">📍 Devanahalli, Bangalore</div>
            <div class="sp-price-type">Special Agri Plots</div>
            
            <div class="sp-specs">
                <div class="sp-spec-item">Smart Home</div>
                <div class="sp-spec-item">Gym & Pool</div>
                <div class="sp-spec-item">Parking</div>
            </div>
            
            <div class="sp-gallery-title">Gallery Preview</div>
            <div class="sp-gallery">
                <?php
                $skylark_imgs = glob(FCPATH . 'assets/website/images/portfolio/skylark/*.webp');
                if($skylark_imgs) {
                    foreach($skylark_imgs as $img) {
                        $imgUrl = base_url('assets/website/images/portfolio/skylark/' . basename($img));
                        echo '<img class="sp-gallery-img" src="'.$imgUrl.'" onclick="openLightbox(this, event)">';
                    }
                }
                ?>
            </div>
            <div class="portfolio-card-desc-html" style="display:none;">
                <p>Skylark offers special agricultural plots perfectly blended with smart home technology, providing a unique lifestyle proposition. Experience the best of both worlds with modern conveniences in a serene environment.</p>
                <p><strong>Location:</strong> Devanahalli, Bangalore<br><strong>Status:</strong> Sold Out</p>
            </div>
            <div style="display: flex; gap: 15px; margin-top: 35px;">
                <button class="sp-btn" style="margin-top: 0; background: #9E693D;" onclick="openPortfolioModal(this.closest('.split-proj'))">View More Info</button>
            </div>
        </div>
    </div>

    <!-- Project 4: Pyramid -->
    <div class="split-proj reverse">
        <div class="split-media">
            <video autoplay loop muted playsinline>
                <source src="<?= base_url('assets/website/images/portfolio/Pyramid video.mp4') ?>" type="video/mp4">
            </video>
        </div>
        <div class="split-content">
            <div class="sp-status" style="background: #1A2530; color: #D4A574;">Premium Living</div>
            <h2 class="sp-title">Pyramid</h2>
            <div class="sp-loc">📍 Premium Project</div>
            <div class="sp-price-type">Exclusive Community Residences</div>
            
            <div class="sp-specs">
                <div class="sp-spec-item">Modern Architecture</div>
                <div class="sp-spec-item">Premium Amenities</div>
            </div>
            
            <div class="sp-gallery-title">Gallery Preview</div>
            <div class="sp-gallery">
                <?php
                $pyramid_imgs = glob(FCPATH . 'assets/website/images/portfolio/pyramid/*.webp');
                if($pyramid_imgs) {
                    foreach($pyramid_imgs as $img) {
                        $imgUrl = base_url('assets/website/images/portfolio/pyramid/' . basename($img));
                        echo '<img class="sp-gallery-img" src="'.$imgUrl.'" onclick="openLightbox(this, event)">';
                    }
                }
                ?>
            </div>
            
            <div class="portfolio-card-desc-html" style="display:none;">
                <p>Pyramid represents the pinnacle of modern residential development. These premium living spaces are designed for those who seek luxury, space, and unmatched quality in the heart of the city.</p>
                <p><strong>Location:</strong> Bengaluru<br><strong>Status:</strong> Ongoing</p>
            </div>
            
            <div style="display: flex; gap: 15px; margin-top: 35px;">
                <button class="sp-btn" style="margin-top: 0; background: #9E693D;" onclick="openPortfolioModal(this.closest('.split-proj'))">View More Info</button>
                <button class="sp-btn" style="margin-top: 0;" onclick="openBookingModal()">Inquire Now</button>
            </div>
        </div>
    </div>

</div>

<!-- ═══ S4: MASTER PLANS ═══ -->
<section style="padding: 100px 5%; background: #F5F3F0; border-top: 1px solid #eaeaea;">
  <div style="text-align: center; margin-bottom: 60px;">
    <h2 style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #1A2530; margin-bottom: 15px;">
      Master Plans
    </h2>
    <p style="font-family: 'DM Sans', sans-serif; font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto; line-height: 1.6;">
      Explore the detailed layouts and designs of our premium residential projects
    </p>
  </div>

  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 40px; max-width: 1200px; margin: 0 auto;">
    
    <!-- Vista Card -->
    <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; display: flex; flex-direction: column;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
      <div style="position: relative; padding-top: 65%; overflow: hidden; background: #e0e0e0; cursor: zoom-in;" onclick="openLightbox('<?= base_url('assets/website/images/portfolio/Vista Master Plan.webp') ?>', event)">
         <img src="<?= base_url('assets/website/images/portfolio/Vista Master Plan.webp') ?>" alt="Vista Master Plan" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
      </div>
      <div style="padding: 35px; display: flex; flex-direction: column; flex-grow: 1;">
         <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #1A2530; margin-bottom: 15px;">Vista Master Plan</h3>
         <p style="font-family: 'DM Sans', sans-serif; font-size: 1.05rem; color: #555; line-height: 1.6; margin-bottom: 30px; flex-grow: 1;">Detailed layout showcasing premium villa plots with modern amenities and green spaces.</p>
         <button onclick="openLightbox('<?= base_url('assets/website/images/portfolio/Vista Master Plan.webp') ?>', event)" style="background: transparent; border: 1px solid #D4A574; color: #9E693D; padding: 12px 25px; border-radius: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; cursor: pointer; transition: 0.3s; align-self: flex-start;" onmouseover="this.style.background='#D4A574'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#9E693D'">View Full Size</button>
      </div>
    </div>

    <!-- EshaVana Card -->
    <div style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: transform 0.3s; display: flex; flex-direction: column;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
      <div style="position: relative; padding-top: 65%; overflow: hidden; background: #e0e0e0; cursor: zoom-in;" onclick="openLightbox('<?= base_url('assets/website/images/portfolio/Eesha Wana Masterplan.webp') ?>', event)">
         <img src="<?= base_url('assets/website/images/portfolio/Eesha Wana Masterplan.webp') ?>" alt="EshaVana Master Plan" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
      </div>
      <div style="padding: 35px; display: flex; flex-direction: column; flex-grow: 1;">
         <h3 style="font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: #1A2530; margin-bottom: 15px;">EshaVana Master Plan</h3>
         <p style="font-family: 'DM Sans', sans-serif; font-size: 1.05rem; color: #555; line-height: 1.6; margin-bottom: 30px; flex-grow: 1;">Comprehensive layout featuring premium farm lands with amenities.</p>
         <button onclick="openLightbox('<?= base_url('assets/website/images/portfolio/Eesha Wana Masterplan.webp') ?>', event)" style="background: transparent; border: 1px solid #D4A574; color: #9E693D; padding: 12px 25px; border-radius: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; cursor: pointer; transition: 0.3s; align-self: flex-start;" onmouseover="this.style.background='#D4A574'; this.style.color='#fff'" onmouseout="this.style.background='transparent'; this.style.color='#9E693D'">View Full Size</button>
      </div>
    </div>

  </div>
</section>

</div> <!-- end .ab-page -->

<!-- Image Lightbox Modal -->
<div id="image-lightbox" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.95); z-index: 99999; display: none; align-items: center; justify-content: center; cursor: zoom-out;">
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;" onclick="closeLightbox()"></div>
  <span style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 45px; font-weight: bold; cursor: pointer; z-index: 2; transition: 0.3s;" onmouseover="this.style.color='#D4A574'" onmouseout="this.style.color='#fff'" onclick="closeLightbox()">&times;</span>
  <span class="lb-arrow lb-prev" onclick="changeLightbox(-1, event)">&#10094;</span>
  <img id="lightbox-img" src="" style="max-width: 85%; max-height: 90vh; border-radius: 4px; box-shadow: 0 10px 40px rgba(0,0,0,0.8); object-fit: contain; z-index: 2; cursor: default;">
  <span class="lb-arrow lb-next" onclick="changeLightbox(1, event)">&#10095;</span>
</div>

<style>
.lb-arrow { position: absolute; top: 50%; transform: translateY(-50%); color: white; font-size: 50px; font-weight: bold; cursor: pointer; user-select: none; z-index: 100000; padding: 10px 20px; background: rgba(0,0,0,0.3); border-radius: 8px; transition: 0.3s; }
.lb-arrow:hover { background: rgba(0,0,0,0.9); color: #D4A574; }
.lb-prev { left: 30px; }
.lb-next { right: 30px; }
@media(max-width: 768px){ .lb-arrow { font-size: 30px; padding: 10px; } .lb-prev { left: 10px; } .lb-next { right: 10px; } }
</style>

<script>
let currentGalleryImages = [];
let currentImageIndex = 0;

function openLightbox(clickedElement, event) {
  if (event) event.preventDefault();
  if (event) event.stopPropagation();

  // If passed an image element (for the mini galleries)
  if (clickedElement && clickedElement.tagName === 'IMG') {
      const gallery = clickedElement.closest('.sp-gallery');
      if (gallery) {
          currentGalleryImages = Array.from(gallery.querySelectorAll('img')).map(img => img.src);
          currentImageIndex = currentGalleryImages.indexOf(clickedElement.src);
      } else {
          currentGalleryImages = [clickedElement.src];
          currentImageIndex = 0;
      }
  } 
  // If passed a string URL (for the Master Plan cards)
  else if (typeof clickedElement === 'string') {
      currentGalleryImages = [clickedElement];
      currentImageIndex = 0;
  }

  // Hide arrows if only 1 image in the gallery
  document.querySelector('.lb-prev').style.display = currentGalleryImages.length > 1 ? 'block' : 'none';
  document.querySelector('.lb-next').style.display = currentGalleryImages.length > 1 ? 'block' : 'none';

  document.getElementById('lightbox-img').src = currentGalleryImages[currentImageIndex];
  document.getElementById('image-lightbox').style.display = 'flex';
  document.body.style.overflow = 'hidden'; // prevent background scrolling
}

function changeLightbox(direction, event) {
  if (event) event.stopPropagation();
  currentImageIndex += direction;
  if (currentImageIndex < 0) currentImageIndex = currentGalleryImages.length - 1;
  if (currentImageIndex >= currentGalleryImages.length) currentImageIndex = 0;
  document.getElementById('lightbox-img').src = currentGalleryImages[currentImageIndex];
}

function closeLightbox() {
  document.getElementById('image-lightbox').style.display = 'none';
  document.body.style.overflow = '';
}
</script>

<script src="<?= base_url('assets/website/js/about.js') ?>"></script>

<?= view('Website/Partials/portfolio_modal') ?>

<?= view('Website/Layouts/footer') ?>
