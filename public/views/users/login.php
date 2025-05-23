<?php
// require "../../../app/brain/loginControler.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connectify | Login</title>
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
            light: '#F0F9FF',
            danger: '#EF4444'
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif']
          },
          boxShadow: {
            'custom': '0 8px 30px rgba(0, 0, 0, 0.1)',
            'glow': '0 0 10px rgba(59, 130, 246, 0.3)'
          },
          animation: {
            fadeIn: 'fadeIn 1s ease-out'
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: 0, transform: 'translateY(20px)' },
              '100%': { opacity: 1, transform: 'translateY(0)' },
            }
          }
        }
      }
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    .messageError {
      color: #EF4444;
      margin-top: 0.75rem;
      font-size: 0.875rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.4rem;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-indigo-100 to-blue-200 min-h-screen flex items-center justify-center px-4 font-sans">

  <div class="bg-white rounded-2xl shadow-custom hover:shadow-glow border border-blue-100 w-full max-w-md overflow-hidden animate-fadeIn transition-all duration-500">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-6 text-white text-center">
      <h1 class="text-2xl font-semibold tracking-wide">Welcome to Connectify</h1>
      <p class="text-sm opacity-90">Please log in to continue</p>
    </div>

    <div class="p-8 bg-white">
      <form action="../../../app/brain/loginControler.php" method="POST" class="space-y-5">
        <input
<<<<<<< HEAD
          type="email"
          name="email"
          required
          class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition text-gray-700 shadow-sm"
          placeholder="Email address"
=======
          type="text"
          name="email"
          class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary transition text-gray-700 mb-4"
          placeholder="email"
>>>>>>> origin/hamza
        >

        <input
          type="password"
          name="pass"
          required
          class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition text-gray-700 shadow-sm"
          placeholder="Password"
        >

        <input
          type="submit"
          value="Log In"
          name="submit"
          class="w-full bg-primary text-white py-3 px-4 rounded-lg font-semibold hover:bg-secondary transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-md"
        >
                <?php if(isset($_GET['msg'])) : ?>
          <p class="messageError">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-danger" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
            </svg>
            <?php echo $_GET['msg'] ?>
          </p>
        <?php endif ?>

        <p class="text-gray-600 text-sm text-center">
          Don't have an account?
          <a href="singup/email.php" class="text-primary font-medium hover:text-secondary transition">Sign up</a>
        </p>


      </form>
    </div>
  </div>
</body>
</html>
