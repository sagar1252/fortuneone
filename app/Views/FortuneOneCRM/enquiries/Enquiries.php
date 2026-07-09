<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Page Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight">Enquiries Inbox</h1>
        <p class="text-[14px] text-gray-500 mt-1 font-medium">Manage incoming messages from website contact forms.</p>
    </div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
            <span class="material-symbols-outlined">inbox</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Enquiries</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['enq_total'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- New -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600">
            <span class="material-symbols-outlined">mark_email_unread</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Unread / New</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['enq_new'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- Replied -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <span class="material-symbols-outlined">reply_all</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Replied</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['enq_replied'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- Closed -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <span class="material-symbols-outlined">check_circle</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Closed</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['enq_closed'] ?? 0) ?></h3>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col md:flex-row items-center gap-4">
    <form id="filterForm" class="flex flex-col md:flex-row items-center gap-4 w-full">
        
        <!-- Main Search Input -->
        <div class="relative flex-1 w-full">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[20px]">search</span>
            <input type="text" id="searchInput" placeholder="Search by name, email, phone, subject..." autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm transition-all outline-none">
        </div>
        
        <!-- Status Dropdown -->
        <div class="w-full md:w-56">
            <select id="statusSelect" class="w-full px-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm font-medium text-gray-700 transition-all outline-none cursor-pointer">
                <option value="">All Statuses</option>
                <option value="New">New</option>
                <option value="Read">Read</option>
                <option value="Replied">Replied</option>
                <option value="Closed">Closed</option>
            </select>
        </div>
        
        <!-- Submit Button (Hidden because JS handles it instantly) -->
        <button type="submit" class="hidden">Apply Filters</button>
        
        <!-- Custom Clear Button (Controlled by JS) -->
        <button type="button" id="clearBtn" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition-colors hidden">
            Clear
        </button>
    </form>
</div>

<!-- Enquiries Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <?php if (empty($enquiries)): ?>
        <div class="px-6 py-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                <span class="material-symbols-outlined text-[32px] text-gray-400">mark_email_read</span>
            </div>
            <h3 class="text-base font-bold text-[#1C222E]">No enquiries found</h3>
            <p class="text-sm text-gray-500 mt-1">There are no contact form submissions in the system right now.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="dataTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Sender</th>
                        <th class="py-4 px-6">Contact Info</th>
                        <th class="py-4 px-6">Subject / Source</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Received Date</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($enquiries as $enq): ?>
                        <tr class="hover:bg-gray-50 transition-colors app-row <?= $enq['status'] === 'New' ? 'bg-indigo-50/20' : '' ?>">
                            <td class="py-4 px-6 sender-col">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-sm uppercase">
                                        <?= substr(esc($enq['full_name'] ?? 'U'), 0, 1) ?>
                                    </div>
                                    <div class="font-bold text-[#1C222E] text-sm"><?= esc($enq['full_name']) ?></div>
                                </div>
                            </td>
                            <td class="py-4 px-6 contact-col">
                                <div class="flex flex-col">
                                    <a href="mailto:<?= esc($enq['email']) ?>" class="text-sm font-medium text-gray-800 hover:text-indigo-600 truncate max-w-[200px]"><?= esc($enq['email']) ?></a>
                                    <?php if (!empty($enq['phone'])): ?>
                                        <a href="tel:<?= esc($enq['phone']) ?>" class="text-xs text-gray-500 hover:text-indigo-600 mt-1"><?= esc($enq['phone']) ?></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="py-4 px-6 subject-col">
                                <div class="text-sm font-semibold text-gray-800 truncate max-w-[250px]"><?= esc($enq['subject']) ?></div>
                                <div class="text-xs text-gray-500 mt-1"><?= esc($enq['source']) ?></div>
                            </td>
                            <td class="py-4 px-6 status-col">
                                <?php 
                                    $color = 'slate';
                                    $status = strtolower($enq['status']);
                                    if ($status == 'new') $color = 'rose';
                                    if ($status == 'read') $color = 'slate';
                                    if ($status == 'replied') $color = 'blue';
                                    if ($status == 'closed') $color = 'emerald';
                                ?>
                                <?= view('FortuneOneCRM/common/status-badge', ['status' => $enq['status'], 'color' => $color]) ?>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600 font-medium">
                                <?= date('M j, Y g:i A', strtotime($enq['created_at'])) ?>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="<?= base_url('enquiries/details/' . $enq['id']) ?>" class="w-8 h-8 inline-flex rounded-full hover:bg-indigo-50 items-center justify-center text-gray-400 hover:text-indigo-600 transition-colors" title="View Details">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- Empty State Row (Hidden by default, shown by JS when filter finds nothing) -->
                    <tr id="emptyRow" style="display: none;">
                        <td colspan="6" class="px-6 py-16 text-center border-t border-gray-100">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                <span class="material-symbols-outlined text-[32px] text-gray-400">search_off</span>
                            </div>
                            <h3 class="text-base font-bold text-[#1C222E]">No enquiries match your filter</h3>
                            <p class="text-sm text-gray-500 mt-1">Try typing something else or clear the filters.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            <?= view('FortuneOneCRM/common/pagination', [
                'page' => $page ?? 1,
                'totalPages' => $totalPages ?? 1,
                'totalRows' => $totalRows ?? 0,
                'baseUrl' => base_url('enquiries'),
                'queryParams' => ['search' => $search ?? '', 'status' => $status ?? '']
            ]) ?>
        </div>
    <?php endif; ?>
</div>

</div>
</main>

<script>
// --- STRICT VISUAL CLIENT-SIDE FILTERING FOR ENQUIRIES ---
const searchInput = document.getElementById('searchInput');
const statusSelect = document.getElementById('statusSelect');
const clearBtn = document.getElementById('clearBtn');
const rows = document.querySelectorAll('.app-row');
const emptyRow = document.getElementById('emptyRow');

function filterTable() {
    const query = searchInput.value.toLowerCase().trim();
    const statusVal = statusSelect.value.toLowerCase();
    
    // Toggle the clear button if any input has text
    if (query.length > 0 || statusVal.length > 0) {
        clearBtn.classList.remove('hidden');
    } else {
        clearBtn.classList.add('hidden');
    }

    let visibleCount = 0;

    rows.forEach(row => {
        // Read the visible text directly from the specific columns
        const senderText = row.querySelector('.sender-col').innerText.toLowerCase();
        const contactText = row.querySelector('.contact-col').innerText.toLowerCase();
        const subjectText = row.querySelector('.subject-col').innerText.toLowerCase();
        const statusText = row.querySelector('.status-col').innerText.toLowerCase();
        
        // Search bar checks sender name, contact info, AND subject
        const matchesSearch = (query === '') || senderText.includes(query) || contactText.includes(query) || subjectText.includes(query);
        // Status checks the status badge
        const matchesStatus = (statusVal === '') || statusText.includes(statusVal);
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // If JavaScript hides all rows, show the "No matches" empty state block
    if (emptyRow) {
        if (visibleCount === 0) {
            emptyRow.style.display = '';
        } else {
            emptyRow.style.display = 'none';
        }
    }
}

// Trigger filter instantly as user types or changes dropdown
searchInput.addEventListener('input', filterTable);
statusSelect.addEventListener('change', filterTable);

// Stop the form from reloading the page
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterTable();
});

// Clear filters button logic
clearBtn.addEventListener('click', function() {
    searchInput.value = '';
    statusSelect.value = '';
    filterTable();
});
</script>

<?= $this->endSection() ?>
