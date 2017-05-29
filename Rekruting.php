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

require_once('Train.php');
$UnitsInProgress = new Train;
$UnitsInProgress->db = $db;
$UnitsInProgress->ID = $_SESSION['Village'];


$query = $db->prepare("select * from `unit`");
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);
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
    $script='';
    for($i=0;$i<count($result);$i++){
        $script = $script."
        ".$result[$i]['Unit_Name']." = $('#".$result[$i]['Unit_Name']."').val();
        if(!".$result[$i]['Unit_Name']."){
            ".$result[$i]['Unit_Name']." = 0;
        }
        MyArray.push(".$result[$i]['Unit_Name'].");
        ";
    ?>
        <tr>
            <td><img src="./Images/<?= $result[$i]['Unit_Name'] ?>.png" style="width:125px;"/></img>
            <td><p><?= constant($result[$i]['Unit_Name']) ?></p></td>
            <td><p><?= $result[$i]['Recrutement_Time'] ?> sec</p></td>
            <td><input type="number" id='<?= $result[$i]['Unit_Name'] ?>'></td>
        </tr><?php
    }?>
</table>
<input type='button' onclick='train()' value='Train' />
</body>
<script Language='javascript'>
    $('body').keypress(function (e) {
        if (e.which == 13) {
            train();
        }
    });

    function train(){
        MyArray = [];
        <?= $script?>
        $.post('Functions.php',{Action:'Make_T',units:MyArray},function(data){alert(data);});
    }
</script>