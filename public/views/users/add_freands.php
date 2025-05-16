<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect with Friends</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Last Step!</h1>
                    <p class="text-blue-100">Connect with people you may know</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-user-friends text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Suggested Connections</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Person 1 -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">Sarah Johnson</h3>
                            <p class="text-sm text-gray-500 mb-3">5 mutual friends</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Person 2 -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">Michael Chen</h3>
                            <p class="text-sm text-gray-500 mb-3">2 mutual friends</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

            
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">Emma Rodriguez</h3>
                            <p class="text-sm text-gray-500 mb-3">Works at TechCorp</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Person 4 -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">David Wilson</h3>
                            <p class="text-sm text-gray-500 mb-3">3 mutual friends</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Person 5 -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">Olivia Smith</h3>
                            <p class="text-sm text-gray-500 mb-3">From your hometown</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Person 6 -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="p-4">
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-blue-100 overflow-hidden border-2 border-white shadow-md">
                                <img src="https://randomuser.me/api/portraits/men/81.jpg" alt="Profile" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-medium text-gray-900">James Brown</h3>
                            <p class="text-sm text-gray-500 mb-3">Went to Stanford</p>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors w-full">
                                <i class="fas fa-user-plus mr-2"></i> Add Friend
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <button class="px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-full font-medium hover:bg-gray-50 transition-colors">
                    Skip for now
                </button>
            </div>
        </div>
    </div>

    <script>
        // Add friend functionality
        document.querySelectorAll('button:not([class*="Skip"])').forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.bg-white');
                const name = card.querySelector('h3').textContent;
                
                // Change button state
                this.innerHTML = '<i class="fas fa-check mr-2"></i> Request Sent';
                this.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                this.classList.add('bg-gray-300', 'hover:bg-gray-400', 'text-gray-700');
                this.disabled = true;
                

            });
        });


    </script>
</body>
</html>