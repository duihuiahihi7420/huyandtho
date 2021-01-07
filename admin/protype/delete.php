<?php
require '../../config/config.php';
require '../../models/db.php';
require '../../models/protype.php';
if(isset($_GET['type_id'])){
    $id = $_GET['type_id'];
    $sql = "DELETE FROM protypes WHERE type_id ='$id'";
    $db = new Db();
    $delete = $db->SIUD($sql);

    header('location:../protypes.php');
}

?>