<?php
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
$_SESSION['test'] = 'test';
$resource->db = $db;
$resource->ID = $result[0]['Village_ID'];
$Res = $resource->Build();
$Res = $resource->Update();

require_once('Train.php');
$UnitsInProgress = new Train;
$UnitsInProgress->db = $db;
$UnitsInProgress->ID = $_SESSION['Village'];
$res = $UnitsInProgress->Build();

$query = $db->prepare('select Amount,Unit_Name from army WHERE Village_ID=?');
$query->bindPARAM(1,$_SESSION['Village'],PDO::PARAM_INT);
$query->execute();
$army = $query->fetchALL(PDO::FETCH_BOTH);

$ResA = explode(',',$Res);
$awnser = $ResA[0].' Food<br/>'.$ResA[1].' Metal<br/>'.$ResA[2].' Stone<br/>'.$ResA[3].' Wood<br/>';

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
    <?php for($i=0;$i<count($army);$i++){
      echo $army[$i][0].' '.constant($army[$i][1]).'\'s<br/>';
    }?>
    <div id='Building6'>
    </div>
    </div>
    <a href="Rekruting.php" id="Building5L">
      <div id='Building5'>
      </div>
    </a>
    <a href="Map.php" id="Building7L" >
      <div id='Building7'>
      </div>
    </a>
    <div id='Building8'>
    </div>
    <div id='Building9'>
    </div>
</body>
<?php 
$query = $db->prepare('SELECT * FROM `recrutement` WHERE `Village_ID`=?');
$query->bindPARAM(1,$_SESSION['Village'],PDO::PARAM_INT);
$query->execute();
$RTime = $query->fetchall(PDO::FETCH_ASSOC);
?>
<script>
<?php
    if(count($RTime)>0){
        echo'setInterval(function(){
            var ATM = new Date().getTime(); //mS
            var Target = 0'.$RTime[0]['End_Time'].'000; //php: in SEconden
            var Time = Target-ATM; //ms
            var hours = Math.floor(Time /1000/60/60); //uren
            var min = Math.floor((Time-hours*1000*60*60) /1000/60);
            var sec = Math.floor((Time-(hours*1000*60*60)-min*1000*60) /1000);
            $("#Building6").html(hours + "h " + min + "m " + sec + "s ");
            if(Time<0){
              location.reload();
            }
        },1000);';
    }
?>
var x = setInterval(function() {
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