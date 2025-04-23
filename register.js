document.getElementById('registerForm').addEventListener('submit', validateRegisterForm);

function validateRegisterForm(event) {
    event.preventDefault(); // Prevent default form submission

    const usernameInput = document.getElementById('user');
    const emailInput = document.getElementById('gmail');
    const passwordInput = document.getElementById('pass');
    const confirmPasswordInput = document.getElementById('pass2');
    let isValid = true;

    // Username Validation
    if (!checkInput(usernameInput, 'Username cannot be empty')) {
        isValid = false;
    }

    // Email Validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!checkInput(emailInput, 'Email cannot be empty') || !emailPattern.test(emailInput.value.trim())) {
        showError(emailInput, 'Enter a valid email address');
        isValid = false;
    } else {
        showSuccess(emailInput);
    }

    // Password Validation
    if (!checkInput(passwordInput, 'Password cannot be empty')) {
        isValid = false;
    } else if (passwordInput.value.length < 6) {
        showError(passwordInput, 'Password must be at least 6 characters');
        isValid = false;
    } else {
        showSuccess(passwordInput);
    }

    // Confirm Password Validation
    if (!checkInput(confirmPasswordInput, 'Confirm password cannot be empty')) {
        isValid = false;
    } else if (confirmPasswordInput.value !== passwordInput.value) {
        showError(confirmPasswordInput, 'Passwords must match');
        isValid = false;
    } else {
        showSuccess(confirmPasswordInput);
    }

    // If the form is valid, send the data via AJAX
    if (isValid) {
        const formData = new FormData();
        formData.append('username', usernameInput.value.trim());
        formData.append('email', emailInput.value.trim());
        formData.append('password', passwordInput.value);
        formData.append('confirmPassword', confirmPasswordInput.value);

        fetch('register.php', {
            method: 'POST',
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = 'login.html'; // Redirect after success
                } else {
                    alert(data.message); // Display error message
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
    }
}

function checkInput(input, errorMessage) {
    const value = input.value.trim();

    if (value === '') {
        showError(input, errorMessage);
        return false;
    }

    showSuccess(input);
    return true;
}

function showError(input, message) {
    const inputBox = input.closest('.input_box');
    const small = inputBox.querySelector('small');
    inputBox.classList.add('error');
    inputBox.classList.remove('success');
    if (small) {
        small.textContent = message; // Show error message
    }
}

function showSuccess(input) {
    const inputBox = input.closest('.input_box');
    const small = inputBox.querySelector('small');
    inputBox.classList.add('success');
    inputBox.classList.remove('error');
    if (small) {
        small.textContent = ''; // Clear error message
    }
}
