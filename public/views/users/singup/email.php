<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connectify | Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',    
            secondary: '#1E40AF',  
            accent: '#60A5FA',     
            dark: '#1F2937',       
            light: '#F0F9FF'     
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
<style>



</style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md">
    <!-- Logo Area -->
    <div class="text-center mb-6">
      <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-primary bg-opacity-10 mb-3">
        <svg class="w-8 h-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
      </div>
      <h1 class="text-3xl font-semibold text-dark">Connectify</h1>
    </div>
    
    <div class="bg-white rounded-xl shadow-custom overflow-hidden border border-blue-100">
      <div class="p-8">
        <div class="text-center mb-8">
          <h2 class="text-2xl font-semibold text-dark mb-2">Create your account</h2>
          <p class="text-gray-500">Join our professional network</p>
        </div>
        
        <form action="" method="post">
          <div class="mb-6">
            <label for="email" class="block text-dark text-sm font-medium mb-2">Work Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="w-full px-4 py-3 rounded-lg transition text-gray-700 border border-blue-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary placeholder-gray-400"
            placeholder="name@company.com"
          >
            <p id="email-error" class="text-red-500 text-sm mt-1 hidden">Please enter a valid email address</p>
          </div>
          
          <button 
            type="submit"
            class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-secondary transition shadow-sm"
          >
            Next →
          </button>
        </form>
        
        <div class="mt-6 text-center">
          <p class="text-gray-600 text-sm">
            Already have an account? 
            <a href="/login" class="text-primary font-medium hover:text-secondary transition">Sign in</a>
          </p>
        </div>
      </div>
      
      <div class="bg-light px-8 py-4 text-center border-t border-blue-100">
        <p class="text-gray-500 text-xs">
          By joining, you agree to our <a href="#" class="text-primary hover:underline">Terms</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>

<script>
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

    const validateEmail = () => {
      const email = emailInput.value.trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!email) {
        setInvalid(emailInput, "Email is required");
        return false;
      } else if (!emailRegex.test(email)) {
        setInvalid(emailInput, "Please enter a valid email address");
        return false;
      } else {
        setValid(emailInput);
        hideError();
        return true;
      }
    };

    emailInput.addEventListener("input", () => {
      if (emailInput.value.trim()) {
        validateEmail();
      } else {
        emailInput.classList.remove('border', 'border-red-300', 'focus:outline-none', 'focus:ring-2', 'focus:ring-red-400', 'focus:border-red-500');
        emailInput.classList.add('border', 'border-blue-500', 'focus:outline-none', 'focus:ring-2', 'focus:ring-accent', 'focus:border-primary');
        hideError();
      }
    });

    form.addEventListener("submit", function (event) {
      event.preventDefault();

      const isEmailValid = validateEmail();
      if (isEmailValid) {
        form.submit(); 
        
      }
    });
  });
</script>

</body>
</html>