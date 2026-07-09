// HERO CANVAS - geometric luxury background
function initHero(){
  const canvas=document.getElementById('bg');
  if(!canvas) return;
  const ctx=canvas.getContext('2d');
  function resize(){canvas.width=window.innerWidth;canvas.height=window.innerHeight}
  resize();window.addEventListener('resize',resize);

  const particles=[];
  const lines=[];
  for(let i=0;i<60;i++){
    particles.push({
      x:Math.random()*canvas.width,y:Math.random()*canvas.height,
      vx:(Math.random()-.5)*.12,vy:(Math.random()-.5)*.12,
      size:Math.random()*1.5+.5,
      alpha:Math.random()*.4+.1,
      color:Math.random()>.7?'193,138,86':'158,105,61'
    });
  }

  // Architectural grid lines
  for(let i=0;i<8;i++){
    lines.push({
      x1:Math.random()*canvas.width,y1:0,
      x2:Math.random()*canvas.width,y2:canvas.height,
      alpha:Math.random()*.06+.02,width:.5
    });
  }

  // Floating geometric shapes
  const shapes=[
    {type:'hex',x:canvas.width*.75,y:canvas.height*.35,r:140,rot:0,rotV:.002,alpha:.06},
    {type:'hex',x:canvas.width*.15,y:canvas.height*.7,r:80,rot:Math.PI/6,rotV:-.001,alpha:.04},
    {type:'rect',x:canvas.width*.6,y:canvas.height*.65,w:200,h:200,rot:.5,rotV:.001,alpha:.04},
    {type:'circle',x:canvas.width*.85,y:canvas.height*.2,r:120,alpha:.05},
    {type:'circle',x:canvas.width*.1,y:canvas.height*.2,r:60,alpha:.04},
  ];

  let t=0;
  function drawHex(ctx,x,y,r,rot){
    ctx.beginPath();
    for(let i=0;i<6;i++){
      const a=rot+i*Math.PI/3;
      const px=x+r*Math.cos(a),py=y+r*Math.sin(a);
      i===0?ctx.moveTo(px,py):ctx.lineTo(px,py);
    }ctx.closePath();
  }

  function draw(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    // Deep gradient bg
    const grad=ctx.createLinearGradient(0,0,canvas.width,canvas.height);
    grad.addColorStop(0,'#1A2A38');grad.addColorStop(.5,'#243443');grad.addColorStop(1,'#1E3048');
    ctx.fillStyle=grad;ctx.fillRect(0,0,canvas.width,canvas.height);

    // Grid lines
    lines.forEach(l=>{
      ctx.strokeStyle=`rgba(158,105,61,${l.alpha})`;
      ctx.lineWidth=l.width;ctx.beginPath();
      ctx.moveTo(l.x1,l.y1);ctx.lineTo(l.x2,l.y2);ctx.stroke();
    });

    // Horizontal grid
    for(let i=0;i<6;i++){
      const y=canvas.height*i/5;
      ctx.strokeStyle='rgba(221,226,232,0.02)';ctx.lineWidth=1;
      ctx.beginPath();ctx.moveTo(0,y);ctx.lineTo(canvas.width,y);ctx.stroke();
    }

    // Shapes
    shapes.forEach(s=>{
      s.rot+=s.rotV||0;
      ctx.strokeStyle=`rgba(158,105,61,${s.alpha})`;ctx.lineWidth=1;
      if(s.type==='hex'){
        drawHex(ctx,s.x,s.y,s.r,s.rot);ctx.stroke();
        drawHex(ctx,s.x,s.y,s.r*.6,s.rot+Math.PI/6);ctx.stroke();
        // Inner accent
        ctx.strokeStyle=`rgba(193,138,86,${s.alpha*.8})`;ctx.lineWidth=.5;
        drawHex(ctx,s.x,s.y,s.r*1.2,s.rot);ctx.stroke();
      } else if(s.type==='rect'){
        ctx.save();ctx.translate(s.x,s.y);ctx.rotate(s.rot);
        ctx.strokeRect(-s.w/2,-s.h/2,s.w,s.h);
        ctx.strokeRect(-s.w/3,-s.h/3,s.w*.67,s.h*.67);
        ctx.restore();
      } else if(s.type==='circle'){
        ctx.beginPath();ctx.arc(s.x,s.y,s.r,0,Math.PI*2);ctx.stroke();
        ctx.strokeStyle=`rgba(193,138,86,${s.alpha*.6})`;ctx.lineWidth=.5;
        ctx.beginPath();ctx.arc(s.x,s.y,s.r*.7,0,Math.PI*2);ctx.stroke();
      }
    });

    // Perspective grid
    const vp={x:canvas.width/2,y:canvas.height*.4};
    for(let i=-5;i<=5;i++){
      const x=canvas.width/2+i*(canvas.width/10);
      ctx.strokeStyle='rgba(158,105,61,0.035)';ctx.lineWidth=.5;
      ctx.beginPath();ctx.moveTo(vp.x,vp.y);ctx.lineTo(x,canvas.height);ctx.stroke();
    }
    for(let i=0;i<4;i++){
      const y=vp.y+(canvas.height-vp.y)*i/4;
      const spread=i/4;
      ctx.strokeStyle=`rgba(158,105,61,${0.05*spread})`;ctx.lineWidth=.5;
      ctx.beginPath();ctx.moveTo(vp.x-(canvas.width/2)*spread,y);ctx.lineTo(vp.x+(canvas.width/2)*spread,y);ctx.stroke();
    }

    // Particles
    particles.forEach(p=>{
      p.x+=p.vx;p.y+=p.vy;
      if(p.x<0)p.x=canvas.width;if(p.x>canvas.width)p.x=0;
      if(p.y<0)p.y=canvas.height;if(p.y>canvas.height)p.y=0;
      const flicker=Math.sin(t*.05+p.x)*.15+.85;
      ctx.fillStyle=`rgba(${p.color},${p.alpha*flicker})`;
      ctx.beginPath();ctx.arc(p.x,p.y,p.size,0,Math.PI*2);ctx.fill();
    });

    // Scanning line
    const scanY=(Math.sin(t*.005)+1)/2*canvas.height;
    const scanGrad=ctx.createLinearGradient(0,scanY-40,0,scanY+40);
    scanGrad.addColorStop(0,'rgba(158,105,61,0)');
    scanGrad.addColorStop(.5,'rgba(158,105,61,0.04)');
    scanGrad.addColorStop(1,'rgba(158,105,61,0)');
    ctx.fillStyle=scanGrad;ctx.fillRect(0,scanY-40,canvas.width,80);

    t++;requestAnimationFrame(draw);
  }draw();

  // HERO GSAP ANIMATIONS
  if (window.gsap) {
      const tl=gsap.timeline({delay:.3});
      let hasTimeline = false;
      if (document.querySelector('.hero-badge')) {
          tl.to('.hero-badge',{opacity:1,y:0,duration:1.4,ease:'power4.out'});
          hasTimeline = true;
      }
      if (document.querySelector('.headline-word span')) {
          tl.to('.headline-word span',{y:0,opacity:1,duration:1.8,ease:'power4.out',stagger:.1}, hasTimeline ? '-=1.0' : '+=0');
          hasTimeline = true;
      }
      if (document.querySelector('.hero-sub')) {
          tl.to('.hero-sub',{opacity:1,y:0,duration:1.5,ease:'power4.out'}, hasTimeline ? '-=.8' : '+=0');
          hasTimeline = true;
      }
      if (document.querySelector('.hero-actions')) {
          tl.to('.hero-actions',{opacity:1,y:0,duration:1.4,ease:'power4.out'}, hasTimeline ? '-=.7' : '+=0');
          hasTimeline = true;
      }
      if (document.querySelector('.hero-stats')) {
          tl.to('.hero-stats',{opacity:1,duration:1.5,ease:'power4.out'}, hasTimeline ? '-=.6' : '+=0');
      }
    
      // Animate stat counters
      const statNums = document.querySelectorAll('.stat-num[data-target]');
      if (statNums.length > 0) {
        statNums.forEach(el=>{
          const target=parseInt(el.dataset.target);
          const suffix=el.textContent.replace(/\d+/,'');
          const prefix=el.innerHTML.match(/<sup>(.*?)<\/sup>/)?.[1]||'';
          gsap.to({val:0},{val:target,duration:3.0,delay:1.8,ease:'power3.out',
            onUpdate:function(){
              el.innerHTML=(prefix?`<sup>${prefix}</sup>`:'')
                +Math.round(this.targets()[0].val)
                +suffix;
            }
          });
        });
      }
  }
}

// ABOUT CANVAS
const aboutC=document.getElementById('aboutCanvas');
if(aboutC){
  const actx=aboutC.getContext('2d');
  function resizeAbout(){aboutC.width=aboutC.offsetWidth;aboutC.height=aboutC.offsetHeight}
  resizeAbout();window.addEventListener('resize',resizeAbout);
  const aParticles=[];
  for(let i=0;i<30;i++){
    aParticles.push({x:Math.random()*aboutC.width,y:Math.random()*aboutC.height,
      vx:(Math.random()-.5)*.2,vy:(Math.random()-.5)*.2,r:Math.random()*1.2+.3,a:Math.random()*.3+.1});
  }
  let at=0;
  function drawAbout(){
    actx.clearRect(0,0,aboutC.width,aboutC.height);
    const grad=actx.createLinearGradient(0,0,aboutC.width,aboutC.height);
    grad.addColorStop(0,'#1A2A38');grad.addColorStop(1,'#243443');
    actx.fillStyle=grad;actx.fillRect(0,0,aboutC.width,aboutC.height);
    // Architectural lines
    for(let i=0;i<6;i++){
      const x=aboutC.width*i/5;
      actx.strokeStyle='rgba(158,105,61,0.05)';actx.lineWidth=.5;
      actx.beginPath();actx.moveTo(x,0);actx.lineTo(x,aboutC.height);actx.stroke();
    }
    // Large hex
    actx.strokeStyle='rgba(158,105,61,0.12)';actx.lineWidth=1;
    const hexX=aboutC.width*.5,hexY=aboutC.height*.4,hexR=150+Math.sin(at*.01)*10;
    actx.beginPath();
    for(let i=0;i<6;i++){const a=at*.002+i*Math.PI/3;
      i===0?actx.moveTo(hexX+hexR*Math.cos(a),hexY+hexR*Math.sin(a))
            :actx.lineTo(hexX+hexR*Math.cos(a),hexY+hexR*Math.sin(a));
    }actx.closePath();actx.stroke();
    actx.strokeStyle='rgba(193,138,86,0.07)';actx.lineWidth=.5;
    actx.beginPath();
    for(let i=0;i<6;i++){const a=-at*.002+i*Math.PI/3;
      i===0?actx.moveTo(hexX+hexR*.6*Math.cos(a),hexY+hexR*.6*Math.sin(a))
            :actx.lineTo(hexX+hexR*.6*Math.cos(a),hexY+hexR*.6*Math.sin(a));
    }actx.closePath();actx.stroke();
    aParticles.forEach(p=>{
      p.x+=p.vx;p.y+=p.vy;
      if(p.x<0)p.x=aboutC.width;if(p.x>aboutC.width)p.x=0;
      if(p.y<0)p.y=aboutC.height;if(p.y>aboutC.height)p.y=0;
      actx.fillStyle=`rgba(158,105,61,${p.a})`;
      actx.beginPath();actx.arc(p.x,p.y,p.r,0,Math.PI*2);actx.fill();
    });
    at++;requestAnimationFrame(drawAbout);
  }drawAbout();
}

// PORTFOLIO DRAG SCROLL
const ps=document.getElementById('portfolioScroll');
if(ps){
  window.isDown=false; let startX,scrollLeft;
  ps.addEventListener('mousedown',e=>{window.isDown=true;startX=e.pageX-ps.offsetLeft;scrollLeft=ps.scrollLeft;ps.style.cursor='grabbing'});
  ps.addEventListener('mouseleave',()=>{window.isDown=false;ps.style.cursor='grab'});
  ps.addEventListener('mouseup',()=>{window.isDown=false;ps.style.cursor='grab'});
  ps.addEventListener('mousemove',e=>{if(!window.isDown)return;e.preventDefault();const x=e.pageX-ps.offsetLeft;const walk=(x-startX)*1.5;ps.scrollLeft=scrollLeft-walk});
}

// PORTFOLIO CAROUSEL AUTOPLAY
window.scrollPortfolioCarousel = function(dir) {
    const c = document.getElementById('portfolioScroll');
    if(c) {
        const card = c.querySelector('.portfolio-card');
        if (!card) return;
        const cardWidth = card.offsetWidth + 3; // gap is 3px
        const maxScroll = c.scrollWidth - c.clientWidth;
        
        if (dir > 0 && c.scrollLeft >= maxScroll - 10) {
            c.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (dir < 0 && c.scrollLeft <= 10) {
            c.scrollTo({ left: maxScroll, behavior: 'smooth' });
        } else {
            c.scrollBy({ left: dir * cardWidth, behavior: 'smooth' });
        }
    }
};

if (ps) {
    let psRaf;
    let isHovering = false;
    function continuousScroll() {
        if (!isHovering && !window.isDown) {
            ps.scrollLeft += 1;
            // if we scrolled past the first set of cards, reset scrollLeft
            if (ps.scrollLeft >= (ps.scrollWidth / 2)) {
                ps.scrollLeft = 0;
            }
        }
        psRaf = requestAnimationFrame(continuousScroll);
    }
    psRaf = requestAnimationFrame(continuousScroll);
    
    ps.addEventListener('mouseenter', () => isHovering = true);
    ps.addEventListener('mouseleave', () => isHovering = false);
}

// VIDEO CAROUSEL SCROLL
window.scrollCarousel = function(dir) {
    const c = document.getElementById('vidCarousel');
    if(c) {
        const cardWidth = c.querySelector('.video-card').offsetWidth + 40; // gap is 2.5rem = 40px
        const maxScroll = c.scrollWidth - c.clientWidth;
        if (dir > 0 && c.scrollLeft >= maxScroll - 10) {
            c.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (dir < 0 && c.scrollLeft <= 10) {
            c.scrollTo({ left: maxScroll, behavior: 'smooth' });
        } else {
            c.scrollBy({ left: dir * cardWidth, behavior: 'smooth' });
        }
    }
};

const vidC = document.getElementById('vidCarousel');
if (vidC) {
    let carouselInterval = setInterval(() => window.scrollCarousel(1), 5000);
    vidC.addEventListener('mouseenter', () => clearInterval(carouselInterval));
    vidC.addEventListener('mouseleave', () => {
        carouselInterval = setInterval(() => window.scrollCarousel(1), 5000);
    });
}

// TESTIMONIALS CAROUSEL SCROLL
window.scrollTestiCarousel = function(dir) {
    const c = document.getElementById('testiCarousel');
    if(c) {
        const cardWidth = c.querySelector('.testi-card').offsetWidth + 40; // gap is 2.5rem = 40px
        const maxScroll = c.scrollWidth - c.clientWidth;
        if (dir > 0 && c.scrollLeft >= maxScroll - 10) {
            c.scrollTo({ left: 0, behavior: 'smooth' });
        } else if (dir < 0 && c.scrollLeft <= 10) {
            c.scrollTo({ left: maxScroll, behavior: 'smooth' });
        } else {
            c.scrollBy({ left: dir * cardWidth, behavior: 'smooth' });
        }
    }
};

const testiC = document.getElementById('testiCarousel');
if (testiC) {
    let testiInterval = setInterval(() => window.scrollTestiCarousel(1), 8000);
    testiC.addEventListener('mouseenter', () => clearInterval(testiInterval));
    testiC.addEventListener('mouseleave', () => {
        testiInterval = setInterval(() => window.scrollTestiCarousel(1), 8000);
    });
}

// GSAP SCROLL EFFECTS (if available)
if(window.gsap&&window.ScrollTrigger){
  gsap.registerPlugin(ScrollTrigger);
  
  // Parallax hero elements
  if (document.querySelector('.hero-content') && document.querySelector('#hero')) {
    gsap.to('.hero-content',{yPercent:-15,ease:'none',scrollTrigger:{trigger:'#hero',start:'top top',end:'bottom top',scrub:1}});
  }
  if (document.querySelector('.hero-stats') && document.querySelector('#hero')) {
    gsap.to('.hero-stats',{yPercent:-20,ease:'none',scrollTrigger:{trigger:'#hero',start:'top top',end:'bottom top',scrub:1}});
  }
  
  // Section reveals with scale and slow fade (excluding elements handled by custom staggers)
  const reveals = gsap.utils.toArray('.reveal:not(.premium-counter-card):not(.why-card):not(.about-img)');
  if (reveals.length > 0) {
    reveals.forEach(elem => {
      elem.style.transition = 'none'; // Disable CSS transition to prevent conflicts
      gsap.fromTo(elem,
        { y: 50, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 1.5,
          ease: 'power4.out',
          scrollTrigger: {
            trigger: elem,
            start: 'top 85%',
            toggleActions: 'play none none none'
          }
        }
      );
    });
  }

  // Stagger about image grid
  const aboutImgs = gsap.utils.toArray('.about-img');
  if (aboutImgs.length > 0 && document.querySelector('.about-image-grid')) {
    aboutImgs.forEach(img => img.style.transition = 'none');
    gsap.fromTo(aboutImgs,
      { scale: 1.15, y: 40, opacity: 0 },
      {
        scale: 1,
        y: 0,
        opacity: 1,
        stagger: 0.15,
        duration: 1.6,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '.about-image-grid',
          start: 'top 80%'
        }
      }
    );
  }

  // Stagger about timeline (does not have .reveal class)
  if (document.querySelector('.timeline') && document.querySelectorAll('.timeline-item').length > 0) {
    gsap.fromTo('.timeline-item',
      { x: -35, opacity: 0 },
      {
        x: 0,
        opacity: 1,
        stagger: 0.12,
        duration: 1.4,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '.timeline',
          start: 'top 80%'
        }
      }
    );
  }

  // Counter Cards Reveal (handled with absolute focus)
  const counterCards = gsap.utils.toArray('.premium-counter-card');
  if (counterCards.length > 0 && document.querySelector('.counter-section')) {
    counterCards.forEach(card => card.style.transition = 'none');
    gsap.fromTo(counterCards,
      { y: 60, scale: 1.05, opacity: 0 },
      {
        y: 0,
        scale: 1,
        opacity: 1,
        stagger: 0.15,
        duration: 1.5,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '.counter-section',
          start: 'top 80%'
        }
      }
    );
  }

  // Why cards Reveal
  const whyCards = gsap.utils.toArray('.why-card');
  if (whyCards.length > 0 && document.querySelector('#why')) {
    whyCards.forEach(card => card.style.transition = 'none');
    gsap.fromTo(whyCards,
      { y: 60, scale: 1.05, opacity: 0 },
      {
        y: 0,
        scale: 1,
        opacity: 1,
        stagger: 0.1,
        duration: 1.6,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '#why',
          start: 'top 75%'
        }
      }
    );
  }
  
  // Portfolio cards Reveal
  if (document.querySelector('#portfolio') && document.querySelectorAll('.portfolio-card').length > 0) {
    gsap.fromTo('.portfolio-card',
      { y: 70, scale: 1.03, opacity: 0 },
      {
        y: 0,
        scale: 1,
        opacity: 1,
        stagger: 0.12,
        duration: 1.6,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '#portfolio',
          start: 'top 75%'
        }
      }
    );
  }

  // Testimonial cards Reveal
  if (document.querySelector('#testimonials') && document.querySelectorAll('.testi-card').length > 0) {
    gsap.fromTo('.testi-card',
      { y: 55, opacity: 0 },
      {
        y: 0,
        opacity: 1,
        stagger: 0.15,
        duration: 1.5,
        ease: 'power4.out',
        scrollTrigger: {
          trigger: '#testimonials',
          start: 'top 75%'
        }
      }
    );
  }
}
