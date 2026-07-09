<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<style>
    #hero-section {
        margin: 0;
        padding: 0;
        overflow: hidden;
        font-family: 'Roboto Condensed', sans-serif;
        color: #fff;
        height: 100vh;
        position: relative;
        background: #000;
        width: 100%;
    }

    #hero-section a {
        color: #fff;
    }

    #hero-section .canvasWrap {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    #hero-section canvas {
        display: block;
    }

    #hero-section .images {
        display: none;
    }

    #hero-section .load {
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #FAFAF8 0%, #C18A56 50%, #9E693D 100%);
        position: absolute;
        top: 0;
        left: 0;
        z-index: 20;
        box-shadow: 0 0 8px rgba(193, 138, 86, 0.8), 0 0 3px rgba(193, 138, 86, 0.4);
    }

    #hero-section .captions {
        position: absolute;
        bottom: 5%;
        left: 5%;
        z-index: 20;
        color: #fff;
        width: 90%;
        height: 260px;
        overflow: visible;
    }

    #hero-section .captions .countWrap {
        float: left;
        margin-right: 45px;
        overflow: hidden;
        height: 230px;
    }

    #hero-section .captions .count {
        font-family: 'Cormorant Garamond', serif;
        font-size: 220px;
        font-weight: 700;
        margin: 0;
        line-height: 0.8;
        color: #FDFBF7;
        text-shadow: 
            1px 1px 0px #9E693D,
            2px 2px 0px #8A572D,
            3px 3px 0px #704523,
            4px 4px 0px #573419,
            5px 5px 0px #3D220E,
            6px 6px 0px #241103,
            7px 7px 0px #0d0600,
            20px 20px 30px rgba(0,0,0,0.85),
            30px 30px 60px rgba(0,0,0,0.65);
    }

    #hero-section .captions .title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 55px;
        font-weight: 600;
        letter-spacing: 1px;
        line-height: 1.2;
        margin: 0;
        color: #FDFBF7;
        text-shadow: 
            1px 1px 0px #9E693D,
            2px 2px 0px #8A572D,
            3px 3px 0px #704523,
            4px 4px 0px #573419,
            5px 5px 0px #3D220E,
            12px 12px 25px rgba(0,0,0,0.85),
            20px 20px 45px rgba(0,0,0,0.65);
    }
    @media (max-width: 768px) {
        #hero-section .captions .title { font-size: 35px; }
    }

    #hero-section .captions .loc {
        color: rgba(221, 226, 232, 0.8);
        letter-spacing: 2px;
        font-size: 16px;
        line-height: 1;
        margin: 0;
        margin-top: 10px;
        font-weight: 300;
        text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }

    #hero-section .captions .buttonWrap {
        padding-top: 29px;
        overflow: hidden;
    }

    #hero-section .captions .titleWrap {
        margin-top: 14px;
        overflow: hidden;
    }

    #hero-section .captions .locWrap {
        overflow: hidden;
    }

    #hero-section .caption {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        visibility: hidden;
    }

    #hero-section .caption.show {
        visibility: visible;
    }

    #hero-section .button {
        background: rgba(21, 31, 40, 0.65);
        color: #FDFBF7;
        border: 1px solid rgba(193, 138, 86, 0.4);
        display: inline-block;
        padding: 8px 32px;
        text-decoration: none;
        font-size: 11px;
        letter-spacing: 2px;
        text-transform: uppercase;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        transition: all 0.4s cubic-bezier(0.25, 1, 0.22, 1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    #hero-section .button:hover, #hero-section .button:focus {
        text-decoration: none;
        color: #0D141A;
        background: linear-gradient(135deg, #FDFBF7 0%, #C18A56 50%, #9E693D 100%);
        border-color: #fff;
        box-shadow: 0 8px 25px rgba(193, 138, 86, 0.4);
        transform: translateY(-1px);
    }

    #hero-section .read {
        position: absolute;
        right: 5%;
        bottom: 7%;
        color: #fff;
        font-weight: bold;
        font-size: 20px;    
        z-index: 30;
        text-decoration: none;
    }

    #hero-section .read:before {
        content: '';
        right: -25px;
        position: absolute;
        left: -25px;
        bottom: -10px;
        height: 1px;
        background: #fff;
        transition: all .4s ease-in-out;
    }

    #hero-section .read:hover, #hero-section .read:focus {
        color: #fff;
        text-decoration: none;
    }

    #hero-section .read:hover:before, #hero-section .read:focus:before {
        left: -40px;
        right: -40px;
    }
    
    
    
</style>

<section id="hero-section">
    <div class="load"></div>

    <div class="canvasWrap">
        <canvas id="canvas"></canvas>
    </div>

    <div class="images">
        <img width="200" id="image1" src="<?= base_url('assets/website/images/Baner/slider1.webp') ?>" alt="Slider 1">
        <img width="200" id="image2" class="active" src="<?= base_url('assets/website/images/Baner/slider2.webp') ?>" alt="Slider 2">
        <img width="200" id="image3" src="<?= base_url('assets/website/images/Baner/slider3.webp') ?>" alt="Slider 3">
    </div>

    <div class="captions">
        <div class="caption show">
            <div class="countWrap"><p class="count">01</p></div>
            <div class="buttonWrap"><a href="#" class="button">Vision</a></div>
            <div class="titleWrap"><h1 class="title" style="margin:0;">Where vision meets reality.<br>Elevating your everyday.</h1></div>
            <div class="locWrap"><p class="loc">Fortune One Group</p></div>
        </div>
        <div class="caption">
            <div class="countWrap"><p class="count">02</p></div>
            <div class="buttonWrap"><a href="#" class="button">Legacy</a></div>
            <div class="titleWrap"><p class="title">Building beyond structures.<br>Crafting timeless legacies.</p></div>
            <div class="locWrap"><p class="loc">Fortune One Group</p></div>
        </div>
        <div class="caption">
            <div class="countWrap"><p class="count">03</p></div>
            <div class="buttonWrap"><a href="#" class="button">Sanctuary</a></div>
            <div class="titleWrap"><p class="title">Invest in your sanctuary.<br>The foundation of a good life.</p></div>
            <div class="locWrap"><p class="loc">Fortune One Group</p></div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    let settings = {};
    settings.cols = 20;
    settings.rows = 20;
    // target canvas inside hero-section to avoid conflict
    let canvas = $('#hero-section #canvas')[0];
    let context = canvas.getContext('2d');
    let toggle1 = $('#hero-section #image1')[0];
    let toggle2 = $('#hero-section #image2')[0];
    let image1 = $('#hero-section #image1')[0];
    let image2 = $('#hero-section #image2')[0];
    let image3 = $('#hero-section #image3')[0];
    let imageArray = [image1, image2, image3];
    let nextImageIdx = 1;
    let newcanvas = $('<canvas></canvas>')[0];
    let newcontext = newcanvas.getContext('2d');
    let state = {pos:2};
    let xw,xh,delay;
    let windowW = $('#hero-section').width();
    let windowH = $('#hero-section').height();

    // GSAP 3 timeline for image transitions
    let tl = gsap.timeline();
    let scaleFrom = 1.2;

    var autoplay = 5000;

    // Immediately hide all text so it's not visible while the loader slides up
    gsap.set('#hero-section .count, #hero-section .title, #hero-section .loc', {y: '-100%'});
    gsap.set('#hero-section .button', {y: '-200%'});

    // Initial load animation for slide 1 using a fresh GSAP 3 timeline
    function playInitialText() {
        let tlText = gsap.timeline();
        tlText.to('#hero-section .show .count', {duration: 1, ease: 'power2.inOut', y: '0%'})
              .to('#hero-section .show .button', {duration: 1, ease: 'power2.inOut', y: '0%'}, '-=0.9')
              .to('#hero-section .show .title, #hero-section .show .loc', {duration: 1, ease: 'power2.inOut', y: '0%'}, '-=0.8')
              .to('#hero-section .show .count, #hero-section .show .title, #hero-section .show .loc, #hero-section .show .button', {duration: 1, ease: 'power2.inOut', y: '170%'}, '+=2.8');
    }
    
    // Do NOT play initial text here. Wait for initHero()
    // playInitialText();

    function clamp(min,mid,max){
      return mid < min ? min : mid < max ? mid : max
    }
    function setCanvasSize(c) {
        c.width = windowW;
        c.height = windowH;    
        $(c).css('width', windowW);
        $(c).css('height', windowH);
    }

    setCanvasSize(canvas);
    setCanvasSize(newcanvas);

    $(window).on('resize', function() {
        windowW = $('#hero-section').width();
        windowH = $('#hero-section').height();
        setCanvasSize(canvas);
        setCanvasSize(newcanvas);
    });

    function RenderTempCanvas() {
        newcontext.clearRect(0,0,windowW,windowH);
        
        if(toggle2.complete && toggle2.naturalHeight !== 0) {
           newcontext.drawImage(toggle2, 0,0, windowW, windowH);
        }

        xw = windowW/settings.cols;
        xh = windowH/settings.rows;
        for (var i = 0; i<=settings.cols; i++) {
            for (var j = 0; j<=settings.rows; j++) {
                delay = (j*i)/(settings.cols*settings.rows);
                newcontext.clearRect(i*xw,j*xh,xw*clamp(state.pos -delay,0,1),xh*clamp(state.pos - delay,0,1));
            }
        }
    }

    function render(imageT) {
        context.clearRect(0,0,windowW,windowH);
        if(imageT.complete && imageT.naturalHeight !== 0) {
            context.drawImage(imageT, 0,0, windowW, windowH);
        }
        RenderTempCanvas();
        context.drawImage(newcanvas, 0,0, windowW, windowH);    
    }

    function draw() {
        render(toggle1);
        window.requestAnimationFrame(draw);
    }

    let isDrawing = false;
    function startDraw() {
        if (!isDrawing) {
            isDrawing = true;
            draw();
        }
    }
    
    $(window).on("load", startDraw);
    startDraw();

    window.initHomeHero = function() {
        playInitialText();
        load();

        setInterval(function() {
            Toggle()
            load();   
        }, autoplay);
    };

    function load() {
        let tlLoad = gsap.timeline();
        tlLoad.to('#hero-section .load', {duration: autoplay / 1000, ease: 'power2.inOut', width: '100%'})
              .to('#hero-section .load', {duration: 0, width: 0});
    }

    function Toggle(){
        if($('#hero-section .caption.show').is(':last-child')) {
            $('#hero-section .caption.show').removeClass('show');
            $('#hero-section .captions .caption:first-child').addClass('show');
        } else {
            $('#hero-section .caption.show').removeClass('show').next().addClass('show');
        }
        
        // Build a fresh GSAP 3 timeline for the new active slide caption transition
        let tlText = gsap.timeline();
        tlText.set('#hero-section .count, #hero-section .title, #hero-section .loc', {y: '-100%'})
              .set('#hero-section .button', {y: '-200%'})
              .to('#hero-section .show .count', {duration: 1, ease: 'power2.inOut', y: '0%'})
              .to('#hero-section .show .button', {duration: 1, ease: 'power2.inOut', y: '0%'}, '-=0.9')
              .to('#hero-section .show .title, #hero-section .show .loc', {duration: 1, ease: 'power2.inOut', y: '0%'}, '-=0.8')
              .to('#hero-section .show .count, #hero-section .show .title, #hero-section .show .loc, #hero-section .show .button', {duration: 1, ease: 'power2.inOut', y: '170%'}, '+=2.8');

        if(state.pos===2) {
            tl.to(state, {
                duration: 2, 
                pos: 0, 
                ease: 'power1.out',
                onComplete: function() {
                    nextImageIdx = (nextImageIdx + 1) % 3;
                    toggle1 = imageArray[nextImageIdx];
                }
            });
        } else {
            tl.to(state, {
                duration: 2, 
                pos: 2, 
                ease: 'power1.out',
                onComplete: function() {
                    nextImageIdx = (nextImageIdx + 1) % 3;
                    toggle2 = imageArray[nextImageIdx];
                }
            });       
        }
    }
});
</script>
