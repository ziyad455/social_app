    document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("name");
    const lastNameInput = document.getElementById("last_name");
    const nameError = document.getElementById("name_error");
    const lastNameError = document.getElementById("last_name_error");
    const form = document.querySelector("form");

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

    // Validation functions
    const validateName = () => {
        const name = nameInput.value.trim();
        
        if (!name) {
            setInvalid(nameInput, nameError, "First name is required");
            return false;
        } else if (name.length < 3) {
            setInvalid(nameInput, nameError, "First name must be at least 3 characters");
            return false;
        } else if (!/^[a-zA-Z]+$/.test(name)) {
            setInvalid(nameInput, nameError, "First name should contain only letters");
            return false;
        } else {
            setValid(nameInput, nameError);
            return true;
        }
    };

    const validateLastName = () => {
        const lastName = lastNameInput.value.trim();
        
        if (!lastName) {
            setInvalid(lastNameInput, lastNameError, "Last name is required");
            return false;
        } else if (lastName.length < 3) {
            setInvalid(lastNameInput, lastNameError, "Last name must be at least 3characters");
            return false;
        } else if (!/^[a-zA-Z]+$/.test(lastName)) {
            setInvalid(lastNameInput, lastNameError, "Last name should contain only letters");
            return false;
        } else {
            setValid(lastNameInput, lastNameError);
            return true;
        }
    };

    // Event listeners for real-time validation
    nameInput.addEventListener("input", () => {
        if (nameInput.value.trim()) {
            validateName();
        } else {
            nameInput.classList.remove('border-red-300', 'focus:ring-red-400', 'focus:border-red-500');
            nameInput.classList.add('border-blue-200', 'focus:ring-accent', 'focus:border-primary');
            nameError.textContent = "";
            nameError.classList.add("hidden");
        }
    });

    lastNameInput.addEventListener("input", () => {
        if (lastNameInput.value.trim()) {
            validateLastName();
        } else {
            lastNameInput.classList.remove('border-red-300', 'focus:ring-red-400', 'focus:border-red-500');
            lastNameInput.classList.add('border-blue-200', 'focus:ring-accent', 'focus:border-primary');
            lastNameError.textContent = "";
            lastNameError.classList.add("hidden");
        }
    });

    // Form submission handler
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const isNameValid = validateName();
        const isLastNameValid = validateLastName();

        if (isNameValid && isLastNameValid) {
            form.submit();
        }
    });
});