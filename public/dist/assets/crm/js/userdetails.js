function switchTab(event, tabId) {
    // Hide all panels
    const panels = document.querySelectorAll('.tab-panel');
    panels.forEach(panel => panel.classList.add('hidden'));
    panels.forEach(panel => panel.classList.remove('block'));

    // Deactivate all buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(btn => {
        btn.classList.remove('active', 'text-primary', 'border-b-2', 'border-primary', 'font-semibold');
        btn.classList.add('text-on-surface-variant');
    });

    // Show current panel
    const activePanel = document.getElementById(tabId);
    if (activePanel) {
        activePanel.classList.remove('hidden');
        activePanel.classList.add('block');
    }

    // Activate current button
    event.currentTarget.classList.add('active', 'text-primary', 'border-b-2', 'border-primary', 'font-semibold');
    event.currentTarget.classList.remove('text-on-surface-variant');
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('tab-overview');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const result = await response.json();
                if (result.status) {
                    alert(result.message || 'User profile updated successfully.');
                    window.location.reload();
                } else {
                    alert('Error: ' + (result.message || 'Unknown error occurred.'));
                }
            } catch (err) {
                console.error(err);
                alert('Failed to connect to the server.');
            }
        });
    }

    const permissionsForm = document.getElementById('form-permissions');
    if (permissionsForm) {
        permissionsForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(permissionsForm);
            try {
                const response = await fetch(permissionsForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const result = await response.json();
                if (result.status) {
                    alert(result.message || 'User permissions updated successfully.');
                    window.location.reload();
                } else {
                    alert('Error: ' + (result.message || 'Unknown error occurred.'));
                }
            } catch (err) {
                console.error(err);
                alert('Failed to connect to the server.');
            }
        });
    }
});
