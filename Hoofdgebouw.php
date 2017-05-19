<?php
require_once('general.config.php');
if(isset($_GET['L'])){
  REQUIRE_ONCE('./Language/'.$_GET['L'].'/Global.php');
}else{
  REQUIRE_ONCE('./Language/ENG/Global.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?PHP echo IABAMUN ;?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
</head>
<body>
<div id='wrapper'>
<div id='top'>
</div>
<div id'Bottom'>
<div>
</div>
</div>
</body>