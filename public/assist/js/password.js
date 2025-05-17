    document.addEventListener('DOMContentLoaded', function() {
      const toggleButtons = document.querySelectorAll('.toggle-password');
      
      toggleButtons.forEach(button => {
        button.addEventListener('click', function() {

          const targetId = this.getAttribute('data-target');
          const passwordInput = document.getElementById(targetId);
          

          if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.querySelector('.eye-open').classList.add('hidden');
            this.querySelector('.eye-closed').classList.remove('hidden');
          } else {
            passwordInput.type = 'password';
            this.querySelector('.eye-open').classList.remove('hidden');
            this.querySelector('.eye-closed').classList.add('hidden');
          }
        });
      });
    });

document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const form = document.querySelector("form");
    
    // Create error message elements if they don't exist
    const passwordError = document.getElementById("password_error");

    
    const confirmPasswordError = document.getElementById("confirm_password_error");



    // Helper functions for validation states
    const setValid = (input, errorElement) => {
        input.classList.add('border', 'border-blue-200', 'focus:outline-none', 'focus:ring-2', 'focus:ring-accent', 'focus:border-primary');
        input.classList.remove('border-red-300', 'focus:ring-red-400', 'focus:border-red-500');
        errorElement.textContent = "";
        errorElement.classList.add("hidden");
    };

    const setInvalid = (input, errorElement, message) => {
        input.classList.add('border', 'border-red-300', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-400', 'focus:border-red-500');
        input.classList.remove('border-blue-200', 'focus:ring-accent', 'focus:border-primary');
        errorElement.textContent = message;
        errorElement.classList.remove("hidden");
    };

    // Password validation function
    const validatePassword = () => {
        const password = passwordInput.value.trim();
        
        if (!password) {
            setInvalid(passwordInput, passwordError, "Password is required");
            return false;
        } else if (password.length < 8) {
            setInvalid(passwordInput, passwordError, "Password must be at least 8 characters");
            return false;
        } 
        else if (!/[A-Z]/.test(password)) {
            setInvalid(passwordInput, passwordError, "Password must contain at least one uppercase letter");
            return false;
        } else if (!/[a-z]/.test(password)) {
            setInvalid(passwordInput, passwordError, "Password must contain at least one lowercase letter");
            return false;
        } else if (!/[0-9]/.test(password)) {
            setInvalid(passwordInput, passwordError, "Password must contain at least one number");
            return false;
        } else if (!/[^A-Za-z0-9]/.test(password)) {
            setInvalid(passwordInput, passwordError, "Password must contain at least one special character");
            return false;
        }
        else {
            setValid(passwordInput, passwordError);
            return true;
        }
    };

    // Confirm password validation function
    const validateConfirmPassword = () => {
        const password = passwordInput.value.trim();
        const confirmPassword = confirmPasswordInput.value.trim();
        
        if (!confirmPassword) {
            setInvalid(confirmPasswordInput, confirmPasswordError, "Please confirm your password");
            return false;
        } else if (password !== confirmPassword) {
            setInvalid(confirmPasswordInput, confirmPasswordError, "Passwords don't match");
            return false;
        } else {
            setValid(confirmPasswordInput, confirmPasswordError);
            return true;
        }
    };

    // Event listeners for real-time validation
    passwordInput.addEventListener("input", () => {
        validatePassword();
        // Also validate confirm password when password changes
        if (confirmPasswordInput.value.trim()) {
            validateConfirmPassword();
        }
    });

    confirmPasswordInput.addEventListener("input", () => {
        if (passwordInput.value.trim()) {
            validateConfirmPassword();
        }
    });

    // Password visibility toggle functionality
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const eyeOpen = this.querySelector('.eye-open');
            const eyeClosed = this.querySelector('.eye-closed');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        });
    });

    // Form submission handler
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const isPasswordValid = validatePassword();
        const isConfirmPasswordValid = validateConfirmPassword();

        if (isPasswordValid && isConfirmPasswordValid) {
            form.submit();
        }
    });
});