<?php


session_start();
require "../../../app/database/conectdb.php";
$userId = $_SESSION['id'];


$query1 = 'SELECT * FROM users WHERE id = ?';
$user = $db->selectOne($query1,[$userId]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary: #1877f2; /* Facebook blue */
      --secondary: #e4e6eb;
      --text-primary: #050505;
      --text-secondary: #65676b;
      --background: #f0f2f5;
      --card-background: #ffffff;
      --story-highlight: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }
    
    body {
      background-color: var(--background);
      color: var(--text-primary);
    }
    
    .profile-container {
      max-width: 935px;
      margin: 0 auto;
      padding: 30px 20px 0;
    }
    
    /* Profile Header */
    .profile-header {
      display: flex;
      margin-bottom: 44px;
    }
    
    .profile-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-right: 30px;
    }
    
    .profile-info {
      flex: 1;
    }
    
    .profile-name {
      font-size: 28px;
      font-weight: 300;
      margin-bottom: 12px;
    }
    
    .profile-stats {
      display: flex;
      margin-bottom: 20px;
    }
    
    .stat {
      margin-right: 40px;
      font-size: 16px;
    }
    
    .stat-number {
      font-weight: 600;
    }
    
    .profile-bio {
      margin-bottom: 20px;
      line-height: 1.5;
    }
    
    .profile-actions {
      display: flex;
      gap: 8px;
    }
    
    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      border: none;
      font-size: 14px;
    }
    
    .btn-primary {
      background-color: var(--primary);
      color: white;
    }
    
    .btn-secondary {
      background-color: var(--secondary);
      color: var(--text-primary);
    }
    
    /* Stories Highlight */
    .stories-highlight {
      display: flex;
      margin-bottom: 44px;
      overflow-x: auto;
      padding-bottom: 10px;
      scrollbar-width: none;
    }
    
    .stories-highlight::-webkit-scrollbar {
      display: none;
    }
    
    .story-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-right: 28px;
      cursor: pointer;
    }
    
    .story-circle {
      width: 77px;
      height: 77px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--story-highlight);
      padding: 2px;
      margin-bottom: 6px;
    }
    
    .story-inner {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: var(--card-background);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border: 2px solid white;
    }
    
    .story-inner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .story-title {
      font-size: 12px;
    }
    
    /* Tabs */
    .profile-tabs {
      display: flex;
      justify-content: center;
      border-top: 1px solid #dbdbdb;
      margin-bottom: 0;
    }
    
    .tab {
      padding: 16px 0;
      margin: 0 30px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      color: var(--text-secondary);
      cursor: pointer;
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .tab i {
      margin-right: 6px;
      font-size: 16px;
    }
    
    .tab.active {
      color: var(--text-primary);
    }
    
    .tab.active::after {
      content: '';
      position: absolute;
      top: -1px;
      left: 0;
      right: 0;
      height: 1px;
      background-color: var(--text-primary);
    }
    
    /* Posts Grid */
    .posts-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
    }
    
    .post-thumbnail {
      width: 100%;
      aspect-ratio: 1/1;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
    }
    
    .post-thumbnail:hover {
      transform: scale(1.03);
    }
    
    .post-overlay {
      position: relative;
    }
    
    .post-stats {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.3);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .post-overlay:hover .post-stats {
      opacity: 1;
    }
    
    .post-stat {
      display: flex;
      align-items: center;
      margin: 0 10px;
      font-weight: 600;
    }
    
    .post-stat i {
      margin-right: 6px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      
      .profile-avatar {
        margin-right: 0;
        margin-bottom: 20px;
      }
      
      .profile-stats {
        justify-content: center;
      }
      
      .profile-actions {
        justify-content: center;
      }
      
      .posts-grid {
        gap: 3px;
      }
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
      <img src="../../../public/assist/profiles/<?= htmlspecialchars($user['profile_picture']) ?>" class="profile-avatar" />
      <div class="profile-info">
        <h1 class="profile-name"><?php $use['username'] ?> </h1>
        
        <div class="profile-stats">
          <div class="stat">
            <span class="stat-number">1,234</span> posts
          </div>
          <div class="stat">
            <span class="stat-number">12.8k</span> followers
          </div>
          <div class="stat">
            <span class="stat-number">456</span> following
          </div>
        </div>
        
        <div class="profile-bio">
          Digital creator | Photography enthusiast
          <br>📍 New York, NY
          <br>✨ Creating content that inspires
          <br>👇 Check out my latest projects
        </div>
        
        <div class="profile-actions">
          <button class="btn btn-primary">Follow</button>
          <button class="btn btn-secondary">Message</button>
          <button class="btn btn-secondary"><i class="fas fa-chevron-down"></i></button>
        </div>
      </div>
    </div>
    
    <!-- Stories Highlight -->
    <div class="stories-highlight">
      <div class="story-item">
        <div class="story-circle">
          <div class="story-inner">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Story">
          </div>
        </div>
        <span class="story-title">Travel</span>
      </div>
      
      <div class="story-item">
        <div class="story-circle">
          <div class="story-inner">
            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Story">
          </div>
        </div>
        <span class="story-title">Fashion</span>
      </div>
      
      <div class="story-item">
        <div class="story-circle">
          <div class="story-inner">
            <img src="https://images.unsplash.com/photo-1524504388940-b1c1722653e1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Story">
          </div>
        </div>
        <span class="story-title">Food</span>
      </div>
      
      <div class="story-item">
        <div class="story-circle">
          <div class="story-inner">
            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Story">
          </div>
        </div>
        <span class="story-title">Art</span>
      </div>
      
      <div class="story-item">
        <div class="story-circle">
          <div class="story-inner">
            <img src="https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Story">
          </div>
        </div>
        <span class="story-title">Work</span>
      </div>
    </div>
    
    <!-- Tabs -->
    <div class="profile-tabs">
      <div class="tab active">
        <i class="fas fa-table-cells"></i>
        <span>Posts</span>
      </div>
      <div class="tab">
        <i class="fas fa-tv"></i>
        <span>Reels</span>
      </div>
      <div class="tab">
        <i class="fas fa-bookmark"></i>
        <span>Saved</span>
      </div>
      <div class="tab">
        <i class="fas fa-user-tag"></i>
        <span>Tagged</span>
      </div>
    </div>
    
    <!-- Posts Grid -->
    <div class="posts-grid">
      <!-- Post 1 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1682686580391-615b3f4f56eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 1.2k
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 143
          </div>
        </div>
      </div>
      
      <!-- Post 2 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1698778573685-99f23095d5db?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 892
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 76
          </div>
        </div>
      </div>
      
      <!-- Post 3 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1699035118638-0a6c5d1b2b4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 2.4k
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 231
          </div>
        </div>
      </div>
      
      <!-- Post 4 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1698949873284-b9daf5e085e2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 1.7k
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 189
          </div>
        </div>
      </div>
      
      <!-- Post 5 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1698402580015-4a1c1a0b0a4a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 3.1k
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 412
          </div>
        </div>
      </div>
      
      <!-- Post 6 -->
      <div class="post-overlay">
        <img src="https://images.unsplash.com/photo-1698778574083-279be0ac6681?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Post" class="post-thumbnail">
        <div class="post-stats">
          <div class="post-stat">
            <i class="fas fa-heart"></i> 1.5k
          </div>
          <div class="post-stat">
            <i class="fas fa-comment"></i> 167
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>












