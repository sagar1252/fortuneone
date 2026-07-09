<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .animation-container {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 30%;
            height: 40vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: sans-serif;
            font-size: 15px;
        }

        svg {
            height: 42vh;
        }

        .page {
            height: 500vh;
        }

        .content {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            width: 500vw;
        }

        .content-section {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #FAFAF8 !important;
        }

        .content-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(140deg, rgba(26, 37, 48, 0.8) 0%, rgba(26, 37, 48, 0.3) 100%);
            z-index: 1;
        }

        .content-section:nth-child(1) { background-image: url('<?= base_url("assets/website/images/process/1.png") ?>'); }
        .content-section:nth-child(2) { background-image: url('<?= base_url("assets/website/images/process/2.png") ?>'); }
        .content-section:nth-child(3) { background-image: url('<?= base_url("assets/website/images/process/3.png") ?>'); }
        .content-section:nth-child(4) { background-image: url('<?= base_url("assets/website/images/process/4.png") ?>'); }
        .content-section:nth-child(5) { background-image: url('<?= base_url("assets/website/images/process/5.png") ?>'); }

        .content-section > div {
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 90%;
            margin-top: -10vh;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 6vw, 5.5rem);
            font-weight: 300;
            letter-spacing: -0.01em;
            margin: 0.5em 0;
            text-shadow: 0 15px 35px rgba(0,0,0,0.6);
            line-height: 1.1;
        }

        .step-num {
            display: block;
            font-size: 0.9rem;
            letter-spacing: 0.4em;
            color: #D4A574; /* Bronze pale */
            margin-bottom: 0.5rem;
            font-family: sans-serif;
            text-transform: uppercase;
        }

        p {
            font-size: 1.35rem;
            font-weight: 300;
            color: rgba(250, 250, 248, 0.85);
            padding: 0;
            margin: 0.5em 0;
            line-height: 1.6;
            text-shadow: 0 4px 15px rgba(0,0,0,0.8);
        }

        a {
            color: black;
        }

        .arrow-animated {
            font-size: 35px;
            animation: arrow-float 1s infinite;
        }

        @keyframes arrow-float {
            0% {
                transform: translateY(0);
                animation-timing-function: ease-out;
            }
            60% {
                transform: translateY(50%);
                animation-timing-function: ease-in-out;
            }
            100% {
                transform: translateY(0);
                animation-timing-function: ease-out;
            }
        }
    </style>
</head>
<body>

    <div class="page"></div>

    <div class="content">
        <div class="content-section">
            <div>
                <h1><span class="step-num">Step 01</span> Initial Consultation</h1>
                <p>Virtual meeting to understand your requirements and budget</p>
                <p class="arrow-animated" style="color: #D4A574; margin-top: 3rem;">↓</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <h1><span class="step-num">Step 02</span> Property Selection</h1>
                <p>Curated property options based on your preferences</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <h1><span class="step-num">Step 03</span> Virtual Tours</h1>
                <p>High-quality virtual tours and video calls with our team</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <h1><span class="step-num">Step 04</span> Documentation</h1>
                <p>Complete paperwork assistance and legal verification</p>
            </div>
        </div>
        <div class="content-section">
            <div>
                <h1><span class="step-num">Step 05</span> Property Handover</h1>
                <p>Seamless property handover with quality assurance</p>
                <button onclick="openBookingModal()" style="margin-top: 2rem; padding: 12px 35px; background: #D4A574; color: #1A2530; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer; font-weight: bold; font-family: sans-serif; text-transform: uppercase; letter-spacing: 1px;">Book an Appointment</button>
            </div>
        </div>
    </div>

    <div class="animation-container">
        <svg viewBox="0 -10 315 350">
            <defs>
                <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                    <feGaussianBlur stdDeviation="4" result="blur" />
                    <feComposite in="SourceGraphic" in2="blur" operator="over" />
                </filter>
            </defs>
            <g class="dude" stroke="#D4A574" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none" filter="url(#glow)">
                <g class="leg">
                    <path class="leg-bottom" d="M182,317l-10.4-2.8c-2.7-0.7-4.5-3.2-4.4-6c1.7-13,3-27,3.7-42.1c0.8-16.5,0.7-32,0.1-46.1"/>
                    <path d="M171,220l6-60"/>
                </g>
                <g class="leg">
                    <path class="leg-bottom" d="M182,317l-10.2-2.7c-2.8-0.8-4.7-3.4-4.6-6.3c-0.8-13.9-1-29.2-0.2-45.8c0.7-15.2,2.1-29.4,4-42.2"/>
                    <path d="M171,222c0.3-10,4.3-42,5.3-48"/>
                </g>

                <g class="arm">
                    <path d="M175,75c-0.6,8.7-0.6,18.9,0.8,30.1c0.6,4.6,1.3,8.9,2.2,12.9"/>
                    <path class="arm-bottom" d="M186,175c-0.2-3.1-0.4-6.2-0.7-9.3c-1.5-16.9-4.1-32.9-7.3-47.7"/>
                </g>
                <g class="arm">
                    <path d="M178.8,82.2c-1.9,13.1-1.8,25.2-0.8,35.8"/>
                    <path class="arm-bottom" d="M186,175c-2.4-7.6-4.7-16.8-6.3-27.2c-1.6-11.3-2-21.3-1.7-29.8"/>
                </g>
                <path class="head" d="M195,14.8c-10.8-5.7-23.9,1.3-28.2,12.4c-4.9,13,6.3,28.4,17.8,29.1c13.2,0.8,22.2-16.1,19.5-26.7c-1.6-6.5-5.2-7.1-5.2-7.1"/>
            </g>
        </svg>
    </div>

    <!-- GSAP Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <script>
        const dude = document.querySelector(".dude");
        const head = dude.querySelector(".head");
        const legs = Array.from(dude.querySelectorAll(".leg"));
        const arms = Array.from(dude.querySelectorAll(".arm"));
        const legBottoms = Array.from(dude.querySelectorAll(".leg-bottom"));
        const armBottoms = Array.from(dude.querySelectorAll(".arm-bottom"));

        const content = document.querySelector(".content");
        const arrowEl = document.querySelector(".arrow-animated");

        gsap.set(arms, { svgOrigin: "180 58" });
        gsap.set(head, { svgOrigin: "180 45" });
        gsap.set(armBottoms, { svgOrigin: "178 118" });
        gsap.set(legs, { svgOrigin: "177 145" });
        gsap.set(legBottoms, { svgOrigin: "171 220" });

        const halfBodyTimeline = (leg, arm) => {
            const legBottom = leg.querySelector(".leg-bottom");
            const armBottom = arm.querySelector(".arm-bottom");

            return gsap.timeline({ repeat: -1, paused: true })
                .fromTo(leg, { rotation: -25 }, { duration: .5, rotation: 15, ease: "sine.inOut" }, 0)
                .to(leg, { duration: .25, rotation: -25, ease: "sine.in" }, ">")
                .to(legBottom, { duration: .25, rotation: 15, ease: "sine.inOut" }, .25)
                .to(legBottom, { duration: .25, rotation: 80, ease: "sine.in" }, ">")
                .to(legBottom, { duration: .25, rotation: 0, ease: "sine.out" }, ">")
                .fromTo(arm, { rotation: -12 }, { duration: .5, rotation: 12, ease: "sine.inOut", yoyo: true, repeat: 1 }, 0)
                .fromTo(armBottom, { rotation: -15 }, { duration: .5, rotation: 10, ease: "sine.inOut", yoyo: true, repeat: 1 }, 0);
        }

        const backCycle = halfBodyTimeline(legs[0], arms[1]);
        const frontCycle = halfBodyTimeline(legs[1], arms[0]);

        const bodyTimeline = gsap.timeline({ paused: true })
            .to(dude, { duration: .25, y: "-=20", repeat: -1, yoyo: true, ease: "sine.inOut" }, 0)
            .fromTo(head, { rotation: -25 }, { duration: .25, rotation: 1, repeat: -1, yoyo: true, ease: "sine.inOut" }, 0);

        const numberOfCycles = Math.ceil(4 * window.innerWidth / window.innerHeight);

        gsap.timeline({
            scrollTrigger: {
                trigger: ".page",
                scrub: true,
                start: "0% 0%",
                end: "100% 100%",
            },
        })
        .to(arrowEl, { duration: .05, opacity: 0 }, 0)
        .fromTo(content, { xPercent: 0 }, { xPercent: -80, ease: "none" }, 0) 
        .fromTo(bodyTimeline, { time: .7 }, { time: .75 + numberOfCycles }, 0)
        .fromTo(backCycle, { time: .7 }, { time: .75 + numberOfCycles }, 0)
        .fromTo(frontCycle, { time: .2 }, { time: .25 + numberOfCycles }, 0);

        window.addEventListener("resize", () => {
            ScrollTrigger.refresh();
        });

        // Intro animation
        gsap.set(window, { scrollTo: 0 });
        gsap.timeline({})
            .to(window, { duration: 1.75, scrollTo: .32 * window.innerHeight, ease: "power1.inOut" }, .3);
    </script>

    <!-- Booking Modal Overlay -->
    <?= view('Website/Partials/booking_modal') ?>

</body>
</html>