<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-start justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="<?= base_url('careers') ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#1C222E] transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-[#1C222E] to-[#2A3143] text-white flex items-center justify-center font-bold text-2xl uppercase shadow-md">
                <?= substr(esc($app['full_name'] ?? 'U'), 0, 1) ?>
            </div>
            <div>
                <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight leading-tight"><?= esc($app['full_name']) ?></h1>
                <div class="flex items-center gap-3 mt-1">
                    <?php 
                        $color = 'slate';
                        $status = strtolower($app['status'] ?? '');
                        if ($status == 'interview scheduled') $color = 'indigo';
                        if ($status == 'selected') $color = 'emerald';
                        if ($status == 'rejected') $color = 'rose';
                    ?>
                    <?= view('FortuneOneCRM/common/status-badge', ['status' => $app['status'] ?? 'Interview Scheduled', 'color' => $color]) ?>
                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1.5 border-l border-gray-300 pl-3">
                        <span class="material-symbols-outlined text-[16px]">history</span>
                        Applied on <?= date('M j, Y', strtotime($app['created_at'])) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex items-center gap-3 mt-4 md:mt-0">
        <?php if (!empty($app['resume_url'])): ?>
            <a href="<?= base_url(esc($app['resume_url'])) ?>" target="_blank" class="px-5 py-2.5 bg-[#B48A5E] hover:bg-[#9d7852] text-white rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">visibility</span>
                View Resume
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left Column: Primary Details -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Applicant Information Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <h2 class="text-lg font-bold text-[#1C222E]">Applicant Information</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Phone Number</label>
                    <div class="flex items-center gap-3">
                        <p class="text-base text-gray-900 font-medium"><?= esc($app['phone']) ?></p>
                        <a href="tel:<?= esc($app['phone']) ?>" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Call">
                            <span class="material-symbols-outlined text-[16px]">call</span>
                        </a>
                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $app['phone']) ?>" target="_blank" class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" title="WhatsApp">
                            <span class="material-symbols-outlined text-[16px]">chat</span>
                        </a>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Email Address</label>
                    <div class="flex items-center gap-3">
                        <p class="text-base text-gray-900 font-medium"><?= esc($app['email']) ?></p>
                        <a href="mailto:<?= esc($app['email']) ?>" class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-colors" title="Send Email">
                            <span class="material-symbols-outlined text-[16px]">mail</span>
                        </a>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Position Applied For</label>
                    <p class="text-base text-[#B48A5E] font-bold"><?= esc($app['position_applied'] ?? 'General Application') ?></p>
                </div>
                <?php if (!empty($app['portfolio_link'])): ?>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Portfolio Link</label>
                    <a href="<?= esc($app['portfolio_link']) ?>" target="_blank" class="text-base font-medium text-blue-600 hover:underline"><?= esc($app['portfolio_link']) ?></a>
                </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($app['cover_letter'])): ?>
                <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-3">Cover Letter / Message</label>
                    <div class="text-sm text-gray-700 bg-white p-4 rounded-xl border border-gray-200 min-h-[80px] whitespace-pre-wrap leading-relaxed">"<?= esc($app['cover_letter']) ?>"</div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Experience & Background Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                    <span class="material-symbols-outlined">work</span>
                </div>
                <h2 class="text-lg font-bold text-[#1C222E]">Experience & Background</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Years of Experience</label>
                    <div class="flex items-center gap-2 text-gray-900 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">history</span>
                        <?= esc($app['years_experience'] ?? '0') ?> Years
                    </div>
                </div>
                <?php if (!empty($app['current_company'])): ?>
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Current/Last Company</label>
                        <div class="flex items-center gap-2 text-gray-900 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                            <span class="material-symbols-outlined text-gray-400 text-[20px]">business</span>
                            <?= esc($app['current_company']) ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($app['current_ctc'])): ?>
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Current CTC</label>
                        <p class="text-base text-gray-900 font-medium"><?= esc($app['current_ctc']) ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($app['expected_ctc'])): ?>
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Expected CTC</label>
                        <p class="text-base text-gray-900 font-medium"><?= esc($app['expected_ctc']) ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($app['notice_period'])): ?>
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Notice Period</label>
                        <p class="text-base text-gray-900 font-medium"><?= esc($app['notice_period']) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Resume Viewer -->
        <?php if (!empty($app['resume_url'])): ?>
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-rose-50 flex items-center justify-center text-rose-600">
                        <span class="material-symbols-outlined">picture_as_pdf</span>
                    </div>
                    <h2 class="text-lg font-bold text-[#1C222E]">Resume / CV</h2>
                </div>
                <a href="<?= base_url(esc($app['resume_url'])) ?>" target="_blank" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                    Open in New Tab
                    <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                </a>
            </div>
            <div class="p-0 h-[800px] w-full bg-gray-100">
                <iframe src="<?= base_url(esc($app['resume_url'])) ?>" class="w-full h-full border-0" title="Resume PDF"></iframe>
            </div>
        </div>
        <?php endif; ?>
        
    </div>

    <!-- Right Column: Actions -->
    <div class="space-y-6">
        
        <!-- Update Form -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden sticky top-8">
            <div class="p-6 border-b border-gray-100 bg-[#1C222E]">
                <h2 class="text-lg font-bold text-white">HR Controls</h2>
            </div>
            <div class="p-6 bg-white">
                <form id="updateAppForm" class="space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($app['id']) ?>">
                    
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Application Status</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] font-medium transition-all cursor-pointer">
                            <option value="Interview Scheduled" <?= strtolower($app['status']) == 'interview scheduled' ? 'selected' : '' ?>>Interview Scheduled</option>
                            <option value="Selected" <?= strtolower($app['status']) == 'selected' ? 'selected' : '' ?>>Selected</option>
                            <option value="Rejected" <?= strtolower($app['status']) == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">HR Notes</label>
                        <textarea name="notes" rows="4" placeholder="Interview feedback, evaluation..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all resize-none"><?= esc($app['notes'] ?? '') ?></textarea>
                    </div>

                    <div id="updateStatusMsg" class="mt-3 text-sm font-medium hidden text-center rounded-lg py-2"></div>

                    <button type="submit" class="w-full py-3 bg-[#1C222E] hover:bg-[#2A3143] text-white text-sm font-semibold rounded-xl shadow-sm transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Changes
                    </button>
                    
                </form>
            </div>
        </div>

    </div>

</div>

</div>
</main>

<script>
document.getElementById('updateAppForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const msg = document.getElementById('updateStatusMsg');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> Saving...';
    
    const formData = new FormData(form);
    
    fetch('<?= base_url('careers/update') ?>', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        msg.classList.remove('hidden');
        if(data.status) {
            msg.className = 'mt-3 text-sm font-medium text-center rounded-lg py-2 bg-green-50 text-green-600 block border border-green-100';
            msg.innerText = data.message;
            setTimeout(() => window.location.reload(), 1000);
        } else {
            msg.className = 'mt-3 text-sm font-medium text-center rounded-lg py-2 bg-red-50 text-red-600 block border border-red-100';
            msg.innerText = data.message;
            btn.disabled = false;
            btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">save</span> Save Changes';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        msg.classList.remove('hidden');
        msg.className = 'mt-3 text-sm font-medium text-center rounded-lg py-2 bg-red-50 text-red-600 block border border-red-100';
        msg.innerText = 'Server Error. Please try again.';
        btn.disabled = false;
        btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">save</span> Save Changes';
    });
});
</script>

<?= $this->endSection() ?>
