<!-- SHARED PORTFOLIO MODAL -->
<div class="portfolio-modal" id="portfolioModal">
  <div class="portfolio-modal-overlay" onclick="closePortfolioModal()"></div>
  <div class="portfolio-modal-content">
    <button class="portfolio-modal-close" onclick="closePortfolioModal()">&times;</button>
    <div class="portfolio-modal-body">
       <div class="portfolio-modal-image" id="pmImage"></div>
       <div class="portfolio-modal-text">
         <span class="portfolio-card-tag" id="pmTag"></span>
         <h3 id="pmTitle"></h3>
         <div id="pmDesc" style="margin-bottom: 20px;"></div>
         <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center; border-top: 1px solid rgba(0,0,0,0.1); padding-top: 20px;">
           <a href="<?= base_url('portfolio') ?>" class="btn-primary" id="pmViewProjectBtn" style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">View Project <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
           <button class="btn-secondary" style="display: inline-flex; align-items: center;" onclick="closePortfolioModal(); openBookingModal();">Get an Appointment</button>
         </div>
       </div>
    </div>
  </div>
</div>
