<?php
session_start();

include_once('general.config.php');
if(isset($_GET['L'])){
  REQUIRE_ONCE('./Language/'.$_GET['L'].'/Global.php');
}else{
  REQUIRE_ONCE('./Language/ENG/Global.php');
}
include_once('Resources.php');
$query = $db->prepare('select * from village where User_ID=?');
$query->bindPARAM(1,$_SESSION['USR'],PDO::PARAM_STR);
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);
$_SESSION['Village'] = $result[0]['Village_ID'];
$resource = new Resource;
$resource->db = $db;
$awnser = $resource->Update($result[0]['Storage_ID']);

$query = $db->prepare('select * from storage where Storage_ID = ?');
$query->bindPARAM(1,$result[0]['Storage_ID'],PDO::PARAM_STR);
$query->execute();
$storage = $query->fetchall(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo IABAMUN ;?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
</head>
<body>
    <div id='Village'>
    </div>
    <a  id='Building1H' href='Hoofdgebouw.php'>
        <div id='Building1D'>      
        </div>
    </a>
    <div id='Building2'>
        <?= $awnser ?>
        <div id='Building3'>
        </div>
    </div>
    <div id='Building4'>
    </div>
    <div id='Building5'>
    </div>
    <div id='Building6'>
    </div>
    <div id='Building7'>
    </div>
    <div id='Building8'>
    </div>
    <div id='Building9'>
    </div>
</body>

<script>
var x = setInterval(function() {

  var now = new Date().getTime();

  var distance = 3600000 - new Date().getTime() % 3600000;
   
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  $("#Building3").html(minutes + "m " + seconds + "s ");

  if (seconds < 1 && minutes == 0) {
    setTimeout(function() {
      location.reload();
    }, 1500);
  }
}, 1000);
</script>