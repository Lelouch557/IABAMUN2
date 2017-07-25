<?php
include('general.config.php');
require_once('./Language/ENG/Global.php');
$query = $db->prepare("select * from village");
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
	    <title><?= IABAMUN ?></title>
	    <link  rel="stylesheet" type="text/css" href="./CSS/Global.css">
	    <link  rel="stylesheet" type="text/css" href="./CSS/Map.css">
    </head>
    <body>
        <table cellspacing="0"><?php
            $k=0;
            for($i=0;$i<count($result);$i++){
                if(($i%20)==0){
                    echo'<tr>';
                }
                $bool = false;
                $k++;
                for($l=0;$l<count($village);$l++){
                    if(!$bool){
                        if(($i+1)==$village[$l]['Cell_ID']){
                            $pic = '<td onclick="lol(\''.$result[$i]['Coordinates'].'\')" id="'.$result[$i]['Coordinates'].'"><img src="./Images/village.jpg" class="MapCell City"></img></td>';
                            $bool = true;
                        }else{
                            $pic = '<td id="'.$result[$i]['Coordinates'].'"><img src="./Images/'.$result[$i]['Terrain'].$result[$i]['Resource_ID'].'.png" class="MapCell"></img></td>';
                        }
                    }else{
                        $l=1000000;
                    }
                }
                    echo $pic;
                if(($k%20)==0){
                    $k=0;
                    echo'</tr>';
                }
            }?>
        </table>
    </body>
    <script>
        function lol(data){
            link = 'Attack.php?a='+data;
            location.assign(link);
            //$.post('Functions.php',{Action:'Build_Village',Village:data},function(){alert('Busy');});
        }
        $('.City').hover(function(){$('.City').css('cursor','pointer')});
    </script>
</html>