<?php
class manufacture extends Db{
    //Lấy ra danh sách 
    function getALlmanuFacture(){
        $sql = self::$connection->prepare("SELECT * FROM manufactures");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    //Lấy ra số trang:
    function getALlmanuFacture_Page(){
        $itemonpage = !empty($_GET['active'])?$_GET['active age']:3;
        $page = !empty($_GET['page'])?$_GET['page']:1;
        $offset= ($page-1)*$itemonpage;

        $numberPage = ceil(7/$itemonpage);
        $sql = self::$connection->prepare("SELECT * FROM manufactures limit ".$itemonpage." offset ".$offset);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        include "page.php";
        return $items; //return an array
    }
    //Lấy ra tên manu_name  
    public function getManuByName($manu_name){
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_name='$manu_name'");
        return $this->select($sql);
    }
    public function getManuById($manu_id){
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_id='$manu_id'");
        return $this->select($sql);
    }
    public function updateManufacture(){
        $sql = self::$connection->prepare("SELECT * FROM manufacture");
    }
    public function getManuNameById($id){
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_id='$id'");
        $manu = $this->select($sql);
        foreach ($manu as $key => $value) {
            return $value['manu_name'];
        }

    }
}
?>