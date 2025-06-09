<?php 

$unreadCount = $db->selectOne("SELECT COUNT(*) as count FROM notifications n JOIN notification_recipients nr ON n.id = nr.notification_id WHERE nr.recipient_id = ? AND nr.is_read = 0", [$_SESSION['id']])['count']; 
$query1 = 'SELECT * FROM users WHERE id = ?'; 
$user = $db->selectOne($query1,[$_SESSION['id']]);  
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
    <div class="flex items-center space-x-2">
      <div class="w-10 h-10 bg-facebook-blue rounded-full flex items-center justify-center">
        <span class="text-white font-bold text-xl">C</span>
      </div>
      <span class="text-2xl font-bold text-facebook-blue">ConnectHub</span>
    </div>

    <div class="flex space-x-5">
      <a href="home.php" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors relative">
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
     
      <a href="notify.php" class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors relative">
        <i class="fas fa-bell  <?php echo isSelected('notify') ?>"></i>
        <?php if (!empty($unreadCount)): ?>
          <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center"><?php echo htmlspecialchars($unreadCount, ENT_QUOTES, 'UTF-8'); ?></span>
        <?php endif; ?>
      </a>
     
      <a href="#" class="h-10 w-10 rounded-full bg-gray-300 overflow-hidden">
        <img src="../../assist/profiles/<?php echo $user["profile_picture"] ?>" alt="Profile" class="h-full w-full object-cover">
      </a>
    </div>
  </nav>
</body>
</html>