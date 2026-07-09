<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[800px] mx-auto py-8">

<!-- Page Header -->
<div class="mb-10">
    <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight leading-tight">Account Settings</h1>
    <p class="text-sm text-gray-500 mt-1 font-medium">Manage your personal account preferences and security.</p>
</div>

<!-- Profile Info Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="border-b border-gray-100 bg-[#1C222E] p-6">
        <h3 class="text-lg font-bold text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-[#B48A5E]">account_circle</span>
            Profile Information
        </h3>
    </div>
    <div class="p-8">
        <form action="<?= base_url('settings/update-profile') ?>" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-start sm:items-center gap-8">
            <div class="relative group cursor-pointer shrink-0">
                <?php if (isset($user_avatar) && $user_avatar !== base_url('assets/website/images/default-avatar.png')): ?>
                    <img src="<?= esc($user_avatar) ?>" alt="Avatar" class="h-24 w-24 rounded-full object-cover border-4 border-gray-50 shadow-sm">
                <?php else: ?>
                    <div class="h-24 w-24 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-4xl font-bold uppercase border-4 border-gray-50 shadow-sm">
                        <?= substr(esc($user_name ?? 'U'), 0, 1) ?>
                    </div>
                <?php endif; ?>
                <div class="absolute inset-0 bg-black/50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-[2px]">
                    <span class="material-symbols-outlined text-white text-2xl">photo_camera</span>
                </div>
                <input type="file" name="avatar" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full">
            </div>
            
            <div class="flex-grow space-y-5 w-full">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                    <input type="text" name="name" value="<?= esc($user_name ?? 'User') ?>" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all font-medium">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Role & Title</label>
                    <input type="text" value="<?= esc($user_role_label ?? 'Role') ?>" disabled class="w-full bg-gray-100 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-500 cursor-not-allowed font-medium">
                </div>
                <div class="pt-2">
                    <button type="submit" class="bg-[#1C222E] hover:bg-[#2A3143] text-white py-3 px-6 rounded-xl font-semibold transition-all text-sm shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Profile Changes
                    </button>
                </div>
            </div>
        
    <?= csrf_field() ?>
</form>
    </div>
</div>

<!-- Change Password Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="border-b border-gray-100 bg-[#1C222E] p-6">
        <h3 class="text-lg font-bold text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-[#B48A5E]">lock</span>
            Change Password
        </h3>
    </div>
    <div class="p-8">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-4 rounded-xl text-sm font-medium flex items-center gap-3">
                <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-700 px-5 py-4 rounded-xl text-sm font-medium flex items-center gap-3">
                <span class="material-symbols-outlined text-rose-600">error</span>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('settings/update-password') ?>" method="POST" class="space-y-5 max-w-md">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                <input type="password" name="current_password" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
            </div>
            
            <div class="pt-2">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                <input type="password" name="new_password" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
                <p class="text-xs text-gray-400 mt-2 font-medium flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Must be at least 8 characters long.</p>
            </div>
            
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                <input type="password" name="confirm_password" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
            </div>
            
            <div class="pt-4 border-t border-gray-100 mt-6 flex">
                <button type="submit" class="bg-[#B48A5E] hover:bg-[#9d7852] text-white py-3 px-6 rounded-xl font-semibold transition-all text-sm shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">key</span>
                    Update Password
                </button>
            </div>
        
    <?= csrf_field() ?>
</form>
    </div>
</div>

</div>
</main>

<?= $this->endSection() ?>
