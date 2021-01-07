<!DOCTYPE html>
<html lang="en">
<?php 


require "../../config/config.php";
require "../../models/db.php";
require "../../models/product.php";
require "../../models/protype.php";
require "../../models/manufacture.php";

if(isset($_GET['ID'])){
    $vID = $_GET['ID'];
    $products = new Product();
    $getProduct = $products->getProductById($vID);
    foreach($getProduct as $key_product=>$value_product){
        
        $vimg = $value_product['pro_image'];
        $vName = $value_product['name'];
        $vPrice = $value_product['price'];
       
        $vDesc = $value_product['description'];
        $vManu_id = $value_product['manu_id'];
        $vType_id = $value_product['type_id'];
        $vFeature = $value_product['feature'];

    }
   
}
else {
    header("Location:../index.php");
}
if(isset($_POST['edit'])){
    $vProductName1="";
    $vProductName1  = isset($_POST["name"]) ? $_POST["name"] : '';
    $vPrice1 	= isset($_POST["price"]) ? $_POST["price"] : '';
  
    $vMaunu_id1 = isset($_POST["manu"]) ? $_POST["manu"] : '';
    $vType_id1 = isset($_POST["type"]) ? $_POST["type"] : '';
    $vFeature1 = isset($_POST["feature"]) ? $_POST["feature"] : '';
   

    
    $vDescription1 	= isset($_POST["description"]) ? $_POST["description"] : '';

    
    //Kiem tra va nghien cuu them truong hop Upload khong thanh cong (vi du: khong cho luu tru)
    $vImage = "";
    if($_FILES["fileUpload"]["error"]==0 && $_FILES["fileUpload"]["size"]>0) {
        $path_tmp = $_FILES["fileUpload"]["tmp_name"];
        $path_luu = "../../images/image/" . $_FILES["fileUpload"]["name"];
        $resultUpload = move_uploaded_file($path_tmp, $path_luu);
        if ($resultUpload){
            $vImage = $_FILES["fileUpload"]["name"];
        }

    }
    if ($vImage) {
        $products = new Product();
         $products->updateProductById($vID,$vProductName1,$vPrice1,$vImage,$vDescription1,$vMaunu_id1,$vType_id1,$vFeature1);
    }else {
        $products = new Product();
        $products->updateProductById2($vID,$vProductName1,$vPrice1,$vDescription1,$vMaunu_id1,$vType_id1,$vFeature1);
    }
}



?>
<head>
    <title>Mobile Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../images/logo.png" type="image/icon type">
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/uniform.css" />
    <link rel="stylesheet" href="../css/select2.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style type="text/css">
        ul.pagination {
            list-style: none;
            float: right;
        }

        ul.pagination li.active {
            font-weight: bold;
        }

        ul.pagination li {
            /* float: left; */
            display: inline-block;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!--Header-part-->
    <div id="header">
        <h1><a href="http://localhost:8888/dienthoai/"><img src="../images/logo.png" alt=""></a></h1>
    </div>
    <!--close-Header-part-->
    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown"
                    data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i> <span
                        class="text">Welcome Super Admin</span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
            <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages"
                    class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span
                        class="label label-important">5</span> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
                    <li class="divider"></li>
                    <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
                    <li class="divider"></li>
                    <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
                    <li class="divider"></li>
                    <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
                </ul>
            </li>
            <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
            <li class=""><a title="" href="#"><i class="icon icon-share-alt"></i> <span
                        class="text">Logout</span></a></li>
        </ul>
    </div>
    <!--start-top-serch-->
    <div id="search">
        <input type="text" placeholder="Search here..." />
        <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
    </div>
    <!--close-top-serch-->
    <!--sidebar-menu-->
    <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
        <ul>
            <li><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <li> <a href="manufactures.php"><i class="icon icon-th-list"></i> <span>Manufactures</span></a></li>
            <li> <a href="protypes.php"><i class="icon icon-th-list"></i> <span>Product type</span></a></li>
            <li> <a href="users.php"><i class="icon icon-th-list"></i> <span>Users</span></a></li>

        </ul>
    </div><!-- BEGIN CONTENT -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                    Home</a></div>
            <h1>Add New Product</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5>Product info</h5>
                        </div>
                        <div class="widget-content nopadding">

                            <!-- BEGIN USER FORM -->
                            <form action="" method="post" class="form-horizontal"
                                enctype="multipart/form-data">

                                <div class="control-group">
                                    <label class="control-label">Name :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" placeholder="Product name" 
                                        name="name" value="<?php if(isset($vProductName1)) echo $vProductName1;else echo  $vName ?>" require /> *

                                        
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Choose a manufacture:</label>
                                    <div class="controls">
                                    <?php 
                                    $manufactures = new manufacture();
                                    $manu_name = $manufactures->getManuNameById($vManu_id);
                                     ?>
                                    <select name="manu" id="" class="form-control" required>
                                        <option value="<?php echo $vManu_id ?>"><?php echo $manu_name ?></option>
                                        <?php
                                            $manu = $manufactures->getALlmanuFacture();
                                            foreach ($manu as $key_manu => $value_manu) {
                                        ?>
                                        <option value="<?php echo $value_manu['manu_id'] ?>"><?php echo $value_manu['manu_name'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                       
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Choose a product type:</label>
                                    <div class="controls">
                                    <?php 
                                        $protype = new Protype;
                                        $type_name = $protype->getProtypeNameId($vType_id);
                                        ?>
                                        <select name="type" id="" class="form-control" required>
                                        <option value="<?php echo $vType_id ?>"><?php echo $type_name ?></option>
                                            <?php 
                                            $getAllType = $protype->getAllProtype();
                                            foreach ($getAllType as $key_cate => $value_type) {
                                            ?>
                                            <option value="<?php echo $value_type['type_id'] ?>"><?php echo $value_type['type_name'] ?></option>
                                            <?php 
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Choose an image :</label>
                                        <div class="controls">
                                            <input type="file" name="fileUpload" value="<?php echo isset($vimg) ? "../../images/image".$vimg : ''; ?>" id="fileUpload">
                                            <img width="100px" src="../../images/image/<?php echo $vimg ?>" alt="">
                                           
                                        </div>
                                    </div> 
                                    <div class="control-group">
                                        <label class="control-label">Description</label>
                                        <div class="controls">
                                            <textarea class="span11" placeholder="Description"
                                                name="description"><?php if(isset($vDescription1)) echo $vDescription1;else echo $vDesc   ?></textarea>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Price :</label>
                                            <div class="controls">
                                                <input type="text" class="span11" placeholder="price" name="price"  value="<?php if(isset($vPrice1)) echo $vPrice1;else echo  $vPrice ?>" require/> *
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Feature :</label>
                                            <div class="controls">
                                                <input type="number" class="span11" name="feature"  value="<?php if(isset($vFeature1)) echo $vFeature1;else echo  $vFeature ?>" min="0" max="1" require/> *
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" name = "edit" class="btn btn-success">Edit</button>
                                        </div>
                                    </div>
                            </form>
                            <!-- END USER FORM -->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
                                            
    </div>
    <?php ?>
    <!-- END CONTENT -->
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> 2017 &copy; TDC - Lập trình web 1</div>
    </div>
    <!--end-Footer-part-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.ui.custom.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.uniform.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/matrix.js"></script>
    <script src="js/matrix.tables.js"></script>
</body>

</html>