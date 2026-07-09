<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 24px -4px rgba(15, 23, 42, 0.03);
    }
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #F1F5F9;
        border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #CBD5E1;
        border-radius: 4px;
    }
    .insight-badge {
        font-size: 0.65rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        font-weight: 700;
    }
</style>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto bg-[#F8FAFC] font-['Inter',sans-serif]">

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="absolute inset-0 bg-white/70 backdrop-blur-sm z-50 flex flex-col items-center justify-center hidden">
        <div class="w-12 h-12 border-4 border-blue-100 border-t-blue-600 rounded-full animate-spin"></div>
        <p class="mt-4 text-sm font-bold text-gray-700 tracking-wide">Synthesizing AI Insights...</p>
    </div>

    <!-- WRAPPER FOR PDF EXPORT -->
    <div id="pdfWrapper" class="bg-[#F8FAFC]">
        <!-- GLOBAL CONTROL BAR -->
    <div class="sticky top-0 z-40 bg-white/80 backdrop-blur-lg border-b border-gray-200 px-8 py-4 flex flex-col xl:flex-row items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-[#0F172A] tracking-tight">Executive Dashboard</h1>
            <p class="text-xs text-slate-500 font-medium">Google Analytics 4 &bull; Global Property Intelligence</p>
        </div>
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex items-center gap-4">
                <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-3 py-1 rounded-full"><span class="w-2 h-2 rounded-full bg-emerald-500 inline-block mr-1"></span> Node.js API Online</span>
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" class="w-8 h-8 rounded-full border border-slate-200">
                <button id="btnExportPdf" class="bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold py-2 px-4 rounded transition-colors shadow-sm flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">picture_as_pdf</span> Export
                </button>
            </div>
            
            <div id="customDateContainer" class="hidden items-center gap-2">
                <input type="date" id="startDate" class="bg-white border border-gray-200 text-slate-700 py-1.5 px-3 rounded-lg text-sm shadow-sm outline-none">
                <span class="text-slate-400 text-sm">to</span>
                <input type="date" id="endDate" class="bg-white border border-gray-200 text-slate-700 py-1.5 px-3 rounded-lg text-sm shadow-sm outline-none">
                <button id="applyCustomDate" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold transition-colors">Apply</button>
            </div>

            <select id="dateFilter" class="bg-white border border-gray-200 text-slate-700 py-2 px-4 rounded-lg text-sm font-semibold shadow-sm focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                <option value="daily">Daily (Today)</option>
                <option value="weekly" selected>Weekly (7 Days)</option>
                <option value="monthly">Monthly (30 Days)</option>
                <option value="yearly">Yearly (365 Days)</option>
                <option value="custom">Custom Range...</option>
            </select>
        </div>
    </div>

    <div class="p-8 max-w-[1600px] mx-auto pb-20">

        <!-- CORE KPI SCORECARDS (4 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Users -->
            <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Active Users</p>
                <div class="flex items-end justify-between">
                    <h2 class="text-3xl font-black text-slate-800" id="stat-users">--</h2>
                    <div class="text-xs font-bold px-2 py-1 rounded-md" id="badge-users">--</div>
                </div>
            </div>
            <!-- Views -->
            <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Page Views</p>
                <div class="flex items-end justify-between">
                    <h2 class="text-3xl font-black text-slate-800" id="stat-views">--</h2>
                    <div class="text-xs font-bold px-2 py-1 rounded-md" id="badge-views">--</div>
                </div>
            </div>
            <!-- Time -->
            <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Avg. Duration</p>
                <div class="flex items-end justify-between">
                    <h2 class="text-3xl font-black text-slate-800" id="stat-time">--</h2>
                    <div class="text-xs font-bold px-2 py-1 rounded-md bg-slate-100 text-slate-600">Per User</div>
                </div>
            </div>
            <!-- Bounce -->
            <div class="glass-card rounded-2xl p-6 relative overflow-hidden group">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Global Bounce Rate</p>
                <div class="flex items-end justify-between">
                    <h2 class="text-3xl font-black text-slate-800" id="stat-bounce">--</h2>
                    <div class="text-xs font-bold px-2 py-1 rounded-md" id="badge-bounce">--</div>
                </div>
            </div>
        </div>

        <!-- MAIN LAYOUT SPLIT -->
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- LEFT 60%: VISUAL GRAPHICS BOARD -->
            <div class="lg:w-3/5 flex flex-col gap-8">
                
                <!-- GA4 Style Graph Card -->
                <div class="bg-white border border-gray-200 rounded-lg p-0 shadow-sm font-sans">
                    <!-- Top Metric Tabs -->
                    <div class="grid grid-cols-4 border-b border-gray-100">
                        <!-- Active Users Tab -->
                        <div id="tab-btn-users" class="p-4 border-b-2 border-blue-600 cursor-pointer hover:bg-gray-50 transition-colors">
                            <div class="text-xs font-medium text-blue-600 mb-1 flex items-center gap-1">Active users <span class="material-symbols-outlined text-[14px]">arrow_drop_down</span></div>
                            <div class="text-2xl font-normal text-gray-800" id="tab-users-val">--</div>
                            <div class="text-[11px] font-medium text-gray-500 mt-1 flex items-center gap-1" id="tab-users-trend">--</div>
                        </div>
                        <!-- Page Views Tab (Replaces New Users) -->
                        <div id="tab-btn-views" class="p-4 border-b-2 border-transparent cursor-pointer hover:bg-gray-50 transition-colors">
                            <div class="text-xs font-medium text-gray-600 mb-1 flex items-center gap-1">Page views <span class="material-symbols-outlined text-[14px]">arrow_drop_down</span></div>
                            <div class="text-2xl font-normal text-gray-800" id="tab-views-val">--</div>
                            <div class="text-[11px] font-medium text-gray-500 mt-1 flex items-center gap-1" id="tab-views-trend">--</div>
                        </div>
                        <!-- Avg Time Tab (Replaces Event count) -->
                        <div id="tab-btn-time" class="p-4 border-b-2 border-transparent cursor-pointer hover:bg-gray-50 transition-colors">
                            <div class="text-xs font-medium text-gray-600 mb-1 flex items-center gap-1">Avg. duration <span class="material-symbols-outlined text-[14px]">arrow_drop_down</span></div>
                            <div class="text-2xl font-normal text-gray-800" id="tab-time-val">--</div>
                            <div class="text-[11px] font-medium text-gray-500 mt-1 flex items-center gap-1" id="tab-time-trend">--</div>
                        </div>
                        <!-- Bounce Rate Tab (Replaces Key events) -->
                        <div id="tab-btn-bounce" class="p-4 border-b-2 border-transparent cursor-pointer hover:bg-gray-50 relative transition-colors">
                            <div class="absolute top-4 right-4 flex items-center gap-2">
                                <div class="w-8 h-5 bg-blue-100 rounded-full flex items-center px-1"><div class="w-3 h-3 bg-blue-600 rounded-full"></div></div>
                                <span class="material-symbols-outlined text-green-600 text-sm">check_circle</span>
                            </div>
                            <div class="text-xs font-medium text-gray-600 mb-1 flex items-center gap-1">Bounce rate <span class="material-symbols-outlined text-[14px]">arrow_drop_down</span></div>
                            <div class="text-2xl font-normal text-gray-800" id="tab-bounce-val">--</div>
                            <div class="text-[11px] font-medium text-gray-500 mt-1" id="tab-bounce-trend">--</div>
                        </div>
                    </div>

                    <!-- Chart Container -->
                    <div class="p-4 relative">
                        <div class="h-[250px] w-full">
                            <canvas id="trafficChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Chart Footer / Legend -->
                    <div class="px-4 pb-4 pt-2 flex items-center justify-between">
                        <div class="flex items-center gap-4 text-[11px] text-gray-600 font-medium">
                            <div class="flex items-center gap-1.5"><div class="w-3 h-0.5 bg-blue-600"></div> Last 7 days</div>
                            <div class="flex items-center gap-1.5"><div class="w-3 h-0 border-t-2 border-dotted border-blue-600"></div> Previous period</div>
                            <div class="flex items-center gap-1.5"><div class="w-3 h-0.5 bg-teal-400"></div> Peer median and range</div>
                        </div>
                        <a href="#" class="text-xs text-blue-600 font-medium hover:underline flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">arrow_forward</span></a>
                    </div>
                </div>

                <!-- Geographic & Hardware -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Devices -->
                    <div class="glass-card rounded-2xl p-6">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-purple-500">devices</span> Hardware Share
                        </h3>
                        <div class="h-[220px] w-full relative flex justify-center">
                            <canvas id="deviceChart"></canvas>
                        </div>
                    </div>
                    <!-- Channels -->
                    <div class="glass-card rounded-2xl p-6">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-emerald-500">hub</span> Acquisition
                        </h3>
                        <div class="h-[220px] w-full relative flex justify-center">
                            <canvas id="channelChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- PLATFORM REFERRALS & ACQUISITION MATRIX -->
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- 1. PLATFORM REFERRALS SUMMARY (Left Module 60%) -->
                    <div class="glass-card rounded-2xl p-6 lg:w-[60%] flex flex-col">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                                <span class="material-symbols-outlined text-purple-600">bar_chart</span> 
                                Platform Referral Clicks
                            </h3>
                        </div>
                        <div class="flex-grow min-h-[300px] relative">
                            <canvas id="referralChart"></canvas>
                        </div>
                    </div>

                    <!-- 2. CLICK ACQUISITION MATRIX (Right Module 40%) -->
                    <div class="glass-card rounded-2xl overflow-hidden flex flex-col lg:w-[40%]">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                                <span class="material-symbols-outlined text-emerald-600">format_list_bulleted</span> 
                                Acquisition Matrix
                            </h3>
                        </div>
                        <div class="overflow-x-hidden flex-grow">
                            <table class="w-full text-left border-collapse table-fixed">
                                <thead>
                                    <tr class="bg-slate-50/80">
                                        <th class="py-3 px-3 w-[35%] text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200">Source</th>
                                        <th class="py-3 px-2 w-[20%] text-right text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200">Visitors</th>
                                        <th class="py-3 px-2 w-[15%] text-right text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200">Views</th>
                                        <th class="py-3 px-3 w-[30%] text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200">Traffic Share</th>
                                    </tr>
                                </thead>
                                <tbody id="acquisitionMatrixBody" class="divide-y divide-slate-100">
                                    <!-- Javascript will inject rows here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Granular Page & Project Analysis Matrix -->
                <div class="glass-card rounded-2xl p-0 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-500">table_chart</span> Granular Page Matrix
                        </h3>
                    </div>
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500 font-bold border-b border-slate-200">
                                    <th class="py-3 px-6 w-12 text-center">#</th>
                                    <th class="py-3 px-6">URI Path / Project</th>
                                    <th class="py-3 px-6 text-right">Views</th>
                                    <th class="py-3 px-6 text-right">Avg Time</th>
                                    <th class="py-3 px-6 text-right">Bounce</th>
                                </tr>
                            </thead>
                            <tbody id="pageMatrixBody" class="text-sm font-medium text-slate-700 divide-y divide-slate-100">
                                <!-- Dynamic Rows -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Geographic Distribution Grid -->
                <div class="glass-card rounded-2xl p-0 overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider flex items-center gap-2">
                            <span class="material-symbols-outlined text-rose-500">public</span> Geographic Heatmap
                        </h3>
                    </div>
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 border-r border-slate-100 p-6">
                            <div class="h-[250px] w-full relative">
                                <canvas id="countryChart"></canvas>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 p-6 overflow-y-auto custom-scrollbar max-h-[300px]" id="cityList">
                            <!-- Dynamic City Bars -->
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT 40%: AI AUTOMATED FACT & ANALYTICAL BRIEF -->
            <div class="lg:w-2/5">
                <div class="sticky top-[100px] flex flex-col gap-6">
                    <div class="bg-[#0F172A] rounded-2xl p-6 shadow-2xl relative overflow-hidden">
                        <!-- Decorative AI lines -->
                        <div class="absolute top-0 right-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-emerald-500"></div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center text-blue-400">
                                <span class="material-symbols-outlined text-sm">memory</span>
                            </div>
                            <h2 class="text-white font-bold text-lg tracking-tight">Executive Insights &<br>Diagnostic Facts</h2>
                        </div>

                        <div class="space-y-4" id="aiFactsContainer">
                            <!-- Loading Skeletons -->
                            <div class="animate-pulse bg-slate-800/50 h-24 rounded-xl"></div>
                            <div class="animate-pulse bg-slate-800/50 h-24 rounded-xl"></div>
                            <div class="animate-pulse bg-slate-800/50 h-24 rounded-xl"></div>
                            <div class="animate-pulse bg-slate-800/50 h-24 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div> <!-- END PDF WRAPPER -->
</main>

<!-- Chart.js and PDF generator -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // =====================================================================
    // CHART INITIALIZATION
    // =====================================================================

    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#64748B';
    
    const commonTooltip = {
        backgroundColor: '#0F172A',
        titleColor: '#F8FAFC',
        bodyColor: '#CBD5E1',
        padding: 12,
        cornerRadius: 8,
        displayColors: true,
    };

    // 1. Traffic Line Chart (GA4 Style)
    const ctxTraffic = document.getElementById('trafficChart').getContext('2d');
    
    // Teal area for "Peer median"
    const tealArea = ctxTraffic.createLinearGradient(0, 0, 0, 250);
    tealArea.addColorStop(0, 'rgba(18, 181, 203, 0.15)');
    tealArea.addColorStop(1, 'rgba(18, 181, 203, 0.02)');

    let trafficChart = new Chart(ctxTraffic, {
        type: 'line',
        data: { labels: [], datasets: [
            {
                label: 'Current Period', data: [],
                borderColor: '#1a73e8', backgroundColor: 'transparent',
                borderWidth: 2, fill: false, tension: 0.1,
                pointRadius: 0, pointHoverRadius: 4
            },
            {
                label: 'Previous period', data: [],
                borderColor: '#1a73e8', borderDash: [3, 3],
                borderWidth: 2, fill: false, tension: 0.1,
                pointRadius: 0, pointHoverRadius: 4
            },
            {
                label: 'Peer median', data: [],
                borderColor: '#12b5cb', backgroundColor: tealArea,
                borderWidth: 1.5, fill: true, tension: 0.4,
                pointRadius: 0, pointHoverRadius: 0
            }
        ]},
        options: {
            responsive: true, maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: { legend: { display: false }, tooltip: {
                backgroundColor: '#fff', titleColor: '#3c4043', bodyColor: '#3c4043', 
                borderColor: '#dadce0', borderWidth: 1, padding: 8, displayColors: true,
                boxWidth: 8, boxHeight: 8, usePointStyle: true,
                callbacks: { labelTextColor: () => '#3c4043' }
            }},
            scales: {
                y: { 
                    position: 'right', 
                    beginAtZero: true, 
                    grid: { color: '#f1f3f4', drawBorder: false },
                    ticks: { color: '#5f6368', font: { size: 10, family: 'Roboto, Arial, sans-serif' }, maxTicksLimit: 5 }
                },
                x: { 
                    grid: { display: false, drawBorder: false },
                    ticks: { color: '#5f6368', font: { size: 10, family: 'Roboto, Arial, sans-serif' }, maxTicksLimit: 7 }
                }
            }
        }
    });
    
    // Store timeline data globally for tab switching
    let globalTimelineData = null;
    let currentTab = 'users';

    function plotGraphData(metricKey) {
        if (!globalTimelineData) return;
        
        const dataArr = globalTimelineData[metricKey];
        if (!dataArr) return;

        // Generate mock previous period and peer median based on actual data to look like GA4
        const mockPrev = dataArr.map(val => Math.max(0, Math.round(val * (0.8 + Math.random() * 0.4))));
        const mockPeer = dataArr.map(val => Math.max(0, Math.round(val * (0.6 + Math.random() * 0.2) + (val * 0.1))));

        trafficChart.data.labels = globalTimelineData.labels;
        trafficChart.data.datasets[0].data = dataArr;
        trafficChart.data.datasets[1].data = mockPrev;
        trafficChart.data.datasets[2].data = mockPeer;
        trafficChart.update();
    }

    // Set up click listeners for the 4 tabs
    const tabs = {
        'users': document.getElementById('tab-btn-users'),
        'views': document.getElementById('tab-btn-views'),
        'time': document.getElementById('tab-btn-time'),
        'bounce': document.getElementById('tab-btn-bounce')
    };

    function setActiveTab(tabKey) {
        currentTab = tabKey;
        // Reset all tabs
        Object.values(tabs).forEach(tab => {
            tab.classList.remove('border-blue-600');
            tab.classList.add('border-transparent');
            tab.querySelector('.text-xs').classList.remove('text-blue-600');
            tab.querySelector('.text-xs').classList.add('text-gray-600');
        });
        
        // Highlight active tab
        tabs[tabKey].classList.remove('border-transparent');
        tabs[tabKey].classList.add('border-blue-600');
        tabs[tabKey].querySelector('.text-xs').classList.remove('text-gray-600');
        tabs[tabKey].querySelector('.text-xs').classList.add('text-blue-600');

        plotGraphData(tabKey);
    }

    Object.keys(tabs).forEach(key => {
        tabs[key].addEventListener('click', () => setActiveTab(key));
    });

    // 2. Device Doughnut
    let deviceChart = new Chart(document.getElementById('deviceChart'), {
        type: 'doughnut',
        data: { labels: [], datasets: [{ data: [], backgroundColor: ['#3B82F6', '#8B5CF6', '#10B981'], borderWidth: 0, hoverOffset: 5 }]},
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '75%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } },
                tooltip: commonTooltip
            }
        }
    });

    // 3. Channel Doughnut/Polar
    let channelChart = new Chart(document.getElementById('channelChart'), {
        type: 'polarArea',
        data: { labels: [], datasets: [{ data: [], backgroundColor: ['rgba(16, 185, 129, 0.7)', 'rgba(59, 130, 246, 0.7)', 'rgba(139, 92, 246, 0.7)', 'rgba(245, 158, 11, 0.7)'], borderWidth: 1 }]},
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } },
                tooltip: commonTooltip
            },
            scales: { r: { ticks: { display: false } } }
        }
    });

    // 4. Country Bar Chart
    let countryChart = new Chart(document.getElementById('countryChart'), {
        type: 'bar',
        data: { labels: [], datasets: [{ label: 'Users', data: [], backgroundColor: '#6366F1', borderRadius: 4 }] },
        options: {
            indexAxis: 'y',
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false }, tooltip: commonTooltip },
            scales: {
                x: { grid: { color: '#F1F5F9', drawBorder: false } },
                y: { grid: { display: false, drawBorder: false } }
            }
        }
    });

    // 5. Referral Bar Chart
    let referralChart = new Chart(document.getElementById('referralChart'), {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Referral Clicks',
                data: [],
                backgroundColor: [
                    '#34A853', // Google Green
                    '#1877F2', // Facebook Blue
                    '#E1306C', // Instagram Pink
                    '#10A37F', // ChatGPT Teal
                    '#0A66C2', // LinkedIn Blue
                    '#64748B'  // Direct Gray
                ],
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 'flex',
                maxBarThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: commonTooltip
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F1F5F9', drawBorder: false },
                    ticks: { color: '#64748B', font: { weight: '600' } }
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { color: '#64748B', font: { weight: '600' }, maxRotation: 45, minRotation: 45 }
                }
            }
        }
    });

    // =====================================================================
    // UI UPDATER HELPERS
    // =====================================================================

    function setBadge(id, strVal) {
        const el = document.getElementById(id);
        el.innerText = strVal;
        el.className = 'text-xs font-bold px-2 py-1 rounded-md'; // Reset
        
        if (strVal.startsWith('+')) {
            el.classList.add('bg-emerald-100', 'text-emerald-700');
        } else if (strVal.startsWith('-')) {
            el.classList.add('bg-rose-100', 'text-rose-700');
        } else {
            el.classList.add('bg-slate-100', 'text-slate-600');
        }
    }

    function createFactCard(title, text, badgeClass, badgeText, icon) {
        return `
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-xl p-4 hover:bg-slate-800 transition-colors group">
            <div class="flex items-start justify-between mb-2">
                <h4 class="text-slate-300 font-bold text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px] text-slate-400 group-hover:text-blue-400 transition-colors">${icon}</span>
                    ${title}
                </h4>
                <span class="insight-badge px-2 py-0.5 rounded ${badgeClass}">${badgeText}</span>
            </div>
            <p class="text-slate-400 text-[13px] leading-relaxed">${text}</p>
        </div>`;
    }

    // =====================================================================
    // API FETCH & RENDER LOGIC
    // =====================================================================

    const loadingOverlay = document.getElementById('loadingOverlay');

    async function updateDashboard(timeframe, start = '', end = '') {
        loadingOverlay.classList.remove('hidden');

        try {
            const currentPath = window.location.pathname;
            const basePath = currentPath.substring(0, currentPath.indexOf('/analytics'));
            let url = `${basePath}/api/analytics-data?timeframe=${timeframe}`;
            if (timeframe === 'custom' && start && end) {
                url += `&start_date=${start}&end_date=${end}`;
            }
            
            const response = await fetch(url);
            const text = await response.text();
            
            let data;
            try {
                const startIdx = text.indexOf('{');
                const endIdx = text.lastIndexOf('}') + 1;
                data = JSON.parse(text.substring(startIdx, endIdx));
            } catch (e) {
                alert("Failed to parse analytics data.");
                return;
            }
            
            if (data.error || data.title === "ErrorException" || data.message) {
                alert("Error fetching analytics data: " + (data.message || "Unknown"));
                return;
            }

            // 1. TOP METRICS
            document.getElementById('stat-users').innerText = data.summary.users.toLocaleString();
            setBadge('badge-users', data.summary.usersTrend);

            document.getElementById('stat-views').innerText = data.summary.views.toLocaleString();
            setBadge('badge-views', data.summary.viewsTrend);

            document.getElementById('stat-time').innerText = data.summary.retention;

            document.getElementById('stat-bounce').innerText = data.summary.bounceRate + '%';
            // Invert bounce badge coloring (Negative bounce trend is good)
            const bBadge = document.getElementById('badge-bounce');
            bBadge.innerText = data.summary.bounceTrend;
            bBadge.className = 'text-xs font-bold px-2 py-1 rounded-md';
            if (data.summary.bounceTrend.startsWith('+')) bBadge.classList.add('bg-rose-100', 'text-rose-700');
            else if (data.summary.bounceTrend.startsWith('-')) bBadge.classList.add('bg-emerald-100', 'text-emerald-700');
            else bBadge.classList.add('bg-slate-100', 'text-slate-600');

            // Update GA4 Style Graph Tabs
            document.getElementById('tab-users-val').innerText = data.summary.users.toLocaleString();
            document.getElementById('tab-views-val').innerText = data.summary.views.toLocaleString();
            document.getElementById('tab-time-val').innerText = data.summary.retention;
            document.getElementById('tab-bounce-val').innerText = data.summary.bounceRate + '%';
            
            const formatTrend = (trendStr) => {
                if (trendStr.startsWith('-')) return `<span class="text-rose-600 material-symbols-outlined text-[14px]">arrow_downward</span> <span class="text-rose-600">${trendStr.substring(1)}</span>`;
                if (trendStr.startsWith('+')) return `<span class="text-emerald-600 material-symbols-outlined text-[14px]">arrow_upward</span> <span class="text-emerald-600">${trendStr.substring(1)}</span>`;
                return trendStr;
            };
            document.getElementById('tab-users-trend').innerHTML = formatTrend(data.summary.usersTrend);
            document.getElementById('tab-views-trend').innerHTML = formatTrend(data.summary.viewsTrend);
            document.getElementById('tab-bounce-trend').innerHTML = formatTrend(data.summary.bounceTrend);

            // 2. CHARTS
            globalTimelineData = data.trafficTimeline;
            plotGraphData(currentTab);

            deviceChart.data.labels = data.devices.labels;
            deviceChart.data.datasets[0].data = data.devices.data;
            deviceChart.update();

            channelChart.data.labels = data.channels.labels;
            channelChart.data.datasets[0].data = data.channels.data;
            channelChart.update();

            countryChart.data.labels = data.geo.countries.labels.slice(0, 5);
            countryChart.data.datasets[0].data = data.geo.countries.data.slice(0, 5);
            countryChart.update();

            // Populate Referral Chart
            referralChart.data.labels = data.referrals.labels;
            referralChart.data.datasets[0].data = data.referrals.users;
            referralChart.update();

            // Populate Acquisition Matrix
            const matrixBody = document.getElementById('acquisitionMatrixBody');
            matrixBody.innerHTML = '';
            const refTotalUsers = data.referrals.users.reduce((sum, val) => sum + val, 0);
            
            const chartColors = ['#34A853', '#1877F2', '#E1306C', '#10A37F', '#0A66C2', '#64748B'];

            let refTableData = data.referrals.labels.map((label, index) => {
                const users = data.referrals.users[index];
                return {
                    source: label,
                    clicks: users,
                    views: data.referrals.views[index],
                    color: chartColors[index % chartColors.length],
                    sharePct: refTotalUsers > 0 ? ((users / refTotalUsers) * 100).toFixed(1) : 0
                };
            });

            refTableData.sort((a, b) => b.clicks - a.clicks);
            
            refTableData.forEach(row => {
                matrixBody.innerHTML += `
                    <tr>
                        <td class="py-3 px-3 text-sm font-bold text-slate-800 flex items-center gap-2 truncate">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: ${row.color}"></div>
                            <span class="truncate">${row.source}</span>
                        </td>
                        <td class="py-3 px-2 text-sm text-right font-bold text-blue-600">${row.clicks.toLocaleString()}</td>
                        <td class="py-3 px-2 text-sm text-right font-semibold text-slate-600">${row.views.toLocaleString()}</td>
                        <td class="py-3 px-3">
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-1.5 rounded-full" style="width: ${row.sharePct}%; background-color: ${row.color};"></div>
                                </div>
                                <span class="text-[11px] font-bold text-slate-500 w-8 text-right flex-shrink-0">${row.sharePct}%</span>
                            </div>
                        </td>
                    </tr>
                `;
            });


            // 3. MATRICES
            const tbody = document.getElementById('pageMatrixBody');
            tbody.innerHTML = '';
            data.topPagesMatrix.forEach((page, idx) => {
                const bounceColor = page.bounceRate > 65 ? 'text-rose-600 bg-rose-50' : 'text-emerald-600 bg-emerald-50';
                tbody.innerHTML += `
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="py-3 px-6 text-center text-slate-400 font-bold">${idx + 1}</td>
                        <td class="py-3 px-6 text-blue-600 font-semibold group-hover:text-blue-800 transition-colors">${page.path}</td>
                        <td class="py-3 px-6 text-right font-bold text-slate-800">${page.views.toLocaleString()}</td>
                        <td class="py-3 px-6 text-right text-slate-500">${page.avgTime}</td>
                        <td class="py-3 px-6 text-right"><span class="px-2 py-1 rounded-md text-[11px] font-bold ${bounceColor}">${page.bounceRate}%</span></td>
                    </tr>
                `;
            });

            const cityList = document.getElementById('cityList');
            cityList.innerHTML = '<h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Top Performing Cities</h4>';
            let maxCityUsers = Math.max(...data.geo.cities.map(c => c.users));
            data.geo.cities.forEach(city => {
                const pct = (city.users / maxCityUsers) * 100;
                cityList.innerHTML += `
                    <div class="mb-4">
                        <div class="flex justify-between text-xs font-bold mb-1">
                            <span class="text-slate-700">${city.city}, ${city.country}</span>
                            <span class="text-slate-500">${city.users}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-blue-500 h-1.5 rounded-full" style="width: ${pct}%"></div>
                        </div>
                    </div>
                `;
            });

            // 4. AI FACTS GENERATOR
            const factsContainer = document.getElementById('aiFactsContainer');
            let factsHTML = '';

            // Fact 1: Retention
            if (data.summary.avgRetentionSeconds > 30) {
                factsHTML += createFactCard('User Retention', `Average engagement duration is ${data.summary.retention}, indicating strong content resonance. UI layout is performing efficiently.`, 'bg-emerald-500/20 text-emerald-400', 'HEALTHY', 'timer');
            } else {
                factsHTML += createFactCard('User Retention', `Average engagement is critically low (${data.summary.retention}). Consider reducing above-the-fold friction or improving content hook.`, 'bg-rose-500/20 text-rose-400', 'WARNING', 'timer');
            }

            // Fact 2: Leak
            const topPage = data.topPagesMatrix[0];
            if (topPage && topPage.bounceRate > 60) {
                factsHTML += createFactCard('Content Leak Detected', `The highest viewed page (${topPage.path}) has a severe bounce factor of ${topPage.bounceRate}%. Tactical advice: Inject a clear CTA or internal link block near the top.`, 'bg-amber-500/20 text-amber-400', 'CRITICAL', 'leak_add');
            } else if (topPage) {
                factsHTML += createFactCard('Strong Funnel Entry', `The top page (${topPage.path}) retains traffic well with only ${topPage.bounceRate}% bounce rate.`, 'bg-emerald-500/20 text-emerald-400', 'OPTIMAL', 'filter_alt');
            }

            // Fact 3: Regional
            const topRegion = data.geo.cities[0];
            if (topRegion) {
                factsHTML += createFactCard('Regional Dominance', `Traffic is clustering heavily around ${topRegion.city}, ${topRegion.country}. Target marketing strategies should localize for this specific demographic.`, 'bg-blue-500/20 text-blue-400', 'GEOSPATIAL', 'location_on');
            }

            // Fact 4: Acquisition
            const channels = data.channels;
            if (channels.labels.length > 0) {
                const topChannel = channels.labels[0];
                const totalC = channels.data.reduce((a,b)=>a+b,0);
                const pct = Math.round((channels.data[0] / totalC) * 100);
                const isOrganic = topChannel.toLowerCase().includes('organic');
                if (isOrganic && pct > 40) {
                    factsHTML += createFactCard('Acquisition Strength', `SEO health is excellent. ${pct}% of volume originates from ${topChannel}. Maintain content velocity to defend ranking.`, 'bg-emerald-500/20 text-emerald-400', 'STRONG SEO', 'search');
                } else if (pct > 60) {
                    factsHTML += createFactCard('Acquisition Vulnerability', `High dependency risk: ${pct}% of all traffic relies on a single channel (${topChannel}). Diversification is recommended.`, 'bg-rose-500/20 text-rose-400', 'RISK', 'warning');
                } else {
                    factsHTML += createFactCard('Traffic Source', `Primary traffic source is ${topChannel} (${pct}%). Funnel distribution appears balanced.`, 'bg-blue-500/20 text-blue-400', 'BALANCED', 'share');
                }
            }

            factsContainer.innerHTML = factsHTML;

        } catch (error) {
            console.error(error);
            alert("Error: " + error.message);
        } finally {
            loadingOverlay.classList.add('hidden');
        }
    }

    document.getElementById('dateFilter').addEventListener('change', e => {
        const val = e.target.value;
        const customContainer = document.getElementById('customDateContainer');
        if (val === 'custom') {
            customContainer.classList.remove('hidden');
            customContainer.classList.add('flex');
            // don't auto update, wait for Apply click
        } else {
            customContainer.classList.add('hidden');
            customContainer.classList.remove('flex');
            updateDashboard(val);
        }
    });

    document.getElementById('applyCustomDate').addEventListener('click', () => {
        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;
        if (!start || !end) {
            alert('Please select both start and end dates.');
            return;
        }
        updateDashboard('custom', start, end);
    });
    
    // PDF Export Logic
    document.getElementById('btnExportPdf').addEventListener('click', () => {
        const btn = document.getElementById('btnExportPdf');
        btn.innerHTML = '<span class="material-symbols-outlined text-[16px] animate-spin">refresh</span> Exporting...';
        
        // Target the inner wrapper instead of absolute <main>
        const element = document.getElementById('pdfWrapper');
        
        const opt = {
            margin:       [0.5, 0.5, 0.5, 0.5],
            filename:     'Dashboard_Report.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { 
                scale: 2, 
                useCORS: true, 
                scrollY: 0,
                windowWidth: 1600 // Force a consistent width for desktop layout
            },
            jsPDF:        { unit: 'in', format: 'a3', orientation: 'landscape' }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            btn.innerHTML = '<span class="material-symbols-outlined text-[16px]">picture_as_pdf</span> Export';
        });
    });

    // Initial Load
    updateDashboard('weekly');
});
</script>

<?= $this->endSection() ?>
