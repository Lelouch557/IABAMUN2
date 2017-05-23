<?php
require_once('general.config.php');
switch($_POST['Action']){
    case 'Level_B': 
        require_once('Level_Building_Up.php');
        $levelup = new Level;
        $levelup->ID = $_SESSION['Village'];
        $levelup->db = $db;
        $levelup->BuildingID = $_POST['ID'];
        
        echo $levelup->Building_Up();
    break;
}