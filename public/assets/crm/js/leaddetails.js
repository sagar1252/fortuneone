// Simple micro-interactions
document.querySelectorAll('button, a').forEach(el => {
    el.addEventListener('mousedown', () => {
        el.style.transform = 'scale(0.98)';
    });
    el.addEventListener('mouseup', () => {
        el.style.transform = 'scale(1)';
    });
});

// Tab switching logic (Visual only for demonstration)
const tabs = document.querySelectorAll('button[class*="text-label-md"]');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => {
            t.classList.remove('text-primary', 'font-bold', 'border-primary');
            t.classList.add('text-secondary', 'border-transparent');
        });
        tab.classList.remove('text-secondary', 'border-transparent');
        tab.classList.add('text-primary', 'font-bold', 'border-primary');
    });
});
