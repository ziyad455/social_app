<?php

$config = require('config.php');
spl_autoload_register(function ($classname) {
  require('C:/xampp/htdocs/my-web/social/app/database/'.$classname . '.php');
});
$db = new Database($config['DB'], 'root', 'hamzahamza1221');


?>
