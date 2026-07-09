<!-- Top App Bar -->
<header class="fixed top-0 right-0 left-0 md:left-64 h-16 bg-white border-b border-gray-100 flex justify-between items-center px-6 z-40 shadow-sm">
    <div class="flex items-center gap-4 flex-1">
        <button onclick="toggleSidebar()" class="p-2 text-gray-500 hover:text-[#B48A5E] transition-colors md:hidden flex items-center justify-center mr-2">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
    <div class="flex items-center gap-5">
        <?= view('FortuneOneCRM/common/notification-dropdown') ?>
        
        <div class="h-8 w-[1px] bg-gray-200 hidden sm:block"></div>
        
        <?= view('FortuneOneCRM/common/user-dropdown') ?>
    </div>
</header>
