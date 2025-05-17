  document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("email-error");
    const form = document.querySelector("form");

const setValid = (input) => {
  input.classList.add('border', 'border-blue-200', 'focus:outline-none', 'focus:ring-2', 'focus:ring-accent', 'focus:border-primary');
  input.classList.remove('border-red-300', 'focus:ring-red-400', 'focus:border-red-500');
  emailError.classList.add("hidden");
};

const setInvalid = (input, message) => {
  input.classList.add('border', 'border-red-300', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-400', 'focus:border-red-500');
  input.classList.remove('border-blue-200', 'focus:ring-accent', 'focus:border-primary');
  emailError.textContent = message;
  emailError.classList.remove("hidden");
};

    const hideError = () => {
      emailError.textContent = "";
      emailError.classList.add("hidden");
    };

   const validateEmail = async () => {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            setInvalid(emailInput, "Email is required");
            return false;
        } else if (!emailRegex.test(email)) {
            setInvalid(emailInput, "Please enter a valid email address");
            return false;
        }

        try {
            const response = await fetch('../../../../app/brain/signupHandling/email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ email })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const result = await response.json();
            console.log("Server response:", result);

            if (result.exists) {
                setInvalid(emailInput, "Email already exists.");
                return false;
            } else {
                setValid(emailInput);
                hideError();
                return true;
            }
        } catch (error) {
            console.error("Error occurred:", error);
            setInvalid(emailInput, "Something went wrong. Please try again.");
            return false;
        }
    };

    emailInput.addEventListener("input", () => {
        if (emailInput.value.trim()) {
            validateEmail();
        } else {
            emailInput.classList.remove('border', 'border-red-300', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-400', 'focus:border-red-500');
            emailInput.classList.add('border', 'border-blue-200', 'focus:outline-none', 'focus:ring-2', 'focus:ring-accent', 'focus:border-primary');
            if (document.querySelector('.error_php')) {
                emailError.textContent = '';
            }
            hideError();
        }
    });

    form.addEventListener("submit", async function (event) {
        event.preventDefault();
        const isEmailValid = await validateEmail(); 

        if (isEmailValid) {
            window.location.href = "user_name.php";
        }
    });
});