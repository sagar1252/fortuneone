document.addEventListener('DOMContentLoaded', () => {
  // We don't register ScrollTrigger here if it might already be registered
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);
    
    /* ─── HERO CANVAS ─── */
    const cvs = document.getElementById('ab-hero-canvas');
    if(cvs) {
      const ctx = cvs.getContext('2d');
      let W,H;
      function resize(){W=cvs.width=window.innerWidth;H=cvs.height=window.innerHeight}
      resize(); window.addEventListener('resize',resize);

      const pts=[];
      for(let i=0;i<70;i++) pts.push({
        x:Math.random()*W,y:Math.random()*H,
        vx:(Math.random()-.5)*.25,vy:(Math.random()-.5)*.25,
        r:Math.random()*1.4+.4,a:Math.random()*.35+.08,
        c:Math.random()>.65?'158,105,61':'193,138,86'
      });

      const shapes=[
        {t:'hex',x:.78,y:.32,r:180,rv:.0015,a:.065},
        {t:'hex',x:.12,y:.72,r:100,rv:-.001,a:.04},
        {t:'rect',x:.62,y:.7,w:220,h:220,rv:.0008,a:.04},
        {t:'ring',x:.88,y:.15,r:130,a:.06},
        {t:'ring',x:.08,y:.25,r:70,a:.045},
      ];
      shapes.forEach(s=>s.rot=Math.random()*Math.PI*2);

      function hex(x,y,r,rot){
        ctx.beginPath();
        for(let i=0;i<6;i++){const a=rot+i*Math.PI/3;i===0?ctx.moveTo(x+r*Math.cos(a),y+r*Math.sin(a)):ctx.lineTo(x+r*Math.cos(a),y+r*Math.sin(a))}
        ctx.closePath();
      }

      let t=0;
      function draw(){
        ctx.clearRect(0,0,W,H);
        const bg=ctx.createLinearGradient(0,0,W,H);
        bg.addColorStop(0,'#15202B');bg.addColorStop(.5,'#1D2F3D');bg.addColorStop(1,'#1A2B38');
        ctx.fillStyle=bg;ctx.fillRect(0,0,W,H);

        const vx=W/2,vy=H*.38;
        for(let i=-6;i<=6;i++){
          const ex=W*.5+i*(W*.095);
          ctx.strokeStyle='rgba(158,105,61,0.028)';ctx.lineWidth=.6;
          ctx.beginPath();ctx.moveTo(vx,vy);ctx.lineTo(ex,H);ctx.stroke();
        }
        for(let i=0;i<5;i++){
          const y=vy+(H-vy)*i/4,sp=(i/4)*.95;
          ctx.strokeStyle=`rgba(158,105,61,${0.04*sp})`;ctx.lineWidth=.5;
          ctx.beginPath();ctx.moveTo(vx-W/2*sp,y);ctx.lineTo(vx+W/2*sp,y);ctx.stroke();
        }

        shapes.forEach(s=>{
          s.rot+=s.rv;
          const sx=s.x*W,sy=s.y*H;
          ctx.strokeStyle=`rgba(158,105,61,${s.a})`;ctx.lineWidth=.8;
          if(s.t==='hex'){hex(sx,sy,s.r,s.rot);ctx.stroke();ctx.strokeStyle=`rgba(193,138,86,${s.a*.6})`;ctx.lineWidth=.4;hex(sx,sy,s.r*.55,s.rot+Math.PI/6);ctx.stroke();}
          else if(s.t==='rect'){ctx.save();ctx.translate(sx,sy);ctx.rotate(s.rot);ctx.strokeRect(-s.w/2,-s.h/2,s.w,s.h);ctx.strokeRect(-s.w/3,-s.h/3,s.w*.67,s.h*.67);ctx.restore();}
          else if(s.t==='ring'){ctx.beginPath();ctx.arc(sx,sy,s.r,0,Math.PI*2);ctx.stroke();ctx.strokeStyle=`rgba(193,138,86,${s.a*.55})`;ctx.lineWidth=.4;ctx.beginPath();ctx.arc(sx,sy,s.r*.65,0,Math.PI*2);ctx.stroke();}
        });

        const sy2=(Math.sin(t*.004)+1)/2*H;
        const sg=ctx.createLinearGradient(0,sy2-50,0,sy2+50);
        sg.addColorStop(0,'rgba(158,105,61,0)');sg.addColorStop(.5,'rgba(158,105,61,0.035)');sg.addColorStop(1,'rgba(158,105,61,0)');
        ctx.fillStyle=sg;ctx.fillRect(0,sy2-50,W,100);

        pts.forEach(p=>{
          p.x+=p.vx;p.y+=p.vy;
          if(p.x<0)p.x=W;if(p.x>W)p.x=0;if(p.y<0)p.y=H;if(p.y>H)p.y=0;
          ctx.fillStyle=`rgba(${p.c},${p.a*(Math.sin(t*.04+p.x*.01)*.15+.85)})`;
          ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,Math.PI*2);ctx.fill();
        });

        t++;requestAnimationFrame(draw);
      }
      draw();
      
      const tl=gsap.timeline({delay:0.5});
      
      // Setup initial states for 3D reveal
      gsap.set('.ab-eyebrow-char', { rotateX: -105, rotateY: 15, z: -150, opacity: 0, transformOrigin: "50% 50% -70px" });
      gsap.set('.ab-eyebrow-line', { scaleX: 0 });
      
      tl.to('.ab-eyebrow-line', { scaleX: 1, duration: 1.2, ease: 'power3.out', stagger: 0.2 })
        .to('.ab-eyebrow-char', {
          rotateX: 0,
          rotateY: 0,
          z: 0,
          opacity: 1,
          duration: 1.8,
          ease: 'expo.out',
          stagger: {
            each: 0.05,
            from: "center"
          }
        }, '-=0.8')
        .to('#abHeroSub',{opacity:1,y:0,duration:1.1,ease:'power3.out'},'-=0.5')
        .add(() => {
          gsap.to('.ab-eyebrow-char', {
            y: '+=5',
            z: '+=8',
            rotateX: '+=2',
            rotateY: '-=3',
            duration: 2.2,
            ease: 'sine.inOut',
            stagger: {
              each: 0.08,
              from: 'center',
              repeat: -1,
              yoyo: true
            }
          });
        }, '-=0.2');
    }

    /* ─── S3 CANVAS ─── */
    const c3=document.getElementById('ab-s3-canvas');
    if(c3){
      const x3=c3.getContext('2d');
      function rs3(){c3.width=c3.offsetWidth;c3.height=c3.offsetHeight}
      rs3();window.addEventListener('resize',rs3);
      const ps3=[];
      for(let i=0;i<35;i++) ps3.push({x:Math.random()*c3.width,y:Math.random()*c3.height,vx:(Math.random()-.5)*.18,vy:(Math.random()-.5)*.18,r:Math.random()*1+.3,a:Math.random()*.25+.07});
      let t3=0;
      function dS3(){
        x3.clearRect(0,0,c3.width,c3.height);
        const g=x3.createLinearGradient(0,0,c3.width,c3.height);
        g.addColorStop(0,'#151E26');g.addColorStop(1,'#1A2530');
        x3.fillStyle=g;x3.fillRect(0,0,c3.width,c3.height);
        for(let i=0;i<8;i++){
          x3.strokeStyle='rgba(158,105,61,0.04)';x3.lineWidth=.5;
          x3.beginPath();x3.moveTo(c3.width*i/7,0);x3.lineTo(c3.width*i/7,c3.height);x3.stroke();
          x3.beginPath();x3.moveTo(0,c3.height*i/7);x3.lineTo(c3.width,c3.height*i/7);x3.stroke();
        }
        const hx=c3.width*.5,hy=c3.height*.5,hr=Math.min(c3.width,c3.height)*.35+Math.sin(t3*.008)*12;
        x3.strokeStyle='rgba(158,105,61,0.09)';x3.lineWidth=.8;
        x3.beginPath();for(let i=0;i<6;i++){const a=t3*.003+i*Math.PI/3;i===0?x3.moveTo(hx+hr*Math.cos(a),hy+hr*Math.sin(a)):x3.lineTo(hx+hr*Math.cos(a),hy+hr*Math.sin(a))}x3.closePath();x3.stroke();
        x3.strokeStyle='rgba(193,138,86,0.06)';x3.lineWidth=.4;
        x3.beginPath();for(let i=0;i<6;i++){const a=-t3*.003+i*Math.PI/3;i===0?x3.moveTo(hx+hr*.6*Math.cos(a),hy+hr*.6*Math.sin(a)):x3.lineTo(hx+hr*.6*Math.cos(a),hy+hr*.6*Math.sin(a))}x3.closePath();x3.stroke();
        ps3.forEach(p=>{
          p.x+=p.vx;p.y+=p.vy;
          if(p.x<0)p.x=c3.width;if(p.x>c3.width)p.x=0;if(p.y<0)p.y=c3.height;if(p.y>c3.height)p.y=0;
          x3.fillStyle=`rgba(158,105,61,${p.a})`;
          x3.beginPath();x3.arc(p.x,p.y,p.r,0,Math.PI*2);x3.fill();
        });
        t3++;requestAnimationFrame(dS3);
      }
      dS3();
    }

    /* ─── INTERSECTION OBSERVER ─── */
    const obs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        if(e.isIntersecting){
          e.target.classList.add('visible');
          e.target.style.transitionDelay=(e.target.dataset.delay||0)+'s';
        }
      });
    },{threshold:.18,rootMargin:'0px 0px -50px 0px'});
    document.querySelectorAll('.ab-s3-panel,.ab-s5-card,.ab-leader-card,.ab-tl-trigger').forEach(el=>obs.observe(el));

    const fadeObs=new IntersectionObserver(entries=>{
      entries.forEach(e=>{
        if(e.isIntersecting){
          gsap.to(e.target,{opacity:1,y:0,duration:.9,delay:parseFloat(e.target.dataset.delay||0),ease:'power3.out'});
          e.target.style.opacity='0';e.target.style.transform='translateY(28px)';
          fadeObs.unobserve(e.target);
        }
      });
    },{threshold:.2});
    document.querySelectorAll('.ab-label,.ab-title-light,.ab-title-dark,.ab-fade-up').forEach(el=>{
      el.style.opacity='0';el.style.transform='translateY(28px)';
      fadeObs.observe(el);
    });

    /* ─── TIMELINE SCROLL (SPLIT SCREEN PARALLAX) ─── */
    const steps = gsap.utils.toArray('.ab-journey-step');
    const images = gsap.utils.toArray('.ab-journey-image-wrapper');
    let currentActive = -1;

    if (steps.length > 0 && images.length > 0) {
      // Setup initial image states
      images.forEach((img, idx) => {
        gsap.set(img, { opacity: 0, y: '0%', zIndex: 1 });
        const innerImg = img.querySelector('img');
        if (innerImg) gsap.set(innerImg, { y: '0%', scale: 1.05 });
      });

      ScrollTrigger.create({
        trigger: '.ab-journey-container',
        start: 'top bottom',
        end: 'bottom top',
        onUpdate: (self) => {
          const viewportCenter = window.innerHeight / 2;
          let activeIndex = 0;
          let minDistance = Infinity;

          steps.forEach((step, idx) => {
            const rect = step.getBoundingClientRect();
            const stepCenter = rect.top + rect.height / 2;
            const distance = Math.abs(viewportCenter - stepCenter);
            if (distance < minDistance) {
              minDistance = distance;
              activeIndex = idx;
            }
          });

          if (activeIndex !== currentActive) {
            const direction = activeIndex > currentActive ? 'down' : 'up';
            if (currentActive === -1) {
              // Direct state setting for page load
              steps[activeIndex].classList.add('ab-step-active');
              gsap.set(images[activeIndex], { opacity: 1, y: '0%', zIndex: 2 });
              currentActive = activeIndex;
            } else {
              changeImage(activeIndex, direction);
            }
          }
        }
      });
    }

    function changeImage(index, direction) {
      if (currentActive === index) return;
      
      const nextImg = images[index];
      const prevImg = images[currentActive];
      if (!nextImg || !prevImg) return;
      
      const nextInner = nextImg.querySelector('img');
      const prevInner = prevImg.querySelector('img');
      
      // Update active card class
      steps.forEach((s, idx) => {
        if (idx === index) {
          s.classList.add('ab-step-active');
        } else {
          s.classList.remove('ab-step-active');
        }
      });
      
      // Stop ongoing animations
      gsap.killTweensOf([prevImg, nextImg, prevInner, nextInner].filter(Boolean));
      
      const tl = gsap.timeline();
      
      if (direction === 'down') {
        // Next image enters from bottom (100% -> 0%)
        gsap.set(nextImg, { y: '100%', opacity: 1, zIndex: 2 });
        if (nextInner) gsap.set(nextInner, { y: '-25%', scale: 1.15 });
        
        tl.to(prevImg, { y: '-100%', opacity: 0.2, duration: 1.2, ease: 'power2.inOut' });
        if (prevInner) tl.to(prevInner, { y: '25%', duration: 1.2, ease: 'power2.inOut' }, 0);
          
        tl.to(nextImg, { y: '0%', duration: 1.2, ease: 'power2.inOut' }, 0);
        if (nextInner) tl.to(nextInner, { y: '0%', scale: 1.05, duration: 1.2, ease: 'power2.inOut' }, 0);
      } else {
        // Next image enters from top (-100% -> 0%)
        gsap.set(nextImg, { y: '-100%', opacity: 1, zIndex: 2 });
        if (nextInner) gsap.set(nextInner, { y: '25%', scale: 1.15 });
        
        tl.to(prevImg, { y: '100%', opacity: 0.2, duration: 1.2, ease: 'power2.inOut' });
        if (prevInner) tl.to(prevInner, { y: '-25%', duration: 1.2, ease: 'power2.inOut' }, 0);
          
        tl.to(nextImg, { y: '0%', duration: 1.2, ease: 'power2.inOut' }, 0);
        if (nextInner) tl.to(nextInner, { y: '0%', scale: 1.05, duration: 1.2, ease: 'power2.inOut' }, 0);
      }
      
      tl.add(() => {
        images.forEach((img, idx) => {
          if (idx !== index) {
            gsap.set(img, { zIndex: 1, opacity: 0, y: '0%' });
            const inner = img.querySelector('img');
            if (inner) gsap.set(inner, { y: '0%', scale: 1.05 });
          } else {
            gsap.set(img, { zIndex: 2, opacity: 1, y: '0%' });
            const inner = img.querySelector('img');
            if (inner) gsap.set(inner, { y: '0%', scale: 1.05 });
          }
        });
      });
      
      currentActive = index;
    }

    /* ─── LEADERSHIP MODAL ─── */
    const modal = document.getElementById('ab-leader-modal');
    if(modal) {
      const modalOverlay = document.getElementById('ab-modal-overlay');
      const modalContent = modal.querySelector('.ab-modal-content');
      const modalImg = document.getElementById('ab-modal-img');
      const modalRole = document.getElementById('ab-modal-role');
      const modalName = document.getElementById('ab-modal-name');
      const modalBio = document.getElementById('ab-modal-bio');
      const closeBtn = document.getElementById('ab-modal-close');
      
      let isAnimating = false;

      // Ensure modal starts clean for GSAP
      gsap.set(modal, { opacity: 1, pointerEvents: 'none' });
      gsap.set(modalOverlay, { opacity: 0 });
      gsap.set(modalContent, { opacity: 0, y: 70, scale: 0.94 });
      
      document.querySelectorAll('.ab-leader-card').forEach(card => {
        card.addEventListener('click', () => {
          if(isAnimating) return;
          isAnimating = true;

          const img = card.querySelector('.ab-lc-portrait-img');
          const role = card.querySelector('.ab-lc-role');
          const name = card.querySelector('.ab-lc-name');
          const bio = card.querySelector('.ab-lc-bio');
          
          if(img) modalImg.src = img.src;
          if(role) modalRole.textContent = role.textContent;
          if(name) modalName.textContent = name.textContent;
          if(bio) modalBio.innerHTML = bio.innerHTML;
          
          // Disable body scroll
          document.body.style.overflow = 'hidden';
          modal.style.pointerEvents = 'auto';
          
          // Cinematic GSAP Timeline
          const tl = gsap.timeline({
            onComplete: () => { isAnimating = false; }
          });
          
          // Reset inner elements to cinematic starting states
          gsap.set(modalImg, { scale: 1.25, filter: 'blur(15px) grayscale(60%)' });
          gsap.set(modalRole, { yPercent: 105 });
          gsap.set(modalName, { yPercent: 105 });
          gsap.set(closeBtn, { opacity: 0, scale: 0.8 });
          
          const bioParagraphs = modalBio.querySelectorAll('p');
          gsap.set(bioParagraphs, { opacity: 0, y: 30 });
          
          tl.to(modalOverlay, { opacity: 1, duration: 0.7, ease: 'power2.out' })
            .to(modalContent, { 
              opacity: 1, 
              y: 0, 
              scale: 1, 
              duration: 0.9, 
              ease: 'power4.out' 
            }, '-=0.5')
            .to(modalImg, { 
              scale: 1, 
              filter: 'blur(0px) grayscale(0%)', 
              duration: 1.5, 
              ease: 'power3.out' 
            }, '-=0.7')
            .to(modalRole, {
              yPercent: 0,
              duration: 0.7,
              ease: 'power3.out'
            }, '-=1.2')
            .to(modalName, {
              yPercent: 0,
              duration: 0.8,
              ease: 'power4.out'
            }, '-=1.0')
            .to(bioParagraphs, { 
              opacity: 1, 
              y: 0, 
              duration: 0.7, 
              stagger: 0.15, 
              ease: 'power3.out' 
            }, '-=0.8')
            .to(closeBtn, { 
              opacity: 1, 
              scale: 1, 
              duration: 0.5, 
              ease: 'back.out(1.7)' 
            }, '-=0.9');
        });
      });
      
      const closeModal = () => {
        if(isAnimating) return;
        isAnimating = true;
        
        const tl = gsap.timeline({
          onComplete: () => {
            modal.style.pointerEvents = 'none';
            document.body.style.overflow = '';
            isAnimating = false;
          }
        });
        
        tl.to(modalContent, { 
          opacity: 0, 
          y: 50, 
          scale: 0.94, 
          duration: 0.5, 
          ease: 'power3.in' 
        })
        .to(modalOverlay, { 
          opacity: 0, 
          duration: 0.4, 
          ease: 'power2.inOut' 
        }, '-=0.3');
      };
      
      if(closeBtn) closeBtn.addEventListener('click', closeModal);
      if(modalOverlay) modalOverlay.addEventListener('click', closeModal);
    }

    /* ─── TILT & SPOTLIGHT EFFECTS ─── */
    document.querySelectorAll('.ab-leader-card').forEach(card=>{
      card.addEventListener('mousemove',e=>{
        const r=card.getBoundingClientRect();
        const x=e.clientX-r.left;
        const y=e.clientY-r.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);

        const tx=(x/r.width)-.5;
        const ty=(y/r.height)-.5;
        card.style.transform=`translateY(0) perspective(1000px) rotateY(${tx*7}deg) rotateX(${-ty*5}deg)`;
        
        const imgWrap = card.querySelector('.ab-lc-portrait');
        if (imgWrap) imgWrap.style.transform=`scale(1.02)`;
      });
      card.addEventListener('mouseleave',()=>{
        card.style.transform='';
        card.style.setProperty('--mouse-x', `50%`);
        card.style.setProperty('--mouse-y', `50%`);
        const p=card.querySelector('.ab-lc-portrait');
        if(p) p.style.transform='';
      });
    });

    /* ─── SCROLL TRIGGER ANIMATIONS ─── */
    if (document.querySelector('#abHeroContent') && document.querySelector('#ab-hero')) {
      gsap.to('#abHeroContent',{yPercent:-18,ease:'none',scrollTrigger:{trigger:'#ab-hero',start:'top top',end:'bottom top',scrub:1.5}});
    }
    if (document.querySelector('.ab-s3-panel') && document.querySelector('#ab-foundation')) {
      gsap.from('.ab-s3-panel',{y:80,stagger:.15,ease:'power3.out',scrollTrigger:{trigger:'#ab-foundation',start:'top 65%',end:'bottom 30%',scrub:.8}});
    }
    const abS5Cards = gsap.utils.toArray('.ab-s5-card');
    if (abS5Cards.length > 0) {
      abS5Cards.forEach((card,i)=>{
        gsap.from(card,{x:i%2===0?-30:30,ease:'power3.out',scrollTrigger:{trigger:card,start:'top 80%'}});
      });
    }
  }
});
