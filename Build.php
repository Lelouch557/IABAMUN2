<?php
session_start();
require_once('general.config.php');
$User = $_SESSION['USR'];
$Building = $_POST['Building'];
$Village = $_SESSION['Village'];

include_once('Resources.php');

$query = $db->prepare('select * from building_list where Building_ID=?');
$query->bindPARAM(1,$Building,PDO::PARAM_INT);
$query->execute();
$result = $query->fetchall(PDO::FETCH_ASSOC);

$query = $db->prepare('select * from building inner join village on village.Village_ID = building.Village_ID inner join user on user.User_ID = village.Village_ID where village.Village_ID=? AND user.User_ID=?');
$query->bindPARAM(1,$Village,PDO::PARAM_INT);
$query->bindPARAM(2,$User,PDO::PARAM_STR);
$query->execute();
$VillageInfo = $query->fetchall(PDO::FETCH_ASSOC);

$query = $db->prepare('select storage.Storage_ID from storage inner join village on storage.Storage_ID = village.Storage_ID where Village_ID=?');
$query->bindPARAM(1,$Village,PDO::PARAM_INT);
$query->execute();
$Storage = $query->fetchall(PDO::FETCH_ASSOC);

$resource = new Resource;
$resource->db = $db;
$resource->ID = $_SESSION['Village'];
$Res = $resource->Update($Storage[0]['Storage_ID']);
$ResA = explode(',',$Res);

$Cost = array(
    'Wood' => ($result[0]['Wood'] * (1+((700 + ($VillageInfo[0]['Level'] *10)) * $VillageInfo[0]['Level']) / 1000)),
    'Metals' => ($result[0]['Metals'] * (1+((700 + ($VillageInfo[0]['Level'] *10)) * $VillageInfo[0]['Level']) / 1000)),
    'Stone' => ($result[0]['Stone'] * (1+((700 + ($VillageInfo[0]['Level'] *10)) * $VillageInfo[0]['Level']) / 1000))
    );
$TimeToNext = $result[0]['Time_to_Next']+((4 + $VillageInfo[0]['Level']) * $VillageInfo[0]['Level']);
$Hours = $TimeToNext / 60 / 24;
$Min = ($TimeToNext-$Hours)/60;
$Sec = $TimeToNext - $Hours - $Min;
$Time = time() + $TimeToNext;

if($ResA[3] >= $Cost['Wood'] AND $ResA[1] >= $Cost['Metals'] AND $ResA[2] >= $Cost['Stone']){
    $query = $db->prepare("insert into `building_in_progress` (Village_ID,End_Time,Building_ID) VALUES(?,?,?)");
    $query->bindPARAM(1,$Village,PDO::PARAM_INT);
    $query->bindPARAM(2,$Time,PDO::PARAM_STR);
    $query->bindPARAM(3,$Building,PDO::PARAM_INT);
    $query->execute();
}
?>