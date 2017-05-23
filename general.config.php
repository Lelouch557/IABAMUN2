<?php
session_start();
$user = 'Andre';
$pass = '3EpUhpQuLGDuYCHS';
$host = 'localhost';

$dbname = 'iabamun';
$host = 'localhost';

$db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function customError($errno, $errstr, $n, $t) {
  echo "<b>Error:</b> [$errno][$n][$t] $errstr<br/>";
}

set_error_handler("customError");

?>