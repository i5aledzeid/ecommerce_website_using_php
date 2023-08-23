<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

/*************************** SORT ***************************/
if (isset($_POST['submit'])) {
    $lang = $_POST['myvalue'];
    //echo "<script>alert('$lang');</script>";
}
else if ($_POST['submit'] == '') {
    //echo "<script>alert('$lang');</script>";
}
if (isset($_POST['submit'])) {
    $brand = $_POST['mybrand'];
    //echo "<script>alert('$brand');</script>";
}
else if ($_POST['submit'] == '') {
    //echo "<script>alert('$brand');</script>";
}
if (isset($_POST['submit'])) {
    $price = $_POST['myprice'];
    //echo "<script>alert('$price');</script>";
}
else if ($_POST['submit'] == '') {
    //echo "<script>alert('$price');</script>";
}
if (isset($_POST['submit'])) {
    $time = $_POST['mytime'];
    //echo "<script>alert('$time');</script>";
}
else if ($_POST['submit'] == '') {
    //echo "<script>alert('$time');</script>";
}
/*************************** SORT ***************************/

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>stores</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   
    <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include 'components/shop_header.php'; ?>

<section class="products">

   <h1 class="heading">latest products <a style="color: blue;">Sort</a>
        <!--*************************** SORT ***************************-->
        <style>
            select, option {
                font-size: 12px;
            }
            .form-select {
                padding: 8px;
                margin-bottom: -16px;
                border-radius: 16px;
            }
            @media only screen and (max-width: 600px) {
                select, option {
                    font-size: 12px;
                }
                select {
                    /* top left bottom right */
                    padding: 4px 0px 4px 0px;
                    margin-bottom: -16px;
                    border-radius: 16px;
                    color: black;
                }
            }
        </style>
        <form action="" method="POST">
            <select class="form-select" aria-label="Default select example" name="myprice" id="myprice">
                <?php
                    echo '<option value="By price">By price</option>';
                    if ($price == '') {
                        echo '<option selected>By price</option>';
                    }
                    else if ($price == 'By price') {
                        echo '<option selected>By price</option>';
                    }
                    else {
                        echo '<option selected>'.$price.'</option>';
                    }
                ?>
                <option value="ASC">Low</option>
                <option value="DESC">High</option>
            </select>
            <select class="form-select" aria-label="Default select example" name="mytime" id="mytime">
                <?php
                    echo '<option value="By time">By time</option>';
                    if ($time == '') {
                        echo '<option selected>By time</option>';
                    }
                    else if ($time == 'By time') {
                        echo '<option selected>By time</option>';
                    }
                    else {
                        echo '<option selected>'.$time.'</option>';
                    }
                ?>
                <option value="ASC">Old</option>
                <option value="DESC">New</option>
            </select>
            <select class="form-select" aria-label="Default select example" name="mybrand" id="mybrand">
                <?php
                    echo '<option value="By brand">By brand</option>';
                    if ($brand == '') {
                        echo '<option selected>By brand</option>';
                    }
                    else if ($brand == 'By brand') {
                        echo '<option selected>By brand</option>';
                    }
                    else {
                        echo '<option selected>'.$brand.'</option>';
                    }
                ?>
                <option value="apple">Apple</option>
                <option value="samsung">Samsung</option>
                <option value="lg">LG</option>
            </select>
            <select class="form-select" aria-label="Default select example" name="myvalue" id="myvalue">
                <?php
                    echo '<option value="By category">By category</option>';
                    if ($lang == '') {
                        echo '<option selected>By category</option>';
                    }
                    else if ($lang == 'By category') {
                        echo '<option selected>By category</option>';
                    }
                    else {
                        echo '<option selected>'.$lang.'</option>';
                    }
                ?>
                <option value="laptop">Laptop</option>
                <option value="television">Television</option>
                <option value="camera">Camera</option>
                <option value="mouse">Mouse</option>
                <option value="fridge">Fridge</option>
                <option value="washing">Washing Machine</option>
                <option value="smartphone">Smartphone</option>
                <option value="watch">Watch</option>
            </select>
            <button type="submit" name="submit" style="padding: 8px 16px 8px 16px; border-radius: 16px; background: #FE4445; color: white; cursor: pointer;">بحث متقدم</button>
        </form>
        <!--*************************** SORT ***************************-->
   </h1>
    
   <div class="box-container">

   <?php
     //$select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id'"); 
     /*if ($lang == 'all' || $lang == '' || $lang == 'By category') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id'"); 
     }
     if ($brand == 'all' || $brand == '' || $brand == 'By brand') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id'"); 
     }
     if ($price == 'all' || $price == '' || $price == 'By price') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id'"); 
     }*/
     /*else if ($price == 'DESC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND category='$lang' OR brand='$brand' ORDER BY `price` $price"); 
     }
     else if ($price == 'ASC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND category='$lang' OR brand='$brand' ORDER BY `price` $price"); 
     }*/
     if ($lang == $lang && $lang != 'By category' && $lang != '') {
        $select_products = $conn->prepare("SELECT * FROM `store` WHERE status='$lang'"); 
     }
     else if ($brand == $brand && $brand != 'By brand' && $brand != '') {
        $select_products = $conn->prepare("SELECT * FROM `store` WHERE create_at='$brand'"); 
     }
     else if ($time == 'DESC') {
        $select_products = $conn->prepare("SELECT * FROM `store` ORDER BY `id` $time"); 
     }
     else if ($time == 'ASC') {
        $select_products = $conn->prepare("SELECT * FROM `store` ORDER BY `id` $time"); 
     }
     else if ($price == 'DESC') {
        $select_products = $conn->prepare("SELECT * FROM `store` ORDER BY `price` $price"); 
     }
     else if ($price == 'ASC') {
        $select_products = $conn->prepare("SELECT * FROM `store` ORDER BY `price` $price"); 
     }
     else {
        //$select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND category='$lang' AND brand='$brand'"); 
        $select_products = $conn->prepare("SELECT * FROM `store`"); 
     }
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
      <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="store/store.php?user_id=<?= $fetch_product['id']; ?>&id=<?= $user_id; ?>" class="fas fa-eye"></a>
      <img src="images/<?= $fetch_product['image']; ?>" alt="">
      <div class="name"><?= $fetch_product['title']; ?>
       <?php
            $status = $fetch_product['status'];
            if ($status == 0) {
                echo '<i class="fa fa-info-circle" style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>';
            } else if ($status == 1) {
                echo '<i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>';
            } else if ($status == 2) {
                echo '<i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>';
            } else if ($status == 3) {
                echo '<i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>';
            } else if ($status == 4) {
                echo '<i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>';
            } else if ($status == 5) {
                echo '<i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>';
            } else if ($status == 6) {
                echo '<i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>';
            }
            ?>
            <script>
                $(document).ready(function() {
                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                });
            </script>
      </div>
      <div class="name"><?= $fetch_product['subtitle']; ?></div>
      <div class="flex">
         <div class="price"><span>[</span><?= $fetch_product['created_at']; ?><span>]</span></div>
      </div>
      <input type="submit" value="مشاهدة السوق" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>