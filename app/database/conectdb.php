<?php

$config = require('config.php');
spl_autoload_register(function ($classname) {

  require('C:/xampp/htdocs/my-web/sociale_app/app/database/'.$classname . '.php');
});
$db = new Database($config['DB'], 'root', 'ziyad123');



?>
