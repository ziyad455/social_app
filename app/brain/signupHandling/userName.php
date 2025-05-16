<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];

    $fname = isset($_POST['name']) ? trim($_POST['name']) : '';
    $lname = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';

    if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error[] = "First name and last name must be at least 3 characters long.";
        $_SESSION['errors'] = $error; 
        header("Location: ../../../public/views/users/singup/user_name.php");
        exit;
    }

    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;

    header("Location: ../../../public/views/users/singup/password.php");
    exit;
}
