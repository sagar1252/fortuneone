<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Fortune One | Create New Password</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png') ?>"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet"/>
<link href="<?= base_url('assets/crm/css/resetpassword.css') ?>" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "secondary-fixed": "#dce2f3",
                      "inverse-on-surface": "#f0f1f3",
                      "primary-container": "#141b2b",
                      "on-primary-fixed": "#141b2b",
                      "surface-variant": "#e1e2e4",
                      "on-secondary": "#ffffff",
                      "on-error": "#ffffff",
                      "tertiary": "#000000",
                      "primary": "#000000",
                      "surface-container-lowest": "#ffffff",
                      "surface-container": "#edeef0",
                      "on-secondary-container": "#5e6572",
                      "surface-dim": "#d9dadc",
                      "secondary-fixed-dim": "#c0c7d6",
                      "surface-bright": "#f8f9fb",
                      "surface-container-low": "#f3f4f6",
                      "surface-container-highest": "#e1e2e4",
                      "tertiary-fixed-dim": "#c5c7c8",
                      "on-tertiary-fixed": "#191c1d",
                      "surface-container-high": "#e7e8ea",
                      "outline-variant": "#c6c6cd",
                      "on-primary-container": "#7d8497",
                      "on-background": "#191c1e",
                      "primary-fixed-dim": "#c0c6db",
                      "on-primary": "#ffffff",
                      "surface-tint": "#575e70",
                      "primary-fixed": "#dce2f7",
                      "tertiary-fixed": "#e1e3e4",
                      "on-surface": "#191c1e",
                      "on-tertiary-fixed-variant": "#454748",
                      "on-secondary-fixed-variant": "#404754",
                      "background": "#f8f9fb",
                      "inverse-primary": "#c0c6db",
                      "outline": "#76777d",
                      "surface": "#f8f9fb",
                      "on-tertiary": "#ffffff",
                      "secondary-container": "#dce2f3",
                      "error-container": "#ffdad6",
                      "inverse-surface": "#2e3132",
                      "error": "#ba1a1a",
                      "on-tertiary-container": "#828485",
                      "tertiary-container": "#191c1d",
                      "secondary": "#585f6c",
                      "on-error-container": "#93000a",
                      "on-surface-variant": "#45464c",
                      "on-primary-fixed-variant": "#404758",
                      "on-secondary-fixed": "#151c27"
              },
              "borderRadius": {
                      "DEFAULT": "0.25rem",
                      "lg": "0.5rem",
                      "xl": "0.75rem",
                      "full": "9999px"
              },
              "spacing": {
                      "xl": "48px",
                      "margin-mobile": "16px",
                      "xxl": "80px",
                      "unit": "4px",
                      "md": "16px",
                      "gutter": "24px",
                      "sm": "8px",
                      "xs": "4px",
                      "container-max": "1440px",
                      "lg": "24px"
              },
              "fontFamily": {
                      "headline-lg-mobile": ["Geist"],
                      "body-lg": ["Geist"],
                      "headline-lg": ["Geist"],
                      "label-md": ["Geist"],
                      "label-sm": ["Geist"],
                      "display-lg": ["Geist"],
                      "body-md": ["Geist"],
                      "headline-md": ["Geist"]
              },
              "fontSize": {
                      "headline-lg-mobile": ["24px", {"lineHeight": "1.2", "fontWeight": "600"}],
                      "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                      "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                      "label-md": ["13px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "500"}],
                      "label-sm": ["11px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                      "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                      "body-md": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}],
                      "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "500"}]
              }
            },
          },
        }
      </script>
</head>
<body class="bg-background min-h-screen flex items-center justify-center p-md sm:p-lg">
<!-- Content Container -->
<main class="w-full max-w-[480px] space-y-xl">
<!-- Brand Identity -->
<div class="flex justify-center flex-col items-center mb-6">
<img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One Logo" class="h-12 w-auto mb-4">
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-[0.2em]">Property Intelligence Platform</p>
</div>
<!-- Main Reset Password Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-xl luxury-shadow transition-all duration-500 ease-in-out" id="reset-card">
<!-- Header Section -->
<div class="text-center mb-xl">
<h1 class="text-headline-lg font-headline-lg text-on-surface mb-xs">Create New Password</h1>
<p class="text-body-md font-body-md text-on-surface-variant max-w-[320px] mx-auto">
                    Your new password must be secure and meet the account security requirements.
                </p>
</div>
<!-- Form -->
<form class="space-y-md" id="reset-form" action="<?= base_url('reset-password') ?>" onsubmit="return handleReset(event)">
<input type="hidden" name="token" value="<?= esc($token) ?>">
<!-- Readonly Email Field -->
<div class="space-y-xs">
<label class="text-label-sm font-label-sm text-on-surface uppercase tracking-wider">Email Address</label>
<div class="relative">
<input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-md py-3 text-body-md font-body-md text-on-surface-variant cursor-not-allowed focus:ring-0 focus:border-outline-variant" readonly="" type="email" value="<?= esc($email) ?>"/>
<span class="absolute right-md top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[18px]">lock</span>
</div>
</div>
<!-- New Password Field -->
<div class="space-y-xs">
<label class="text-label-sm font-label-sm text-on-surface uppercase tracking-wider" for="new_password">New Password</label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-md py-3 text-body-md font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-surface-container-high transition-all duration-200" id="new_password" placeholder="••••••••" required="" type="password"/>
<button class="absolute right-md top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" onclick="togglePassword('new_password')" type="button">
<span class="material-symbols-outlined text-[20px]" id="icon-new_password">visibility_off</span>
</button>
</div>
</div>
<!-- Confirm Password Field -->
<div class="space-y-xs">
<label class="text-label-sm font-label-sm text-on-surface uppercase tracking-wider" for="confirm_password">Confirm Password</label>
<div class="relative">
<input class="w-full bg-white border border-outline-variant rounded-lg px-md py-3 text-body-md font-body-md text-on-surface focus:outline-none focus:border-primary focus:ring-2 focus:ring-surface-container-high transition-all duration-200" id="confirm_password" placeholder="••••••••" required="" type="password"/>
<button class="absolute right-md top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" onclick="togglePassword('confirm_password')" type="button">
<span class="material-symbols-outlined text-[20px]" id="icon-confirm_password">visibility_off</span>
</button>
</div>
</div>
<!-- Password Requirements Checklist -->
<div class="bg-surface-container-low rounded-lg p-md space-y-sm">
<h3 class="text-label-sm font-label-sm text-on-surface-variant uppercase mb-2">Security Checklist</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2">
<div class="requirement-item flex items-center gap-xs text-on-surface-variant transition-colors duration-200" id="req-length">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span class="text-label-md font-label-md">8+ characters</span>
</div>
<div class="requirement-item flex items-center gap-xs text-on-surface-variant transition-colors duration-200" id="req-upper">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span class="text-label-md font-label-md">Uppercase letter</span>
</div>
<div class="requirement-item flex items-center gap-xs text-on-surface-variant transition-colors duration-200" id="req-lower">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span class="text-label-md font-label-md">Lowercase letter</span>
</div>
<div class="requirement-item flex items-center gap-xs text-on-surface-variant transition-colors duration-200" id="req-number">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span class="text-label-md font-label-md">One number</span>
</div>
<div class="requirement-item flex items-center gap-xs text-on-surface-variant transition-colors duration-200" id="req-special">
<span class="material-symbols-outlined text-[16px]">check_circle</span>
<span class="text-label-md font-label-md">Special character</span>
</div>
</div>
</div>
<!-- Error Message Placeholder -->
<div class="hidden-state flex items-start gap-sm p-sm bg-error-container/30 border border-error/10 rounded-lg" id="error-message">
<span class="material-symbols-outlined text-error text-[20px]">error</span>
<span class="text-label-md font-label-md text-on-error-container" id="error-text">Passwords do not match.</span>
</div>
<!-- Submit Button -->
<div class="pt-sm">
<button class="w-full bg-[#111827] text-white py-3 rounded-lg text-body-md font-body-md font-medium milled-button hover:bg-black transition-all duration-200 focus:ring-4 focus:ring-surface-container-high" type="submit">
                        Reset Password
                    </button>
</div>

    <?= csrf_field() ?>
</form>
<div class="mt-xl text-center">
<a class="text-label-md font-label-md text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center gap-xs" href="<?= base_url('admin') ?>">
<span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Back to Sign In
                </a>
</div>
</div>
<!-- Success Card (Hidden initially) -->
<div class="hidden-state bg-surface-container-lowest border border-outline-variant rounded-xl p-xl luxury-shadow text-center animate-in fade-in zoom-in duration-500" id="success-card">
<div class="mb-lg flex justify-center">
<div class="w-16 h-16 bg-surface-container-high rounded-full flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-[40px]" style="font-variation-settings: 'FILL' 1;">verified</span>
</div>
</div>
<h1 class="text-headline-lg font-headline-lg text-on-surface mb-xs">Password Updated</h1>
<p class="text-body-md font-body-md text-on-surface-variant mb-xl">
                Your security credentials have been successfully updated. You can now access your Fortune One dashboard.
            </p>
<button class="w-full bg-[#111827] text-white py-3 rounded-lg text-body-md font-body-md font-medium milled-button hover:bg-black transition-all duration-200" onclick="window.location.href='<?= base_url('admin') ?>'">
                Return to Login
            </button>
</div>
<!-- Footer Info -->
<footer class="text-center space-y-md">
<p class="text-label-sm font-label-sm text-on-tertiary-fixed-variant opacity-60">
                © 2024 Fortune One Financial. All rights reserved.
            </p>
<div class="flex items-center justify-center gap-md">
<a class="text-label-sm font-label-sm text-on-tertiary-fixed-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
<span class="w-1 h-1 bg-outline-variant rounded-full"></span>
<a class="text-label-sm font-label-sm text-on-tertiary-fixed-variant hover:text-primary transition-colors" href="#">Security Center</a>
</div>
</footer>
</main>
<script src="<?= base_url('assets/crm/js/resetpassword.js?v=' . time()) ?>"></script>
</body></html>