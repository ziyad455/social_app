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
    .messageError {
      color: #EF4444;
      margin-top: 0.5rem;
      font-size: 0.875rem;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-xl shadow-custom overflow-hidden border border-blue-100 w-full max-w-md">
    <div class="p-8">
      <form action="../../../app/brain/loginControler.php" method="POST">
        <input
          type="text"
          name="email"
          class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary transition text-gray-700 mb-4"
          placeholder="email"
        >
        <input
          type="password"
          name="pass"
          class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:outline-none focus:ring-2 focus:ring-accent focus:border-primary transition text-gray-700 mb-4"
          placeholder="Password"
        >
        <input
          type="submit"
          value="Log In"
          name="submit"
          class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-secondary transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm mb-4"
        >
        <p class="text-gray-600 text-sm text-center">
          You don't have an account? <a href="singup/email.php" class="text-primary font-medium hover:text-secondary transition">Sign up</a>
        </p>
        <?php if(isset($_GET['msg'])) : ?>
          <p class="messageError text-center"><?php echo $_GET['msg']?></p>
        <?php endif ?>
      </form>
    </div>
  </div>
</body>
</html>