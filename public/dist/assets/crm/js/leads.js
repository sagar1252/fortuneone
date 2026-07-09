function toggleDrawer() {
    const drawer = document.getElementById('lead-drawer');
    drawer.classList.toggle('drawer-open');
}

function switchDrawerTab(tabName) {
    // Hide all contents
    document.querySelectorAll('.drawer-content').forEach(content => {
        content.classList.add('hidden');
    });
    // Reset tab styles
    document.querySelectorAll('.drawer-tab').forEach(tab => {
        tab.classList.remove('text-primary', 'border-primary');
        tab.classList.add('text-on-surface-variant', 'border-transparent');
    });
    
    // Show active content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    // Set active tab style
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.add('text-primary', 'border-primary');
    activeTab.classList.remove('text-on-surface-variant', 'border-transparent');
}
