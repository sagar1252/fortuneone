<?= view('Website/Layouts/header') ?>
<link rel="stylesheet" href="<?= base_url('assets/website/css/about.css') ?>">
<style>
.blog-content { max-width: 800px; margin: 4rem auto; padding: 2rem 2rem; color: #333; line-height: 1.8; font-family: 'DM Sans', sans-serif; background: #fff; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
.blog-content h1 { font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 1rem; color: #1a1a1a; line-height: 1.2; }
.blog-content .meta { color: #888; font-size: 0.85rem; margin-bottom: 2rem; text-transform: uppercase; letter-spacing: 1.5px; border-bottom: 1px solid #eee; padding-bottom: 1rem; }
.blog-content img { width: 100%; height: auto; border-radius: 8px; margin-bottom: 2rem; }
.blog-content h2 { font-family: 'Playfair Display', serif; font-size: 1.8rem; margin: 2.5rem 0 1rem; color: #1a1a1a; }
.blog-content h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; margin: 1.5rem 0 1rem; color: #333; }
.blog-content p { margin-bottom: 1.5rem; font-size: 1.05rem; }
.blog-content ul { margin-bottom: 1.5rem; padding-left: 20px; }
.blog-content li { margin-bottom: 0.5rem; font-size: 1.05rem; }
.blog-wrapper { background: #f6f5f2; padding: 120px 0 60px; min-height: 100vh; }
</style>

<div class="blog-wrapper">
    <div class="blog-content">
        <h1>Sustainable Building: The Rise of Eco-Friendly Construction Materials</h1>
        <div class="meta">Published on <?= date('F j, Y') ?> | Green Architecture</div>
        
        <img src="<?= base_url('assets/website/images/blog/post2.webp') ?>" alt="Eco Friendly Construction Materials">
        
        <p>The construction industry is undergoing a profound transformation. As environmental awareness grows, understanding how construction is evolving with time requires looking closely at the materials we use. The shift toward <strong>sustainable building materials</strong> is no longer just a trend; it is becoming the fundamental standard for modern real estate development and green architecture.</p>

        <h2>Rethinking Traditional Methods</h2>
        <p>For decades, concrete and steel have been the undisputed kings of construction. However, their production carries a massive carbon footprint. Today, architects and developers are turning to innovative, eco-friendly alternatives that offer incredible strength and durability without compromising the health of our planet.</p>

        <h2>Key Eco-Friendly Materials Shaping the Future</h2>
        <ul>
            <li><strong>Mass Timber and Cross-Laminated Timber (CLT):</strong> Wood is making a massive comeback. Engineered timber products like CLT are exceptionally strong, fire-resistant, and act as a carbon sink, locking away CO2 that would otherwise be released into the atmosphere.</li>
            <li><strong>Recycled Steel and Reclaimed Wood:</strong> Utilizing materials that have already been processed significantly reduces the energy required for manufacturing. These materials also add a unique aesthetic character to modern developments.</li>
            <li><strong>Green Concrete:</strong> Innovations in concrete production involve replacing carbon-heavy cement with industrial by-products like fly ash or slag, resulting in a significantly lower environmental impact.</li>
            <li><strong>Mycelium and Hempcrete:</strong> At the cutting edge of material science, builders are experimenting with organic materials. Hempcrete offers incredible insulation, while mycelium (mushroom roots) can be grown into custom shapes for packaging and insulation.</li>
        </ul>

        <h2>The Benefits Beyond the Environment</h2>
        <p>The adoption of sustainable building materials offers tangible benefits beyond environmental conservation. Eco-friendly structures often boast superior thermal insulation, leading to drastically reduced energy bills for residents. Furthermore, buildings constructed with non-toxic, natural materials promote better indoor air quality, directly contributing to the health and well-being of the occupants.</p>

        <h2>Commitment to a Greener Horizon</h2>
        <p>As the evolution of construction accelerates, integrating sustainable practices is essential. At Fortune One, we believe that building the future means preserving it. By championing eco-friendly materials and green architectural principles, we ensure that our developments stand the test of time—both structurally and environmentally.</p>
    </div>
</div>

<?= view('Website/Layouts/footer') ?>
