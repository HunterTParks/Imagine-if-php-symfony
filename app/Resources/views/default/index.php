<?php
  include("Config.php");
  include("Auth.php");

  $dbh = new PDO("mysql:host=localhost;dbname=phpauth", "username", "password");

  $config = new PHPAuth\Config($dbh);
  $auth   = new PHPAuth\Auth($dbh, $config);
  if(!$auth->isLogged()) {
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";

    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Testing Title</title>
  </head>
  <body>
    HEY THERE YOU GOT THERE
  </body>
</html>
