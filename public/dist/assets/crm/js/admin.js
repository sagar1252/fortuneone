function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('passwordIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        passwordInput.type = 'password';
        icon.textContent = 'visibility';
    }
}

const loginForm = document.getElementById('loginForm');
const submitBtn = document.getElementById('submitBtn');
const btnText = document.getElementById('btnText');
const loadingState = document.getElementById('loadingState');
const errorArea = document.getElementById('errorArea');
const errorMessage = document.getElementById('errorMessage');

if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // UI Transition to Loading
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        loadingState.classList.remove('hidden');
        errorArea.classList.add('hidden');

        // Submit form data via AJAX
        const formData = new FormData(loginForm);
        
        fetch(loginForm.action || window.location.href, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                // Success - Redirect
                window.location.href = data.redirect;
            } else {
                // Error
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                loadingState.classList.add('hidden');
                errorMessage.textContent = data.message || 'Invalid credentials. Please contact your system administrator.';
                errorArea.classList.remove('hidden');
            }
        })
        .catch(err => {
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            loadingState.classList.add('hidden');
            errorMessage.textContent = 'Something went wrong. Please try again.';
            errorArea.classList.remove('hidden');
        });
    });
}

// Interactive Focus for labels
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', () => {
        input.previousElementSibling?.classList.add('text-primary');
    });
    input.addEventListener('blur', () => {
        input.previousElementSibling?.classList.remove('text-primary');
    });
});
