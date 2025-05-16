<?php
  session_start();




if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

  
  $allowedExtensions = ['jpg', 'jpeg','png'];
  $imageName = $_FILES['image']['name'];
  $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION)); // ex.  png
  // var_dump($_FILES['image']);
  // die();

  if (in_array($extension, $allowedExtensions) && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
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


    if (move_uploaded_file($imageTmp, $targetFile)) {
      echo " image moved sucsufuly";
  //     // $sql = "INSERT INTO products(name,mobile,image) VALUES (?,?,?) ";
  //     // $stmt = $conn->prepare($sql);
  //     // echo "no problem de upload limage";
  //     // if ($stmt->execute([$username, $mobile, $imageName])) {
  //     //   header("Location: index.php"); 
  //     //   exit;
  //     // } else {
  //     //   echo " not good .";
  //     //   print_r($stmt->errorInfo()); 
  //     // }

    } else {
      echo "probleme de upload l'image ";
    }
  }
}


