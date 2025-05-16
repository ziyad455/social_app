<?php
require "../database/Database.php";
require "../database/conectdb.php";

    if($_SERVER['REQUEST_METHOD'] ==='POST' && isset($_POST['submit'])){
        $userName = isset($_POST['username']) ? trim($_POST['username']) : '';
        $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $para = [$userName,$pass];
        $stmt = $db->selectOne($sql,$para);

        if($stmt){
          // header("Location : user.php");
          // exit();
          echo "hello" . $userName;
        }else{
          $error = "no one exist";
          header("Location: ../../public/views/users/login.php?msg=$error");
        }


        
    }
