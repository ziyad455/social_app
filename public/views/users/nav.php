<?php
require('../../assist/others/isselcted.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
      <nav class="fixed w-full bg-white shadow-sm h-14 flex items-center justify-between px-4 z-50">
      <div class="flex items-center">
        <div class="text-blue-600 text-2xl font-bold mr-4">myFace</div>
        <div class="relative">
          <input type="text" class="bg-gray-100 rounded-full py-2 pl-10 pr-4 w-64 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:bg-white transition-all" placeholder="Search..." />
          <i class="fas fa-search text-gray-500 absolute left-3 top-2.5"></i>
        </div>
      </div>
      
<div class="flex space-x-2">
  <a href="#" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors relative">
    <i class="fas fa-home <?php echo isSelected('home') ?>"></i>
    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">3</span>
  </a>
  
  <a href="freands_manager.php" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
    <i class="fas fa-user-friends <?php echo isSelected('freands_manager') ?>"></i>
  </a>
  
  <a href="#" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
    <i class="fas fa-tv text-gray-600"></i>
  </a>
  
  <a href="#" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors relative">
    <i class="fab fa-facebook-messenger text-gray-600"></i>
    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">2</span>
  </a>
  
  <a href="#" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors relative">
    <i class="fas fa-bell text-gray-600"></i>
    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">5</span>
  </a>
  
  <a href="#" class="h-10 w-10 rounded-full bg-gray-300 overflow-hidden">
    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="h-full w-full object-cover">
  </a>
</div>

    </nav>
    
</body>
</html>