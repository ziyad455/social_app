<?php
  session_start();
  require('../../database/conectdb.php');




if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

  
  $allowedExtensions = ['jpg', 'jpeg','png'];
  $imageName = $_FILES['image']['name'] ?? ''; // ex: img1.png
  $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION)); // ex.  png
  // var_dump($_FILES['image']);
  // die();

  if (in_array($extension, $allowedExtensions) && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    if(!empty($extension)){
        $imageName = $_FILES['image']['name']; // ex: img1.png
        $username = $_SESSION['fname'];         // ex: hamza

        $extension = pathinfo($imageName, PATHINFO_EXTENSION); // png

        $newImageName = $username . '.' . $extension; // hamza.png


        $imageTmp = $_FILES['image']['tmp_name']; //
        // $imageTmp = $_FILES['image']['size']; size
        // $imageTmp = $_FILES['image']['error']; les error
        // $imageTmp = $_FILES['image']['type']; image/png jpeg

        // $targetDir = "public/assist/profiles/";
        $targetDir = __DIR__ . "/../../../public/assist/profiles/";

        // $targetFile = $targetDir . basename($imageName); // images ex.png
        $targetFile = $targetDir . basename($newImageName);

    }
  


    if (move_uploaded_file($imageTmp, $targetFile)) {
      
      try{
        $query = "INSERT INTO users (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";
        $uername = $_SESSION['fname'] . " " . $_SESSION['lname'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        $db->insert($query, [$uername, $email, $password, $newImageName]);
        header("Location: ../../../public/views/users/add_freands.php");
      }
      catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
      }

    } 

  }
       else{
          try{
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $uername = $_SESSION['fname'] . " " . $_SESSION['lname'];
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        $db->insert($query, [$uername, $email, $password]);
        header("Location: ../../../public/views/users/add_freands.php");
        exit();
      }
      catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
      }


  }
 
}


