<?php  
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    require('../../database/conectdb.php');
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['userId']) && isset($_SESSION['id'])) {
        $userId = (int)$data['userId'];
        $currentUserId = (int)$_SESSION['id'];

        try {
            if ($data['type'] === 'confirm') {
                $db->insert("INSERT INTO friends (user1_id, user2_id) VALUES (?, ?)", [$currentUserId, $userId]);
                $db->delete("DELETE FROM friend_requests WHERE sender_id = ? AND receiver_id = ?", [$userId, $currentUserId]);
                echo json_encode(['status' => 'success', 'message' => 'You are now friends']);
            } else {
                $db->delete("DELETE FROM friend_requests WHERE sender_id = ? AND receiver_id = ?", [$userId, $currentUserId]);
                echo json_encode(['status' => 'success', 'message' => 'Friend request canceled']);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to handle friend request',
                'error' => $e->getMessage() 
            ]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user ID or session']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
