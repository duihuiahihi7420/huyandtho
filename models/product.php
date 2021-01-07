<?php

class Product extends Db{

    function execuPage() {
        $itemonpage = !empty($_GET['active'])?$_GET['active age']:3;
        $page = !empty($_GET['page'])?$_GET['page']:10;
        $offset= ($page-10)*$itemonpage;

        $numberPage = ceil(30/$itemonpage);
        
        $sql = self::$connection->prepare("SELECT * FROM products limit ".$itemonpage." offset ".$offset);
        
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function getAllProduct()
    {
        $itemonpage = !empty($_GET['active'])?$_GET['active age']:3;
        $page = !empty($_GET['page'])?$_GET['page']:1;
        $offset= ($page-1)*$itemonpage;
        
        $numberPage = ceil(30/$itemonpage);

        $sql = self::$connection->prepare("SELECT * FROM `products` ,`protypes`,`manufactures` WHERE `protypes`.`type_id`=`products`.`type_id` 
        and manufactures.manu_id=products.manu_id ORDER BY products.ID DESC
         limit ".$itemonpage." offset ".$offset);
        $sql->execute();//return an object
        $items = array();
        include "page.php";
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    //search
    public function SearchKeyword($keyword)
    {
        $sql=self::$connection->prepare("SELECT * FROM `products` WHERE products.name LIKE '%$keyword%' ");
        return $this->select($sql);
    }

    //Viet phuong thuc lay ra 3 san pham noi bat
    function getFeatureProducts(){
       
        $itemonpage = !empty($_GET['per_page'])?$_GET['per_page']:3;
        $page = !empty($_GET['page'])?$_GET['page']:1;
        $offset= ($page-1)*$itemonpage;

        $numberPage = ceil(30/$itemonpage);
        
        $sql = self::$connection->prepare("SELECT * FROM products limit ".$itemonpage." offset ".$offset);
        
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        include "link.php";
        return $items; //return an array
    }
    //lấy ra sản phẩm có id truyền vào
    public function getProductById($id){
        $sql = self::$connection->prepare("SELECT * FROM products , manufactures , protypes WHERE products.manu_id = manufactures.manu_id AND products.type_id = protypes.type_id and products.ID = ?");
        $sql->bind_param('i',$id);
        return $this->select($sql);
    }
    //Update 
    function UpdateProduct($id,$name_product,$price,$img,$desc,$manu_id,$type_id,$fe,$Created) {
        $sql = self::$connection->prepare("UPDATE `products` SET `name`='$name_product' ,`price`= $price,pro_image=$img,
        `description`='$desc',`manu_id`= $manu_id,
        `type_id`=$type_id,`feature`= $fe,`created_at`= '$Created' WHERE ID = $id");
        $sql->execute();
    }
    function getProductsByid($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products,manufactures where products.manu_id =  manufactures.manu_id and  ID = ? ");
        $sql->bind_param("i",$id);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    ///
    function getProductsByid_edit($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products , protypes , manufactures WHERE products.manu_id = manufactures.manu_id 
        AND protypes.type_id = products.type_id AND products.ID = ? ");
        $sql->bind_param("i",$id);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    //Viet phuong thuc lay ra 3 sp moi nhat
    function getNewestProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 3");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function getProductsByType_id($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products, protypes where products.type_id =  protypes.type_id and protypes.type_id = ? ");
        $sql->bind_param("i",$id);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function getProductsByManu_id($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products, manufactures where products.manu_id =  manufactures.manu_id and manufactures.manu_id = ? ");
        $sql->bind_param("i", $id);
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    function getProductsBySeach($s)
    {
        $s=$_GET['key'];
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE `Description` LIKE '%$s%' ");
        $sql->execute();//return an object
        $items = array(); 
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    //Hàm tìm kiếm danh sách : 
    function getProductBySeach_Admin($chuoi) {
        
    }

    //lấy ra số trang
    public function counPagetByNumProduct($num,$select){
        $sql = self::$connection->prepare("SELECT * FROM $select");
        $product = count($this->select($sql));
        $page = ceil($product/$num); 
        return $page;
    }
     function InsertProduct($vProductName,$vPrice,$vImage,$vDescription,$vMaunu_id,$vType_id,$vFeature){
    
        $sql = "INSERT INTO `products` (`ID`, `name`, `price`, `pro_image`, `description`, `manu_id`, `type_id`, `feature`, `created_at`)
        VALUES(NULL,'$vProductName','$vPrice','$vImage',
        '$vDescription','$vMaunu_id','$vType_id','$vFeature',CURRENT_TIMESTAMP)";	
         $vResult_Ins =  $this->SIUD($sql);


        if($vResult_Ins) {
			echo "Bạn đã thêm mới một sản phẩm thành công!";
			header("Location:../admin/index.php");
		}
         
    }
     function updateProductById($vID,$vProductName,$vPrice,$vImage,$vDescription,$vMaunu_id,$vType_id,$vFeature){
          
                $vSQL_Upd = "UPDATE products 
                    SET
                        name = '$vProductName',
                        price = '$vPrice',
                        description = '$vDescription',
                        pro_image = '$vImage',
                        manu_id = '$vMaunu_id',
                        type_id = '$vType_id',
                        feature = '$vFeature'
                    WHERE products.ID='$vID'
                ";			
                $vResult_Upd = $this->SIUD($vSQL_Upd);
                
                if($vResult_Upd) {
                    $vMsg = "Bạn đã chỉnh sửa thông tin sản phẩm thành công!";
                    header("Location:../index.php");
                }
    }
    function updateProductById2($vID,$vProductName,$vPrice,$vDescription,$vMaunu_id,$vType_id,$vFeature){
          
        $vSQL_Upd = "UPDATE products 
            SET
                name = '$vProductName',
                price = '$vPrice',
                description = '$vDescription',

                manu_id = '$vMaunu_id',
                type_id = '$vType_id',
                feature = '$vFeature'
            WHERE products.ID='$vID'
        ";			
        $vResult_Upd = $this->SIUD($vSQL_Upd);
        
        if($vResult_Upd) {
            $vMsg = "Bạn đã chỉnh sửa thông tin sản phẩm thành công!";
            header("Location:../index.php");
        }
}
}