<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Page Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight">Appointments</h1>
        <p class="text-[14px] text-gray-500 mt-1 font-medium">Manage and track all scheduled meetings and site visits.</p>
    </div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <span class="material-symbols-outlined">calendar_month</span>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Total Appointments</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['appt_total'] ?? 0) ?></h3>
        </div>
    </div>
    
    <!-- Upcoming -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <span class="material-symbols-outlined">schedule</span>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Upcoming</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['appt_upcoming'] ?? 0) ?></h3>
        </div>
    </div>

    <!-- Today -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
            <span class="material-symbols-outlined">today</span>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Today</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['appt_today'] ?? 0) ?></h3>
        </div>
    </div>

    <!-- Completed -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
            <span class="material-symbols-outlined">check_circle</span>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Completed</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['appt_completed'] ?? 0) ?></h3>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
    
    <!-- Filters & Search -->
    <div class="p-6 border-b border-gray-100 bg-white">
        <form id="searchForm" class="flex flex-col md:flex-row gap-4 items-center">
            
            <!-- Realtime Search Input -->
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" id="searchInput" placeholder="Start typing a name to search..." autocomplete="off" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
            </div>

            <div class="flex-1"></div>

            <!-- Status Filter -->
            <select id="statusSelect" class="w-full md:w-56 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 text-gray-700 cursor-pointer">
                <option value="">All Statuses</option>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <!-- Filter Button -->
            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-[#1C222E] text-white text-sm font-medium rounded-xl hover:bg-[#2A3143] shadow-sm transition-colors flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">filter_list</span>
                Filter
            </button>

            <button type="button" id="clearBtn" class="w-full md:w-auto px-4 py-2.5 text-gray-500 text-sm font-medium hover:text-gray-800 transition-colors text-center hidden">
                Clear
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse" id="appointmentsTable">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Client Info</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Date & Time</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Project</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100" id="tableBody">
                <?php if(!empty($appointments)): ?>
                    <?php foreach($appointments as $appt): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors group appt-row">
                            <td class="px-6 py-4 client-col">
                                <div class="flex flex-col">
                                    <span class="text-sm font-semibold text-gray-900"><?= esc($appt['name']) ?></span>
                                    <span class="text-xs text-gray-500 mt-0.5"><?= esc($appt['phone']) ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <span class="material-symbols-outlined text-[16px] text-gray-400">calendar_month</span>
                                    <?= date('d M Y, h:i A', strtotime($appt['preferred_date'])) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 project-col">
                                <?= esc($appt['project_name'] ?? 'N/A') ?>
                            </td>
                            <td class="px-6 py-4 status-col">
                                <?php 
                                    $statusColor = 'bg-gray-100 text-gray-700';
                                    if($appt['status'] == 'Scheduled') $statusColor = 'bg-amber-100 text-amber-700';
                                    if($appt['status'] == 'Completed') $statusColor = 'bg-green-100 text-green-700';
                                    if($appt['status'] == 'Cancelled') $statusColor = 'bg-red-100 text-red-700';
                                ?>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $statusColor ?>">
                                    <?= esc($appt['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="<?= base_url('appointments/details/' . $appt['id']) ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-500 hover:bg-[#B48A5E] hover:text-white transition-all" title="View Details">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr id="emptyRow">
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-4">
                                <span class="material-symbols-outlined text-gray-400 text-[24px]">event_busy</span>
                            </div>
                            <h3 class="text-sm font-medium text-gray-900">No appointments found</h3>
                            <p class="text-xs text-gray-500 mt-1">Try adjusting your search or filters.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Only works for full page loads, but kept for design consistency) -->
    <div id="pagination-wrapper">
        <?php if(($totalPages ?? 0) > 1): ?>
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between bg-gray-50/30" id="pagination-container">
            <p class="text-xs text-gray-500">
                Showing page <?= esc($page) ?> of <?= esc($totalPages) ?>
            </p>
            <div class="flex gap-2">
                <?php if($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-50 transition-colors">Previous</a>
                <?php endif; ?>
                
                <?php if($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-50 transition-colors">Next</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

</div>

</div>
</main>

<script>
// --- STRICT VISUAL CLIENT-SIDE FILTERING ---
const searchInput = document.getElementById('searchInput');
const statusSelect = document.getElementById('statusSelect');
const clearBtn = document.getElementById('clearBtn');
const rows = document.querySelectorAll('.appt-row');

function filterTable() {
    const query = searchInput.value.toLowerCase().trim();
    const statusVal = statusSelect.value.toLowerCase();
    
    // Show clear button if there is any filter active
    if(query.length > 0 || statusVal.length > 0) {
        clearBtn.classList.remove('hidden');
    } else {
        clearBtn.classList.add('hidden');
    }

    rows.forEach(row => {
        // Read strictly the visible text in the Name/Phone column and Project column
        const clientText = row.querySelector('.client-col').innerText.toLowerCase();
        const projectText = row.querySelector('.project-col').innerText.toLowerCase();
        const statusText = row.querySelector('.status-col').innerText.toLowerCase();
        
        // If query is empty, or it matches the visible text
        const matchesSearch = (query === '') || clientText.includes(query) || projectText.includes(query);
        const matchesStatus = (statusVal === '') || statusText.includes(statusVal);
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Filter instantly on typing
searchInput.addEventListener('input', filterTable);

// Filter instantly on dropdown change
statusSelect.addEventListener('change', filterTable);

// Filter when button is clicked (prevents page reload)
document.getElementById('searchForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterTable();
});

// Clear filters
clearBtn.addEventListener('click', function() {
    searchInput.value = '';
    statusSelect.value = '';
    filterTable();
});
</script>

<?= $this->endSection() ?>
