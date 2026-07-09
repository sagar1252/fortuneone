<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Page Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight">Career Applications</h1>
        <p class="text-[14px] text-gray-500 mt-1 font-medium">Review and manage incoming candidate applications.</p>
    </div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
            <span class="material-symbols-outlined">description</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Applications</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['career_total'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- Month -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <span class="material-symbols-outlined">fiber_new</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">New This Month</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['career_month'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- Interviews -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <span class="material-symbols-outlined">event</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Interviews Scheduled</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['career_interviews'] ?? 0) ?></h3>
        </div>
    </div>
    <!-- Selected -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <span class="material-symbols-outlined">how_to_reg</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Hired / Selected</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($kpis['career_selected'] ?? 0) ?></h3>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col md:flex-row items-center gap-4">
    <form id="filterForm" class="flex flex-col md:flex-row items-center gap-4 w-full">
        
        <!-- Main Search Input -->
        <div class="relative flex-1 w-full">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[20px]">search</span>
            <input type="text" id="searchInput" placeholder="Search by name, email, phone, company..." autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm transition-all outline-none">
        </div>

        <!-- Position Applied Input -->
        <div class="relative w-full md:w-64">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[20px]">work</span>
            <input type="text" id="postInput" placeholder="Position Applied" autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm transition-all outline-none">
        </div>
        
        <!-- Status Dropdown (Only 3 Options) -->
        <div class="w-full md:w-56">
            <select id="statusSelect" class="w-full px-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm font-medium text-gray-700 transition-all outline-none cursor-pointer">
                <option value="">All Statuses</option>
                <option value="Interview Scheduled">Interview Scheduled</option>
                <option value="Selected">Selected</option>
                <option value="Rejected">Rejected</option>
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

<!-- Applications Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <?php if (empty($applications)): ?>
        <div class="px-6 py-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                <span class="material-symbols-outlined text-[32px] text-gray-400">group_off</span>
            </div>
            <h3 class="text-base font-bold text-[#1C222E]">No applications found</h3>
            <p class="text-sm text-gray-500 mt-1">Try adjusting your search or filters to find what you are looking for.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="dataTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="py-4 px-6">Candidate Name</th>
                        <th class="py-4 px-6">Position Applied</th>
                        <th class="py-4 px-6">Experience</th>
                        <th class="py-4 px-6">Applied On</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($applications as $app): ?>
                        <tr class="hover:bg-gray-50 transition-colors app-row">
                            <td class="py-4 px-6 candidate-col">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm uppercase">
                                        <?= substr(esc($app['full_name'] ?? 'U'), 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-[#1C222E] text-sm"><?= esc($app['full_name']) ?></div>
                                        <div class="text-xs text-gray-500 font-medium"><?= esc($app['email']) ?> <br> <?= esc($app['phone']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 position-col">
                                <div class="text-sm font-semibold text-gray-800">
                                    <?= esc($app['position_applied'] ?? 'General Application') ?>
                                </div>
                            </td>
                            <td class="py-4 px-6 experience-col">
                                <div class="text-sm font-medium text-gray-700">
                                    <?= esc($app['years_experience'] ?? '0') ?> Years
                                </div>
                                <?php if (!empty($app['current_company'])): ?>
                                <div class="text-xs text-gray-500">
                                    at <?= esc($app['current_company']) ?>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 text-sm text-gray-600 font-medium">
                                <?= date('M j, Y', strtotime($app['created_at'])) ?>
                            </td>
                            <td class="py-4 px-6 status-col">
                                <?php 
                                    $color = 'slate';
                                    $status = strtolower($app['status'] ?? '');
                                    if ($status == 'interview scheduled') $color = 'indigo';
                                    if ($status == 'selected') $color = 'emerald';
                                    if ($status == 'rejected') $color = 'rose';
                                ?>
                                <?= view('FortuneOneCRM/common/status-badge', ['status' => $app['status'] ?? 'New', 'color' => $color]) ?>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <?php if (!empty($app['resume_path'])): ?>
                                        <a href="<?= base_url('uploads/resumes/' . esc($app['resume_path'])) ?>" target="_blank" class="w-8 h-8 rounded-full hover:bg-emerald-50 flex items-center justify-center text-gray-400 hover:text-emerald-600 transition-colors" title="Download Resume">
                                            <span class="material-symbols-outlined text-[20px]">download</span>
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('careers/details/' . $app['id']) ?>" class="w-8 h-8 rounded-full hover:bg-indigo-50 flex items-center justify-center text-gray-400 hover:text-indigo-600 transition-colors" title="View Details">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- Empty State Row (Hidden by default, shown by JS when filter finds nothing) -->
                    <tr id="emptyRow" style="display: none;">
                        <td colspan="6" class="px-6 py-16 text-center border-t border-gray-100">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                <span class="material-symbols-outlined text-[32px] text-gray-400">search_off</span>
                            </div>
                            <h3 class="text-base font-bold text-[#1C222E]">No applications match your filter</h3>
                            <p class="text-sm text-gray-500 mt-1">Try typing something else or clear the filters.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            <?= view('FortuneOneCRM/common/pagination', [
                'page' => $page,
                'totalPages' => $totalPages,
                'totalRows' => $totalRows,
                'baseUrl' => base_url('careers'),
                'queryParams' => ['q' => $search, 'post' => $post, 'status' => $status]
            ]) ?>
        </div>
    <?php endif; ?>
</div>

</div>
</main>

<script>
// --- STRICT VISUAL CLIENT-SIDE FILTERING FOR CAREERS ---
const searchInput = document.getElementById('searchInput');
const postInput = document.getElementById('postInput');
const statusSelect = document.getElementById('statusSelect');
const clearBtn = document.getElementById('clearBtn');
const rows = document.querySelectorAll('.app-row');
const emptyRow = document.getElementById('emptyRow');

function filterTable() {
    const query = searchInput.value.toLowerCase().trim();
    const postQuery = postInput.value.toLowerCase().trim();
    const statusVal = statusSelect.value.toLowerCase();
    
    // Toggle the clear button if any input has text
    if (query.length > 0 || postQuery.length > 0 || statusVal.length > 0) {
        clearBtn.classList.remove('hidden');
    } else {
        clearBtn.classList.add('hidden');
    }

    let visibleCount = 0;

    rows.forEach(row => {
        // Read the visible text directly from the specific columns
        const candidateText = row.querySelector('.candidate-col').innerText.toLowerCase();
        const experienceText = row.querySelector('.experience-col').innerText.toLowerCase();
        const positionText = row.querySelector('.position-col').innerText.toLowerCase();
        const statusText = row.querySelector('.status-col').innerText.toLowerCase();
        
        // Search bar checks candidate name, email, phone AND experience/company text
        const matchesSearch = (query === '') || candidateText.includes(query) || experienceText.includes(query);
        // Position input specifically checks the Position Applied column
        const matchesPost = (postQuery === '') || positionText.includes(postQuery);
        // Status checks the status badge
        const matchesStatus = (statusVal === '') || statusText.includes(statusVal);
        
        if (matchesSearch && matchesPost && matchesStatus) {
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
postInput.addEventListener('input', filterTable);
statusSelect.addEventListener('change', filterTable);

// Stop the form from reloading the page
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterTable();
});

// Clear filters button logic
clearBtn.addEventListener('click', function() {
    searchInput.value = '';
    postInput.value = '';
    statusSelect.value = '';
    filterTable();
});
</script>

<?= $this->endSection() ?>
