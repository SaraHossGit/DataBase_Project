<?php

    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper - Bootstrap Shop Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/customStyle.css" rel="stylesheet">

    <?php
        include ('../functions.php');
        $product_cat = getData('categories');
        $product_shuffle = getData();
        $CusID = isset($_SESSION['CusID'])? $_SESSION['CusID']: 0;
    ?>

</head>

<body>

    
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="http://www.facebook.com/">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="http://www.twitter.com/">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="http://www.linkedin.com/">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="http://www.instagram.com/">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="http://www.youtube.com/">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="../index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">

                <form action="SearchPage.php" method="get">
                    <div class="input-group">
                        <input input type="text" name="search" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span>
                                <button class="btn btn-primary px-4" type="submit" style="height: 38px"><i class="fa fa-search"></i></button>
                                
                            </span>
                        </div>
                    </div>
               </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
            <a href="favouritesPage.php" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">
                        <?php
                            if ($CusID){
                                $favCount = getSubData('favourits', 'CusID', $CusID);
                                if ($favCount != null) {echo (count($favCount));}
                                else {echo '0';}
                            }
                            else {echo '0';}
                        ?>
                    </span>
                </a>
                <a href="cartPage.php" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">
                        <?php
                            if ($CusID){
                                $cartCount = getSubData('cart', 'CusID', $CusID);
                                if ($cartCount != null) {echo (count($cartCount));}
                                else {echo '0';}
                            }
                            else {echo '0';}
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical" style="height: 410px; overflow-y: scroll;">
                    <div class="navbar-nav w-100"  style="height: 450px">

                        <div class="navbar-nav w-100" >
                            <?php foreach ($product_cat as $item) { 
                                $subcat=getSubData('sub_categories', 'CatID', $item['CatID']);?>
                                <!-- html code -->
                                <div class="nav-item dropdown">
                                    <a href="shop.php" class="nav-link" data-toggle="dropdown"> <?php echo $item['CatName']?> 
                                        <?php if ($subcat!=null) { ?> 
                                            <i class="fa fa-angle-down float-right mt-1"></i> 
                                        <?php } ?> 
                                    </a>
                                    
                                    <?php if ($subcat!=null) { ?>
                                        <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0" style="height: 50px; overflow-y: scroll;">
                                            <?php foreach ($subcat as $item2) { ?>
                                                <!-- html code -->
                                                    <a href="shop.php" class="dropdown-item"> <?php echo $item2['SubCatName']?> </a>
                                            <?php } // closing foreach function ?>
                                        </div> 
                                    <?php } // closing if statement ?>

                                </div>
                            <?php } // closing foreach function ?>
                        </div>

                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="../index.php" class="nav-item nav-link">Home</a>
                            <a href="shop.html" class="nav-item nav-link">Shop</a>
                            <a href="Pages/returnProduct.php" class="nav-item nav-link">Return Product</a>
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div>  -->
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <?php 
                        if (isset($_SESSION['CusID'])) {
                            ?>
                            <div class="navbar-nav ml-auto py-0">
                                <a href="ForAdmin.php" class="nav-item nav-link"> <?php echo "Welcome, "  . $_SESSION['First_name']; ?></a>
                                <a href="login/logout.php" class="nav-item nav-link">logout</a>
                            </div>
                            <?php

                        }
                        else{
                            ?>
                            <div class="navbar-nav ml-auto py-0">
                                <a href="login/index.php" class="nav-item nav-link">Login</a>
                                <a href="login/register.php" class="nav-item nav-link">Register</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->