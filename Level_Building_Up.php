<?php
class Level{
    public $db;
    public $ID;
    public $BuildingID;
    function Building_Up(){
        $query = $this->db->prepare('SELECT * FROM `storage` WHERE `Village_ID`=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        
        $query = $this->db->prepare('SELECT `Time_To_Next`,`Level` FROM `building` WHERE Village_ID=? AND Building_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->bindPARAM(2,$this->BuildingID,PDO::PARAM_INT);
        $query->execute();
        $BRes = $query->fetchall(PDO::FETCH_ASSOC);
print_r($this->ID);
print_r($this->BuildingID);
        $cost = array(
            (($BRes[0]['Level'] * ($result[0]['Wood']/100))*3.045988942379389894971),
            (($BRes[0]['Level'] * ($result[0]['Stone']/100))*3.645988942379389894971),
            (($BRes[0]['Level'] * ($result[0]['Metals']/100))*1.745988942379389894971)
        );
        if($result['Wood'] >=$cost[0] AND $result['Stone']>=$cost[1] AND $result['Metals']>=$cost[2]){
            $Remaining = array();
            $Remaining[0] = $result[0]['Wood'] - $cost[0];
            $Remaining[1] = $result[0]['Stone'] - $cost[1];
            $Remaining[2] = $result[0]['Wood'] - $cost[2];


            $Time = $BRes[0]['End_Time'] + time();
            $Level = $BRes[0]['Level'];

            $query = $this->db->prepare('INSERT INTO `building_in_progress` (`Village_ID`,`Building_ID`,`End_Time`,`Level`) VALUES(?,?,?,?)');
            $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
            $query->bindPARAM(2,$this->Building_ID,PDO::PARAM_INT);
            $query->bindPARAM(3,$Time,PDO::PARAM_INT);
            $query->bindPARAM(4,$BRes[0]['Level'],PDO::PARAM_INT);

            $query = $this->db->prepare('UPDATE `storage` SET `Wood`=?, `Stone`=?, `Metals`=? where Village_ID=?');
            $query->bindPARAM(1,$Remaining[0],PDO::PARAM_INT);
            $query->bindPARAM(2,$Remaining[1],PDO::PARAM_INT);
            $query->bindPARAM(3,$Remaining[2],PDO::PARAM_INT);
            $query->bindPARAM(4,$this->ID,PDO::PARAM_INT);
            return 'Yes';
        }
        else{
            return 'No';
        }
    }
}


?>