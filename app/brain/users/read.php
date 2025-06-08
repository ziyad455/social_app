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
    
    if (isset($data['id']) && isset($_SESSION['id'])) {
        $Id = (int)$data['id'];


        try {
          $db->update("UPDATE notification_recipients SET is_read = 1 WHERE notification_id = ? AND recipient_id = ?", [$Id, $_SESSION['id']]);
          echo json_encode(['status' => 'success', 'message' => 'Notification marked as read']);


        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to mark notification as read',
                'error' => $e->getMessage() 
            ]);

        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid user ID or session']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
