<?php 
session_start();
require "../../../app/database/conectdb.php";
require "nav.php";
try{
$Friend_Requests = $db->selectALL(
  'SELECT users.*, friend_requests.sent_at 
   FROM users 
   JOIN friend_requests ON users.id = friend_requests.sender_id 
   WHERE friend_requests.receiver_id = ? AND friend_requests.status = ? 
   ORDER BY friend_requests.sent_at',
   [$_SESSION['id'], "pending"]
);

$users = $db->selectALL('SELECT * FROM users WHERE id != ? AND id NOT IN (SELECT CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END FROM friends WHERE user1_id = ? OR user2_id = ?) AND id NOT IN (SELECT sender_id FROM friend_requests WHERE receiver_id = ? UNION SELECT receiver_id FROM friend_requests WHERE sender_id = ?)
', [$_SESSION['id'],$_SESSION['id'],$_SESSION['id'], $_SESSION['id'], $_SESSION['id'], $_SESSION['id']]);
$friends = $db->selectALL('SELECT * FROM users WHERE id IN (SELECT CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END FROM friends WHERE user1_id = ? OR user2_id = ?);', [$_SESSION['id'],$_SESSION['id'], $_SESSION['id']]) ;
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        .friend-card {
            transition: all 0.3s ease;
            border-radius: 16px;
        }
        
        .friend-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .tab-button.active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }
        
        .profile-img {
            border: 3px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #2563eb, #1d4ed8);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }
        
        .btn-secondary {
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-1px);
        }
        
        .search-input {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }
        
        .header-bg {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 0 0 25% 25% / 20px;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .message-btn {
            background: linear-gradient(to right, #f0f9ff, #e0f2fe);
            transition: all 0.3s ease;
        }
        
        .message-btn:hover {
            background: linear-gradient(to right, #e0f2fe, #bae6fd);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header with Gradient Background -->
    <div class="header-bg p-6 pb-12 mb-8 shadow-md">
        <div class="container mx-auto max-w-6xl">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-white flex items-center">
                    <i class="fas fa-users mr-3 text-blue-100"></i>
               
                </h1>

            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12 max-w-6xl -mt-10">
        <!-- Tabs -->
        <div class="bg-white rounded-xl p-2 flex shadow-md mb-8">
            <button class="tab-button active flex-1 px-4 py-3 mx-1 rounded-lg hover:bg-blue-50 transition-colors text-center font-medium" data-tab="requests">
                <i class="fas fa-user-plus mr-2"></i>Friend Requests
            </button>
            <button class="tab-button flex-1 px-4 py-3 mx-1 rounded-lg hover:bg-blue-50 transition-colors text-center font-medium" data-tab="friends">
                <i class="fas fa-users mr-2"></i>Your Friends
            </button>
            <button class="tab-button flex-1 px-4 py-3 mx-1 rounded-lg hover:bg-blue-50 transition-colors text-center font-medium" data-tab="suggestions">
                <i class="fas fa-user-tag mr-2"></i>Add Friends
            </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Friend Requests Tab -->
            <div id="requests" class="tab-panel animate-fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm font-bold"><?php echo count($Friend_Requests) ?></span>
                        Friend Requests
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    if(count($Friend_Requests) == 0){
                        echo '<div class="col-span-3 text-center text-gray-500">No friend requests found.</div>';
                    }?>
                  <?php foreach ($Friend_Requests as $request): ?>
                <?php
                        $createdAt = new DateTime($request["sent_at"]);
                        $now = new DateTime();
                        $interval = $createdAt->diff($now);

                        if ($interval->y > 0) {
                            $joined = "sent " . $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                        } elseif ($interval->m > 0) {
                            $joined = "sent " . $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                        } elseif ($interval->d > 0) {
                            $joined = "sent " . $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                        } elseif ($interval->h > 0) {
                            $joined = "sent " . $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                        } elseif ($interval->i > 0) {
                            $joined = "sent " . $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                        } else {
                            $joined = "sent just now";
                        }
                        ?>

          
                    <div class="friend-card bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="../../assist/profiles/<?php echo $request["profile_picture"] ?>" alt="Profile" class="profile-img w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800"><?php echo $request["username"] ?></h3>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-user-friends mr-2 text-blue-400"></i>
                                    <span><?php echo $joined ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <button class="confirm-btn flex-1 btn-primary flex items-center justify-center bg-blue-500 text-white px-4 py-2.5 rounded-lg text-sm font-medium" data-user-id="<?php echo $request["id"] ?>" data-type = 'confirm'>
                                <i class="fas fa-check mr-2"></i> Confirm
                            </button>
                            <button class="delete-btn flex-1 btn-secondary flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg text-sm font-medium" data-user-id="<?php echo $request["id"] ?>" data-type = 'delete'>
                                <i class="fas fa-times mr-2"></i> Delete
                            </button>
                        </div>
                    </div>
                  <?php endforeach; ?>


                </div>
            </div>

            <!-- Your Friends Tab -->
            <div id="friends" class="tab-panel hidden animate-fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm font-bold"><?php echo count($friends) ?></span>
                        Your Friends
                    </h2>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-200 rounded-lg pl-4 pr-10 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm">
                            <option>Recently added</option>
                            <option>Alphabetical</option>
                            <option>Most interactions</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-2.5 text-gray-500 pointer-events-none"></i>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5">
                    <?php
                    if(count($friends) == 0){
                        echo '<div class="col-span-5 text-center text-gray-500">No friends found.</div>';
                    }
                    ?>
                  <?php foreach ($friends as $friend): ?>
                    <!-- Friend 1 -->
                    <div class="friend-card bg-white rounded-xl border border-gray-100 p-4 text-center shadow-sm hover:shadow-lg">
                        <div class="relative mb-3">
                            <img src="../../assist/profiles/<?php echo $friend["profile_picture"] ?>" alt="Profile" class="profile-img w-20 h-20 rounded-full object-cover mx-auto">
                            <div class="absolute bottom-0 right-1/3 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <h3 class="font-semibold text-gray-800"><?php echo $friend['username']?></h3>
                        <button class="message-btn w-full flex items-center justify-center text-blue-600 px-3 py-2 rounded-lg text-sm font-medium">
                            <i class="fas fa-comment-dots mr-2"></i> Message
                        </button>
                    </div>
                  <?php endforeach; ?>


                </div>


            </div>

            <!-- Add Friends Tab -->
            <div id="suggestions" class="tab-panel hidden animate-fade-in">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">People You May Know</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($users as $user): ?>
                    <!-- Suggestion 1 -->
                    <div class="friend-card bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:shadow-lg">
                        <div class="flex items-center mb-4">
                            <img src="../../assist/profiles/<?php echo $user["profile_picture"] ?>" alt="Profile" class="profile-img w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800"><?php echo $user["username"] ?></h3>

                            </div>
                        </div>
                        <button class="add-btn w-full  flex items-center text-white justify-center bg-blue-500 hover:bg-blue-600 active:bg-blue-700 px-4 py-2.5 rounded-lg text-sm font-medium" data-user-id="<?php echo $user["id"] ?>">
                            <i class="fas fa-user-plus mr-2"></i> Add Friend
                        </button>
                    </div>
                    <?php endforeach; ?>


                </div>

                </div>
            </div>
        </div>
    </div>



    <script>

      
 


      const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.getAttribute('data-tab');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            tabPanels.forEach(panel => {
                panel.style.display = 'none';
            });

            // عرض التبويب المحدد
            document.getElementById(tab).style.display = 'block';
        });
    });

    // تعيين العرض المبدئي
    document.querySelectorAll('.tab-panel').forEach(panel => panel.style.display = 'none');
    document.getElementById('requests').style.display = 'block';

                document.querySelectorAll('.add-btn').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const card = this.closest('.friend-card');
                    const name = card.querySelector('h3').textContent;

                    
                    
                

                    
                    // Send connection request to server
                    const userId = this.getAttribute('data-user-id');
                    console.log(userId);
                    
                    try {
                        const response = await fetch('../../../app/brain/signupHandling/add_friends.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ userId: userId })
                        });
                        
                        const result = await response.json();
                        if (result.status === 'success') {
                            console.log(`Connection request sent to ${name}`);
                        } else {
                            console.error(`Error sending connection request: ${result.message}`);
                        }
                    } catch (error) {
                        console.error('Error sending connection request:', error);
                    }
                });
            });

            document.querySelectorAll('.confirm-btn, .delete-btn').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const card = this.closest('.friend-card');
                    const name = card.querySelector('h3').textContent;
                    card.style.display = 'none'
                    

                    
                    // Send connection request to server
                    const userId = this.getAttribute('data-user-id');
                    const type = this.getAttribute('data-type');
                    console.log(userId);
                    
                    try {
                        const response = await fetch('../../../app/brain/users/confirm_friends.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                          body: JSON.stringify({ userId: userId, type: type })

                        });
                        
                        const result = await response.json();
                        if (result.status === 'success') {
                            console.log(`your are now freand with ${name}`);
                        } else {
                            console.error(`Error sending connection request: ${result.message}`);
                        }
                    } catch (error) {
                        console.error('Error sending connection request:', error);
                    }
                });
            });
    </script>
</body>
</html>