<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Fortune One CRM | Secure Login</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/website/images/logo.png') ?>"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- User's Live Tailwind Config -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed": "#151c27",
                        "on-primary-fixed": "#141b2b",
                        "background": "#f8f9fb",
                        "error-container": "#ffdad6",
                        "inverse-primary": "#c0c6db",
                        "surface": "#f8f9fb",
                        "on-primary-fixed-variant": "#404758",
                        "outline": "#76777d",
                        "primary-fixed-dim": "#c0c6db",
                        "primary": "#000000",
                        "inverse-on-surface": "#f0f1f3",
                        "on-secondary-fixed-variant": "#404754",
                        "surface-tint": "#575e70",
                        "on-surface": "#191c1e",
                        "on-secondary-container": "#5e6572",
                        "on-tertiary-fixed-variant": "#454748",
                        "tertiary": "#000000",
                        "on-surface-variant": "#45464c",
                        "on-primary-container": "#7d8497",
                        "surface-bright": "#f8f9fb",
                        "on-tertiary-fixed": "#191c1d",
                        "tertiary-fixed": "#e1e3e4",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#dce2f3",
                        "surface-container-low": "#f3f4f6",
                        "surface-dim": "#d9dadc",
                        "on-tertiary-container": "#828485",
                        "outline-variant": "#c6c6cd",
                        "on-secondary": "#ffffff",
                        "primary-container": "#141b2b",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-background": "#191c1e",
                        "secondary": "#585f6c",
                        "primary-fixed": "#dce2f7",
                        "tertiary-fixed": "#e1e3e4",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#e1e2e4",
                        "surface-variant": "#e1e2e4",
                        "secondary-fixed-dim": "#c0c7d6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "4px",
                        "lg": "24px",
                        "unit": "4px",
                        "gutter": "24px",
                        "xl": "48px",
                        "container-max": "1440px",
                        "margin-mobile": "16px",
                        "sm": "8px",
                        "xxl": "80px",
                        "md": "16px"
                    },
                    "fontFamily": {
                        "headline-lg": ["Geist"],
                        "label-md": ["Geist"],
                        "display-lg": ["Geist"],
                        "body-lg": ["Geist"],
                        "headline-md": ["Geist"],
                        "body-md": ["Geist"]
                    },
                    "fontSize": {
                        "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                        "label-md": ["13px", {"lineHeight": "1.2", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "500"}],
                        "body-md": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <link href="<?= base_url('assets/crm/css/admin.css') ?>" rel="stylesheet"/>
    <style>
        body { font-family: 'Geist', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-crm-gradient { background: linear-gradient(135deg, #FFF9F3 0%, #F5EDE4 100%); }
    </style>
</head>
<body class="antialiased min-h-screen flex bg-[#FCFBF9] text-[#1C222E]">

<!-- Left Side -->
<section class="hidden lg:flex flex-col w-1/2 relative overflow-hidden px-16 py-12 border-r border-gray-200">
    <!-- Subtle Background watermark -->
    <div class="absolute right-[-10%] top-[10%] w-[80%] h-full opacity-5 pointer-events-none" style="background-image: url('<?= base_url('assets/website/images/logo.png') ?>'); background-size: contain; background-repeat: no-repeat;"></div>

    <!-- Header / Logo -->
    <div class="z-10 mb-12">
        <img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One Logo" class="h-12 w-auto">
    </div>

    <!-- Main Content -->
    <div class="z-10 max-w-[500px] flex-1 flex flex-col justify-center">
        <p class="text-xs font-bold tracking-[0.15em] text-[#B48A5E] uppercase mb-4">Enterprise CRM Platform</p>
        
        <h1 class="text-[56px] leading-[1.1] mb-6 tracking-tight">
            <span class="font-serif font-semibold text-[#1C222E]">Fortune One</span> 
            <span class="font-serif font-bold text-[#B48A5E]">CRM</span>
        </h1>
        
        <p class="text-[17px] text-gray-600 leading-relaxed font-medium mb-10 max-w-[400px]">
            Manage leads, advisor interactions, appointments, customer journeys, and project inquiries in one secure ecosystem.
        </p>

        <!-- Feature List -->
        <div class="space-y-6 mb-12">
            <!-- Item 1 -->
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#F5EDE4] text-[#B48A5E] flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[20px]">person_search</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1C222E]">Lead Management</h3>
                    <p class="text-xs text-gray-500 mt-1">Capture, track and convert quality leads</p>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#F5EDE4] text-[#B48A5E] flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[20px]">event_available</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1C222E]">Appointment Scheduling</h3>
                    <p class="text-xs text-gray-500 mt-1">Schedule and manage advisor appointments</p>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#F5EDE4] text-[#B48A5E] flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[20px]">work</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1C222E]">Career Applications</h3>
                    <p class="text-xs text-gray-500 mt-1">Review and manage prospective candidate applications</p>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#F5EDE4] text-[#B48A5E] flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[20px]">inbox</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#1C222E]">Enquiries Management</h3>
                    <p class="text-xs text-gray-500 mt-1">Manage and follow up on general and project inquiries</p>
                </div>
            </div>
        </div>

        <!-- Dashboard Image Mockup -->
        <div class="relative w-[120%] max-w-[600px] rounded-xl shadow-[0_20px_40px_rgba(0,0,0,0.08)] overflow-hidden border border-gray-100 bg-white">
            <img src="<?= base_url('assets/crm/images/dashboard-mockup.png') ?>" alt="Dashboard Mockup" class="w-full h-auto object-cover object-left-top max-h-[220px]">
        </div>
    </div>

    <!-- Footer -->
    <div class="z-10 mt-auto pt-8">
        <p class="text-[11px] text-gray-400 font-medium">© 2024 Fortune One Group. All rights reserved.</p>
    </div>
</section>

<!-- Right Side -->
<section class="flex-1 flex justify-center items-center p-8 relative overflow-hidden bg-crm-gradient">
    <!-- Balloon Background Subtle Integration -->
    <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('<?= base_url('crm-baloon.webp') ?>'); background-size: cover; background-position: center; mix-blend-mode: multiply;"></div>
    
    <div class="z-10 w-full max-w-[440px] relative">
        <!-- Floating Logo Badge -->
        <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-[0_10px_30px_rgba(180,138,94,0.15)] z-20 border-[6px] border-[#FDFBF9]">
            <img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Logo" class="h-8 w-auto">
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[32px] pt-14 pb-10 px-10 shadow-[0_30px_60px_rgba(0,0,0,0.05)] border border-white/50 relative z-10">
            
            <div class="text-center mb-8">
                <h2 class="font-serif text-[28px] font-bold text-[#1C222E] mb-2 tracking-tight">Welcome Back</h2>
                <p class="text-[13px] text-gray-500 font-medium">Sign in to access your dashboard</p>
            </div>

            <!-- PRESERVED LIVE FORM -->
            <form class="space-y-5" id="loginForm" action="<?= base_url('admin') ?>" method="POST">
                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-[12px] font-bold text-[#1C222E]" for="email">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[18px]">mail</span>
                        <input class="w-full h-12 pl-11 pr-4 bg-transparent border border-gray-200 rounded-xl text-[13px] text-gray-900 focus:border-[#B48A5E] focus:ring-1 focus:ring-[#B48A5E] transition-all outline-none" id="email" name="email" placeholder="admin@fortuneone.co" required type="email"/>
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label class="text-[12px] font-bold text-[#1C222E]" for="password">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[18px]">lock</span>
                        <input class="w-full h-12 pl-11 pr-11 bg-transparent border border-gray-200 rounded-xl text-[13px] text-gray-900 focus:border-[#B48A5E] focus:ring-1 focus:ring-[#B48A5E] transition-all outline-none" id="password" name="password" placeholder="••••••••" required type="password"/>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#B48A5E] transition-colors" type="button" onclick="document.getElementById('password').type = document.getElementById('password').type === 'password' ? 'text' : 'password'">
                            <span class="material-symbols-outlined text-[18px]" id="passwordIcon">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between pt-1 pb-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input class="w-3.5 h-3.5 border-gray-300 rounded text-[#B48A5E] focus:ring-[#B48A5E]" type="checkbox"/>
                        <span class="text-[12px] text-gray-500 font-medium group-hover:text-gray-800 transition-colors">Remember me</span>
                    </label>
                    <a class="text-[12px] font-bold text-[#B48A5E] hover:text-[#99734e] transition-colors" href="<?= base_url('forgot-password') ?>">Forgot Password?</a>
                </div>

                <!-- Submit Button with live loading state -->
                <button class="w-full h-12 bg-[#121824] hover:bg-black text-white rounded-xl text-[14px] font-medium transition-all shadow-md flex items-center justify-center gap-2" id="submitBtn" type="submit">
                    <span id="btnText" class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        Sign In
                    </span>
                    <div class="hidden items-center justify-center gap-1" id="loadingState">
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                        <span class="ml-2 opacity-80">Authenticating...</span>
                    </div>
                </button>
                <?= csrf_field() ?>
            </form>
            
            <!-- Live Validation Error Area -->
            <div class="mt-6 hidden" id="errorArea">
                <div class="p-3 bg-red-50 text-red-700 rounded-xl border border-red-100 flex items-start gap-2 text-[13px]">
                    <span class="material-symbols-outlined text-[16px]">error</span>
                    <p class="font-medium" id="errorMessage">Invalid credentials. Please contact your system administrator.</p>
                </div>
            </div>

            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                <div class="flex items-center justify-center gap-1.5 mb-1.5 text-[#B48A5E]">
                    <span class="material-symbols-outlined text-[16px]">verified_user</span>
                    <span class="text-[12px] font-bold tracking-wide">Secure Enterprise Access</span>
                </div>
                <p class="text-[11px] text-gray-500 font-medium">Trusted by Advisors & Teams Worldwide</p>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/crm/js/admin.js') ?>"></script>
</body>
</html>
