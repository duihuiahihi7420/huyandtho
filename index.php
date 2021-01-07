<!DOCTYPE html>
<html lang="en">
<?php
require "config/config.php";
require "models/db.php";
require "models/product.php";
require "models/protype.php";
require "models/manufacture.php";

$product = new Product;
$manu = new manufacture;
$pro = new protype;
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mobile Shopping</title>
    <link rel="icon" href="./images/logo.png" type="image/icon type">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
        .login {
            float: left;
            margin-right: 428px;
        }
        .login-logout {
            display: flex;
        }
    </style>
</head>
<!--/head-->

<body>
    <div class="header-bottom">
        <!--header-bottom-->
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                        </button>
                        <div class="logo"> <a href="index.php"><img src="images/home/logo.png" alt="" /></a> </div>
                    </div>
                    <div class="mainmenu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                        <div class="login">
                        <?php
                                    if(isset($_SESSION['user'])){
                                        
                                        ?>
                                        <a href="profile.php" title="User"><span class="account">
                                                <li><i class="fa fa-user"></i> <?php echo $_SESSION['user'] ?></a> -<a
                                            title="Đăng Xuất" href="logout.php" style="font-size:0.9em">Đăng Xuất</a></li>
                                        </span>

                                <?php
                                    }else{
                                        ?>
                                <span class="login-logout">
                                    <li><a title="Đăng nhập" href="dangnhap.php"><i class="fa fa-user"></i>Đăng nhập</a>
                                    </li>
                                    <li><a title="Đăng kí" href="dangky.php"><i class="fa fa-lock"></i> Đăng kí</a>
                                    </li>
                                </span>
                                <?php
                                    }
                                ?>
                        </div>
                            <li><a href="index.php" class="active">Home</a></li>
                            <li class="dropdown"><a href="index.php">Products<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <?php foreach ($pro->getAllProtype() as $value) { ?>
                                    <li><a href="cate.php?type_id=<?= $value['type_id']?>"><?= $value['type_name']?></a></li>
                                    <?php  }?>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="#">Blog List</a></li>
                                    <li><a href="#">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="cart.php?">Cart</a></li>
                           
                            
                        </ul>
                        <div class="search_box pull-right">
                            <form action="result.php?" method="get">
                                <input type="text" placeholder="Search" name="key" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
    </header>
    <!--/header-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>   
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            <?php foreach ($manu->getALlmanuFacture() as $value) {?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    
                                    <h4 class="panel-title"><a href="cate.php?manu_id=<?php echo $value['manu_id']?>"><?= $value['manu_name']?></a></h4>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        <?php foreach ($product->getFeatureProducts() as $value) {?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center"> 
                                        <div class="box-img">
                                        <img
                                            src="images/image/<?php echo $value['pro_image']?>" alt="" />
                                        </div>
                                        <h2><?php echo number_format($value['price'])." VND"?></h2>
                                        <p></p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to
                                            cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2><?php echo number_format($value['price'])." VND"?></h2>
                                            <p><a href="detail.php?id=<?php echo $value['id']?>"><?php echo $value['name']?></a></p>
                                            <a href="cart.php?45" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php } ?>
                    
                    <!--newest_items-->
                </div>  
           
    </section>
    <footer id="footer">
        <!--Footer-->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>

</html>