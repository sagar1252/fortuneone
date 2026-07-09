<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Fortune One | Forgot Password</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png') ?>"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-fixed-dim": "#c0c7d6",
                        "surface-variant": "#e1e2e4",
                        "surface-container-highest": "#e1e2e4",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "tertiary-fixed-dim": "#c5c7c8",
                        "surface-container": "#edeef0",
                        "surface-container-high": "#e7e8ea",
                        "inverse-surface": "#2e3132",
                        "tertiary-container": "#191c1d",
                        "secondary-fixed": "#dce2f3",
                        "secondary": "#585f6c",
                        "primary-fixed": "#dce2f7",
                        "on-background": "#191c1e",
                        "on-error-container": "#93000a",
                        "surface-container-lowest": "#ffffff",
                        "on-primary": "#ffffff",
                        "primary-container": "#141b2b",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#c6c6cd",
                        "on-tertiary-container": "#828485",
                        "surface-dim": "#d9dadc",
                        "surface-container-low": "#f3f4f6",
                        "secondary-container": "#dce2f3",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#e1e3e4",
                        "on-tertiary-fixed": "#191c1d",
                        "surface-bright": "#f8f9fb",
                        "on-primary-container": "#7d8497",
                        "on-surface-variant": "#45464c",
                        "tertiary": "#000000",
                        "on-tertiary-fixed-variant": "#454748",
                        "on-surface": "#191c1e",
                        "on-secondary-container": "#5e6572",
                        "surface-tint": "#575e70",
                        "on-secondary-fixed-variant": "#404754",
                        "inverse-on-surface": "#f0f1f3",
                        "primary": "#000000",
                        "primary-fixed-dim": "#c0c6db",
                        "outline": "#76777d",
                        "on-primary-fixed-variant": "#404758",
                        "surface": "#f8f9fb",
                        "inverse-primary": "#c0c6db",
                        "error-container": "#ffdad6",
                        "background": "#f8f9fb",
                        "on-secondary-fixed": "#151c27",
                        "on-primary-fixed": "#141b2b"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "sm": "8px",
                        "xxl": "80px",
                        "md": "16px",
                        "xs": "4px",
                        "lg": "24px",
                        "xl": "48px",
                        "unit": "4px",
                        "gutter": "24px",
                        "container-max": "1440px",
                        "margin-mobile": "16px"
                    },
                    "fontFamily": {
                        "headline-md": ["Geist"],
                        "body-md": ["Geist"],
                        "headline-lg": ["Geist"],
                        "label-md": ["Geist"],
                        "headline-lg-mobile": ["Geist"],
                        "display-lg": ["Geist"],
                        "body-lg": ["Geist"],
                        "label-sm": ["Geist"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", { "lineHeight": "1.3", "fontWeight": "500" }],
                        "body-md": ["14px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "label-md": ["13px", { "lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "500" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "1.2", "fontWeight": "600" }],
                        "display-lg": ["48px", { "lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "label-sm": ["11px", { "lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600" }]
                    }
                },
            },
        }
    </script>
<link href="<?= base_url('assets/crm/css/forgotpassword.css') ?>" rel="stylesheet"/>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col justify-center items-center px-margin-mobile md:px-lg">
<!-- Header / Brand Section -->
<header class="mb-xl text-center flex flex-col items-center">
<img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One Logo" class="h-12 w-auto mb-4">
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-[0.2em]">Property Intelligence Platform</p>
</header>
<main class="w-full max-w-[480px]">
<!-- Reset Password Form Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-xl md:p-xxl shadow-executive transition-all duration-300" id="reset-card">
<div id="form-container">
<div class="mb-xl">
<h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface mb-sm">Forgot Your Password?</h2>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Enter your registered email address and we'll send you instructions to reset your password.
                    </p>
</div>
<form class="space-y-lg" id="forgot-password-form" action="<?= base_url('forgot-password') ?>" onsubmit="handleReset(event)">
<div class="space-y-xs">
<label class="font-label-md text-label-md text-on-surface-variant block" for="email">Email Address</label>
<input class="w-full h-12 px-md bg-surface-container-lowest border border-outline-variant rounded transition-all duration-200 font-body-md text-body-md text-on-surface placeholder:text-outline focus:outline-none form-focus-ring" id="email" name="email" placeholder="e.g. alexander@fortuneone.com" required="" type="email"/>
<p class="hidden text-[12px] font-medium text-[#EF4444] mt-1" id="error-message">Please enter a valid business email address.</p>
</div>
<button class="w-full h-12 bg-[#111827] text-[#FFFFFF] font-semibold rounded hover:bg-on-surface transition-colors duration-200 shadow-sm border-t border-white/10" type="submit">
                        Send Reset Link
                    </button>

    <?= csrf_field() ?>
</form>
<div class="mt-xl text-center border-t border-outline-variant pt-lg">
<a class="inline-flex items-center gap-xs font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="<?= base_url('admin') ?>">
<span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Back to Login
                    </a>
</div>
</div>
<!-- Success State (Hidden by default) -->
<div class="hidden text-center" id="success-container">
<div class="mb-lg flex justify-center">
<div class="w-12 h-12 bg-surface-container rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-on-surface-variant" style="font-variation-settings: 'FILL' 1;">mark_email_read</span>
</div>
</div>
<h2 class="font-headline-md text-headline-md text-on-surface mb-sm">Email Sent</h2>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-xl">
                    Reset link sent successfully. If an account exists for the provided email address, password reset instructions have been sent.
                </p><div class="mt-lg pt-lg border-t border-outline-variant/30 text-center">
                <button class="w-full h-12 bg-surface-container text-on-surface font-semibold rounded hover:bg-surface-container-high transition-colors duration-200" onclick="window.location.href='<?= base_url('admin') ?>'">
                    Return to Login
                </button>
<button class="w-full text-center font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" onclick="handleReset(event)">
                        Resend Email
                    </button>
</div>
</div>
</div>
<!-- Footer / Support Info -->
<footer class="mt-xl text-center">
<p class="font-label-sm text-label-sm text-outline uppercase tracking-widest">
                Protected by Fortune One Security Systems
            </p>
</footer>
</main>
<script src="<?= base_url('assets/crm/js/forgotpassword.js') ?>"></script>
</body></html>