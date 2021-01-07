<?php 
class Protype extends Db{
    function getAllProtype(){
        $sql = self::$connection->prepare("SELECT * FROM protypes ");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    function getAllProtype_Page(){
        $itemonpage = !empty($_GET['active'])?$_GET['active age']:3;
        $page = !empty($_GET['page'])?$_GET['page']:1;
        $offset= ($page-1)*$itemonpage;

        $numberPage = ceil(7/$itemonpage);
        $sql = self::$connection->prepare("SELECT * FROM protypes limit ".$itemonpage." offset ".$offset);
        $sql->execute();//return an object
        $items = array();
        include "page.php";
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    //Thực hiện delete:
    function getProtype_search($s){
        $s=$_GET['key'];
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `Description` LIKE '%$s%' ");
        $sql->execute();//return an object
        $items = array(); 
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        $dem;
    }

    public function getProtypeById($type_id){
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_id='$type_id'");
        return $this->select($sql);
    }
    function getProtypeByName($type_name){
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_name ='$type_name'");
        return $this->select($sql);
    }
    public function getProtypeNameId($type_id){
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE type_id='$type_id'");
        $type = $this->select($sql);
        foreach ($type as $key => $value) {
            return $value['type_name'];
        }
    }
}
?>