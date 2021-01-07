<?php
require '../../config/config.php';
require '../../models/db.php';
require '../../models/manufacture.php';
try {
    if(isset($_GET['manu_id'])){
        $id = $_GET['manu_id'];
        $sql = "DELETE FROM manufactures WHERE manu_id ='$id'";
        $db = new Db();
        $delete = $db->SIUD($sql);
        echo "Delete Succesfully";
        header('location:../manufactures.php');
    }
} catch (PDOException $th) {
    echo $sql . "<br>" . $th->getMessage();
}


?>