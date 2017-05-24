<?php
include('general.config.php');
for($i=1;$i<601;$i++){
    for($int=1;$int<601;$int++){
        $map = 1;
        $Terrain = 'Forrest';
        $Resource = 1;
    
        $Coordinates = $i.'-'.$int;
        $query = $db->prepare('INSERT INTO `cells` (`Coordinates`, `Terrain`, `Resource_ID`, `Map_ID`) VALUES(?,?,?,?)');
        $query->bindPARAM(1,$Coordinates,PDO::PARAM_STR);
        $query->bindPARAM(2,$Terrain,PDO::PARAM_INT);
        $query->bindPARAM(3,$Resource,PDO::PARAM_STR);
        $query->bindPARAM(4,$map,PDO::PARAM_INT);
    }
}






?>