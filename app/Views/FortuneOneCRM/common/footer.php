<!-- Mobile Bottom Nav -->
<nav class="fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-outline-variant flex items-center justify-around md:hidden z-50">
    <a href="<?= base_url('dashboard') ?>" class="flex flex-col items-center text-on-surface-variant">
        <span class="material-symbols-outlined">dashboard</span>
        <span class="text-[10px] font-bold">DASH</span>
    </a>
  <a href="<?= base_url('leads') ?>" class="hidden flex flex-col items-center text-primary">

        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person_search</span>
        <span class="text-[10px] font-bold">LEADS</span>
    </a>
       <a href="#" class="hidden w-12 h-12 bg-primary rounded-full -mt-8 shadow-lg text-white flex items-center justify-center">
        <span class="material-symbols-outlined">add</span>
    </a>

    <a href="<?= base_url('appointments') ?>" class="flex flex-col items-center text-on-surface-variant">
        <span class="material-symbols-outlined">event_available</span>
        <span class="text-[10px] font-bold">APPTS</span>
    </a>
    <a href="<?= base_url('settings') ?>" class="flex flex-col items-center text-on-surface-variant">
        <span class="material-symbols-outlined">settings</span>
        <span class="text-[10px] font-bold">SETT</span>
    </a>
</nav>

<!-- Footer Text -->
<div class="py-4 text-center text-[11px] text-on-surface-variant">
    Fortune One CRM • Version 1.0 • <?= date('Y') ?>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const backdrop = document.getElementById('sidebar-backdrop');
    if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
    } else {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
    }
}
</script>
