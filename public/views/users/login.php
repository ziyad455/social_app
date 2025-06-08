<?php // require "../../../app/brain/loginControler.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ConnectHub | Welcome Back</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'facebook-blue': '#1877F2',
            'facebook-light': '#E7F3FF',
            'facebook-dark': '#166FE5',
            'facebook-hover': '#42A5F5'
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            'soft': '0 4px 20px rgba(24, 119, 242, 0.15)',
            'button': '0 2px 8px rgba(24, 119, 242, 0.2)'
          },
          animation: {
            'gentle-bounce': 'gentleBounce 0.6s ease-out',
            'fade-up': 'fadeUp 0.8s ease-out'
          },
          keyframes: {
            gentleBounce: {
              '0%': { transform: 'translateY(-10px)', opacity: '0' },
              '50%': { transform: 'translateY(5px)', opacity: '0.8' },
              '100%': { transform: 'translateY(0)', opacity: '1' }
            },
            fadeUp: {
              '0%': { transform: 'translateY(30px)', opacity: '0' },
              '100%': { transform: 'translateY(0)', opacity: '1' }
            }
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .messageError {
      color: #EF4444;
      margin-top: 1rem;
      font-size: 0.875rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      background: #FEF2F2;
      padding: 0.75rem;
      border-radius: 0.5rem;
      border: 1px solid #FECACA;
    }
    
    .input-field:focus {
      transform: translateY(-1px);
    }
    
    .login-button:hover {
      transform: translateY(-1px);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-facebook-light via-blue-50 to-white min-h-screen flex items-center justify-center px-4 font-sans">
  
  <div class="w-full max-w-md animate-fade-up">
    <!-- Logo Section -->
    <div class="text-center mb-8 animate-gentle-bounce">
      <div class="flex items-center justify-center space-x-3 mb-4">
        <div class="w-12 h-12 bg-facebook-blue rounded-full flex items-center justify-center shadow-soft">
          <span class="text-white font-bold text-2xl">C</span>
        </div>
        <span class="text-3xl font-bold text-facebook-blue">ConnectHub</span>
      </div>
      <p class="text-gray-600 text-lg">Welcome back! 👋</p>
      <p class="text-gray-500 text-sm mt-1">Sign in to connect with your world</p>
    </div>

    <!-- Login Form -->
    <div class="bg-white rounded-3xl shadow-soft border border-facebook-light p-8 backdrop-blur-sm">
      <form action="../../../app/brain/loginControler.php" method="POST" class="space-y-6">
        
        <!-- Email Input -->
        <div class="space-y-2">
          <label for="email" class="text-sm font-medium text-gray-700 block">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            required
            class="input-field w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-facebook-blue focus:ring-2 focus:ring-facebook-blue/20 transition-all duration-300 text-gray-700 text-lg"
            placeholder="Enter your email"
          >
        </div>

        <!-- Password Input -->
        <div class="space-y-2">
          <label for="password" class="text-sm font-medium text-gray-700 block">Password</label>
          <input
            type="password"
            name="pass"
            id="password"
            required
            class="input-field w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-facebook-blue focus:ring-2 focus:ring-facebook-blue/20 transition-all duration-300 text-gray-700 text-lg"
            placeholder="Enter your password"
          >
        </div>

        <!-- Login Button -->
        <input
          type="submit"
          value="Sign In"
          name="submit"
          class="login-button w-full bg-facebook-blue text-white py-4 px-6 rounded-xl font-semibold text-lg hover:bg-facebook-dark transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-facebook-blue/30 shadow-button cursor-pointer"
        >

        <!-- Error Message -->
        <?php if(isset($_GET['msg'])) : ?>
          <div class="messageError">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-4-6h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z" />
            </svg>
            <span><?php echo htmlspecialchars($_GET['msg']) ?></span>
          </div>
        <?php endif ?>

        <!-- Forgot Password -->
        <div class="text-center">
          <a href="#" class="text-sm text-facebook-blue hover:text-facebook-dark font-medium transition-colors">
            Forgot your password?
          </a>
        </div>

      </form>
    </div>

    <!-- Sign Up Link -->
    <div class="text-center mt-6 p-4 bg-white/60 rounded-2xl backdrop-blur-sm">
      <p class="text-gray-600">
        New to ConnectHub? 
        <a href="singup/email.php" class="text-facebook-blue font-semibold hover:text-facebook-dark transition-colors ml-1">
          Create an account
        </a>
      </p>
    </div>

  </div>

</body>
</html>