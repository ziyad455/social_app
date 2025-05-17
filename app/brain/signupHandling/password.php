<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';
    $_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT);
    header("Location: ../../../public/views/users/singup/image.php");
    exit;

    }  

    
