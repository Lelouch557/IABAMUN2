<?php
class Train{
    public $db;
    public $ID;
    public $Units;
    function Build(){
        $query = $this->db->prepare('select * from recrutement WHERE Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetchALL(PDO::FETCH_ASSOC);
        for($i=0;$i<count($res);$i++){
            if(time()>$res[0]['End_Time']){
                
            }
        }
    }
    function Make(){
        
        $query = $this->db->prepare('SELECT * FROM `storage` INNER JOIN `village` on `village`.Storage_ID=`storage`.Storage_ID WHERE `village`.Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        
        //$query = $this->db->prepare('SELECT `Recrutement_Time` FROM `Unit` WHERE Village_ID=? AND Building_ID=?');
        $query = $this->db->prepare('SELECT `Recrutement_Time` FROM `Unit`');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $BRes = $query->fetchall(PDO::FETCH_ASSOC);
        for($i=0;$i<count($BRes);$i++){
            $cost = array(
                (($BRes[$i]['Level'] * -($result[$i]['Wood']/100))*3.045988942379389894971),
                (($BRes[$i]['Level'] * -($result[$i]['Stone']/100))*3.645988942379389894971),
                (($BRes[$i]['Level'] * -($result[$i]['Metals']/100))*1.745988942379389894971)
            );

            if($result[$i]['Wood'] >=$cost[0] AND $result[$i]['Stone']>=$cost[1] AND $result[$i]['Metals']>=$cost[2]){
                $Remaining = array();
                $Remaining[0] = $result[$i]['Wood'] - $cost[0];
                $Remaining[1] = $result[$i]['Stone'] - $cost[1];
                $Remaining[2] = $result[$i]['Wood'] - $cost[2];

                $Time = $BRes[0]['Time_to_Next'] + time();
                
                $query = $this->db->prepare('select * from recrutement where Village_ID=?');
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->execute();
                $res = $query->fetchall(PDO::FETCH_ASSOC);
                if(count($res)==0){
                    $Amount = $this->Units[$i] + $res[0]['Amount'];
                    $query = $this->db->prepare('UPDATE `recrutement` Amount=?, Unit_ID=?, Village_ID=?');
                    $query->bindPARAM(1,$Amount,PDO::PARAM_INT);
                    $query->bindPARAM(2,$i,PDO::PARAM_INT);
                    $query->bindPARAM(3,$Village_ID,PDO::PARAM_INT);
                    $query->execute();
                }else{
                    $query = $this->db->prepare('INSERT INTO `recrutement`SET(Amount,Unit_ID,Village_ID,End_Time) VALUES(?,?,?,?)');
                    $query->bindPARAM(1,$this->Units[$i],PDO::PARAM_INT);
                    $query->bindPARAM(2,$i,PDO::PARAM_INT);
                    $query->bindPARAM(3,$Village_ID,PDO::PARAM_INT);
                    $query->execute();
                }
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
}


?>