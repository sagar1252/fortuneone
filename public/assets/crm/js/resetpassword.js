const newPassInput = document.getElementById('new_password');
const confirmPassInput = document.getElementById('confirm_password');
const errorContainer = document.getElementById('error-message');
const errorText = document.getElementById('error-text');

// Live Validation Logic
newPassInput.addEventListener('input', () => {
    const val = newPassInput.value;
    validate(val);
});

function validate(val) {
    updateRequirement('req-length', val.length >= 8);
    updateRequirement('req-upper', /[A-Z]/.test(val));
    updateRequirement('req-lower', /[a-z]/.test(val));
    updateRequirement('req-number', /[0-9]/.test(val));
    updateRequirement('req-special', /[!@#$%^&*(),.?":{}|<>]/.test(val));
}

function updateRequirement(id, isValid) {
    const el = document.getElementById(id);
    if (isValid) {
        el.classList.add('valid');
        el.classList.remove('text-on-surface-variant');
    } else {
        el.classList.remove('valid');
        el.classList.add('text-on-surface-variant');
    }
}

function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = document.getElementById('icon-' + id);
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}

function handleReset(e) {
    e.preventDefault();
    
    // Hide previous errors
    errorContainer.classList.add('hidden-state');

    // Passwords Match Check
    if (newPassInput.value !== confirmPassInput.value) {
        errorText.textContent = "Passwords do not match. Please verify your entries.";
        errorContainer.classList.remove('hidden-state');
        return false;
    }

    // Simple requirement check
    const val = newPassInput.value;
    const isValid = (val.length >= 8 && /[A-Z]/.test(val) && /[a-z]/.test(val) && /[0-9]/.test(val) && /[!@#$%^&*(),.?":{}|<>]/.test(val));
    
    if (!isValid) {
        errorText.textContent = "Security requirements not met. Please check the checklist.";
        errorContainer.classList.remove('hidden-state');
        return false;
    }

    // Simulate loading and submit via AJAX
    const btn = e.target.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.disabled = true;
    btn.innerHTML = '<span class="flex items-center justify-center gap-xs"><svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Updating Security...</span>';

    const form = document.getElementById('reset-form');
    const formData = new FormData(form);
    formData.set('password', val);

    fetch(form.action || '/reset-password', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            document.getElementById('reset-card').classList.add('hidden-state');
            document.getElementById('success-card').classList.remove('hidden-state');
        } else {
            btn.disabled = false;
            btn.innerHTML = originalText;
            errorText.textContent = data.message || "Failed to update password.";
            errorContainer.classList.remove('hidden-state');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        errorText.textContent = "Something went wrong. Please try again.";
        errorContainer.classList.remove('hidden-state');
    });

    return false;
}

// Professional interactions: Clear error when typing
[newPassInput, confirmPassInput].forEach(el => {
    el.addEventListener('focus', () => {
        errorContainer.classList.add('hidden-state');
    });
});
