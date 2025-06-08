<?php if(!function_exists ('isSelected')){
  function isSelected($page){
    $current_page = basename($_SERVER['PHP_SELF'], ".php");


    if ($current_page == $page) {
        return "text-blue-600";
    } else {
        return 'text-gray-600';
    }
  }
}

function createdAt($createdA) {
      $createdAt = new DateTime($createdA);
      $now = new DateTime();
      $interval = $createdAt->diff($now);

      if ($interval->y > 0) {
          $joined = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
      } elseif ($interval->m > 0) {
          $joined = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
      } elseif ($interval->d > 0) {
          $joined = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
      } elseif ($interval->h > 0) {
          $joined = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
      } elseif ($interval->i > 0) {
          $joined = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
      } else {
          $joined = "just now";
      }
      return $joined;
}

function isLiked($postId, $userId) {
    global $db;
    $query = "SELECT *   FROM likes WHERE post_id = ? AND user_id = ?";
    $result = $db->selectOne($query, [$postId, $userId]);
    if ($result) {
        return true; // Post is liked by the user
    } else {
        return false; // Post is not liked by the user
    }
}


function liked_people($postId) {
    global $db;
    $query = "SELECT COUNT(*) as count FROM likes WHERE post_id = ?";
    $result = $db->selectOne($query, [$postId]);

    $count = (int)$result['count'];

    if (isLiked($postId, $_SESSION['id'])) {
        if ($count === 1) {
            return "You like this post.";
        } else {
            return "You and " . ($count - 1) . " others like this post.";
        }
    } else {
        return $count === 0 
            ? "No one has liked this post yet."
            : $count . " people like this post.";
    }
}

