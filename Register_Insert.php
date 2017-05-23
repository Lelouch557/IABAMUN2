<?php
session_start();
include_once('General.config.php');
$Pass1 = $_POST['Pass1'];
$Pass2 = $_POST['Pass2'];
$Name = $_POST['Name'];
if(!preg_match('/[A-Z]+[a-z]+[0-9]+/', $Pass1) AND !preg_match('/[A-Z]+[a-z]+[0-9]+/', $Pass2) AND !preg_match('/[A-Z]+[a-z]+[0-9]+/', $Name)){
    $query = $db->prepare('insert into `user` (
        `User_Name`,
        `Password`,
        `Mail`,
        `Phone_Number`,
        `Phone_Number2,
        ``
    )');
}else{
    echo'0';
}
?>