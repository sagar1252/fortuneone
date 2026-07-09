<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-start justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="<?= base_url('appointments') ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#1C222E] transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-[#1C222E] to-[#2A3143] text-white flex items-center justify-center font-bold text-2xl uppercase shadow-md">
                <?= substr(esc($appt['name'] ?? 'U'), 0, 1) ?>
            </div>
            <div>
                <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight leading-tight"><?= esc($appt['name']) ?></h1>
                <div class="flex items-center gap-3 mt-1">
                    <?php 
                        $statusColor = 'bg-gray-100 text-gray-700';
                        $status = strtolower($appt['status'] ?? '');
                        if ($status == 'scheduled') $statusColor = 'bg-amber-50 text-amber-700';
                        if ($status == 'completed') $statusColor = 'bg-green-50 text-green-700';
                        if ($status == 'cancelled') $statusColor = 'bg-red-50 text-red-700';
                    ?>
                    <span class="px-3 py-1 rounded-md text-xs font-semibold <?= $statusColor ?>">
                        <?= esc($appt['status'] ?? 'Scheduled') ?>
                    </span>
                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1.5 border-l border-gray-300 pl-3">
                        <span class="material-symbols-outlined text-[16px]">history</span>
                        Created on <?= date('M j, Y', strtotime($appt['created_at'])) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex items-center gap-3 mt-4 md:mt-0">
        <?php if (!empty($appt['meeting_link'])): ?>
            <button onclick="navigator.clipboard.writeText('<?= esc($appt['meeting_link']) ?>'); alert('Meeting link copied to clipboard!');" class="px-4 py-2.5 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">content_copy</span>
                Copy Link
            </button>
            <a href="<?= esc($appt['meeting_link']) ?>" target="_blank" class="px-5 py-2.5 bg-[#B48A5E] hover:bg-[#9d7852] text-white rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">videocam</span>
                Join Meeting
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left Column: Primary Details -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Info Card -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <h2 class="text-lg font-bold text-[#1C222E]">Customer Information</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Phone Number</label>
                    <div class="flex items-center gap-3">
                        <p class="text-base text-gray-900 font-medium"><?= esc($appt['phone']) ?></p>
                        <a href="tel:<?= esc($appt['phone']) ?>" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Call">
                            <span class="material-symbols-outlined text-[16px]">call</span>
                        </a>
                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $appt['phone']) ?>" target="_blank" class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" title="WhatsApp">
                            <span class="material-symbols-outlined text-[16px]">chat</span>
                        </a>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Email Address</label>
                    <div class="flex items-center gap-3">
                        <p class="text-base text-gray-900 font-medium"><?= esc($appt['email']) ?></p>
                        <a href="mailto:<?= esc($appt['email']) ?>" class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-colors" title="Send Email">
                            <span class="material-symbols-outlined text-[16px]">mail</span>
                        </a>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Project Interest</label>
                    <p class="text-base text-[#B48A5E] font-bold"><?= esc($appt['project_name'] ?? 'General Inquiry') ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Lead Source</label>
                    <p class="text-base text-gray-900 font-medium"><?= esc($appt['source'] ?? 'Website') ?></p>
                </div>
            </div>
            
            <?php if (!empty($appt['notes'])): ?>
                <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-3">Customer Notes / Message</label>
                    <div class="text-sm text-gray-700 bg-white p-4 rounded-xl border border-gray-200 min-h-[80px] whitespace-pre-wrap leading-relaxed">"<?= esc($appt['notes']) ?>"</div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Meeting Details -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                    <span class="material-symbols-outlined">event</span>
                </div>
                <h2 class="text-lg font-bold text-[#1C222E]">Meeting Information</h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Date & Time</label>
                    <div class="flex items-center gap-2 text-gray-900 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">calendar_month</span>
                        <?= $appt['preferred_date'] ? date('M j, Y', strtotime($appt['preferred_date'])) : 'TBD' ?> at <?= esc($appt['preferred_time'] ?? 'TBD') ?>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Appointment Mode</label>
                    <div class="flex items-center gap-2 text-gray-900 font-medium bg-gray-50 px-4 py-3 rounded-xl border border-gray-100">
                        <span class="material-symbols-outlined text-gray-400 text-[20px]">videocam</span>
                        Google Meet
                    </div>
                </div>
                <?php if (!empty($appt['advisor_name'])): ?>
                    <div class="md:col-span-2">
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Assigned Advisor</label>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#1C222E] flex items-center justify-center text-white font-bold text-sm">
                                <?= substr(esc($appt['advisor_name']), 0, 1) ?>
                            </div>
                            <span class="text-base text-gray-900 font-medium"><?= esc($appt['advisor_name']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Right Column: Actions -->
    <div class="space-y-6">
        
        <!-- Update Form -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden sticky top-8">
            <div class="p-6 border-b border-gray-100 bg-[#1C222E]">
                <h2 class="text-lg font-bold text-white">Update Appointment</h2>
            </div>
            <div class="p-6 bg-white">
                <form id="updateApptForm" class="space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($appt['id']) ?>">
                    
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Status Workflow</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] font-medium transition-all cursor-pointer">
                            <option value="Scheduled" <?= strtolower($appt['status'] ?? '') == 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
                            <option value="Completed" <?= strtolower($appt['status'] ?? '') == 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="Cancelled" <?= strtolower($appt['status'] ?? '') == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Internal Advisor Notes</label>
                        <textarea name="internal_notes" rows="4" placeholder="Follow-up notes, outcomes..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all resize-none"><?= esc($appt['internal_notes'] ?? '') ?></textarea>
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
document.getElementById('updateApptForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const msg = document.getElementById('updateStatusMsg');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> Saving...';
    
    const formData = new FormData(form);
    
    fetch('<?= base_url('appointments/update') ?>', {
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
