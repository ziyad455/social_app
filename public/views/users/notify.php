<?php



session_start();
require "../../../app/database/conectdb.php";
require "nav.php";

$userId = $_SESSION['id'];
$userId = $_SESSION['id'];
$notifications = $db->selectALL("
    SELECT n.*, nr.is_read
    FROM notification_recipients nr
    JOIN notifications n ON nr.notification_id = n.id
    WHERE nr.recipient_id = ?
    ORDER BY n.created_at DESC", [$userId]);


    function created($createdA) {
      $created = new DateTime($createdA);
      $now = new DateTime();
      $interval = $created->diff($now);

      if ($interval->y > 0) {
          $joined = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
      } elseif ($interval->m > 0) {
          $joined = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
      } elseif ($interval->d > 0) {
          $joined = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
      } elseif ($interval->h > 0) {
          $joined = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
      } elseif ($interval->i > 0) {
          $joined = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
      } else {
          $joined = "just now";
      }
      return $joined;
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifications - ConnectHub</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../../../public/assist/css/notify.css">
  <body>
  <!-- left bar -->
<div class="fixed top-20 left-8 w-64 h-[80vh] bg-white shadow-xl rounded-2xl p-4 border border-gray-200">
  <div class="flex flex-col h-full justify-between">

    <div>
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Notifications</h2>


      <div class="flex space-x-2 rtl:space-x-reverse mb-4">
        <a href="#" class="all px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium hover:bg-blue-200 transition">All</a>
        <a href="#" class="unread px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium hover:bg-gray-200 transition">Unread</a>
      </div>

  
      <ul class="space-y-2 text-sm text-gray-700">
        <li>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium transition">All Notifications</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium transition">Mentions</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium transition">Likes</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium transition">Comments</a>
        </li>
        <li>
          <a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium transition">Messages</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- main -->
<!-- Main Notification Area -->
<div class="absolute left-80 top-20 right-8 h-[80vh] bg-white shadow-xl rounded-2xl p-6 overflow-y-auto border border-gray-200">

  <!-- Title -->
  <h2 class="text-xl font-bold text-gray-800 mb-4">All Notifications</h2>

  <!-- Notifications List -->
  <div class="space-y-4 all_n">
    <?php if (empty($notifications)) : ?>
      <div class="flex con justify-center items-center h-40">
      <p class="text-gray-500 text-lg font-semibold">No notifications found.</p>
      </div>
    <?php endif; ?>
    <?php foreach ($notifications as $n) :?>
      <?php 
      $profilePicture = $db->selectOne("SELECT profile_picture FROM users WHERE id = ?", [$n['user_id']])['profile_picture'];
      $username =  $db->selectOne("SELECT username FROM users WHERE id = ?", [$n['user_id']])['username'];
      $profilePicturePath = "../../assist/profiles/" . $profilePicture;
      ?>

      <?php if ($n['category'] == 'post') :?>
       <?php if (!$n['is_read']) :?>
    <!-- Unread Notification -->
    <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> has posted a new update.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
      <?php else :?>
    <!-- Read Notification -->
    <div class="re con flex items-start gap-4 p-4 bg-white rounded-xl hover:bg-gray-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> has posted a new update.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
      <?php endif; ?>
       <?php endif; ?>

      <?php if ($n['category'] == 'like') : ?>
        <?php if (!$n['is_read']) : ?>
        <!-- Unread Like Notification -->
        <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
          <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
          <div class="flex-1">
          <p class="text-sm text-gray-800">
            <span class="font-semibold"><?php echo $username?></span> liked your post.
          </p>
          <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
          </div>
        </div>
        <?php else : ?>
        <!-- Read Like Notification -->
        <div class="re con flex items-start gap-4 p-4 bg-white rounded-xl hover:bg-gray-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
          <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
          <div class="flex-1">
          <p class="text-sm text-gray-800">
            <span class="font-semibold"><?php echo $username?></span> liked your post.
          </p>
          <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
          </div>
        </div>
        <?php endif; ?>
      <?php endif; ?>

       <?php if ($n['category'] == 'friend_request') : ?>
      <?php if (!$n['is_read']) : ?>
    <!-- Unread Friend Request -->
    <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> sent you a friend request.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
    <?php else : ?>
    <!-- Read Friend Request -->
    <div class="re con flex items-start gap-4 p-4 bg-white rounded-xl hover:bg-gray-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> sent you a friend request.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($n['category'] == 'friend_accept') : ?>
    <?php if (!$n['is_read']) : ?>
    <!-- Unread Friend Accept -->
    <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> accepted your friend request.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
    <?php else : ?>
    <!-- Read Friend Accept -->
    <div class="re con flex items-start gap-4 p-4 bg-white rounded-xl hover:bg-gray-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
      <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
      <div class="flex-1">
      <p class="text-sm text-gray-800">
      <span class="font-semibold"><?php echo $username?></span> accepted your friend request.
      </p>
      <span class="text-xs text-gray-500"><?php echo created($n['created_at'])?></span>
      </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Add more notifications here -->
    <?php endforeach; ?>
    </div>
  <!-- unread notify -->
  <div class="space-y-4 unread_n hidden">
    <?php foreach ($notifications as $n) : ?>
    <?php if (!$n['is_read']) : ?>
      <?php 
      $profilePicture = $db->selectOne("SELECT profile_picture FROM users WHERE id = ?", [$n['user_id']])['profile_picture'];
      $username =  $db->selectOne("SELECT username FROM users WHERE id = ?", [$n['user_id']])['username'];
      $profilePicturePath = "../../assist/profiles/" . $profilePicture;
      ?>
      <?php if ($n['category'] === 'post') : ?>
      <!-- Unread Post Notification -->
      <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
        <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
        <div class="flex-1">
        <p class="text-sm text-gray-800">
          <span class="font-semibold"><?php echo $username; ?></span> has posted a new update.
        </p>
        <span class="text-xs text-gray-500"><?php echo created($n['created_at']); ?></span>
        </div>
      </div>

      <?php elseif ($n['category'] === 'like') : ?>
      <!-- Unread Like Notification -->
      <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
        <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
        <div class="flex-1">
        <p class="text-sm text-gray-800">
          <span class="font-semibold"><?php echo $username; ?></span> liked your post.
        </p>
        <span class="text-xs text-gray-500"><?php echo created($n['created_at']); ?></span>
        </div>
      </div>

      <?php elseif ($n['category'] === 'friend_request') : ?>
      <!-- Unread Friend Request -->
      <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
        <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
        <div class="flex-1">
        <p class="text-sm text-gray-800">
          <span class="font-semibold"><?php echo $username; ?></span> sent you a friend request.
        </p>
        <span class="text-xs text-gray-500"><?php echo created($n['created_at']); ?></span>
        </div>
      </div>

      <?php elseif ($n['category'] === 'friend_accept') : ?>
      <!-- Unread Friend Accept -->
      <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
        <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
        <div class="flex-1">
        <p class="text-sm text-gray-800">
          <span class="font-semibold"><?php echo $username; ?></span> accepted your friend request.
        </p>
        <span class="text-xs text-gray-500"><?php echo created($n['created_at']); ?></span>
        </div>
      </div>

      <?php else : ?>
      <!-- Unread Other Category -->
      <div class="unre con flex items-start gap-4 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition cursor-pointer" data-id="<?php echo $n['id']; ?>">
        <img src="<?php echo $profilePicturePath ?>" alt="Avatar" class="w-10 h-10 rounded-full">
        <div class="flex-1">
        <p class="text-sm text-gray-800">
          <span class="font-semibold"><?php echo $username; ?></span> <?php echo htmlspecialchars($n['message']); ?>
        </p>
        <span class="text-xs text-gray-500"><?php echo created($n['created_at']); ?></span>
        </div>
      </div>
      <?php endif; ?>

    <?php endif; ?>
    <?php endforeach; ?>
  </div>

<script>


let all = document.querySelector('.all');
let unread = document.querySelector('.unread');

all.addEventListener('click', () => {
  all.classList.add('bg-blue-100', 'text-blue-600');
  all.classList.remove('bg-gray-100', 'text-gray-600');
  document.querySelector('.all_n').classList.remove('hidden');
  document.querySelector('.unread_n').classList.add('hidden');

  unread.classList.add('bg-gray-100', 'text-gray-600');
  unread.classList.remove('bg-blue-100', 'text-blue-600');
});

unread.addEventListener('click', () => {
  unread.classList.add('bg-blue-100', 'text-blue-600');
  unread.classList.remove('bg-gray-100', 'text-gray-600');
  document.querySelector('.unread_n').classList.remove('hidden');
  document.querySelector('.all_n').classList.add('hidden');

  all.classList.add('bg-gray-100', 'text-gray-600');
  all.classList.remove('bg-blue-100', 'text-blue-600');
});

const con = document.querySelectorAll('.con');
con.forEach((div) =>{
  div.addEventListener('click',async () =>{
    const id = div.getAttribute('data-id');
    try{
      const response = await fetch('../../../app/brain/users/read.php',{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: id })
    });
    const data = await response.json();
    if (data.status === 'success') {
        console.log('Notification marked as read');
        div.classList.remove('bg-blue-50' , 'hover:bg-blue-100');
        div.classList.add('bg-white', 'hover:bg-gray-100');


      }
     else {
        console.error('Error marking notification as read:', data.message);
      }

    }
    catch (error) {
      console.error('Error:', error);
    }




    




  })
})



</script>

</body>
</html>


