<?php
session_start();
include_once('general.config.php');
#
function customError($errno, $errstr) {
  echo '<b>Error:</b> ['.$errno.'] '.$errstr;
  die('');
}

set_error_handler("customError");

$pass = $_POST['Password'];
$name = $_POST['User_Name'];

if(!preg_match('/[^A-Za-z0-9]/',  $name) AND !preg_match('/[^A-Za-z0-9]/',  $pass)){
    if(strlen($pass)>4 AND strlen($name)>4){
        $query = $db->prepare('select count(*),User_ID from user where `User_Name` = ? AND `Password` = ?');
        $query->bindPARAM(1,$name,PDO::PARAM_STR);
        $query->bindPARAM(2,$pass,PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        $_SESSION['USR'] = $result[0]['User_ID'];
        header('Location: Main.php');
    }else{
        echo $pass.$name;
        print_r( $_REQUEST);
    }
}else{
    echo $pass.$name;
    print($_REQUEST);
}
?>