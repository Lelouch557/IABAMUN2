<?php
include('general.config.php');
$query = $db->prepare("select * from village where Village_ID=?");
$query->bindPARAM(1,$_SESSION['Village'],PDO::PARAM_INT);
$query->execute();
$village = $query->fetchall(PDO::FETCH_ASSOC);
$query = $db->prepare('select * from cells');
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
    <head>
	    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
	    <title><?PHP echo IABAMUN ;?></title>
	    <link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
	    <link  rel="stylesheet" type="text/css" href="./CSS/Map.css">
    </head>
    <body>
        <table><?php
            $k=0;
            for($i=0;$i<count($result);$i++){
                if(($i%20)==0){
                    echo'<tr>';
                }
                $k++;
                if(!$result[$i]['Village_ID']==0){
                    echo'<td><img src="./Images/village.jpg" class="MapCell"></img></td>';
                }else{
                    echo'<td><img src="./Images/'.$result[$i]['Terrain'].$result[$i]['Resource_ID'].'.png" class="MapCell"></img></td>';
                }
                if(($k%20)==0){
                    $k=0;
                    echo'</tr>';
                }
            }?>
        </table>
    </body>
</html>