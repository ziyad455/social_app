<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../../index.php");
    exit();
}
require "../../../app/database/conectdb.php";
require "nav.php";

$user = $db->selectOne("SELECT * FROM users WHERE id = ?", [$_SESSION['id']]);



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enhanced Social Network</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
      font-family: 'Inter', sans-serif;
    }
    
    /* Custom scrollbar styling */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #c5c5c5;
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #a8a8a8;
    }
    
    /* Remove default focus outline */
    .focus-visible:focus {
      outline: none;
    }
    
    /* Animations */
    .scale-hover {
      transition: transform 0.15s ease;
    }
    
    .scale-hover:hover {
      transform: scale(1.05);
    }
    
    /* Custom story gradient overlay */
    .story-overlay {
      background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(0,0,0,0.7) 100%);
    }
    
    /* Post hover animation */
    .post-card {
      transition: box-shadow 0.3s ease;
    }
    
    .post-card:hover {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    /* Disable resize on textarea */
    textarea {
      resize: none;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="flex h-screen">
    

  

    <div class="flex w-full pt-14">
      <!-- Left Sidebar -->
      <aside class="w-64 fixed left-0 top-14 h-screen overflow-y-auto bg-white p-4 hidden md:block">
        <div class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors mb-4 cursor-pointer">
          <img src="../../assist/profiles/<?php echo $user["profile_picture"] ?>" alt="Profile" class="h-10 w-10 rounded-full object-cover">
          <span class="font-medium"><?php echo $user["username"] ?></span>
        </div>
        
        <ul class="space-y-1">
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
              <i class="fas fa-user text-blue-600"></i>
            </div>
            <span>Profile</span>
          </li>
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
              <i class="fas fa-users text-green-600"></i>
            </div>
            <span>Friends</span>
          </li>
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center">
              <i class="fas fa-users-cog text-purple-600"></i>
            </div>
            <span>Groups</span>
          </li>
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center">
              <i class="fas fa-flag text-yellow-600"></i>
            </div>
            <span>Pages</span>
          </li>
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
              <i class="fas fa-calendar-alt text-red-600"></i>
            </div>
            <span>Events</span>
          </li>
        </ul>
        
        <div class="mt-4 flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
          <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
            <i class="fas fa-chevron-down text-gray-600"></i>
          </div>
          <span>See More</span>
        </div>
        
        <div class="border-t border-gray-200 my-4"></div>
        
        <h4 class="text-gray-500 font-medium text-sm px-3 mb-2">Your Shortcuts</h4>
        <ul class="space-y-1">
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-lg bg-gray-300 overflow-hidden">
              <img src="https://via.placeholder.com/60/3b5998/ffffff?text=G" alt="Gaming" class="h-full w-full object-cover">
            </div>
            <span>Gaming Zone</span>
          </li>
          <li class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
            <div class="h-8 w-8 rounded-lg bg-gray-300 overflow-hidden">
              <img src="https://via.placeholder.com/60/ff5722/ffffff?text=D" alt="Design" class="h-full w-full object-cover">
            </div>
            <span>Design Community</span>
          </li>
        </ul>
      </aside>

      <!-- Main Feed -->
      <main class="flex-grow md:ml-64 md:mr-80 p-4 overflow-y-auto">
        <!-- Stories -->
        <div class="flex space-x-2 overflow-x-auto pb-4 mb-4 hide-scrollbar">
          <div class="relative min-w-[120px] h-48 rounded-xl overflow-hidden shadow-sm cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>
            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Your Story" class="h-full w-full object-cover">
            <div class="absolute bottom-0 w-full p-3">
              <div class="flex items-center justify-center h-9 w-9 bg-blue-500 rounded-full mb-2 mx-auto border-4 border-white">
                <i class="fas fa-plus text-white text-xs"></i>
              </div>
              <span class="text-white text-sm font-medium block text-center">Your Story</span>
            </div>
          </div>
          
          <div class="relative min-w-[120px] h-48 rounded-xl overflow-hidden shadow-sm cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John" class="h-full w-full object-cover">
            <div class="absolute top-3 left-3">
              <div class="h-10 w-10 rounded-full border-4 border-blue-500 overflow-hidden">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="John" class="h-full w-full object-cover">
              </div>
            </div>
            <span class="absolute bottom-3 left-3 text-white font-medium">John</span>
          </div>
          
          <div class="relative min-w-[120px] h-48 rounded-xl overflow-hidden shadow-sm cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Emma" class="h-full w-full object-cover">
            <div class="absolute top-3 left-3">
              <div class="h-10 w-10 rounded-full border-4 border-blue-500 overflow-hidden">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Emma" class="h-full w-full object-cover">
              </div>
            </div>
            <span class="absolute bottom-3 left-3 text-white font-medium">Emma</span>
          </div>
          
          <div class="relative min-w-[120px] h-48 rounded-xl overflow-hidden shadow-sm cursor-pointer">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>
            <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="David" class="h-full w-full object-cover">
            <div class="absolute top-3 left-3">
              <div class="h-10 w-10 rounded-full border-4 border-blue-500 overflow-hidden">
                <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="David" class="h-full w-full object-cover">
              </div>
            </div>
            <span class="absolute bottom-3 left-3 text-white font-medium">David</span>
          </div>
        </div>

        <!-- Create Post -->
        <div class="bg-white rounded-xl shadow-sm mb-4 p-4">
          <div class="flex items-center space-x-3">
            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="h-10 w-10 rounded-full">
            <div class="bg-gray-100 rounded-full flex-grow px-4 py-2.5 cursor-pointer hover:bg-gray-200 transition-colors">
              <p class="text-gray-500">What's on your mind?</p>
            </div>
            <a href="Addpost.php" class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center hover:bg-blue-600 transition-colors text-white">
              <i class="fas fa-paper-plane"></i>
            </a>
          </div>
          
          <div class="border-t border-gray-200 mt-4 pt-3">
            <div class="flex justify-between">
              <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-video text-red-500"></i>
                <span class="font-medium text-gray-600">Live Video</span>
              </button>
              <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-images text-green-500"></i>
                <span class="font-medium text-gray-600">Photo/Video</span>
              </button>
              <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-smile text-yellow-500"></i>
                <span class="font-medium text-gray-600">Feeling/Activity</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Posts -->
        <div class="space-y-4">
          <!-- Post 1 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden post-card">
            <div class="p-4">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <div class="relative">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" class="h-10 w-10 rounded-full">
                    <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-white"></span>
                  </div>
                  <div>
                    <h4 class="font-medium">Sarah Johnson</h4>
                    <p class="text-gray-500 text-xs">2 hours ago • <i class="fas fa-globe-americas"></i></p>
                  </div>
                </div>
                <button class="text-gray-500 hover:bg-gray-100 h-8 w-8 rounded-full flex items-center justify-center transition-colors">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
              </div>
              
              <p class="mt-3 mb-3">Enjoying the sunny weather today! Perfect day for a hike in the mountains. 🌞🏔️ #NatureLovers #Weekend</p>
              
              <div class="rounded-lg overflow-hidden -mx-4">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" class="w-full h-auto" alt="Mountain Landscape">
              </div>
              
              <div class="flex items-center justify-between text-gray-500 text-sm mt-2 pt-1">
                <div class="flex items-center space-x-1">
                  <div class="flex -space-x-1">
                    <div class="h-5 w-5 rounded-full bg-blue-500 flex items-center justify-center">
                      <i class="fas fa-thumbs-up text-white text-xs"></i>
                    </div>
                    <div class="h-5 w-5 rounded-full bg-red-500 flex items-center justify-center">
                      <i class="fas fa-heart text-white text-xs"></i>
                    </div>
                  </div>
                  <span>328</span>
                </div>
                <div class="flex space-x-2">
                  <span>42 comments</span>
                  <span>18 shares</span>
                </div>
              </div>
              
              <div class="border-t border-gray-200 mt-3 pt-1">
                <div class="flex justify-between mt-2">
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="far fa-thumbs-up text-gray-600"></i>
                    <span class="font-medium text-gray-600">Like</span>
                  </button>
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="far fa-comment text-gray-600"></i>
                    <span class="font-medium text-gray-600">Comment</span>
                  </button>
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-share text-gray-600"></i>
                    <span class="font-medium text-gray-600">Share</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Post 2 -->
          <div class="bg-white rounded-xl shadow-sm overflow-hidden post-card">
            <div class="p-4">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <img src="https://randomuser.me/api/portraits/men/32.jpg" class="h-10 w-10 rounded-full">
                  <div>
                    <h4 class="font-medium">John Smith</h4>
                    <p class="text-gray-500 text-xs">5 hours ago • <i class="fas fa-user-friends"></i></p>
                  </div>
                </div>
                <button class="text-gray-500 hover:bg-gray-100 h-8 w-8 rounded-full flex items-center justify-center transition-colors">
                  <i class="fas fa-ellipsis-h"></i>
                </button>
              </div>
              
              <p class="mt-3 mb-3">Just finished reading this amazing book! Highly recommend it to everyone. What are you all reading these days? 📚</p>
              
              <div class="border-t border-gray-200 mt-3 pt-1">
                <div class="flex justify-between mt-2">
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="far fa-thumbs-up text-gray-600"></i>
                    <span class="font-medium text-gray-600">Like</span>
                  </button>
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="far fa-comment text-gray-600"></i>
                    <span class="font-medium text-gray-600">Comment</span>
                  </button>
                  <button class="flex items-center justify-center space-x-2 flex-grow py-1.5 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-share text-gray-600"></i>
                    <span class="font-medium text-gray-600">Share</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Right Sidebar -->
      <aside class="w-80 fixed right-0 top-14 h-screen overflow-y-auto bg-white p-4 hidden lg:block">

        
        <div class="border-t border-gray-200 my-4"></div>
        
        <div class="flex items-center justify-between mb-3">
          <h4 class="font-semibold text-gray-500">Active Friends</h4>
          <div class="flex space-x-2">
            <button class="h-8 w-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors">
              <i class="fas fa-search text-gray-500"></i>
            </button>
            <button class="h-8 w-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors">
              <i class="fas fa-ellipsis-h text-gray-500"></i>
            </button>
          </div>
        </div>
        
        <ul class="space-y-3">
          <li class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg transition-colors cursor-pointer">
            <div class="flex items-center space-x-3">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/men/55.jpg" class="w-10 h-10 rounded-full">
                <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-white"></span>
              </div>
              <span>Ali Hassan</span>
            </div>
          </li>
          
          <li class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg transition-colors cursor-pointer">
            <div class="flex items-center space-x-3">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/women/21.jpg" class="w-10 h-10 rounded-full">
                <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-white"></span>
              </div>
              <span>Lina Ahmed</span>
            </div>
          </li>
          
          <li class="flex items-center justify-between hover:bg-gray-100 p-2 rounded-lg transition-colors cursor-pointer">
            <div class="flex items-center space-x-3">
              <div class="relative">
                <img src="https://randomuser.me/api/portraits/men/41.jpg" class="w-10 h-10 rounded-full">
                <span class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 rounded-full border-2 border-white"></span>
              </div>
              <span>Omar Farooq</span>
            </div>
          </li>
        </ul>
        
        <div class="border-t border-gray-200 my-4"></div>
        
        <h4 class="font-semibold text-gray-500 mb-3">Group Conversations</h4>
        <ul class="space-y-3">
          <li class="flex items-center space-x-3 hover:bg-gray-100 p-2 rounded-lg transition-colors cursor-pointer">
            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
              <i class="fas fa-users text-gray-600"></i>
            </div>
            <span>Design Team</span>
          </li>
          
          <li class="flex items-center space-x-3 hover:bg-gray-100 p-2 rounded-lg transition-colors cursor-pointer">
            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
              <i class="fas fa-users text-gray-600"></i>
            </div>
            <span>Family Group</span>
          </li>
        </ul>
      </aside>
    </div>
  </div>
  
  <script>
    // Sticky header shadow effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('nav');
      if (window.scrollY > 0) {
        header.classList.add('shadow');
      } else {
        header.classList.remove('shadow');
      }
    });
    
    // Post interaction simulations
    document.querySelectorAll('.post-card button').forEach(button => {
      button.addEventListener('click', function() {
        if (this.querySelector('.far.fa-thumbs-up')) {
          this.querySelector('.far.fa-thumbs-up').classList.remove('far');
          this.querySelector('.fa-thumbs-up').classList.add('fas');
          this.querySelector('.fa-thumbs-up').classList.add('text-blue-500');
          this.querySelector('span').classList.add('text-blue-500');
        }
      });
    });
  </script>
</body>
</html>