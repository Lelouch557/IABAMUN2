<?php
include_once('general.config.php');

if(!preg_match('/[^A-Za-z0-9]/',  $_POST['name']) AND !preg_match('/[^A-Za-z0-9]/',  $_POST['pass'])){
    $user_name = $_POST['name'];
    $password = $_POST['pass'];

    $query = $db->prepare('select count(*)from user where `User_Name` = ? AND `Password` = ?');
    $query->bindPARAM(1,$user_name,PDO::PARAM_STR);
    $query->bindPARAM(2,$password,PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchall(PDO::FETCH_ASSOC);
    if($result[0]['count(*)']>0){
        echo'0';
    }else{
        echo '1';
    }
}else{
    echo'2';
}
?>