<?php
class Train{
    public $db;
    public $ID;
    public $Units;
    public $Type;
    public $Target;
    public $Return_To_Sender;
    function Order(){
        $Bool = true;

        $query = $this->db->prepare('select Village_ID from village inner join cells on cells.Cell_ID = village.Cell_ID where cells.coordinates=?');
        $query->bindPARAM(1,$this->Target,PDO::PARAM_INT);
        $query->execute();
        $village = $query->fetchall(PDO::FETCH_ASSOC);

        $query = $this->db->prepare('select Unit_Name,Amount from army where Village_ID=?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetchALL(PDO::FETCH_ASSOC);
        
        
        for($i=0;$i<count($res);$i++){
            $left = $res[$i]['Amount'] - $this->Units[$res[$i]['Unit_Name']];
            if($left>=0){
                if(count($village)==0){
                    return '2';
                }
                if($Bool){
                    $query = $this->db->prepare('insert into ordered_units (Spear_Man)  VALUES(0)');
                    $query->execute();

                    $query = $this->db->prepare('select ID from ordered_units ORDER BY ID DESC LIMIT 1');
                    $query->execute();
                    $Order_ID = $query->fetchall(PDO::FETCH_ASSOC);
                }
                $sql = 'update ordered_units SET '.$res[$i]['Unit_Name'].'=? where ID=?';
                $query = $this->db->prepare($sql);
                $query->bindPARAM(1,$this->Units[$res[$i]['Unit_Name']],PDO::PARAM_INT);
                $query->bindPARAM(2,$Order_ID[0]['ID'],PDO::PARAM_INT);
                $query->execute();
                
                $query = $this->db->prepare("update army SET Amount=? where Village_ID=? AND Unit_Name=?");
                $query->bindPARAM(1,$left,PDO::PARAM_INT);
                $query->bindPARAM(2,$this->ID,PDO::PARAM_INT);
<<<<<<< HEAD
                $query->bindPARAM(3,$$res[$i]['Units_Name'],PDO::PARAM_INT);
                $query->execute();
                
                $query = $this->db->prepare("select Coordinates from village where Village_ID=?");
                $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
                $query->execute();
                $res = $query->fetchall(PDO::FETCH_ASSOC);

=======
                $query->bindPARAM(3,$res[$i]['Unit_Name'],PDO::PARAM_INT);
                $query->execute();
                $Bool = false;
>>>>>>> 31d903e7e268ec3fe94eb78a73bd1309e00645f3
            }else{
                return'1 '.$res[$i]['Unit_Name'].' : '.$res[$i]['Amount'].'-'.$this->Units[$res[$i]['Unit_Name']].'='.$left;
            }
            
        }

        $query = $this->db->prepare('insert into orders (Origin_Village_ID, Destination_Village_ID, Type, Return_On_Success, Units_ID) VALUES(?,?,?,?,?)');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->bindPARAM(2,$village[0]['Village_ID'],PDO::PARAM_INT);
        $query->bindPARAM(3,$this->Type,PDO::PARAM_INT);
        $query->bindPARAM(4,$this->Return_To_Sender,PDO::PARAM_INT);
        $query->bindPARAM(5,$Order_ID[0]['ID'],PDO::PARAM_INT);
        $query->execute();
        return'Yes';
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