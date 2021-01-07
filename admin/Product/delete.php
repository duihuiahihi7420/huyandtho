<?php
require '../../config/config.php';
require '../../models/db.php';
require '../../models/protype.php';
require '../../models/product.php';
require '../../models/manufacture.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE ID ='$id'";
    $db = new Db();
    $delete = $db->SIUD($sql);
    header('location:../index.php');
}
?>