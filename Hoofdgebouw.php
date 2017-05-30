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
print_r($_SESSION['Village']);
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
$query = $db->prepare('select * from `building_in_progress` where Village_ID=?');
$query->bindPARAM(1,$_SESSION['Village'],PDO::PARAM_INT);
$query->execute();
$BuildingsP = $query->fetchall(PDO::FETCH_ASSOC);

$query = $db->prepare('select * from `building` where Village_ID=?');
$query->bindPARAM(1,$_SESSION['USR'],PDO::PARAM_INT);
$query->execute();
$BuildingsV = $query->fetchall(PDO::FETCH_ASSOC);

$query = $db->prepare('select * from `building_list`');
$query->execute();
$BuildingsL = $query->fetchall(PDO::FETCH_ASSOC);
$script = '';
	for($integer=0;count($BuildingsP)>$integer;$integer++){
		$query = $db->prepare('select * from `building_list` where Building_ID=?');
		$query->bindPARAM(1,$BuildingsP[$integer]['Building_ID'],PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetchall(PDO::FETCH_ASSOC);

		$script = $script.'
		var now'.$integer.' = new Date('.$BuildingsP[$integer]['End_Time'].'000);
		bool'.$integer.' = false;
		setInterval(time'.$integer.',1000);
		function time'.$integer.'() {
		  	var distance =now'.$integer.' - new Date().getTime();

		  	var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  	var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	  
		  	$("#Time_to_Finished'.$integer.'").html(minutes + "M " +seconds+"S");
	  
		  	if (seconds < 1 && minutes == 0) {
				bool'.$integer.' = true;
		  	}
		  	if(bool'.$integer.'){
			  	$("#Time_to_Finished'.$integer.'").html("Finished");
		  	}
		}
		time'.$integer.'();
';
		echo"
		<tr class='BIP'>
			<td>
				<img src='./Images/".$result[0]['Building_Name']."2.png' style='width:50px'></img>
			</td>
			<td>
				<p>".$BuildingsP[$integer]['Level']."</p>
			</td>
			<td>
				<p>".constant($result[0]['Building_Name'])."</p>
			</td>
			<td>
				<p id='Time_to_Finished".$integer."'></p>
			</td>
			<td>
				<input type='button' onclick='Cancle(".$BuildingsP[$integer]['ID'].")' value='".Cancle."' />
			</td>
		</tr>
			";
	}
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
				<img src='./Images/".$BuildingsV[$i]['Building_Name']."2.png' style='width:50px'></img>
			</td>
			<td>
			
				<p>".$BuildingsV[$i]['Level']."</p>
			</td>
			<td>
				<p>".constant($BuildingsV[$i]['Building_Name'])."</p>
			</td>
			<td>
				<p>".$BuildingsV[$i]['Time_to_Next']."Seconds</p>
			</td>
			<td>
				<input type='button'onclick='Level_Up(".$BuildingsV[$i]['Building_ID'].")' value='Level Up'/><br/>
				
		</tr>";
	}else{
	echo"
		<tr class='NBY'>
			<td>
				<img src='./Images/".$BuildingsL[$i]['Building_Name']."2.png' style='width:50px'></img>
			</td>
			<td>
				<p>Not Build Yet.</p>
			</td>
			<td>
				<p>".constant($BuildingsL[$i]['Building_Name'])."</p>
			</td>
			<td>
				<p>".$BuildingsL[$i]['Time_to_Next']."seconds</p>
			</td>
			<td><input onclick='Build(\"".$BuildingsL[$i]['Building_ID']."\")' type='button' value='Build'/><br/>
			</td>
		</tr>";
	}
}

?>
</table>
</div>
</div>
</body>
<script>

<?= $script?>
	function Cancle(data){
		$.post('Build_Cancle.php',{Building:data},function(){
			location.reload();
			}
		);
	}
	
	function Build(data){
$.post('Build.php',{Building:data},function(){location.reload();});
	}

function Level_Up($ID){
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