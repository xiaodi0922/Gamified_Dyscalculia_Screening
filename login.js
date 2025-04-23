let debounceTimer;

document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.getElementById('user');
    const passwordInput = document.getElementById('pass');
    const emailBox = emailInput.closest('.input_box');

    // Debounce logic for validating email input
    emailInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            validateEmail(emailInput, emailBox);
        }, 300); // Delay of 300ms
    });

    // Attach form validation to the submit event
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', validateForm);
});

// Function to validate email input with inline error messages
function validateEmail(emailInput, emailBox) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Remove any previous error messages
    emailBox.querySelector('.error-message')?.remove();

    if (!emailPattern.test(emailInput.value.trim())) {
        const errorMessage = document.createElement('span');
        errorMessage.className = 'error-message';
        errorMessage.textContent = 'Invalid email format';
        emailBox.appendChild(errorMessage);
    }
}

// Function to validate the form and handle login
async function validateForm(event) {
    event.preventDefault(); // Prevent default form submission

    const emailInput = document.getElementById('user');
    const passwordInput = document.getElementById('pass');
    const emailBox = emailInput.closest('.input_box');
    const passwordBox = passwordInput.closest('.input_box');
    let isValid = true;

    // Clear previous error messages
    emailBox.querySelector('.error-message')?.remove();
    passwordBox.querySelector('.error-message')?.remove();

    // Check if email and password are valid
    if (emailInput.value.trim() === '') {
        const errorMessage = document.createElement('span');
        errorMessage.className = 'error-message';
        errorMessage.textContent = 'Email is required';
        emailBox.appendChild(errorMessage);
        isValid = false;
    }

    if (passwordInput.value.trim() === '') {
        const errorMessage = document.createElement('span');
        errorMessage.className = 'error-message';
        errorMessage.textContent = 'Password is required';
        passwordBox.appendChild(errorMessage);
        isValid = false;
    }

    if (isValid) {
        try {
            const response = await fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    email: emailInput.value,
                    password: passwordInput.value,
                }),
            });

            const data = await response.json();

            if (data.status === 'success') {
                // Clear input fields
                emailInput.value = '';
                passwordInput.value = '';

                // Redirect to home page
                window.location.href = 'home.php';
            } else {
                // Display error message as an alert (or inline if needed)
                alert(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        }
    }
}
