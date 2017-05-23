<?php
require_once('general.config.php');
switch($_POST['Action']){
    case 'Level_B': 
        require_once('Level_Building_Up.php');
        $levelup = new Level;
        $levelup->ID = $_SESSION['Village'];
        $levelup->db = $db;
        $levelup->BuildingID = $_POST['ID'];
        print_r($_REQUEST);
        print_r($_SESSION['Village']);
        return $levelup->Building_Up();
    break;
}