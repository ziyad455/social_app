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