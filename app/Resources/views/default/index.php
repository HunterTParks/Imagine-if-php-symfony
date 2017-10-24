<?php
  include("Config.php");
  include("Auth.php");

  $dbh = new PDO("mysql:host=localhost;dbname=phpauth", "username", "password");

  $config = new PHPAuth\Config($dbh);
  $auth   = new PHPAuth\Auth($dbh, $config);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Testing Title</title>
  </head>
  <body>
    HEY THERE YOU GOT THERE
  </body>
</html>
