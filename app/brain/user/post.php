<?php

// var_dump($_POST);
// die();

session_start();
require "../../database/conectdb.php";



function handleColor($color){
    global $image;
    if(empty($color)){ return null ;}
    if(!isset($image)){ return null ;}

    return $_POST['selected_color'];
}


function handleImage(&$error) {
    if (isset($_FILES['image'])  && $_FILES['image']['error'] !== 4) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $imageName = $_FILES['image']['name'];
        $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (in_array($extension, $allowedExtensions) && $_FILES['image']['error'] === 0) {
            $imageTmp = $_FILES['image']['tmp_name'];
            // ymken yt3awdo smyat gha n3tih lkola image shi uniq id
            $newImageName = uniqid('post_', true) . '.' . $extension;
            $targetDir = __DIR__ . "/../../../public/assist/posts/";
            $targetFile = $targetDir . $newImageName;

            if (!move_uploaded_file($imageTmp, $targetFile)) {
                $error[] = "Failed to move the uploaded image.";
                return null;
            } else {
                return $newImageName;
            }
        } else {
            $error[] = "Invalid extension or upload error.";
            return null;
        }
    }else { 
      return '';
    }
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  $error=[];
  $image = handleImage($error);
  $description = $_POST['description'] ?? '';
  $selectedColor = handleColor( $_POST['description'] ) ;
  if($image === '' && $description ===''){
    $error[] = 'One of image or description must be provided.';
  }
  if(count($error) > 0){
    var_dump($error);
  }else{
      if (empty($selectedColor)){
        $query = "INSERT INTO posts(user_id,image_path,description) VALUES (?,?,?)";
        $params=[$_SESSION['id'],$image,$description];
      }else{
        $query = "INSERT INTO posts(user_id,image_path,description,color) VALUES (?,?,?,?)";
        $params=[$_SESSION['id'],$image,$description,$selectedColor];
      }
      
      
      $stmt = $db->insert($query,$params);
      if($stmt){
      
            try {
              $friends = $db->selectALL('SELECT id FROM users WHERE id IN (SELECT CASE WHEN user1_id = ? THEN user2_id ELSE user1_id END FROM friends WHERE user1_id = ? OR user2_id = ?);', [$_SESSION['id'],$_SESSION['id'], $_SESSION['id']]);
              $db->insert('INSERT INTO notifications(user_id,category) values (?,?)', [$_SESSION['id'], 'post']);
              $id_notification = $db->lastInsertId();
              foreach($friends as $friend){
                $db->insert('INSERT INTO notification_recipients (notification_id, recipient_id) VALUES (?,?)', [$id_notification,$friend['id']]);
              }
            } catch (Exception $e) {
     
              error_log('Notification error: ' . $e->getMessage());
              die('An error occurred while processing notifications.');
            }
          header("Location: ../../../public/views/users/home.php");
          exit();
      }else{
        echo "<script>alert('Something went wrong while inserting into database.');</script>";
      }
  }


}




