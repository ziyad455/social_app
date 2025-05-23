<?php
session_start();
require "../../../app/database/conectdb.php";

$query = "
SELECT * FROM users 
WHERE id = ? 
";

$user = $db->selectOne($query,[$_SESSION['id']]);


$query1 = 'SELECT * FROM posts WHERE user_id = ?
ORDER BY created_at DESC';
$posts = $db->selectALL($query1,[$_SESSION['id']]);

function createdAt($createdAt) {
    date_default_timezone_set('Africa/Casablanca');

    $cr = strtotime($createdAt);
    $now = time();
    $diff = $now - $cr;

    if ($diff < 0) {
        return "Now";
    }

    if ($diff < 60) {
        return "$diff seconds ago";
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return "$minutes minutes ago";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return "$hours hours ago";
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return "$days days ago";
    } else {
        return date("Y-m-d", $cr);
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facebook Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../../../public/assist/css/profile.css">
</head>
<body>
  <div class="container">
    <!-- Cover Photo -->
    <div class="cover-photo">
      <img src="https://images.unsplash.com/photo-1579547945413-497e1b99dac0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Cover">
    </div>
    
    <!-- Profile Header -->
    <div class="profile-header">
      <div class="profile-pic-container">
      <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-pic" />
      </div>
      
      <div class="profile-actions">
        <button class="btn btn-secondary">
          <i class="fas fa-ellipsis-h"></i>
        </button>
        <button class="btn btn-secondary">
          <i class="fas fa-search"></i>
        </button>
        <button class="btn btn-primary">
          <i class="fas fa-user-plus"></i> Add Friend
        </button>
      </div>
      
      <div class="profile-info">
        <h1 class="profile-name"><?= $user['username'] ?></h1>
        <!-- ! here we will work on the number of freinds -->
        <div class="profile-friends">387 friends</div>
      </div>
      
      <div class="profile-nav">
        <div class="nav-item active">Posts</div>
        <div class="nav-item">About</div>
        <div class="nav-item">Friends</div>
        <div class="nav-item">Photos</div>
        <div class="nav-item">More <i class="fas fa-caret-down"></i></div>
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="profile-content">
      <!-- Left Column -->
      <div class="left-column">
        <div class="intro-section">
          <h2 class="section-title">Intro</h2>
          <div class="intro-item">
            <i class="fas fa-briefcase"></i>
            <span>Works at Digital Creative Agency</span>
          </div>
          <div class="intro-item">
            <i class="fas fa-graduation-cap"></i>
            <span>Studied at University of Design</span>
          </div>
          <div class="intro-item">
            <i class="fas fa-home"></i>
            <span>Lives in New York, NY</span>
          </div>
          <div class="intro-item">
            <i class="fas fa-heart"></i>
            <span>In a relationship</span>
          </div>
        </div>
        
        <div class="friends-section">
          <div class="section-header">
            <h2 class="section-title">Friends</h2>
            <a href="#" style="color: var(--fb-blue); text-decoration: none; font-size: 14px;">See all friends</a>
          </div>
          
          <div class="friends-grid">
            <!-- Friend 1 -->
            <div class="friend-card">
              <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Friend" class="friend-pic">
              <div class="friend-name">Emma</div>
            </div>
            
            <!-- Friend 2 -->
            <div class="friend-card">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Friend" class="friend-pic">
              <div class="friend-name">John</div>
            </div>
            
            <!-- Add more friends as needed -->
          </div>
        </div>
      </div>
      
      <!-- Right Column -->
      <div class="right-column">
        <!-- Create Post -->
        <div class="create-post">
          <div class="post-input">
            <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-pic" />
            <input type="text" placeholder="What's on your mind?">
          </div>
          <div class="post-options">
            <div class="post-option">
              <i class="fas fa-video" style="color: #f3425f;"></i>
              <span>Live video</span>
            </div>
            <div class="post-option">
              <i class="fas fa-images" style="color: #45bd62;"></i>
              <span>Photo/video</span>
            </div>
            <div class="post-option">
              <i class="fas fa-smile" style="color: #f7b928;"></i>
              <span>Feeling/activity</span>
            </div>
          </div>
        </div>
        
        <!-- Posts -->
        <!-- Post with text only -->
         <?php foreach($posts as $post) :?>
        <div class="post">
          <div class="post-header">
            <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="post-user-pic" />
            <div class="post-user-info">
              <div class="post-username"><?= $user['username'] ?></div>
              <div class="post-time"><?= createdAt($post['created_at']) ?></div>
            </div>
            <div class="post-more">
              <i class="fas fa-ellipsis-h"></i>
            </div>
          </div>
          <div class="post-content">
              <?= $post['description'] ?>
          </div>
          <?php if($post['image_path']) :?>
          <img src="../../../public/assist/posts/<?= htmlspecialchars($post['image_path']) ?>" alt="Park" class="post-image">
          <?php endif ?>
          <div class="post-stats">
            <div class="post-likes">
              <i class="fas fa-thumbs-up"></i> 124
            </div>
            <div class="post-comments">
              23 comments
            </div>
          </div>
          <div class="post-actions">
            <div class="post-action">
              <i class="far fa-thumbs-up"></i>
              <span>Like</span>
            </div>
            <div class="post-action">
              <i class="far fa-comment"></i>
              <span>Comment</span>
            </div>
            <div class="post-action">
              <i class="fas fa-share"></i>
              <span>Share</span>
            </div>
          </div>
        </div>
        <?php endforeach ?>
        
        <!-- Post with image -->
        <!-- <div class="post">
          <div class="post-header">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="User" class="post-user-pic">
            <div class="post-user-info">
              <div class="post-username">Sarah Miller</div>
              <div class="post-time">Monday at 10:30 AM</div>
            </div>
            <div class="post-more">
              <i class="fas fa-ellipsis-h"></i>
            </div>
          </div>
          <div class="post-content">
            Beautiful day for a walk in the park! The colors this time of year are amazing.
          </div>
          <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1574&q=80" alt="Park" class="post-image">
          <div class="post-stats">
            <div class="post-likes">
              <i class="fas fa-thumbs-up"></i> 245
            </div>
            <div class="post-comments">
              42 comments
            </div>
          </div>
          <div class="post-actions">
            <div class="post-action">
              <i class="far fa-thumbs-up"></i>
              <span>Like</span>
            </div>
            <div class="post-action">
              <i class="far fa-comment"></i>
              <span>Comment</span>
            </div>
            <div class="post-action">
              <i class="fas fa-share"></i>
              <span>Share</span>
            </div>
          </div>
        </div> -->
        
        <!-- Post with no text (just image) -->
        <!-- <div class="post">
          <div class="post-header">
            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="User" class="post-user-pic">
            <div class="post-user-info">
              <div class="post-username">Sarah Miller</div>
              <div class="post-time">Last Friday at 8:15 PM</div>
            </div>
            <div class="post-more">
              <i class="fas fa-ellipsis-h"></i>
            </div>
          </div>
          <img src="https://images.unsplash.com/photo-1493612276216-ee3925520721?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1528&q=80" alt="Dinner" class="post-image">
          <div class="post-stats">
            <div class="post-likes">
              <i class="fas fa-thumbs-up"></i> 189
            </div>
            <div class="post-comments">
              31 comments
            </div>
          </div>
          <div class="post-actions">
            <div class="post-action">
              <i class="far fa-thumbs-up"></i>
              <span>Like</span>
            </div>
            <div class="post-action">
              <i class="far fa-comment"></i>
              <span>Comment</span>
            </div>
            <div class="post-action">
              <i class="fas fa-share"></i>
              <span>Share</span>
            </div>
          </div>
        </div> -->

      </div>
    </div>
  </div>
</body>
</html>