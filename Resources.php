<?php

class Resource{
    public $db;

    function Update($data){
        $ID = $data;
        
        $query = $this->db->prepare('select * from storage where Storage_ID = ?');
        $query->bindPARAM(1,$ID,PDO::PARAM_INT);
        $query->execute();
        $Resource = $query->fetchall(PDO::FETCH_ASSOC);
        $resources = array(
            $Resource[0]['Wood'],
            $Resource[0]['Metals'],
            $Resource[0]['Food'],
            $Resource[0]['Stone']
        );
        $stamp = date('ymdH',time());
        if($Resource[0]['Timestamp'] <= $stamp){
            $diff = $stamp - $Resource[0]['Timestamp'];
            $query = $this->db->prepare('update storage SET Timestamp=? where Storage_ID = ?');
            $query->bindPARAM(1,$stamp,PDO::PARAM_INT);
            $query->bindPARAM(2,$ID,PDO::PARAM_INT);
            $query->execute();

            $query = $this->db->prepare('select * from `building`');
            $query->bindPARAM(1,$ID,PDO::PARAM_INT);
            $query->execute();
            $building = $query->fetchall(PDO::FETCH_ASSOC);

            for($int=0;4>$int;$int++){
                $resources[$int] = $resources[$int] + ($building[$int]['Spawn_Rate'] * $diff);
                $vari='update storage SET '.$building[$int]['Building_Name'].'='.$resources[$int].' WHERE Storage_ID = '.$ID;
                $query = $this->db->prepare($vari);
                //$query->bindPARAM(1,$building[$int]['Building_Name'],PDO::PARAM_STR);
                //$query->bindPARAM(2,$resources[$int],PDO::PARAM_INT);
                //$query->bindPARAM(3,$ID,PDO::PARAM_INT);
                $query->execute();
            }
        }else{
        }

        $query = $this->db->prepare('select * from storage where Storage_ID = ?');
        $query->bindPARAM(1,$ID,PDO::PARAM_INT);
        $query->execute();
        $storage = $query->fetchall(PDO::FETCH_ASSOC);
        
        return $storage[0]['Food'].' Food</br>'.$storage[0]['Metals'].' Metal</br>'.$storage[0]['Stone'].' Stone</br>'.$storage[0]['Wood'].' Wood';
    
    }
}
?>