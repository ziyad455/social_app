<?php
require "../database/Database.php";
require "../database/conectdb.php";
session_start();
session_start();

    if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['submit'])){
        $userName = isset($_POST['email']) ? trim($_POST['email']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

        $sql = "SELECT * FROM users WHERE email = ?";
        $para = [$userName];
        $user = $db->selectOne($sql, $para);


        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['profile_picture'] = $user['profile_picture'];

           header("Location: ../../public/views/users/home.php");
           exit();

        } else {
          $error = "wrong email or password";
          header("Location: ../../public/views/users/login.php?msg=$error");
        }


        
    }
