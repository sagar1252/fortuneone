<div class="relative" id="notification-container">
    <button id="notification-btn" class="p-2 text-on-surface-variant hover:text-primary transition-colors relative focus:outline-none">
        <span class="material-symbols-outlined">notifications</span>
        <?php if (!empty($unread_count) && $unread_count > 0): ?>
            <span id="notification-badge" class="absolute top-1 right-1 h-3 w-3 bg-red-500 rounded-full border-2 border-surface-container-lowest"></span>
        <?php endif; ?>
    </button>
    
    <div id="notification-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden z-50">
        <div class="border-b border-slate-200 bg-slate-50 p-4 flex justify-between items-center">
            <h3 class="font-semibold text-slate-800">Notifications</h3>
            <?php if (!empty($unread_count) && $unread_count > 0): ?>
                <button id="mark-read-btn" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">Mark all as read</button>
            <?php endif; ?>
        </div>
        <div class="max-h-80 overflow-y-auto">
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $note): ?>
                    <div class="p-4 border-b border-slate-100 <?= $note['is_read'] ? 'bg-white' : 'bg-indigo-50/50' ?>">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined <?= $note['type'] === 'success' ? 'text-emerald-500' : 'text-indigo-500' ?> mt-0.5">
                                <?= $note['type'] === 'success' ? 'check_circle' : 'info' ?>
                            </span>
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800"><?= esc($note['title']) ?></h4>
                                <p class="text-xs text-slate-600 mt-1"><?= esc($note['message']) ?></p>
                                <span class="text-[10px] text-slate-400 mt-2 block"><?= date('M j, g:i a', strtotime($note['created_at'])) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="p-8 text-center text-slate-500">
                    <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">notifications_off</span>
                    <p class="text-sm">No new notifications</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('notification-btn');
        const dropdown = document.getElementById('notification-dropdown');
        const markReadBtn = document.getElementById('mark-read-btn');
        const badge = document.getElementById('notification-badge');

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        if (markReadBtn) {
            markReadBtn.addEventListener('click', function() {
                fetch('<?= base_url('notifications/mark-read') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(res => res.json()).then(data => {
                    if (data.status === 'success') {
                        if (badge) badge.remove();
                        markReadBtn.remove();
                        // visually mark as read
                        dropdown.querySelectorAll('.bg-indigo-50\\/50').forEach(el => {
                            el.classList.remove('bg-indigo-50/50');
                            el.classList.add('bg-white');
                        });
                    }
                });
            });
        }
    });
</script>
