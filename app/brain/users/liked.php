<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require('../../../public/assist/others/functions.php');


header('Content-Type: application/json');
try {
    require('../../database/conectdb.php');
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  if (isset($data['postId']) && isset($_SESSION['id'])) {
    if($data['type'] === 'like') {
      $postid = (int)$data['postId'];
      $userid = (int)$_SESSION['id'];
      try {
          $db->insert("INSERT INTO likes (post_id, user_id) VALUES (?, ?)", [$postid, $userid]);
          $user_post = $db->selectOne("SELECT user_id FROM posts WHERE id = ?", [$postid]);
          if ($user_post && $user_post['user_id'] !== $userid) {
              $db->insert("INSERT INTO notifications (user_id, category) VALUES (?, ?)", [$user_post['user_id'], 'like']);
              $notificationId = $db->lastInsertId();
              $db->insert("INSERT INTO notification_recipients (notification_id, recipient_id) VALUES (?, ?)", [$notificationId, $userid]);
          }

          

          echo json_encode(['status' => 'success', 'message' => 'Post liked', 'liked_people' => liked_people($postid)]);
      } catch (Exception $e) {
          echo json_encode(['status' => 'error', 'message' => 'Failed to toggle like', 'error' => $e->getMessage()]);
      }
    }
    elseif($data['type'] === 'unlike') {
      $postid = (int)$data['postId'];
      $userid = (int)$_SESSION['id'];
      try {
          $db->delete("DELETE FROM likes WHERE post_id = ? AND user_id = ?", [$postid, $userid]);
          echo json_encode(['status' => 'success', 'message' => 'Post unliked', 'liked_people' => liked_people($postid)]);
      } catch (Exception $e) {
          echo json_encode(['status' => 'error', 'message' => 'Failed to toggle like', 'error' => $e->getMessage()]);
      }
    }
  } 
  else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid post ID or session']);
  }
}