<?php
require_once('general.config.php');
require_once('./language/ENG/Global.php');
$query = $db->prepare('select * from army where Village_ID=?');
$query->bindPARAM(1,$_SESSION['Village'],PDO::PARAM_INT);
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	<title><?= IABAMUN ?></title>
	<link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
	<link  rel="stylesheet" type="text/css" href="./CSS/Attack.css">
</head>
<body>
    <div id='wrapper'>
    <div id='top'>
    </div>
    <div id='bottom'>
        <table><?php 
        $script = '';
        for($i=0;$i<count($result);$i++){
            echo"
            <tr>
                <td>   
                    <img src='./Images/".$result[$i]['Unit_Name'].".png' style='width:100px' ></img>
                </td>
                <td>   
                    <p>".constant($result[$i]['Unit_Name'])."'s</p>
                </td>
                <td>   
                    <input type='number' id='".$result[$i]['Unit_Name']."' />
                </td>
            </tr>";
            $script .= "
                ".$result[$i]['Unit_Name'].": ('0'+$('#".$result[$i]['Unit_Name']."').val())";
            if(!(count($result)-1) ==$i){
                $script .=',';
            }
        }?>
            <tr>
                <td>
                    <button onclick='Attack()'>click me</button>
                </td>
            </tr>
        </table>
    </div>
</body>
    <script>
        function Attack(){
            dest = "<?= $_GET['a'] ?>";
            Units = {<?= $script ?>};
            $.post('Functions.php',{Action:'Attack',Army:Units,Destination:dest,R_T_S:'1'},function(awnser){if(awnser='Yes'){location.assign('Main.php');}});
        }
    </script>
</html>