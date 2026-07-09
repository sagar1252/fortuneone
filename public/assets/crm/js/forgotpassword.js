function handleReset(event) {
    event.preventDefault();
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('error-message');
    const formContainer = document.getElementById('form-container');
    const successContainer = document.getElementById('success-container');
    const card = document.getElementById('reset-card');
    const submitBtn = document.querySelector('button[type="submit"]');

    // Simple validation simulation
    if (!emailInput.value.includes('@')) {
        emailInput.classList.add('border-[#EF4444]');
        errorMessage.classList.remove('hidden');
        return;
    }

    const form = document.getElementById('forgot-password-form');
    const formData = new FormData(form);

    // Add loading state
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px] align-middle mr-2">progress_activity</span> Sending...';
    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

    // UI Transition to Success
    card.style.opacity = '0';
    card.style.transform = 'translateY(10px)';

    fetch(form.action || '/forgot-password', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            setTimeout(() => {
                formContainer.classList.add('hidden');
                successContainer.classList.remove('hidden');
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 300);
        } else {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
            emailInput.classList.add('border-[#EF4444]');
            errorMessage.textContent = data.message;
            errorMessage.classList.remove('hidden');
        }
    })
    .catch(err => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
        errorMessage.textContent = 'Something went wrong. Please try again.';
        errorMessage.classList.remove('hidden');
    })
    .finally(() => {
        // Restore button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
    });
}

// Remove error states on focus
const emailElem = document.getElementById('email');
if (emailElem) {
    emailElem.addEventListener('focus', function() {
        this.classList.remove('border-[#EF4444]');
        const errMsg = document.getElementById('error-message');
        if (errMsg) errMsg.classList.add('hidden');
    });
}

