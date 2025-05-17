<?php 
require "../../../app/database/conectdb.php"

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Facebook Clone Layout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <link rel="stylesheet" href="../../../public/assist/css/homepage.css">
>
</head>
<body>
  <div class="container">
    
    <!-- Left Sidebar -->
    <aside class="left-sidebar">
      <div class="profile-link">
        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="profile-pic">
        <span>Ahmed Mohamed</span>
      </div>
      <ul class="sidebar-links">
        <li><i class="fas fa-user"></i> Profile</li>
        <li><i class="fas fa-users"></i> Friends</li>
        <li><i class="fas fa-users-cog"></i> Groups</li>
        <li><i class="fas fa-flag"></i> Pages</li>
        <li><i class="fas fa-calendar-alt"></i> Events</li>
        <li><i class="fas fa-chevron-down"></i> See More</li>
      </ul>
    </aside>

    <!-- Main Feed (Middle) -->
    <main class="main-feed">
      <!-- Navbar -->
        <!-- Navbar - MOVED INSIDE MAIN FEED -->
  <nav class="navbar">
    <div class="nav-left">
      <div class="logo">MyFace</div>
      <input type="text" class="search-bar" placeholder="Search..." />
    </div>
    <div class="nav-center">
      <div class="icon active"><i class="fas fa-home"></i></div>
      <div class="icon"><i class="fas fa-user-friends"></i></div>
      <div class="icon"><i class="fas fa-tv"></i></div>
    </div>
    <div class="nav-right">
      <div class="icon"><i class="fab fa-facebook-messenger"></i></div>
      <div class="icon"><i class="fas fa-bell"></i></div>
      <div class="icon"><i class="fas fa-user-circle"></i></div>
    </div>
  </nav>

      <!-- Content: Stories + Create Post + Posts -->
      <section class="content">
        <!-- Stories -->
        <div class="stories">
          <div class="story add-story">
            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Your Story">
            <button class="add-btn">+</button>
            <span>Your Story</span>
          </div>
          <div class="story"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt=""><span>John</span></div>
          <div class="story"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt=""><span>Emma</span></div>
          <div class="story"><img src="https://randomuser.me/api/portraits/men/12.jpg" alt=""><span>David</span></div>
        </div>

        <!-- Create Post -->
        <!-- Create Post -->
      <div class="create-post">
        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile Pic" class="profile-pic" />
        <input type="text" placeholder="What's on your mind?" />
        <!-- Add this button -->
        <button class="add-post-btn">
          <a href="Addpost.php">
                      <i class="fas fa-paper-plane"></i>
          </a>
        </button>
      </div>

        

        <!-- Posts -->
       
        <div class="posts">
          <div class="post">
            <div class="post-header">
              <img src="https://randomuser.me/api/portraits/women/65.jpg" class="profile-pic" />
              <div>
                <h4>Sarah</h4>
                <small>2 hrs ago</small>
              </div>
            </div>
            <p>Enjoying the sunny weather!</p>
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" class="post-img" />
            <div class="post-actions">
              <button><i class="fas fa-thumbs-up"></i> Like</button>
              <button><i class="fas fa-comment"></i> Comment</button>
              <button><i class="fas fa-share"></i> Share</button>
            </div>
          </div>
        </div>
      </section>
    </main>


    <!-- Right Sidebar -->
    <aside class="right-sidebar">
      <h4>Active Friends</h4>
      <ul class="friends-list">
        <li><img src="https://randomuser.me/api/portraits/men/55.jpg" /> <span>Ali</span></li>
        <li><img src="https://randomuser.me/api/portraits/women/21.jpg" /> <span>Lina</span></li>
        <li><img src="https://randomuser.me/api/portraits/men/41.jpg" /> <span>Omar</span></li>
      </ul>
      <h4>Sponsored</h4>
      <img src="https://via.placeholder.com/200x100" alt="Ad" />
    </aside>

  </div>
</body>
</html>
