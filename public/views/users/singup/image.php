
<?php
session_start();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Image Upload</title>
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <h2 class="text-2xl font-semibold text-dark mb-2">Profile Picture</h2>
          <p class="text-gray-500">Upload a photo to personalize your profile</p>
        </div>
        
        <form action="../../../../app/brain/signupHandling/image.php" method="post" enctype="multipart/form-data">
          <div class="mb-8">
            <div class="text-center">
              <div class="mx-auto w-32 h-32 mb-6 relative">
                <div id="preview-container" class="w-full h-full rounded-full bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                  <svg id="default-image" class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  <img id="image-preview" class="hidden w-full h-full object-cover" alt="Profile preview">
                </div>
              </div>
              
              <label for="image" class="cursor-pointer inline-flex items-center px-4 py-2 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                <svg class="-ml-1 mr-2 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                Choose Photo
              </label>
              <input type="file" name="image" id="image" accept="image/*" class="hidden">
              <p class="mt-2 text-xs text-gray-500">JPG, PNG or GIF (max 2MB)</p>
            </div>
          </div>
          
          <div class="flex flex-col gap-3 mb-6">
            <button
              type="submit"
              class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-secondary transition focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 shadow-sm"
            >
              Continue
            </button>
          </div>
        </form>
        
        <form action="../../../../app/brain/signupHandling/image.php" method="post" class="mb-6">
          <button
            type="submit"
            class="w-full bg-white text-gray-600 py-3 px-4 rounded-lg font-medium border border-gray-300 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2"
          >
            Skip for now
          </button>
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
                <div class="mt-8 flex justify-center">
                <div class="flex space-x-1">
                    <div class="w-6 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-6 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-6 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-6 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-6 h-1 rounded-full bg-gray-300"></div>
                </div>
            </div>
  </div>

  <script src="../../../assist/js/image.js"></script>
</body>
</html>