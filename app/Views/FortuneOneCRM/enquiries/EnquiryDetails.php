<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-start justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="<?= base_url('enquiries') ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#1C222E] transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <div class="flex items-center gap-4">
            <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-[#1C222E] to-[#2A3143] text-white flex items-center justify-center font-bold text-2xl uppercase shadow-md">
                <?= substr(esc($enq['full_name'] ?? 'U'), 0, 1) ?>
            </div>
            <div>
                <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight leading-tight truncate max-w-[500px]" title="<?= esc($enq['subject']) ?>"><?= esc($enq['subject']) ?></h1>
                <div class="flex items-center gap-3 mt-1">
                    <?php 
                        $color = 'slate';
                        $status = strtolower($enq['status']);
                        if ($status == 'new') $color = 'rose';
                        if ($status == 'read') $color = 'slate';
                        if ($status == 'replied') $color = 'blue';
                        if ($status == 'closed') $color = 'emerald';
                    ?>
                    <?= view('FortuneOneCRM/common/status-badge', ['status' => $enq['status'], 'color' => $color]) ?>
                    <span class="text-sm font-medium text-gray-500 flex items-center gap-1.5 border-l border-gray-300 pl-3">
                        <span class="material-symbols-outlined text-[16px]">history</span>
                        Received on <?= date('M j, Y g:i A', strtotime($enq['created_at'])) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex items-center gap-3 mt-4 md:mt-0">
        <?php if (!empty($enq['phone'])): ?>
            <button onclick="navigator.clipboard.writeText('<?= esc($enq['phone']) ?>'); alert('Phone copied!');" class="px-4 py-2.5 bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">content_copy</span>
                Copy Phone
            </button>
        <?php endif; ?>
        <a href="mailto:<?= esc($enq['email']) ?>" class="px-5 py-2.5 bg-[#B48A5E] hover:bg-[#9d7852] text-white rounded-xl text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[18px]">mail</span>
            Open in Mail Client
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Left Column: Main Content -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Message Box -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                        <span class="material-symbols-outlined">chat</span>
                    </div>
                    <h2 class="text-lg font-bold text-[#1C222E]">Message Content</h2>
                </div>
                <span class="text-xs font-bold text-[#B48A5E] bg-[#B48A5E]/10 px-3 py-1.5 rounded-lg uppercase tracking-wider"><?= esc($enq['source']) ?></span>
            </div>
            <div class="p-8">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-base font-medium">"<?= esc($enq['message']) ?>"</p>
            </div>
        </div>

    </div>
    
    <!-- Right Column: Info & Actions -->
    <div class="space-y-8">
        
        <!-- Contact Information -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <h2 class="text-lg font-bold text-[#1C222E]">Contact Information</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Full Name</label>
                    <p class="text-base text-gray-900 font-bold"><?= esc($enq['full_name']) ?></p>
                </div>
                <div>
                    <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Email Address</label>
                    <div class="flex items-center gap-3">
                        <p class="text-base text-gray-900 font-medium truncate"><?= esc($enq['email']) ?></p>
                        <a href="mailto:<?= esc($enq['email']) ?>" class="w-8 h-8 shrink-0 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-colors" title="Send Email">
                            <span class="material-symbols-outlined text-[16px]">mail</span>
                        </a>
                    </div>
                </div>
                <?php if (!empty($enq['phone'])): ?>
                    <div>
                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Phone Number</label>
                        <div class="flex items-center gap-3">
                            <p class="text-base text-gray-900 font-medium"><?= esc($enq['phone']) ?></p>
                            <a href="tel:<?= esc($enq['phone']) ?>" class="w-8 h-8 shrink-0 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Call">
                                <span class="material-symbols-outlined text-[16px]">call</span>
                            </a>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $enq['phone']) ?>" target="_blank" class="w-8 h-8 shrink-0 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-600 hover:text-white transition-colors" title="WhatsApp">
                                <span class="material-symbols-outlined text-[16px]">chat</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden sticky top-8">
            <div class="p-6 border-b border-gray-100 bg-[#1C222E]">
                <h2 class="text-lg font-bold text-white">Update Status</h2>
            </div>
            <div class="p-6 bg-white">
                <form id="updateEnquiryForm" class="space-y-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($enq['id']) ?>">
                    
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Current Status</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] font-medium transition-all cursor-pointer">
                            <option value="New" <?= strtolower($enq['status']) == 'new' ? 'selected' : '' ?>>New</option>
                            <option value="Read" <?= strtolower($enq['status']) == 'read' ? 'selected' : '' ?>>Read</option>
                            <option value="Replied" <?= strtolower($enq['status']) == 'replied' ? 'selected' : '' ?>>Replied</option>
                            <option value="Closed" <?= strtolower($enq['status']) == 'closed' ? 'selected' : '' ?>>Closed</option>
                        </select>
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
// Handle Status Update
document.getElementById('updateEnquiryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const msg = document.getElementById('updateStatusMsg');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> Saving...';
    
    const formData = new FormData(form);
    
    fetch('<?= base_url('enquiries/update') ?>', {
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
