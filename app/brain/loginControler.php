<?php
require "../database/Database.php";
require "../database/conectdb.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $userName = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    if ($userName === '' || $pass === '') {
        $error = "Please fill in all fields.";
        header("Location: ../../public/views/users/login.php?msg=" . urlencode($error));
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $params = [$userName];
    $user = $db->selectOne($sql, $params);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        header("Location: ../../public/views/users/home.php");
        exit();
    } else {
        $error = "Invalid username or password.";
        header("Location: ../../public/views/users/login.php?msg=" . urlencode($error));
        exit();
    }
}

