// GSAP SILENT CONFIG
if (window.gsap) {
  window.gsap.config({ nullTargetWarn: false });
}

// CURSOR
const cursor = document.getElementById('cursor');
const ring = document.getElementById('cursorRing');
let mouseX=0,mouseY=0,ringX=0,ringY=0;

if (cursor && ring) {
  document.addEventListener('mousemove',e=>{
    mouseX=e.clientX;mouseY=e.clientY;
    cursor.style.left=mouseX+'px';cursor.style.top=mouseY+'px';
  });
  function animateRing(){
    ringX+=(mouseX-ringX)*.08;ringY+=(mouseY-ringY)*.08;
    ring.style.left=ringX+'px';ring.style.top=ringY+'px';
    requestAnimationFrame(animateRing);
  }animateRing();
  document.querySelectorAll('a,button,.why-card,.testi-card,.portfolio-card,.nav-cta,.premium-counter-card,.video-card').forEach(el=>{
    el.addEventListener('mouseenter',()=>{cursor.classList.add('hover');ring.classList.add('hover')});
    el.addEventListener('mouseleave',()=>{cursor.classList.remove('hover');ring.classList.remove('hover')});
  });
}

// LOADER
const loader=document.getElementById('loader');
if (loader) {
  const loaderLine=document.getElementById('loaderLine');
  const loaderPct=document.getElementById('loaderPct');
  const lLogo=loader.querySelector('.l-logo');
  const lText=loader.querySelector('.l-text');
  const loaderBadge=loader.querySelector('.loader-badge');
  let progress=0;
  
  // Staggered luxury reveal entry
  if (loaderBadge) {
    gsap.fromTo(loaderBadge, 
      {opacity: 0, scale: 0.82, rotate: -45},
      {opacity: 1, scale: 1, rotate: 0, duration: 1.8, delay: 0.1, ease: 'power4.out'}
    );
  }
  gsap.to(lLogo,{opacity:1,y:0,duration:1,delay:.4,ease:'power3.out'});
  gsap.to(lText,{opacity:1,duration:.8,delay:.9});
  gsap.to(loaderPct,{opacity:1,duration:.5,delay:.6});
  
  const interval=setInterval(()=>{
    progress=Math.min(progress+Math.random()*8+2,100);
    loaderLine.style.width=(progress*3.2)+'px';
    loaderPct.textContent=Math.floor(progress)+'%';
    if(progress>=100){
      clearInterval(interval);
      setTimeout(()=>{
        gsap.to(loader,{opacity:0,scale:1.02,duration:1.2,ease:'power4.inOut',onComplete:()=>{
          loader.style.display='none';
          if(typeof initHero === 'function') initHero();
          if(typeof initHomeHero === 'function') initHomeHero();
        }});
      },400);
    }
  },80);
} else {
  // If no loader, just init hero
  setTimeout(() => {
    if(typeof initHero === 'function') initHero();
    if(typeof initHomeHero === 'function') initHomeHero();
  }, 100);
}

// NAV SCROLL
window.addEventListener('scroll',()=>{
  const nav=document.getElementById('nav');
  if(nav) nav.classList.toggle('scrolled',window.scrollY>80);
});

// SCROLL REVEAL (Fallback if GSAP/ScrollTrigger is not available)
if (!(window.gsap && window.ScrollTrigger)) {
  const revealObserver=new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
      if(e.isIntersecting){
        e.target.classList.add('visible');
        // Stagger children
        const delay=Array.from(e.target.parentElement?.children||[]).indexOf(e.target)*.12;
        e.target.style.transitionDelay=delay+'s';
      }
    });
  },{threshold:.15,rootMargin:'0px 0px -60px 0px'});
  document.querySelectorAll('.reveal').forEach(el=>revealObserver.observe(el));
}

// MAGNETIC BUTTONS
document.querySelectorAll('.btn-primary,.btn-secondary,.nav-cta,.form-submit').forEach(btn=>{
  btn.addEventListener('mousemove',e=>{
    const r=btn.getBoundingClientRect();
    const x=(e.clientX-r.left-r.width/2)*.25;
    const y=(e.clientY-r.top-r.height/2)*.25;
    btn.style.transform=`translate(${x}px,${y}px)`;
  });
  btn.addEventListener('mouseleave',()=>{btn.style.transform=''});
});

// PORTFOLIO MODAL LOGIC
window.openPortfolioModal = function(cardElement) {
    const modal = document.getElementById('portfolioModal');
    if(!modal) return;
    
    const tagElem = cardElement.querySelector('.portfolio-card-tag') || cardElement.querySelector('.sp-status');
    const titleElem = cardElement.querySelector('h3') || cardElement.querySelector('.sp-title');
    const pElem = cardElement.querySelector('p');
    const htmlDesc = cardElement.querySelector('.portfolio-card-desc-html');
    
    const tag = tagElem ? tagElem.innerText : '';
    const title = titleElem ? titleElem.innerText : '';
    
    const modalImg = document.getElementById('pmImage');
    const bgElem = cardElement.querySelector('.portfolio-card-bg');
    if (bgElem && bgElem.style.backgroundImage) {
        modalImg.style.backgroundImage = bgElem.style.backgroundImage;
    } else if (cardElement.style.backgroundImage) {
        modalImg.style.backgroundImage = cardElement.style.backgroundImage;
    } else if (cardElement.querySelector('img')) {
        modalImg.style.backgroundImage = `url('${cardElement.querySelector('img').src}')`;
    }
    // Also include the SVG inside the background for extra visual flair
    modalImg.innerHTML = bgElem ? bgElem.innerHTML : '';
    
    const pmTag = document.getElementById('pmTag');
    if (pmTag) pmTag.innerText = tag;
    
    const pmTitle = document.getElementById('pmTitle');
    if (pmTitle) pmTitle.innerText = title;
    
    const pmDesc = document.getElementById('pmDesc');
    if (pmDesc) {
        if (htmlDesc) {
            pmDesc.innerHTML = htmlDesc.innerHTML;
        } else if (pElem) {
            pmDesc.innerText = pElem.innerText;
        } else {
            pmDesc.innerHTML = '';
        }
    }
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden'; 
};

window.closePortfolioModal = function() {
    const modal = document.getElementById('portfolioModal');
    if(modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
};

// Open Booking Modal function
window.openBookingModal = function() {
    console.log("Opening booking modal...");
    const modal = document.getElementById('bookingModal');
    if(modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

// Mobile Menu Toggle
window.toggleMobileMenu = function() {
    const overlay = document.getElementById('mobileOverlay');
    const btn = document.getElementById('mobileMenuBtn');
    if(overlay) {
        overlay.classList.toggle('active');
        btn.classList.toggle('active');
        document.body.style.overflow = overlay.classList.contains('active') ? 'hidden' : '';
    }
};

// SMOOTH SCROLL for nav links
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click',e=>{
    e.preventDefault();
    const target=document.querySelector(a.getAttribute('href'));
    if(target)target.scrollIntoView({behavior:'smooth'});
  });
});

// GLOBAL CARD SPOTLIGHT GLOW EFFECT
document.querySelectorAll('.why-card, .premium-counter-card, .portfolio-card, .ab-s5-card, .cr-wj-card, .ab-leader-card').forEach(card => {
  card.style.position = 'relative'; // Ensure relative positioning
  card.addEventListener('mousemove', e => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    card.style.setProperty('--mouse-x', `${x}px`);
    card.style.setProperty('--mouse-y', `${y}px`);
  });
});

// MAGNETIC ROTATING BADGE
const rotBadge = document.querySelector('.rotating-badge');
if (rotBadge) {
  rotBadge.addEventListener('mousemove', e => {
    const rect = rotBadge.getBoundingClientRect();
    const x = (e.clientX - rect.left - rect.width / 2) * 0.35;
    const y = (e.clientY - rect.top - rect.height / 2) * 0.35;
    rotBadge.style.transform = `translate(${x}px, ${y}px)`;
  });
  rotBadge.addEventListener('mouseleave', () => {
    rotBadge.style.transform = '';
  });
}

