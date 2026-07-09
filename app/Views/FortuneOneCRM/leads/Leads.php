<?= $this->extend('FortuneOneCRM/common/master') ?>
<?= $this->section('content') ?>
<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-lg custom-scrollbar">
<div class="max-w-[1440px] mx-auto pb-xxl">
<?= view('FortuneOneCRM/common/page-header', [
    'title' => 'Leads',
    'subtitle' => 'Manage customer inquiries, advisor requests, site visits, and lead progression across the Fortune One ecosystem.'
]) ?>
<!-- Summary Cards Grid -->
<div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-gutter mb-xl">
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'Total Leads', 'value' => number_format($kpis['total_leads'] ?? 0), 'subtitleIcon' => 'trending_up', 'subtitle' => 'Active records', 'subtitleClass' => 'text-green-600']) ?>
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'New Today', 'value' => number_format($kpis['new_leads_today'] ?? 0), 'subtitleIcon' => 'bolt', 'subtitle' => 'High velocity', 'subtitleClass' => 'text-blue-600']) ?>
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'Advisor Requests', 'value' => number_format($kpis['advisor_requests'] ?? 0), 'subtitleIcon' => 'priority_high', 'subtitle' => 'Requires attention', 'subtitleClass' => 'text-amber-600']) ?>
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'Site Visits', 'value' => number_format($kpis['site_visits'] ?? 0), 'subtitleIcon' => 'calendar_month', 'subtitle' => 'Scheduled', 'subtitleClass' => 'text-on-surface-variant']) ?>
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'Hot Leads', 'value' => number_format($kpis['hot_leads'] ?? 0), 'subtitleIcon' => 'local_fire_department', 'subtitle' => 'High conversion', 'subtitleClass' => 'text-red-600']) ?>
    <?= view('FortuneOneCRM/common/stats-card', ['title' => 'Booked', 'value' => number_format($kpis['booked'] ?? 0), 'subtitleIcon' => 'check_circle', 'subtitle' => 'Conversion successful', 'subtitleClass' => 'text-green-600']) ?>
</div>
<!-- Filters & Quick Actions -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-md mb-lg">
<!-- Quick Filter Tabs -->
<div class="flex flex-wrap gap-2 mb-md border-b border-outline-variant pb-md">
<a class="px-4 py-1.5 rounded-full <?= (empty($interest) && empty($priority)) ? 'bg-primary text-on-primary' : 'hover:bg-surface-container text-on-surface-variant' ?> font-label-md text-label-md" href="<?= base_url('leads') ?>">All Leads</a>
<a class="px-4 py-1.5 rounded-full <?= $interest === 'cold' ? 'bg-primary text-on-primary' : 'hover:bg-surface-container text-on-surface-variant' ?> font-label-md text-label-md" href="<?= base_url('leads?interest=cold') ?>">New</a>
<a class="px-4 py-1.5 rounded-full <?= $priority === 'high' ? 'bg-primary text-on-primary' : 'hover:bg-surface-container text-on-surface-variant' ?> font-label-md text-label-md" href="<?= base_url('leads?priority=high') ?>">Needs Follow-up</a>
<a class="px-4 py-1.5 rounded-full hover:bg-surface-container text-on-surface-variant font-label-md text-label-md" href="<?= base_url('appointments?type=site_visit') ?>">Site Visits</a>
<a class="px-4 py-1.5 rounded-full hover:bg-surface-container text-on-surface-variant font-label-md text-label-md" href="<?= base_url('appointments?status=completed') ?>">Booked</a>
<a class="px-4 py-1.5 rounded-full hover:bg-surface-container text-on-surface-variant font-label-md text-label-md" href="<?= base_url('careers') ?>">Career Applications</a>
</div>
<!-- Robust Filter Bar -->
<form method="GET" action="<?= base_url('leads') ?>" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-sm" id="leads-filter-form">
<div class="relative">
<input name="q" value="<?= esc($search) ?>" class="w-full h-10 bg-surface border border-outline-variant rounded-lg pl-9 pr-4 font-body-md text-body-md focus:ring-1 focus:ring-primary" placeholder="Search leads..." type="text"/>
<span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
</div>
<select name="source" class="h-10 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md px-3" onchange="this.form.submit()">
<option value="">Source: All</option>
<option value="AI Advisor">AI Advisor</option>
<option value="Contact Form">Contact Form</option>
<option value="Direct Referral">Direct Referral</option>
</select>
<select name="project" class="h-10 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md px-3" onchange="this.form.submit()">
<option value="">Project: All</option>
<option value="The Pinnacle">The Pinnacle</option>
<option value="Azure Shores">Azure Shores</option>
<option value="Sky Garden">Sky Garden</option>
</select>
<select name="assigned" class="h-10 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md px-3" onchange="this.form.submit()">
<option value="">Assigned To: All</option>
<option value="Marcus Holloway">Marcus Holloway</option>
<option value="Sarah Chen">Sarah Chen</option>
</select>
<select name="interest" class="h-10 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md px-3" onchange="this.form.submit()">
<option value="" <?= $interest === '' ? 'selected' : '' ?>>Interest: Any</option>
<option value="cold" <?= $interest === 'cold' ? 'selected' : '' ?>>Cold</option>
<option value="warm" <?= $interest === 'warm' ? 'selected' : '' ?>>Warm</option>
<option value="hot" <?= $interest === 'hot' ? 'selected' : '' ?>>Hot</option>
<option value="ready" <?= $interest === 'ready' ? 'selected' : '' ?>>Ready</option>
</select>
<select name="priority" class="h-10 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md px-3" onchange="this.form.submit()">
<option value="" <?= $priority === '' ? 'selected' : '' ?>>Priority: Any</option>
<option value="high" <?= $priority === 'high' ? 'selected' : '' ?>>High</option>
<option value="medium" <?= $priority === 'medium' ? 'selected' : '' ?>>Medium</option>
<option value="low" <?= $priority === 'low' ? 'selected' : '' ?>>Low</option>
</select>

    <?= csrf_field() ?>
</form>
</div>
<!-- Lead Table -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-x-auto shadow-sm">
<table class="w-full text-left font-body-md text-body-md border-collapse">
<thead class="bg-surface-container-low border-b border-outline-variant">
<tr>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Lead Name</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Contact</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Source</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Interest</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Status</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Assigned To</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]">Created At</th>
<th class="px-lg py-4 font-semibold text-on-surface-variant uppercase tracking-wider text-[11px]"></th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/30">
<?php if (empty($leads)): ?>
<?= view('FortuneOneCRM/common/table-empty-state', ['colspan' => 8, 'message' => 'No leads found matching the filters.']) ?>
<?php else: ?>
<?php foreach ($leads as $lead): 
    $initials = '';
    if (!empty($lead['name'])) {
        $words = explode(' ', $lead['name']);
        $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
    } else {
        $initials = 'LD';
    }
?>
<tr class="hover:bg-surface-bright transition-colors group cursor-pointer" onclick="window.location.href='<?= base_url('leads/details/' . $lead['id']) ?>'">
<td class="px-lg py-4">
<div class="flex items-center gap-3">
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-[12px]"><?= esc($initials) ?></div>
<span class="font-medium text-on-surface"><?= esc($lead['name'] ?? 'Anonymous') ?></span>
</div>
</td>
<td class="px-lg py-4">
<p class="text-on-surface text-sm"><?= esc($lead['phone'] ?? 'N/A') ?></p>
<p class="text-on-surface-variant text-xs"><?= esc($lead['email'] ?? 'N/A') ?></p>
</td>
<td class="px-lg py-4">
<span class="px-2 py-0.5 rounded-md bg-secondary-container text-on-secondary-fixed-variant text-[11px] font-semibold border border-outline-variant"><?= esc($lead['last_action'] ?: 'AI Chat') ?></span>
</td>
<td class="px-lg py-4">
<span class="text-on-surface"><?= esc($lead['last_project_viewed'] ?: 'General Inquiry') ?></span>
</td>
<td class="px-lg py-4">
<?php
    $statusClass = 'bg-blue-50 text-blue-700 border-blue-200';
    $statusLabel = 'New';
    if ($lead['interest_level'] === 'warm') {
        $statusClass = 'bg-amber-50 text-amber-700 border-amber-200';
        $statusLabel = 'Interested';
    } elseif ($lead['interest_level'] === 'hot') {
        $statusClass = 'bg-red-50 text-red-700 border-red-200';
        $statusLabel = 'Hot Lead';
    } elseif ($lead['interest_level'] === 'ready') {
        $statusClass = 'bg-green-50 text-green-700 border-green-200';
        $statusLabel = 'Ready to Book';
    }
?>
<span class="px-2.5 py-1 rounded-full <?= esc($statusClass) ?> text-[11px] font-bold border"><?= esc($statusLabel) ?></span>
</td>
<td class="px-lg py-4">
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-surface-container border border-outline-variant flex items-center justify-center"><span class="material-symbols-outlined text-[14px]">person</span></div>
<span>AI Advisor</span>
</div>
</td>
<td class="px-lg py-4 text-on-surface-variant"><?= !empty($lead['created_at']) ? date('M d, Y', strtotime($lead['created_at'])) : 'N/A' ?></td>
<td class="px-lg py-4 text-right">
<a href="<?= base_url('leads/details/' . $lead['id']) ?>" class="p-1 hover:bg-surface-container rounded-full inline-block">
<span class="material-symbols-outlined text-[20px]">chevron_right</span>
</a>
</td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
<?= view('FortuneOneCRM/common/pagination', [
    'page' => $page ?? 1,
    'totalRows' => $totalRows ?? 0,
    'perPage' => 10,
    'baseUrl' => 'leads',
    'item_name' => 'leads'
]) ?>
</div>
</div>
</main>
<!-- Lead Detail Drawer -->
<div class="fixed top-0 right-0 h-full w-full sm:w-[500px] bg-white border-l border-outline-variant shadow-2xl z-[100] translate-x-full overflow-hidden flex flex-col" id="lead-drawer">
<!-- Drawer Header -->
<div class="p-lg border-b border-outline-variant flex justify-between items-start">
<div class="flex items-center gap-4">
<div class="w-16 h-16 rounded-2xl bg-primary text-white flex items-center justify-center font-bold text-2xl shadow-lg">JC</div>
<div>
<h3 class="font-headline-md text-headline-md font-bold text-on-surface">Julian Casablancas</h3>
<p class="font-body-md text-body-md text-on-surface-variant">j.casablancas@voids.com • +1 555-0912-321</p>
<div class="flex items-center gap-2 mt-2">
<span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[10px] font-bold border border-amber-200">SITE VISIT SCHEDULED</span>
<span class="text-on-surface-variant text-[11px]">• Azure Shores, Penthouse B</span>
</div>
</div>
</div>
<button class="p-2 hover:bg-surface-container rounded-full" onclick="toggleDrawer()">
<span class="material-symbols-outlined">close</span>
</button>
</div>
<!-- Quick Action Bar -->
<div class="px-lg py-4 bg-surface-container-low border-b border-outline-variant grid grid-cols-5 gap-2">
<button class="flex flex-col items-center gap-1 p-2 hover:bg-white rounded-lg transition-colors group">
<span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">call</span>
<span class="text-[10px] font-bold uppercase tracking-tighter">Call</span>
</button>
<button class="flex flex-col items-center gap-1 p-2 hover:bg-white rounded-lg transition-colors group">
<span class="material-symbols-outlined text-green-600 group-hover:scale-110 transition-transform">chat</span>
<span class="text-[10px] font-bold uppercase tracking-tighter">WhatsApp</span>
</button>
<button class="flex flex-col items-center gap-1 p-2 hover:bg-white rounded-lg transition-colors group">
<span class="material-symbols-outlined text-blue-600 group-hover:scale-110 transition-transform">mail</span>
<span class="text-[10px] font-bold uppercase tracking-tighter">Email</span>
</button>
<button class="flex flex-col items-center gap-1 p-2 hover:bg-white rounded-lg transition-colors group">
<span class="material-symbols-outlined text-amber-600 group-hover:scale-110 transition-transform">event</span>
<span class="text-[10px] font-bold uppercase tracking-tighter">Visit</span>
</button>
<button class="flex flex-col items-center gap-1 p-2 hover:bg-white rounded-lg transition-colors group">
<span class="material-symbols-outlined text-on-surface-variant group-hover:scale-110 transition-transform">note_add</span>
<span class="text-[10px] font-bold uppercase tracking-tighter">Note</span>
</button>
</div>
<!-- Tabs -->
<div class="px-lg flex border-b border-outline-variant overflow-x-auto no-scrollbar">
<button class="drawer-tab py-4 px-4 font-label-md text-label-md text-primary border-b-2 border-primary whitespace-nowrap" id="tab-overview" onclick="switchDrawerTab('overview')">Overview</button>
<button class="drawer-tab py-4 px-4 font-label-md text-label-md text-on-surface-variant border-b-2 border-transparent hover:text-on-surface whitespace-nowrap" id="tab-conversation" onclick="switchDrawerTab('conversation')">Conversation</button>
<button class="drawer-tab py-4 px-4 font-label-md text-label-md text-on-surface-variant border-b-2 border-transparent hover:text-on-surface whitespace-nowrap" id="tab-activities" onclick="switchDrawerTab('activities')">Activities</button>
<button class="drawer-tab py-4 px-4 font-label-md text-label-md text-on-surface-variant border-b-2 border-transparent hover:text-on-surface whitespace-nowrap" id="tab-appointments" onclick="switchDrawerTab('appointments')">Appointments</button>
<button class="drawer-tab py-4 px-4 font-label-md text-label-md text-on-surface-variant border-b-2 border-transparent hover:text-on-surface whitespace-nowrap" id="tab-notes" onclick="switchDrawerTab('notes')">Notes</button>
</div>
<!-- Tab Content Area -->
<div class="flex-1 overflow-y-auto p-lg custom-scrollbar bg-surface-bright/30">
<!-- Overview Tab (Default) -->
<div class="drawer-content space-y-6" id="content-overview">
<div>
<h4 class="font-label-sm text-label-sm uppercase text-on-surface-variant mb-3">Core Details</h4>
<div class="grid grid-cols-2 gap-4">
<div class="p-3 bg-white border border-outline-variant rounded-lg">
<p class="text-[11px] text-on-surface-variant uppercase">Interest Level</p>
<p class="text-on-surface font-medium">9.8/10 High Priority</p>
</div>
<div class="p-3 bg-white border border-outline-variant rounded-lg">
<p class="text-[11px] text-on-surface-variant uppercase">Buying Power</p>
<p class="text-on-surface font-medium">$4.5M - $6.2M</p>
</div>
</div>
</div>
<div>
<h4 class="font-label-sm text-label-sm uppercase text-on-surface-variant mb-3">AI Analysis</h4>
<p class="bg-primary-container/10 p-4 rounded-xl border-l-4 border-primary text-on-surface-variant italic font-body-md text-body-md">
                        "Julian is primarily interested in top-floor units with westward sea views. He mentioned a preference for smart-home integration and private elevator access. He is looking to relocate within the next 3 months."
                    </p>
</div>
</div>
<!-- Conversation Tab -->
<div class="drawer-content hidden space-y-4" id="content-conversation">
<div class="flex justify-center">
<span class="px-3 py-1 bg-surface-container rounded-full text-[10px] text-on-surface-variant uppercase font-bold">Today, 10:42 AM</span>
</div>
<div class="max-w-[85%] bg-surface-container-high p-4 rounded-2xl rounded-bl-none">
<p class="font-body-md text-body-md text-on-surface">Hello, I'm interested in the Azure Shores project. Specifically the Penthouse B. Is it still available?</p>
</div>
<div class="max-w-[85%] bg-primary text-on-primary p-4 rounded-2xl rounded-br-none ml-auto">
<p class="font-body-md text-body-md">Greetings Julian. Yes, Penthouse B is currently available. It features 5,400 sq. ft. of living space and a private rooftop pool. Would you like to see a virtual tour or schedule a site visit?</p>
<div class="mt-3 space-y-2">
<label class="flex items-center gap-2 bg-white/10 p-2 rounded-lg cursor-pointer hover:bg-white/20 transition-colors">
<input class="text-white focus:ring-0" name="ai-opt" type="radio"/>
<span class="text-xs">Schedule a Site Visit</span>
</label>
<label class="flex items-center gap-2 bg-white/10 p-2 rounded-lg cursor-pointer hover:bg-white/20 transition-colors">
<input class="text-white focus:ring-0" name="ai-opt" type="radio"/>
<span class="text-xs">Send Virtual Tour Link</span>
</label>
</div>
</div>
<div class="max-w-[85%] bg-surface-container-high p-4 rounded-2xl rounded-bl-none">
<p class="font-body-md text-body-md text-on-surface">I'd like to schedule a site visit for this Thursday if possible.</p>
</div>
</div>
<!-- Activities Tab -->
<div class="drawer-content hidden" id="content-activities">
<div class="relative pl-6 border-l-2 border-outline-variant space-y-8 py-2">
<div class="relative">
<div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-primary ring-4 ring-white"></div>
<p class="font-label-sm text-label-sm text-on-surface-variant">Today, 10:45 AM</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Site Visit Scheduled</p>
<p class="text-sm text-on-surface-variant">Confirmed for Thursday, Nov 2nd at 14:00.</p>
</div>
<div class="relative">
<div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-surface-container ring-4 ring-white border-2 border-outline"></div>
<p class="font-label-sm text-label-sm text-on-surface-variant">Today, 10:43 AM</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Advisor Requested</p>
<p class="text-sm text-on-surface-variant">Julian requested a manual review of Penthouse B floorplans.</p>
</div>
<div class="relative">
<div class="absolute -left-[31px] top-1 w-4 h-4 rounded-full bg-surface-container ring-4 ring-white border-2 border-outline"></div>
<p class="font-label-sm text-label-sm text-on-surface-variant">Today, 10:42 AM</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">Lead Created</p>
<p class="text-sm text-on-surface-variant">Inbound lead from AI Advisor chat widget.</p>
</div>
</div>
</div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/crm/js/leads.js') ?>"></script>
<?= $this->endSection() ?>