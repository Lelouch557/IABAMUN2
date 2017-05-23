<?php
class Level{
    public $db;
    public $ID;
    public $BuildingID;
    function Building_Up(){
        $query = $this->db->prepare('SELECT * FROM `storage` INNER JOIN `village` on `village`.Storage_ID=`storage`.Storage_ID WHERE `village`.Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        
        $query = $this->db->prepare('SELECT `Time_to_Next`,`Level` FROM `building` WHERE Village_ID=? AND Building_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->bindPARAM(2,$this->BuildingID,PDO::PARAM_INT);
        $query->execute();
        $BRes = $query->fetchall(PDO::FETCH_ASSOC);

        $cost = array(
            (($BRes[0]['Level'] * ($result[0]['Wood']/100))*3.045988942379389894971),
            (($BRes[0]['Level'] * ($result[0]['Stone']/100))*3.645988942379389894971),
            (($BRes[0]['Level'] * ($result[0]['Metals']/100))*1.745988942379389894971)
        );
        
        if($result[0]['Wood'] >=$cost[0] AND $result[0]['Stone']>=$cost[1] AND $result[0]['Metals']>=$cost[2]){
            $Remaining = array();
            $Remaining[0] = $result[0]['Wood'] - $cost[0];
            $Remaining[1] = $result[0]['Stone'] - $cost[1];
            $Remaining[2] = $result[0]['Wood'] - $cost[2];


            $Time = $BRes[0]['Time_to_Next'] + time();
            $Level = $BRes[0]['Level'] + 1;
            
            $query = $this->db->prepare('INSERT INTO `building_in_progress` (`Village_ID`,`Building_ID`,`End_Time`,`Level`) VALUES(?,?,?,?)');
            $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
            $query->bindPARAM(2,$this->BuildingID,PDO::PARAM_INT);
            $query->bindPARAM(3,$Time,PDO::PARAM_INT);
            $query->bindPARAM(4,$Level,PDO::PARAM_INT);
            $query->execute();

            $query = $this->db->prepare('UPDATE `storage` INNER JOIN `village` on `village`.Storage_ID=`storage`.Storage_ID SET `Wood`=?, `Stone`=?, `Metals`=? WHERE `village`.Village_ID=?');
            $query->bindPARAM(1,$Remaining[0],PDO::PARAM_INT);
            $query->bindPARAM(2,$Remaining[1],PDO::PARAM_INT);
            $query->bindPARAM(3,$Remaining[2],PDO::PARAM_INT);
            $query->bindPARAM(4,$this->ID,PDO::PARAM_INT);
            $query->execute();
            return 'Yes';
        }
        else{
            return 'No';
        }
    }
}


?>