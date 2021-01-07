<?php
class manufacture extends Db{
    function getALlmanuFacture(){
        $sql = self::$connection->prepare("SELECT * FROM manufactures,protypes ");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}
?>