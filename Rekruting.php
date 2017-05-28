<?php
require_once('general.config.php');
if(isset($_GET['L'])){
  REQUIRE_ONCE('./Language/'.$_GET['L'].'/Global.php');
}else{
  REQUIRE_ONCE('./Language/ENG/Global.php');
}
include_once('Resources.php');
$resource = new Resource;
$resource->db = $db;
$resource->ID = $_SESSION['Village'];
$Buil = $resource->Build();
$Res = $resource->Update();
$query = $db->prepare("select * from `unit`");
$query->execute();
$result = $query->fetachall(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo IABAMUN ;?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
	<link  rel="stylesheet" type="text/css" href="./CSS/Hoofdgebouw.css">
</head>
<body>
<div id='wrapper'>
<div id='top'>
</div>
<div id='bottom'>
<table>
    <?php
    for($i=0;$i<count($result);$i++){?>
        <tr>
            <td><p><?= constant($result[$i]['Unit_Name']) ?></p></td>
            <td><input type="number"></td>
        </tr>
        <tr>
            <td><p><?= bow ?></p></td>
            <td><input type="number"></td>
        </tr>
        <tr>
            <td><p><?= spear ?></p></td>
            <td><input type="number"></td>
        </tr>
        <tr>
            <td><p><?= lightCavalery ?></p></td>
            <td><input type="number"></td>
        </tr>
        <tr>
            <td><p><?= heavyCavalery ?></p></td>
            <td><input type="number"></td>
        </tr>
        <tr>
            <td><p><?= mountedCavalery ?></p></td>
            <td><input type="number"></td>
        </tr><?php
    }?>
</table>