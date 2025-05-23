<?php

use BcMath\Number;

session_start();
require "../../../app/database/conectdb.php";
$userId = $_SESSION['id'];

$query = "
SELECT posts.*, users.username, users.profile_picture
FROM posts 
JOIN users ON posts.user_id = users.id 
WHERE posts.user_id != ? 
ORDER BY posts.created_at DESC
";
$posts = $db->selectALL($query, [$userId]);



$query1 = 'SELECT * FROM users WHERE id = ?';
$user = $db->selectOne($query1,[$userId]);

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
        <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-pic" />
        <span><?=  $user['username'] ?></span>
      </div>
      <ul class="sidebar-links">
        <li><i class="fas fa-user"></i><a style="text-decoration: none;color:black;" href="profile.php">Profile</a> </li>
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
        <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-pic" />
        <input type="text" placeholder="What's on your mind?" />
        <!-- Add this button -->
        <button class="add-post-btn">
          <a href="Addpost.php">
              <i class="fas fa-paper-plane"></i>
          </a>
        </button>
      </div>

        

        <!-- Posts -->
     <?php foreach ($posts as $post) : ?>
        <div class="posts">
          <div class="post">
            <div class="post-header">

              <img src="../../../public/assist/profiles/<?= htmlspecialchars($post['profile_picture']) ?>" class="profile-pic" />
              <div>
                <h4><strong><?= htmlspecialchars($post['username']) ?></strong></h4>
                <small><?php echo createdAt($post['created_at']) ?></small>
                

              </div>
            </div>

            <?php if (!empty($post['description'])): ?>
              <p><?= htmlspecialchars($post['description']) ?></p>
            <?php endif; ?>

            <?php if (!empty($post['image_path'])): ?>
              <img src="../../../public/assist/posts/<?= htmlspecialchars($post['image_path']) ?>" class="post-img" />
            <?php endif; ?>

            <div class="post-actions">
              <button><i class="fas fa-thumbs-up"></i> Like</button>
              <button><i class="fas fa-comment"></i> Comment</button>
              <button><i class="fas fa-share"></i> Share</button>
            </div>
          </div>
        </div>
<?php endforeach ?>


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
