<?php
session_start();
require "../config/config.php";
require "../models/db.php";
require "../models/product.php";
require "../models/protype.php";
require "../models/manufacture.php";    

if(empty($_GET['keyword']) || $_GET['keyword']==null)
{
  header("location:index.php");
}   
if(isset($_SESSION['user'][0]['id']))
{
$IdUser=$_SESSION['user'][0]['id'];
$totalmoney=0;
$qty=0;
//tinh tong tien 
    if(isset($_SESSION['cart'][$IdUser]))
    {
        foreach($_SESSION['cart'][$IdUser] as $value)
        {
            $totalmoney+=($value['price']*$value['qty']);
            $qty+=$value['qty'];
        }

    }
}
if(empty($_GET['p']))
{
    $_GET['p']=1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exe6</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script src="public/js/jquery-3.3.1.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    <!--header-->
    <header>
        <!--cart-->
        <div class="container">
            <div class="cart">

                <?php if(isset($_SESSION['user'])) {?>
                <!--khi dang nhap la user-->
                <?php if($_SESSION['user'][0]['type_user']=='user') { ?>

                <h5>Xin chào:<?php echo $_SESSION['user'][0]['username'] ?></h5>
                <p><?php if(isset($_SESSION['cart'])) {?> <?php echo $totalmoney." VNĐ" ?> (<?php echo $qty; ?> items)<i class="fas fa-shopping-cart"></i></p> <?php } ?>
                <a href="cart.php"><p>Xem giỏ hàng</p></a>
                <a href="logout.php?p=user">Đăng xuất</a>   

                <!--khi dang nhap la admin-->
                <?php }else if($_SESSION['user'][0]['type_user']=='admin') {?>

                <h5>Xin chào:<?php echo $_SESSION['user'][0]['username'] ?></h5>
                <a href="mobileadmin/index.php"><p>Chỉnh sửa</p> </a>
                <a href="logout.php?p=user"><p>Đăng xuất</p></a>  

                <?php } ?>
                 <!--khi chua dang nhap-->
                <?php }else{ ?>

                <a href="login.php">Đăng nhập</a>

                <?php } ?>
            </div>
        </div>
        <!--end cart-->
        <!--navbar-->
        <div class="container">
            <nav class="navbar navbar-expand-sm navbar-light bg-pink">
                <div class="logo"><a href="index.php"><img class="img-fluid" src="public/images/logo_fnc.jpg" style="width: 200px; height: 100px;"></a></div>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a id="home" class="nav-link" href="index.php">HOME<span class="sr-only">(current)</span></a>
                        </li>
                        <?php
                        $getname=new products;
                        $showmenu=$getname->GetName();
                        foreach($showmenu as $key){
                        ?>
                        <li class="nav-item">
                            <a id="a1" class="nav-link" href="manu.php?p=<?php echo $key['manu_ID'] ?>"><?php echo $key['manu_name'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
			<div class="f1">
				
				<form action="search.php" method="get">
					<span class="icon"><i class="fas fa-search"></i></span>
					<input name="keyword" id="email" type="text" placeholder="Tìm sản phẩm" >
					<input id="join" type="submit" value="Tìm">
				</form>
			</div>
		</div>
        <!--end navbar-->
        <!--banner-->
       
        <!--end banner-->
    </header>
    <!--end header-->
    <!--content-->
    <div class="content">
        <h1>New Collections</h1>
        <div class="container">
            <!--line 1 -->
           
            <div class="row">
            <?php
            
            $product=new products;
            $name=$_GET['keyword'];
            $sosanphamtren1trang=4;
            if(isset($name))
            {
            $getallproduct=$product->SearchKeyword($name);
            }
            $totalpage=ceil(count($getallproduct)/$sosanphamtren1trang);

            $phantrangsearch=$product->PhanTrangSearch($name,$_GET['p'],$sosanphamtren1trang);
            foreach( $phantrangsearch as $value){
            ?>
                <div class="col-md-3">
                    <div class="item">
                        <div class="product"><img class="img-fluid" src="public/images/<?php echo $value['image'] ?>"  style="width: 350px; height: 250px;" ></div>
                        <p><strong><a href="detail.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></strong><span class="star"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i></span><br><span class="comment"><a  href="detail.php?id=<?php echo $value['id'] ?>" ><?php echo  "<br/>".substr($value['description'],0,50)?>[...]</a></span>
                        </p>
                        <div class="row cost">
                            <div class="col-md-4">
                                <p><strong><?php echo $value['price'] ?></strong></p>
                            </div>
                            <div class="col-md-8">
                                <a href="viewcard.php?id=<?php echo $value['id'] ?>">ADD TO CART</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php } ?>
                
            </div>
            </div>
            <br><br>
            <center>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-center">
                    <?php if($_GET['p']==1) {?>
                    <li class="page-item disabled">
                    <?php }  ?>
                    <a class="page-link" href="search.php?keyword=<?php echo $name ?>&p=<?php echo $x=$_GET['p']-1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <?php for($i=1;$i<=$totalpage;$i++){?>
                    <li <?php if($_GET['p']==$i){ ?> class="page-item active" <?php } ?>><a class="page-link" href="search.php?keyword=<?php echo $name ?>&p=<?php echo $i ?>"><?php echo $i ?></a></li>
                     <?php } ?>
                     <?php if($_GET['p']==$totalpage) {?>
                        <?php if($_GET['p']==$totalpage) {?>
               <li class="page-item disabled">
                <?php }
                }  ?>
                 <a class="page-link" href="search.php?keyword=<?php echo $name ?>&p=<?php echo $x=$_GET['p']+1 ?>" aria-label="Next">
                   <span aria-hidden="true">&raquo;</span>
                   <span class="sr-only">Next</span>
                 </a>
                    </li>
                  </ul>
                </nav>
            </center>
    </div>
        
    <!--end content-->
    <footer>
		
    <div class="f2">
        <p>&copy; 2016 FIT TDC</p>
    </div>
	</footer>
</body>
</html>