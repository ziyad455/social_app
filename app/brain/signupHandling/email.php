<?php 
require('../../database/conectdb.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    header('Content-Type: application/json');


    try {
        $checkQuery = 'SELECT COUNT(*) as count FROM users WHERE email = ?';
        $result = $db->selectOne($checkQuery, [$email]);
        
        if ($result['count'] > 0) {
            
            echo json_encode(['exists' => true, 'success' => false]);
            exit();
        }
        


        
        echo json_encode(['exists' => false, 'success' => true]);
        $_SESSION['email'] = $email;
        exit();
    } catch (Exception $e) {
        echo json_encode(['exists' => false, 'success' => false, 'error' => $e->getMessage()]);
        exit();
    }
}