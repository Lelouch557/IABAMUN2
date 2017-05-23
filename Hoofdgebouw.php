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
	<link  rel="stylesheet" type="text/css" href="./CSS/Hoofdgebouw.css">
</head>
<body>
<div id='wrapper'>
<div id='top'>
</div>
<div id='bottom'>
<?php 
$query = $db->prepare('select * from `building` where Village_ID=?');
$query->bindPARAM(1,$_SESSION['USR'],PDO::PARAM_INT);
$query->execute();
$BuildingsV = $query->fetchall(PDO::FETCH_ASSOC);

$query = $db->prepare('select * from `building_list`');
$query->execute();
$BuildingsL = $query->fetchall(PDO::FETCH_ASSOC);

for($i=0;$i<count($BuildingsL);$i++){
	$bool = false;
	for($int=0;count($BuildingsL)>$int;$int++){
		if(!$bool){
			if($i >= count($BuildingsV)){
				$bool=false;
			}else{
				if($BuildingsV[$i]['Building_Name'] == $BuildingsL[$int]['Building_Name'] ){
					$bool=true;
				}
				else{
					$bool=false;
				}
			}
		}
	}
	if($bool){
		echo"
		<tr>
			<td>
				<img src='./Images/".$BuildingsL[$i]['Building_Name']."2.png' style='width:50px'></img>
			</td>
			<td>
				<input type='button'onclick='LevelUp(".$BuildingsV[$i]['Level'].", ".$BuildingsV[$i]['Building_ID'].")' value='Level Up'/><br/>
			</td>
		</tr>";
	}else{
		echo"
		<tr>
			<td>
				<img src='./Images/".$BuildingsL[$i]['Building_Name']."2.png' style='width:50px'></img>
			</td>
			<td>
				<input type='button' value='Build'/><br/>
			</td>
		</tr>";
	}
}

?>
</div>
</div>
</body>
<script>
function LevelUp($ID){
	$.post('Functions.php',{Action:"Level_B",ID:$ID},function(data){
		if(data=='Yes'){
			location.reload();
			}else{
				alert('<?= Validate1 ?>');
			}
		}
	);
}
</script>