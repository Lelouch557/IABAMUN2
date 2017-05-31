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
    case 'Make_T':
        require_once('Train.php');
        $make = new Train;
        $make->ID = $_SESSION['Village'];
        $make->db = $db;
        $make->Units = $_POST['units'];
        echo $make->Make();
    break;
    case 'Attack':
        require_once('Train.php');
        $make = new Train;
        $make->ID = $_SESSION['Village'];
        $make->db = $db;
        $make->Units = $_POST['Army'];
        echo $_POST['Army'];
    break;
    case 'delete':
        require_once('Build.php');
        $levelup = new Level;
    break;
    default:
        echo'wrong';
    break;
}