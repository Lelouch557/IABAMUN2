<?php
class Resource{
    public $db;
    public $ID;
    function Update(){
         $query = $this->db->prepare('select * from storage where Storage_ID = ?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $Resource = $query->fetchall(PDO::FETCH_ASSOC);

        $resources = array(
            $Resource[0]['Wood'],
            $Resource[0]['Metals'],
            $Resource[0]['Food'],
            $Resource[0]['Stone']
        );

        $stamp = time();

        if($Resource[0]['Timestamp'] < $stamp){

            $diff = $stamp - $Resource[0]['Timestamp'];

            $query = $this->db->prepare('update storage SET Timestamp=? where Storage_ID = ?');
            $query->bindPARAM(1,$stamp,PDO::PARAM_INT);
            $query->bindPARAM(2,$this->ID,PDO::PARAM_INT);
            $query->execute();

            $query = $this->db->prepare('select * from `building` where Village_ID=?');
            $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
            $query->execute();

            $building = $query->fetchall(PDO::FETCH_ASSOC);
            for($int=0;4>$int;$int++){
                $resources[$int] = $resources[$int] + ($building[$int]['Spawn_Rate'] * $diff);
            }
            $query = $this->db->prepare('update storage SET Wood=?, Metals=?, Food=?, Stone=? WHERE Storage_ID=?');
            $query->bindPARAM(1,$resources[0],PDO::PARAM_INT);
            $query->bindPARAM(2,$resources[1],PDO::PARAM_INT);
            $query->bindPARAM(3,$resources[2],PDO::PARAM_INT);
            $query->bindPARAM(4,$resources[3],PDO::PARAM_INT);
            $query->bindPARAM(5,$this->ID,PDO::PARAM_INT);
            $query->execute();
        }else{
        }
        $query = $this->db->prepare('select * from storage where Storage_ID = ?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();

        $storage = $query->fetchall(PDO::FETCH_ASSOC);
        return $storage[0]['Food'].','.$storage[0]['Metals'].','.$storage[0]['Stone'].','.$storage[0]['Wood'].' Wood';
     }
     function Build(){
        $query = $this->db->prepare('select * from building_in_progress where Village_ID = ?');
        $query->bindPARAM(1,$this->ID,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        for($i=0;$i<count($result);$i++){
            if($result[$i]['End_Time']<time()){
                if($result[$i]['Level']>1){
                    $query = $this->db->prepare('UPDATE `building` SET `Level`=? WHERE building_ID=? AND Village_ID=?');
                    $query->bindPARAM(1,$result[$i]['Level'],PDO::PARAM_INT);
                    $query->bindPARAM(2,$result[$i]['Building_ID'],PDO::PARAM_INT);
                    $query->bindPARAM(3,$result[$i]['Village_ID'],PDO::PARAM_INT);
                    $query->execute();
                    
                    $query = $this->db->prepare("DELETE FROM `building_in_progress` WHERE `building_in_progress`.`ID` = ?");
                    $query->bindPARAM(1,$result[$i]['ID'],PDO::PARAM_INT);
                    $query->execute();
                }else{
                    $query = $this->db->prepare('select * from building_list where Building_ID=?');
                    $query->bindPARAM(1,$result[$i]['Building_ID'],PDO::PARAM_INT);
                    $query->execute();
                    $Building_Info = $query->fetchall(PDO::FETCH_ASSOC);

                    $level = 1;
                    $query = $this->db->prepare('insert into building (Building_Name, Spawn_Rate, HP, Armor, Level, Time_to_Next, Village_ID) VALUES(?,?,?,?,?,?,?)');
                    $query->bindPARAM(1,$Building_Info[0]['Building_Name'],PDO::PARAM_STR);
                    $query->bindPARAM(2,$Building_Info[0]['Spawn_Rate'],PDO::PARAM_INT);
                    $query->bindPARAM(3,$Building_Info[0]['HP'],PDO::PARAM_INT);
                    $query->bindPARAM(4,$Building_Info[0]['Armor'],PDO::PARAM_INT);
                    $query->bindPARAM(5,$level,PDO::PARAM_INT);
                    $query->bindPARAM(6,$Building_Info[0]['Time_to_Next'],PDO::PARAM_INT);
                    $query->bindPARAM(7,$this->ID,PDO::PARAM_INT);
                    $query->execute();

                    $query = $this->db->prepare("DELETE FROM `building_in_progress` WHERE `building_in_progress`.`ID` = ?");
                    $query->bindPARAM(1,$result[$i]['ID'],PDO::PARAM_INT);
                    $query->execute();
                }
            }
            else{return $result[$i]['End_Time'];}
        }
     }
}

?>