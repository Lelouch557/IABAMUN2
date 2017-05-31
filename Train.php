<?php
class Train{
    public $db;
    public $ID;
    public $Units;
    function Order(){
        $query = $this->db->prepare('select * from army where Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetchALL(PDO::FETCH_ASSOC);
        $Remaining = array();
        for($i=0;$i<count($res);$i++){
            $left = $res[$i]['Unit_Name'] - $this->Units[$res[$i]['Units_Name']];
            if(!$left<0){
                $Remaining[$res[$i]['Units_Name']] = $left;
                
                $query = $this->db->prepare("update army Amount=? where Village_ID=? AND Unit_Name=?");
                $query->bindPARAM(1,$left,PDO::PARAM_INT);
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->bindPARAM(1,$$res[$i]['Units_Name'],PDO::PARAM_INT);
                $query->execute();

            }else{
                return'1';
            }
            if(!$i<(count($res)-1)){
                $sqlU .= ',';
            }
        }
            
                $query = $this->db->prepare('select * from army where Village_ID=?');
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->execute();
    }
    function Build(){
        $query = $this->db->prepare('select * from recrutement WHERE Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetchALL(PDO::FETCH_ASSOC);
        for($i=0;$i<count($res);$i++){
            if(time()>$res[0]['End_Time']){
                $query = $this->db->prepare('select Amount from army WHERE Village_ID=? AND Unit_ID=?');
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->bindPARAM(2,$res[$i]['Unit_ID'],PDO::PARAM_INT);
                $query->execute();
                $result = $query->fetchALL(PDO::FETCH_ASSOC);

                $Amount = $result[0]['Amount'] + $res[0]['Amount'];
                $query = $this->db->prepare('update `army` SET Amount=? where Village_ID=? AND Unit_ID=?');
                $query->bindPARAM(1,$Amount,PDO::PARAM_INT);
                $query->bindPARAM(2,$this->ID,PDO::PARAM_INT);
                $query->bindPARAM(3,$res[$i]['Unit_ID'],PDO::PARAM_STR);
                $query->execute();
                $query = $this->db->prepare('DELETE FROM `recrutement` WHERE Recrutement_ID=?');
                $query->bindPARAM(1,$res[$i]['Recrutement_ID'],PDO::PARAM_INT);
                $query->execute();
            }
        }
        return 'Yes';
    }
    function Make(){
        $query = $this->db->prepare('SELECT * FROM `storage` INNER JOIN `village` on `village`.Storage_ID=`storage`.Storage_ID WHERE `village`.Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchALL(PDO::FETCH_ASSOC);
        
        $query = $this->db->prepare('SELECT `Recrutement_Time`,`Wood`,`Stone`,`Metals` FROM `Army` where village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $BRes = $query->fetchall(PDO::FETCH_ASSOC);
        for($i=0;$i<count($this->Units);$i++){
            $cost = array(
                ($BRes[$i]['Wood'] * $this->Units[$i]),
                ($BRes[$i]["Stone"] * $this->Units[$i]),
                ($BRes[$i]['Metals'] * $this->Units[$i])
            );
            if($result[$i]['Wood'] >=$cost[0] AND $result[$i]['Stone']>=$cost[1] AND $result[$i]['Metals']>=$cost[2]){
                $Remaining = array();
                $Remaining[0] = $result[$i]['Wood'] - $cost[0];
                $Remaining[1] = $result[$i]['Stone'] - $cost[1];
                $Remaining[2] = $result[$i]['Wood'] - $cost[2];
                $Time = ($BRes[0]['Recrutement_Time'] * $this->Units[$i]) + time();

                $query = $this->db->prepare('select * from recrutement where Village_ID=?');
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->execute();
                $res = $query->fetchall(PDO::FETCH_ASSOC);

                $tempID = $i+1;
                $query = $this->db->prepare('INSERT INTO `recrutement`   (`Amount`,`Unit_ID`,`Village_ID`,`End_Time`) VALUES(?,?,?,?)');
                $query->bindPARAM(1,$this->Units[$i],PDO::PARAM_INT);
                $query->bindPARAM(2,$tempID,PDO::PARAM_INT);
                $query->bindPARAM(3,$this->ID,PDO::PARAM_INT);
                $query->bindPARAM(4,$Time,PDO::PARAM_INT);
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
}
?>