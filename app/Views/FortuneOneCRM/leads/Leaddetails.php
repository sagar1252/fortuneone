<?= $this->extend('FortuneOneCRM/common/master') ?>
<?= $this->section('content') ?>
<main class="ml-0 md:ml-64 pt-16 h-screen flex overflow-hidden">
<!-- Left Sidebar: Lead Profile -->
<aside class="hidden lg:flex w-80 shrink-0 border-r border-outline-variant bg-white flex-col custom-scrollbar overflow-y-auto">
<div class="p-lg">
<!-- Profile Card -->
<div class="relative mb-lg">
<img class="w-full h-48 object-cover rounded-xl mb-md grayscale hover:grayscale-0 transition-all duration-700" data-alt="A detailed portrait of a sophisticated high-net-worth individual, Julian Casablancas, with a relaxed yet refined aesthetic. He is portrayed in a tastefully decorated mid-century modern living space with warm ambient lighting. The visual style is premium and cinematic, suggesting exclusivity and wealth." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXQXkspZDrxsl88R_udlvvsTrm3t1VRPSdC41FSbB0Drc_tl2pFMYAaDA8b_TsAcLxs3P0zeejfRQ6gUIFmvGDfio826mdXM75WylNB7ickOo6wIEAMPS8lykM1gyHhCqUzuA6W8RfrVmzifEjENg1sRyZCFPPOhG_vm6QS_s2E3vdgOGhxxfD82dTvY__u4XhXGWG7nPXrQ6Qz5CsV5QwSdOHwmToB8BCdf-XRBUJv-yme9k51fficBju7R7gh1jWg-KILRuHUbU"/>
<div class="absolute top-3 right-3">
<span class="bg-primary text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Hot Lead</span>
</div>
</div>
<div>
<h2 class="text-headline-md font-headline-md font-semibold text-primary mb-xs"><?= esc($lead['name'] ?? 'Anonymous') ?></h2>
<p class="text-body-md text-secondary flex items-center gap-xs mb-md">
<span class="material-symbols-outlined text-[16px]">call</span>
                        <?= esc($lead['phone'] ?? 'N/A') ?>
                    </p>
<div class="inline-flex items-center gap-sm bg-surface-container px-3 py-1.5 rounded-full border border-outline-variant">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
<span class="text-label-md font-label-md text-primary"><?= esc(ucfirst($lead['interest_level'] ?? 'cold')) ?></span>
</div>
</div>
<!-- Customer Requirements -->
<div class="mt-xxl border-t border-outline-variant pt-lg">
<h3 class="text-label-sm font-label-sm text-secondary uppercase tracking-widest mb-lg">Customer Requirements</h3>
<div class="space-y-lg">
<div class="flex flex-col gap-xs">
<span class="text-label-sm text-secondary">Investment Budget</span>
<span class="text-body-md font-semibold text-primary"><?= esc($lead['budget'] ?? 'N/A') ?></span>
</div>
<div class="flex flex-col gap-xs">
<span class="text-label-sm text-secondary">Primary Goal</span>
<span class="text-body-md font-semibold text-primary"><?= esc($lead['goal'] ?? 'N/A') ?></span>
</div>
<div class="flex flex-col gap-xs">
<span class="text-label-sm text-secondary">Specific Interest</span>
<span class="text-body-md font-semibold text-primary"><?= esc($lead['last_project_viewed'] ?? 'N/A') ?></span>
</div>
<div class="flex flex-col gap-xs">
<span class="text-label-sm text-secondary">Estimated Timeline</span>
<span class="text-body-md font-semibold text-primary"><?= esc($lead['timeline'] ?? 'N/A') ?></span>
</div>
</div>
</div>
</div>
</aside>
<!-- Center: Tabbed Interface & Conversations -->
<section class="flex-grow flex flex-col bg-surface overflow-hidden">
<!-- Tabs Navigation -->
<div class="px-gutter bg-white border-b border-outline-variant flex items-center justify-between">
<div class="flex gap-xl">
<button class="py-md text-label-md font-label-md text-secondary hover:text-primary transition-all border-b-2 border-transparent">Overview</button>
<button class="py-md text-label-md font-label-md text-primary font-bold border-b-2 border-primary">Conversation</button>
<button class="py-md text-label-md font-label-md text-secondary hover:text-primary transition-all border-b-2 border-transparent">Activities</button>
<button class="py-md text-label-md font-label-md text-secondary hover:text-primary transition-all border-b-2 border-transparent">Appointments</button>
<button class="py-md text-label-md font-label-md text-secondary hover:text-primary transition-all border-b-2 border-transparent">Notes</button>
</div>
<div class="flex items-center gap-md"><button onclick="toggleSidebar()" class="p-2 text-on-surface-variant hover:text-primary transition-colors md:hidden flex items-center justify-center mr-2"><span class="material-symbols-outlined">menu</span></button>
<span class="text-label-sm text-secondary italic">Last active: 14 mins ago</span>
<button class="bg-surface-container px-4 py-2 rounded border border-outline-variant text-label-md font-label-md text-primary flex items-center gap-xs">
<span class="material-symbols-outlined text-[18px]">history</span>
                        Full Log
                    </button>
</div>
</div>
<!-- Chat Container -->
<div class="flex-grow flex flex-col overflow-hidden relative">
<!-- Journey Progress Overlay (Compact) -->
<div class="absolute top-0 left-0 right-0 z-10 px-gutter py-4 bg-white/80 backdrop-blur-md border-b border-outline-variant flex items-center justify-between">
<div class="flex items-center gap-md"><button onclick="toggleSidebar()" class="p-2 text-on-surface-variant hover:text-primary transition-colors md:hidden flex items-center justify-center mr-2"><span class="material-symbols-outlined">menu</span></button>
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px]">1</div>
<span class="text-label-sm font-semibold text-primary">Lead Created</span>
</div>
<div class="w-8 h-px bg-outline-variant"></div>
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px]">2</div>
<span class="text-label-sm font-semibold text-primary">AI Vetting</span>
</div>
<div class="w-8 h-px bg-outline-variant"></div>
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-[10px]">3</div>
<span class="text-label-sm font-semibold text-primary">Site Visit</span>
</div>
<div class="w-8 h-px bg-outline-variant"></div>
<div class="flex items-center gap-2">
<div class="w-6 h-6 rounded-full border border-outline text-outline flex items-center justify-center text-[10px]">4</div>
<span class="text-label-sm font-medium text-secondary">Closing</span>
</div>
</div>
<span class="text-label-sm text-primary font-bold">Stage: Site Visit (Active)</span>
</div>
<!-- Messages -->
<div class="flex-grow overflow-y-auto p-gutter pt-24 custom-scrollbar flex flex-col gap-lg bg-surface-bright/50">
<?php if (!empty($conversations)): ?>
    <?php 
    $lastDate = '';
    foreach ($conversations as $conv): 
        $convDate = !empty($conv['created_at']) ? date('l, M d', strtotime($conv['created_at'])) : 'Recent';
        if ($convDate !== $lastDate):
            $lastDate = $convDate;
    ?>
            <!-- Date Separator -->
            <div class="flex justify-center">
                <span class="text-[10px] font-bold uppercase tracking-widest text-secondary px-3 py-1 bg-surface-container rounded-full"><?= esc($convDate) ?></span>
            </div>
        <?php endif; ?>

        <?php if ($conv['role'] === 'user'): ?>
            <!-- User Message -->
            <div class="flex flex-row-reverse gap-md max-w-2xl self-end">
                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-[12px] flex-shrink-0">
                    <?= esc(substr($lead['name'] ?? 'U', 0, 2)) ?>
                </div>
                <div class="space-y-md text-right">
                    <div class="bg-primary text-white p-lg rounded-xl shadow-md">
                        <p class="text-body-md"><?= esc($conv['message']) ?></p>
                    </div>
                    <span class="text-[11px] text-secondary"><?= esc($lead['name'] ?? 'User') ?> • <?= !empty($conv['created_at']) ? date('h:i A', strtotime($conv['created_at'])) : '' ?></span>
                </div>
            </div>
        <?php else: ?>
            <!-- AI Message -->
            <div class="flex gap-md max-w-2xl">
                <div class="w-8 h-8 rounded bg-primary flex-shrink-0 flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">smart_toy</span>
                </div>
                <div class="space-y-md">
                    <div class="bg-white p-lg rounded-xl border border-outline-variant">
                        <p class="text-body-md text-primary"><?= esc($conv['message']) ?></p>
                    </div>
                    <span class="text-[11px] text-secondary">AI Advisor • <?= !empty($conv['created_at']) ? date('h:i A', strtotime($conv['created_at'])) : '' ?></span>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <div class="flex flex-col items-center justify-center p-8 text-on-surface-variant h-full">
        <span class="material-symbols-outlined text-4xl text-outline mb-2">forum</span>
        <p class="font-bold text-primary mb-1">No Conversations</p>
        <p class="text-xs text-on-surface-variant">No conversations available for this lead.</p>
    </div>
<?php endif; ?>
</div>
<!-- Chat Input -->
<div class="p-lg bg-white border-t border-outline-variant">
<div class="flex items-center gap-md p-2 bg-surface rounded-xl border border-outline-variant focus-within:ring-1 focus-within:ring-primary focus-within:border-primary transition-all">
<button class="p-2 text-secondary hover:text-primary transition-colors"><span class="material-symbols-outlined">attach_file</span></button>
<input class="flex-grow bg-transparent border-none focus:ring-0 text-body-md py-2" placeholder="Type a message to Julian..." type="text"/>
<div class="flex items-center gap-sm">
<button class="flex items-center gap-xs px-md py-2 bg-white rounded border border-outline-variant text-label-md font-label-md text-secondary hover:text-primary transition-all">
<span class="material-symbols-outlined text-[18px]">bolt</span>
                                AI Draft
                            </button>
<button class="p-2 bg-primary text-white rounded-lg hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined">send</span>
</button>
</div>
</div>
<div class="flex justify-between items-center mt-sm px-xs">
<p class="text-[10px] text-secondary">Advisor Marcus Holloway is currently viewing this conversation.</p>
<div class="flex gap-md">
<button class="text-[10px] font-bold text-secondary uppercase hover:text-primary">Voice Note</button>
<button class="text-[10px] font-bold text-secondary uppercase hover:text-primary">Insert Property</button>
</div>
</div>
</div>
</div>
</section>
<!-- Right Sidebar: Advisor Panel -->
<aside class="hidden xl:flex w-80 shrink-0 border-l border-outline-variant bg-white flex-col custom-scrollbar overflow-y-auto">
<div class="p-lg">
<div class="flex items-center justify-between mb-lg">
<h3 class="text-label-sm font-label-sm text-secondary uppercase tracking-widest">Lead Ownership</h3>
<span class="w-2 h-2 rounded-full bg-green-500"></span>
</div>
<!-- Advisor Profile -->
<div class="bg-surface-container-low p-md rounded-xl border border-outline-variant mb-xl">
<div class="flex items-center gap-md mb-md">
<img class="w-12 h-12 rounded-lg object-cover" data-alt="Marcus Holloway" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgkr7tHCJNKteCjz6wkDfICYPQldMHDFVpEHtNN5yjj0n-swm67zIqSuCB-XjVqwtbZsidHmNziEt0EnwKUJlaT9ACnyPHe3Y6QdMrwJvl-EZE9lGYK0NftUHXZ3hdryd_ioq3PZ4iPETH7RgyivWuWQdOdeLT5wrRxgdQTLBOTtmI9_KGa89h8ORTm12Alj6ipicsxdtf-tvFb9GroPnRG-ogIYFegUibq-449FV38-6CmRUplvJrfYKSXvUdsfSE_sxDUBgud7w"/>
<div>
<p class="text-body-md font-bold text-primary">Marcus Holloway</p>
<p class="text-label-sm text-secondary">Lead Advisor</p>
</div>
</div>
<div class="grid grid-cols-3 gap-xs">
<button class="p-3 bg-white border border-outline-variant rounded hover:bg-surface-container transition-all flex flex-col items-center gap-xs text-primary">
<span class="material-symbols-outlined text-[20px]">call</span>
<span class="text-[10px] font-bold uppercase">Call</span>
</button>
<button class="p-3 bg-white border border-outline-variant rounded hover:bg-surface-container transition-all flex flex-col items-center gap-xs text-primary">
<span class="material-symbols-outlined text-[20px]">chat</span>
<span class="text-[10px] font-bold uppercase">WhatsApp</span>
</button>
<button class="p-3 bg-white border border-outline-variant rounded hover:bg-surface-container transition-all flex flex-col items-center gap-xs text-primary">
<span class="material-symbols-outlined text-[20px]">event_repeat</span>
<span class="text-[10px] font-bold uppercase">Visit</span>
</button>
</div>
</div>
<!-- Reminders & Actions -->
<div class="space-y-xl">
<div>
<h4 class="text-label-sm font-bold text-primary mb-md flex items-center gap-xs">
<span class="material-symbols-outlined text-[18px]">notification_important</span>
                            Next Follow-up
                        </h4>
<div class="p-md bg-error-container/10 border border-error/10 rounded-lg">
<p class="text-body-md font-bold text-primary">Thursday, Oct 26</p>
<p class="text-label-sm text-secondary">Site Visit: Marquee Tower (14:30)</p>
<button class="mt-sm text-label-sm font-bold text-primary underline">Reschedule</button>
</div>
</div>
<div>
<h4 class="text-label-sm font-bold text-primary mb-md">Internal Status</h4>
<div class="space-y-sm">
<label class="flex items-center gap-md p-md border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container transition-all">
<input class="rounded text-primary focus:ring-primary border-outline-variant" type="checkbox"/>
<span class="text-body-md text-primary">Vetting Completed</span>
</label>
<label class="flex items-center gap-md p-md border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container transition-all">
<input checked="" class="rounded text-primary focus:ring-primary border-outline-variant" type="checkbox"/>
<span class="text-body-md text-primary">KYC Verified</span>
</label>
<label class="flex items-center gap-md p-md border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container transition-all">
<input class="rounded text-primary focus:ring-primary border-outline-variant" type="checkbox"/>
<span class="text-body-md text-primary">Financing Proof Secured</span>
</label>
</div>
</div>
<div>
<h4 class="text-label-sm font-bold text-primary mb-md">Tags</h4>
<div class="flex flex-wrap gap-xs">
<span class="px-2 py-1 bg-surface-container text-[10px] font-bold text-secondary rounded uppercase">Ultra-High Net</span>
<span class="px-2 py-1 bg-surface-container text-[10px] font-bold text-secondary rounded uppercase">Penthouse Only</span>
<span class="px-2 py-1 bg-surface-container text-[10px] font-bold text-secondary rounded uppercase">Cash Buyer</span>
</div>
</div>
<button class="w-full py-md border border-outline-variant rounded text-label-md font-bold text-primary hover:bg-surface-container transition-all">
                        Archive Lead
                    </button>
</div>
</div>
</aside>
</main>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/crm/js/leaddetails.js') ?>"></script>
<?= $this->endSection() ?>