<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

    if (strlen($password) < 8) {
        $error[] = "Password must be at least 8 characters long.";
    }

    if ($password !== $confirmPassword) {
        $error[] = "Passwords do not match.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $error[] = "Password must contain at least one uppercase letter.";
    }

    if (!preg_match('/[a-z]/', $password)) {
        $error[] = "Password must contain at least one lowercase letter.";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $error[] = "Password must contain at least one number.";
    }

    if (!preg_match('/[\W_]/', $password)) {
        $error[] = "Password must contain at least one special character.";
    }

    if (count($error) > 0) {
        $_SESSION['errors'] = $error;
        header("Location: ../../../public/views/users/singup/password.php");
        exit;
    } else {
        $_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT);
        header("Location: ../../../public/views/users/singup/image.php");
        exit;
    }
}