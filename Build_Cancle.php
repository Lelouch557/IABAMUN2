<?php
require_once('general.config.php');
$Building = $_POST['Building'];
$query = $db->prepare('DELETE FROM `building_in_progress` WHERE `ID`=?');
$query->bindPARAM(1,$Building,PDO::PARAM_INT);
$query->execute();
?>