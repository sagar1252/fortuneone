<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<!-- Background changed back to the simple #F8F9FB gray -->
<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Page Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight">Good Morning, Admin <span class="text-2xl">👋</span></h1>
        <p class="text-[14px] text-gray-500 mt-1 font-medium">Welcome back to your dashboard</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 bg-white border border-gray-200 text-gray-600 py-2.5 px-4 rounded-xl text-sm font-medium shadow-sm">
            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
            <?= date('l, d F Y') ?>
        </div>
    </div>
</div>

<!-- Main KPI Row (ALL ARE NOW CLICKABLE LINKS) -->
<div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
    
    <?php if ($isAdmin || in_array('enquiries_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('enquiries') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-blue-200 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-100 transition-colors">
            <span class="material-symbols-outlined">mail</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Total Enquiries</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['enq_total'] ?></div>
            <p class="text-[10px] font-medium text-emerald-600 flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">arrow_upward</span> All time</p>
        </div>
    </a>
    <?php endif; ?>

    <?php if ($isAdmin || in_array('appointments_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('appointments') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-indigo-200 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 group-hover:bg-indigo-100 transition-colors">
            <span class="material-symbols-outlined">event</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Appointments</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['appt_total'] ?></div>
            <p class="text-[10px] font-medium text-emerald-600 flex items-center gap-1"><span class="material-symbols-outlined text-[12px]">arrow_upward</span> All time</p>
        </div>
    </a>
    <?php endif; ?>

    <?php if ($isAdmin || in_array('careers_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('careers') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-amber-200 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-100 transition-colors">
            <span class="material-symbols-outlined">work</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Careers</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['career_new'] ?></div>
            <p class="text-[10px] font-medium text-amber-600 flex items-center gap-1">Pending Review</p>
        </div>
    </a>
    <?php endif; ?>

    <?php if ($isAdmin || in_array('enquiries_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('enquiries') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-slate-300 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-slate-50 text-slate-600 flex items-center justify-center flex-shrink-0 group-hover:bg-slate-100 transition-colors">
            <span class="material-symbols-outlined">corporate_fare</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Enquiries Today</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['enq_today'] ?></div>
            <p class="text-[10px] font-medium text-slate-500 flex items-center gap-1">Happening today</p>
        </div>
    </a>
    <?php endif; ?>

    <?php if ($isAdmin || in_array('appointments_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('appointments') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-rose-200 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 group-hover:bg-rose-100 transition-colors">
            <span class="material-symbols-outlined">event_available</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Meetings Today</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['appt_today'] ?></div>
            <p class="text-[10px] font-medium text-rose-600 flex items-center gap-1">Happening today</p>
        </div>
    </a>
    <?php endif; ?>

    <?php if ($isAdmin || in_array('enquiries_access', $userPermissions ?? [])): ?>
    <a href="<?= base_url('enquiries?status=New') ?>" class="bg-white rounded-2xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex items-center gap-4 hover:-translate-y-1 hover:shadow-lg hover:border-emerald-200 transition-all cursor-pointer group">
        <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 transition-colors">
            <span class="material-symbols-outlined">mark_email_unread</span>
        </div>
        <div>
            <p class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Unread Enquiries</p>
            <div class="text-2xl font-bold text-[#1C222E] mb-1"><?= $kpis['enq_unread'] ?></div>
            <p class="text-[10px] font-medium text-emerald-600 flex items-center gap-1">Needs attention</p>
        </div>
    </a>
    <?php endif; ?>
</div>

<!-- Middle Row (Charts area + Other KPIs) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 lg:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-base font-bold text-[#1C222E]">Enquiries Trend</h3>
            <!-- Select Dropdown -->
            <select id="chartFilter" class="bg-gray-50 hover:bg-gray-100 cursor-pointer border border-gray-200 text-gray-700 text-xs rounded-lg px-3 py-1.5 outline-none font-medium transition-colors">
                <option value="1_day">1 Day</option>
                <option value="1_week">1 Week</option>
                <option value="1_month" selected>1 Month</option>
                <option value="1_year">1 Year</option>
                <option value="all_time">All Time</option>
            </select>
        </div>
        
        <!-- Interactive Chart.js Area added! -->
        <div class="h-[250px] relative w-full">
            <canvas id="enquiriesChart"></canvas>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 flex flex-col justify-center">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-base font-bold text-[#1C222E]">Appointment Status</h3>
            <a href="<?= base_url('appointments') ?>" class="text-xs font-bold text-[#B48A5E] hover:underline">View all</a>
        </div>
        <?php if ($isAdmin || in_array('appointments_access', $userPermissions ?? [])): ?>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center"><span class="material-symbols-outlined text-[18px]">calendar_month</span></div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Upcoming</p>
                        <p class="text-xs text-gray-500">Scheduled & Confirmed</p>
                    </div>
                </div>
                <div class="text-xl font-bold text-gray-900"><?= $kpis['appt_upcoming'] ?></div>
            </div>
            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-gray-100 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center"><span class="material-symbols-outlined text-[18px]">check_circle</span></div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Completed</p>
                        <p class="text-xs text-gray-500">Successfully met</p>
                    </div>
                </div>
                <div class="text-xl font-bold text-gray-900"><?= $kpis['appt_completed'] ?></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bottom Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    <!-- Recent Activity Feed -->
    <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 overflow-hidden flex flex-col h-[400px]">
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <h3 class="text-base font-bold text-[#1C222E]">Recent Activity</h3>
            <a href="#" class="text-xs font-bold text-[#B48A5E] hover:underline">View all</a>
        </div>
        <div class="overflow-y-auto custom-scrollbar flex-1 p-2">
            <?php if (!empty($activity_feed)): ?>
                <div class="space-y-1">
                <?php foreach ($activity_feed as $item): ?>
                    <div class="p-4 hover:bg-gray-50 transition-colors rounded-xl mx-2 cursor-pointer">
                        <div class="flex items-start gap-4">
                            <div class="mt-1">
                                <?php if ($item['type'] === 'Appointment'): ?>
                                    <div class="h-9 w-9 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[16px]">event</span>
                                    </div>
                                <?php elseif ($item['type'] === 'Enquiry'): ?>
                                    <div class="h-9 w-9 rounded-full bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[16px]">mail</span>
                                    </div>
                                <?php else: ?>
                                    <div class="h-9 w-9 rounded-full bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[16px]">work</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <p class="text-[13px] font-bold text-[#1C222E]">New <?= esc($item['type']) ?> received</p>
                                <p class="text-[12px] text-gray-500 mt-0.5">From <span class="font-semibold text-gray-700"><?= esc($item['title']) ?></span></p>
                                <p class="text-[11px] text-gray-400 mt-1"><?= date('h:i A', strtotime($item['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="p-8 text-center h-full flex flex-col justify-center items-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-50 border border-gray-100 text-gray-400 mb-3">
                        <span class="material-symbols-outlined">inbox</span>
                    </div>
                    <p class="text-sm font-bold text-[#1C222E]">No recent activity</p>
                    <p class="text-xs text-gray-500 mt-1">When new submissions arrive, they will show up here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-100 p-6 h-[400px]">
        <h3 class="text-base font-bold text-[#1C222E] mb-6">Quick Links</h3>
        <div class="grid grid-cols-2 gap-4 h-[calc(100%-48px)]">
            <?php if ($isAdmin || in_array('appointments_access', $userPermissions ?? [])): ?>
            <a href="<?= base_url('appointments') ?>" class="flex flex-col items-center justify-center p-5 rounded-xl border border-gray-100 bg-blue-50/50 hover:bg-blue-50 hover:border-blue-100 transition-colors group">
                <span class="material-symbols-outlined text-[28px] text-blue-600 mb-3 group-hover:scale-110 transition-transform">calendar_add_on</span>
                <span class="text-[13px] font-bold text-[#1C222E] text-center">Manage Appointments</span>
            </a>
            <?php endif; ?>
            
            <?php if ($isAdmin || in_array('enquiries_access', $userPermissions ?? [])): ?>
            <a href="<?= base_url('enquiries') ?>" class="flex flex-col items-center justify-center p-5 rounded-xl border border-gray-100 bg-emerald-50/50 hover:bg-emerald-50 hover:border-emerald-100 transition-colors group">
                <span class="material-symbols-outlined text-[28px] text-emerald-600 mb-3 group-hover:scale-110 transition-transform">note_add</span>
                <span class="text-[13px] font-bold text-[#1C222E] text-center">View Enquiries</span>
            </a>
            <?php endif; ?>
            
            <?php if ($isAdmin || in_array('careers_access', $userPermissions ?? [])): ?>
            <a href="<?= base_url('careers') ?>" class="flex flex-col items-center justify-center p-5 rounded-xl border border-gray-100 bg-amber-50/50 hover:bg-amber-50 hover:border-amber-100 transition-colors group">
                <span class="material-symbols-outlined text-[28px] text-amber-600 mb-3 group-hover:scale-110 transition-transform">person_add</span>
                <span class="text-[13px] font-bold text-[#1C222E] text-center">Review Careers</span>
            </a>
            <?php endif; ?>

            <a href="<?= base_url('settings') ?>" class="flex flex-col items-center justify-center p-5 rounded-xl border border-gray-100 bg-purple-50/50 hover:bg-purple-50 hover:border-purple-100 transition-colors group">
                <span class="material-symbols-outlined text-[28px] text-purple-600 mb-3 group-hover:scale-110 transition-transform">settings</span>
                <span class="text-[13px] font-bold text-[#1C222E] text-center">System Settings</span>
            </a>
        </div>
    </div>
</div>

</div>
</main>

<!-- Load Chart.js script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Load Chart.js script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('enquiriesChart');
    if (ctx) {
        // Create the graph instance
        var myChart = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: [], 
                datasets: [{
                    label: 'Enquiries',
                    data: [], 
                    borderColor: '#B48A5E',
                    backgroundColor: 'rgba(180, 138, 94, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#B48A5E',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 1. Fallback dummy data (Used if backend isn't hooked up yet)
        var dummyData = {
            '1_day': { labels: ['12 AM', '4 AM', '8 AM', '12 PM', '4 PM', '8 PM'], data: [0, 1, 3, 8, 4, 2] },
            '1_week': { labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], data: [12, 19, 10, 15, 22, 14, 25] },
            '1_month': { labels: ['1st', '5th', '10th', '15th', '20th', '25th', '30th'], data: [12, 19, 10, 25, 22, 30, 45] },
            '1_year': { labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'], data: [120, 150, 180, 100, 170, 250, 300, 280, 310, 350, 400, 450] },
            'all_time': { labels: ['2021', '2022', '2023', '2024', '2025', '2026'], data: [500, 800, 1200, 1500, 2100, 2800] }
        };

        // 2. Try to get Real Data from PHP Safely!
        var chartDataMap;
        try {
            // If PHP passes data, use it. Otherwise, use dummy data.
            var rawPhpData = <?= isset($chartDataMap) && !empty($chartDataMap) ? $chartDataMap : 'null' ?>;
            chartDataMap = rawPhpData ? rawPhpData : dummyData;
            
            // Safety check to ensure arrays aren't totally empty
            if (chartDataMap['1_month'] && chartDataMap['1_month'].labels.length === 0) {
                chartDataMap = dummyData;
            }
        } catch(e) {
            chartDataMap = dummyData;
        }

        // 3. Initialize chart with 1 month data
        if (chartDataMap['1_month']) {
            myChart.data.labels = chartDataMap['1_month'].labels;
            myChart.data.datasets[0].data = chartDataMap['1_month'].data;
            myChart.update();
        }

        // 4. Handle Dropdown Changes instantly
        var filterSelect = document.getElementById('chartFilter');
        if (filterSelect) {
            filterSelect.addEventListener('change', function(e) {
                var selectedValue = e.target.value;
                var newData = chartDataMap[selectedValue];
                
                if (newData) {
                    myChart.data.labels = newData.labels;
                    myChart.data.datasets[0].data = newData.data;
                    myChart.update();
                }
            });
        }
    }
});
</script>


<?= $this->endSection() ?>
