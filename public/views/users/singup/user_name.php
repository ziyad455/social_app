<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',    // Bright blue
            secondary: '#1E40AF',  // Darker blue
            accent: '#60A5FA',     // Light blue
            dark: '#1F2937',       // Dark gray
            light: '#F0F9FF'       // Light blue tint
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            'custom': '0 4px 20px rgba(0, 0, 0, 0.08)'
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <div class="bg-white rounded-xl shadow-custom overflow-hidden border border-blue-100">
      <div class="p-8">
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-primary bg-opacity-10 mb-4">
            <svg class="w-8 h-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <h2 class="text-2xl font-semibold text-dark mb-2">Personal Information</h2>
          <p class="text-gray-500">Tell us your name to get started</p>
           <?php
        session_start();
        if (isset($_SESSION['errors'])):
        ?>
          <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
            <?php
            foreach ($_SESSION['errors'] as $error) {
                echo "<p>$error</p>";
            }
            unset($_SESSION['errors']);
            ?>
          </div>
        <?php endif; ?>

        </div>
        
        <form action="../../../../app/brain/signupHandling/userName.php" method="post">
          <div class="mb-6">
            <label for="name" class="block text-dark text-sm font-medium mb-2">First Name</label>
            <input
              type="text"
              name="name"
              id="name"
              required
              class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary transition text-gray-700"
              placeholder="Enter your first name"
            >
            <div id="name_error" class="text-red-500 text-sm mt-1 hidden"></div>
          </div>
          
          <div class="mb-6">
            <label for="last_name" class="block text-dark text-sm font-medium mb-2">Last Name</label>
            <input
              type="text"
              name="last_name"
              id="last_name"
              required
              class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary transition text-gray-700"
              placeholder="Enter your last name"
            >
            <div id="last_name_error" class="text-red-500 text-sm mt-1 hidden"></div>
          </div>
          
          <div class="mb-6">
            <button
              type="submit"
              class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-secondary transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm"
            >
              Next ->
            </button>
          </div>
        </form>
        
        <div class="text-center">
          <p class="text-gray-600 text-sm">
            Already have an account? 
            <a href="/login" class="text-primary font-medium hover:text-secondary transition">Sign in</a>
          </p>
        </div>
      </div>
      
      <div class="bg-light px-8 py-4 text-center border-t border-blue-100">
        <p class="text-gray-500 text-xs">
          By continuing, you agree to our <a href="#" class="text-primary hover:underline">Terms</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
  <script>
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
  </script>
</body>
</html>