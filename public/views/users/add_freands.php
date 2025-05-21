<?php
require('../../../app/database/conectdb.php');
session_start();
$users = $db->selectALL('SELECT * FROM users WHERE email != ? LIMIT 6', [$_SESSION['email']]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Connection Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
        <!-- Enhanced Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white relative overflow-hidden">
            <!-- Abstract Background Elements -->
            <div class="absolute top-0 right-0 w-24 h-24 bg-white bg-opacity-10 rounded-full -mr-12 -mt-12"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -ml-16 -mb-16"></div>
            
            <div class="flex items-center justify-between relative z-10">
                <div class="space-y-1">
                    <h1 class="text-2xl font-bold tracking-tight">Last Step!</h1>
                    <p class="text-blue-100 text-base">Connect with people you may know</p>
                    <p class="text-blue-200 text-xs mt-2">Build your network with professionals in your field</p>
                </div>
                <div class="w-14 h-14 rounded-full bg-white bg-opacity-20 flex items-center justify-center shadow-lg backdrop-blur-sm">
                    <i class="fas fa-user-friends text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Main Content -->
        <div class="p-5 md:p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Suggested Connections</h2>
                <div class="text-sm text-blue-600 font-medium flex items-center">
                    <span>View all</span>
                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                </div>
            </div>
            
            <!-- Connection Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($users as $user): ?>
                    <?php
                        $createdAt = new DateTime($user["created_at"]);
                        $now = new DateTime();
                        $interval = $createdAt->diff($now);

                        if ($interval->y > 0) {
                            $joined = "joined " . $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                        } elseif ($interval->m > 0) {
                            $joined = "joined " . $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                        } elseif ($interval->d > 0) {
                            $joined = "joined " . $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                        } elseif ($interval->h > 0) {
                            $joined = "joined " . $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                        } elseif ($interval->i > 0) {
                            $joined = "joined " . $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                        } else {
                            $joined = "joined just now";
                        }
                        ?>

                <!-- Connection Card with Enhanced Styling -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 overflow-hidden group">
                    <!-- Card Header with Background Gradient -->
                    <div class="h-10 bg-gradient-to-r from-blue-50 to-indigo-50 relative">
                        <div class="absolute -bottom-7 left-1/2 transform -translate-x-1/2">
                            <div class="w-16 h-16 rounded-full bg-white p-1 shadow-md overflow-hidden">
                                <img src="../../assist/profiles/<?php echo $user["profile_picture"] ?>" alt="Profile" class="w-full h-full object-cover rounded-full">
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-10 p-3">
                        <div class="text-center">
                            <h3 class="font-semibold text-gray-900 text-base"><?php echo ucwords($user["username"])?></h3>
                            <p class="text-gray-500 mb-1 text-xs"><?php echo isset($user["profession"]) ? $user["profession"] : "Professional" ?></p>
                            <div class="flex items-center justify-center mb-3 text-xs text-gray-400">
                                <i class="fas fa-user-friends mr-1"></i>
                                <span> <?php echo $joined?> </span>
                            </div>
                            
                            <button class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white px-4 py-1.5 rounded-full text-xs font-medium transition-colors w-full flex items-center justify-center group-hover:shadow-md" data-user-id="<?php echo $user['id'] ?>">
                                <i class="fas fa-user-plus mr-1"></i> Connect
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <form action="home.php" method="post" class="mt-6 flex items-center justify-center">
                <button disabled  class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-50 active:bg-gray-100 transition-colors flex items-center shadow-sm hover:shadow">
                    <span class="text-gray-400">Continue</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
            
            <!-- Progress Indicator -->
            <div class="mt-6 flex justify-center">
                <div class="flex space-x-1">
                    <div class="w-5 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-5 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-5 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-5 h-1 rounded-full bg-blue-500"></div>
                    <div class="w-5 h-1 rounded-full bg-blue-500"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const continueButton = document.querySelector('form button');
            let c = 0;
            document.querySelectorAll('.text-center button[data-user-id]').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const card = this.closest('.bg-white.rounded-lg');
                    const name = card.querySelector('h3').textContent;
                    if (c  === 0) {
                        continueButton.removeAttribute('disabled');

                        continueButton.querySelector('span').classList.remove('text-gray-400');
                        c++;
                    }

                    
                    
                    // Update button appearance
                    this.innerHTML = '<i class="fas fa-check mr-1"></i> Request Sent';
                    this.classList.remove('bg-blue-500', 'hover:bg-blue-600', 'active:bg-blue-700');
                    this.classList.add('bg-gray-300', 'hover:bg-gray-400', 'text-gray-700');
                    this.disabled = true;
                    
                    // Remove hover effect from parent card
                    card.classList.remove('hover:-translate-y-1', 'group-hover:shadow-md');
                    
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
        });
    </script>
</body>
</html>