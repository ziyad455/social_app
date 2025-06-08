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
         
            $db->insert("INSERT INTO friend_requests (sender_id, receiver_id) VALUES (?, ?)", [$currentUserId, $userId]);
            $db->insert("INSERT INTO notifications (user_id, category) VALUES (?, ?)", [$currentUserId, 'friend_request']);
            $notificationId = $db->lastInsertId();
            $db->insert("INSERT INTO notification_recipients (notification_id, recipient_id) VALUES (?, ?)", [$notificationId, $userId]);

            echo json_encode(['status' => 'success', 'message' => 'Friend request sent']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send friend request']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user ID or session']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
