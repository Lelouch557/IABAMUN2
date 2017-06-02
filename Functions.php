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
<<<<<<< HEAD
        $Train = new Train;
        $Train->ID = $_SESSION['Village'];
        $Train->db = $db;
        $Train->Units = $_POST['Army'];
        echo $Train->Order();
=======
        $make = new Train;
        $make->ID = $_SESSION['Village'];
        $make->db = $db;
        $make->Type = '1';
        $make->Target = $_POST['Destination'];
        $make->Return_To_Sender = $_POST['R_T_S'];
        $make->Units = $_POST['Army'];
        echo $make->Order();
<<<<<<< HEAD
>>>>>>> 31d903e7e268ec3fe94eb78a73bd1309e00645f3
=======
>>>>>>> 31d903e7e268ec3fe94eb78a73bd1309e00645f3
    break;
    case 'delete':
        require_once('Build.php');
        $levelup = new Level;
    break;
    default:
        echo'wrong';
    break;
}