<div class="relative inline-block text-left" id="profile-container">
    <!-- Clickable Profile Button -->
    <button id="profile-btn" class="flex items-center gap-3 hover:bg-gray-50 p-2 rounded-xl transition-colors cursor-pointer group focus:outline-none w-full">
        <div class="text-right hidden sm:block">
            <p class="text-[13px] font-bold text-[#1C222E] leading-tight group-hover:text-[#B48A5E] transition-colors"><?= esc($user_name ?? 'Admin') ?></p>
            <p class="text-[11px] font-medium text-gray-500"><?= esc($user_role_label ?? 'Administrator') ?></p>
        </div>
        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white shadow-sm">
            <!-- Image with fallback -->
            <img class="w-full h-full object-cover" src="<?= esc($user_avatar ?? base_url('assets/website/images/default-avatar.png')) ?>" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name=Admin&background=F5EDE4&color=B48A5E&bold=true';" alt="Profile"/>
        </div>
        <span class="material-symbols-outlined text-[18px] text-gray-400 group-hover:text-[#B48A5E] hidden sm:block">expand_more</span>
    </button>

    <!-- Dropdown Menu -->
    <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-56 rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.08)] bg-white border border-gray-100 z-50 overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-50 bg-gray-50/50">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Signed in</p>
            <p class="text-[12px] font-semibold text-gray-600 truncate"><?= esc($user_email ?? 'admin@fortuneone.com') ?></p>
        </div>
        
        <div class="py-2">
            <a href="<?= base_url('settings') ?>" class="flex items-center gap-3 px-4 py-2 text-[13px] font-medium text-gray-700 hover:text-[#B48A5E] hover:bg-gray-50 transition-colors">
                <span class="material-symbols-outlined text-[18px]">person</span>
                Update Profile Info
            </a>
        </div>
        
        <div class="border-t border-gray-50 py-2">
            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-4 py-2 text-[13px] font-medium text-rose-600 hover:bg-rose-50 transition-colors">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                Logout
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var profileBtn = document.getElementById('profile-btn');
        var profileDropdown = document.getElementById('profile-dropdown');

        if(profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!profileDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
