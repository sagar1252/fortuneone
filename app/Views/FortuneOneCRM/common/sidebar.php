<!-- Sidebar Wrapper (Hidden on mobile) -->
<aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-[#121824] border-r border-gray-800 flex flex-col py-8 z-50 -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <a href="<?= base_url('dashboard') ?>" class="px-6 mb-10 hover:opacity-90 transition-opacity flex flex-col items-center">
        <!-- Logo inverted for dark background -->
        <div style="filter: brightness(0) invert(1) sepia(1) saturate(5) hue-rotate(350deg) brightness(0.9);">
             <img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Fortune One Logo" class="h-10 w-auto mb-2">
        </div>
        <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] text-center font-bold mt-2 leading-relaxed">Property Intelligence<br>Platform</p>
    </a>
    <nav class="flex-1 px-4 space-y-2 flex flex-col">
        <?php $currentUri = current_url(); ?>
        <?php if ($isAdmin ?? true || in_array('dashboard_access', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/dashboard') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('dashboard') ?>">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                Dashboard
            </a>
        <?php endif; ?>
        
        <?php if ($isAdmin ?? true || in_array('dashboard_access', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/analytics') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('analytics') ?>">
                <span class="material-symbols-outlined text-[20px]">insert_chart</span>
                Analytics
            </a>
        <?php endif; ?>
        
        <?php /* if (($isAdmin ?? true) || in_array('lead_management', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/leads') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('leads') ?>">
                <span class="material-symbols-outlined text-[20px]">person_search</span>
                Leads
            </a>
        <?php endif; */ ?>
        
        <?php if (($isAdmin ?? true) || in_array('appointments_access', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/appointments') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('appointments') ?>">
                <span class="material-symbols-outlined text-[20px]">event_available</span>
                Appointments
            </a>
        <?php endif; ?>
        
        <?php if (($isAdmin ?? true) || in_array('careers_access', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/careers') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('careers') ?>">
                <span class="material-symbols-outlined text-[20px]">work</span>
                Career Applications
            </a>
        <?php endif; ?>
        
        <?php if (($isAdmin ?? true) || in_array('enquiries_access', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/enquiries') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('enquiries') ?>">
                <span class="material-symbols-outlined text-[20px]">inbox</span>
                Enquiries
            </a>
        <?php endif; ?>
        
        <?php if (($isAdmin ?? true) || in_array('users_manage', $userPermissions ?? [])): ?>
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/users') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('users') ?>">
                <span class="material-symbols-outlined text-[20px]">group</span>
                Users
            </a>
        <?php endif; ?>
        
        <div class="mt-auto flex flex-col gap-2 pt-6 border-t border-gray-800">
            <a class="flex items-center gap-3 px-4 py-2.5 <?= str_contains($currentUri, 'crm/settings') ? 'text-[#B48A5E] font-bold bg-[#1A2235] rounded-xl border-l-2 border-[#B48A5E]' : 'text-gray-400 hover:text-white hover:bg-[#1A2235] rounded-xl transition-colors font-medium' ?> text-[13px]" href="<?= base_url('settings') ?>">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                Settings
            </a>
            
            <!-- Logout Button moved here -->
            <a class="flex items-center gap-3 px-4 py-2.5 text-rose-400 hover:text-rose-300 hover:bg-[#1A2235] rounded-xl transition-colors font-medium text-[13px]" href="<?= base_url('logout') ?>">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Logout
            </a>
        </div>
    </nav>
</aside>
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/40 z-40 hidden" onclick="toggleSidebar()"></div>
