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

include 'functions/count_time_ago.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   
    <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
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
                <?php
                $select_brand = $conn->prepare("SELECT * FROM `brand`"); 
                $select_brand->execute();
                if($select_brand->rowCount() > 0){
                    while($fetch_brand = $select_brand->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="'.$fetch_brand['title'].'">'.$fetch_brand['title'].'</option>';
                    }
                } ?>
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
                <?php
                $select_category = $conn->prepare("SELECT * FROM `category`"); 
                $select_category->execute();
                if($select_category->rowCount() > 0){
                    while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
                        if ($fetch_category['title'] != 'real estate') {
                            echo '<option value="'.$fetch_category['title'].'">'.$fetch_category['title'].'</option>';
                        }
                    }
                } ?>
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
     if ($lang == $lang && $lang != 'By category' && $lang != '' && $lang != 'Real Estate') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND category='$lang'"); 
     }
     else if ($lang == 'Real Estate') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE sid!='$user_id'"); 
     }
     else if ($brand == $brand && $brand != 'By brand' && $brand != '') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND brand='$brand'"); 
     }
     else if ($time == 'DESC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' ORDER BY `id` $time"); 
     }
     else if ($time == 'ASC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' ORDER BY `id` $time"); 
     }
     else if ($price == 'DESC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' ORDER BY `price` $price"); 
     }
     else if ($price == 'ASC') {
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' ORDER BY `price` $price"); 
     }
     else {
        //$select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id' AND category='$lang' AND brand='$brand'"); 
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE sid!='$user_id'"); 
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
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <?php if ($fetch_product['category'] != "Real Estate") { ?>
        <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <?php } else { ?>
        <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
      <?php } ?>
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="name">
          <?= $fetch_product['category']; ?>
          (<?= $fetch_product['brand']; ?>)
      </div>
      <div class="name" style="font-size: 16px; color: #198754;">
            <i class="bi bi-shop"></i> <?= '[' . $fetch_product['sid'] . '] ' . $fetch_product['created_by']; ?>
            <?php
            $by = $fetch_product['created_by'];
            $select_stores = $conn->prepare("SELECT * FROM `store` WHERE `title`='$by'"); 
            $select_stores->execute();
            if($select_stores->rowCount() > 0){
                while($fetch_store = $select_stores->fetch(PDO::FETCH_ASSOC)){ ?>
                    <?php
                        $status = $fetch_store['status'];
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
                    
                }
            }
            ?>
            <script>
                $(document).ready(function() {
                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                });
            </script>
      </div>
        <div class="name" style="font-size: 12px; direction: ltr;"><?php
            $created_at = $fetch_product['created_at'];
            echo time_elapsed_string($created_at, true);
        ?></div>
        <br><br>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <?php if ($lang != 'Real Estate') { ?>
      <br>
      <div class="flex" style="font-size: 16px;">
          <?php
            $i = $fetch_product['id'];
            $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE `pid`='$i'"); 
            $select_comments->execute();
            $count = $select_comments->rowCount();
            //if($select_comments->rowCount() > 0){
                //while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                    //echo $fetch_comment['pid'];
                    if ($count > 999) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> 1K comments';
                    }
                    else if ($count > 99) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> +99 comments';
                    }
                    else if ($count > 0 && $count > 1) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comments';
                    } else {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comment';
                    }
                //}
            //}
          ?>
          <br>
            <a id="like-button" name="like">
            <?php
                $pid = $fetch_product['id'];
                $like = 1;
                $dislike = 1;
                $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid='$pid' AND likes='1'");
                $select_likes->execute();
                $number_of_likes = $select_likes->rowCount();
                if ($number_of_likes > 0) {
                    echo $number_of_likes . ' <i class="bi bi-hand-thumbs-up-fill" name="like" style="color: #198754;"></i>';
                }
                else {
                    echo '0 <i class="bi bi-hand-thumbs-up-fill" name="like" style="color: #198754;"></i>';
                }
            ?>
            </a>
            <a id="dislike-button" name="dislike">
            <?php
                $pid = $fetch_product['id'];
                $like = 1;
                $dislike = 1;
                $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid='$pid' AND dislike='1'");
                $select_likes->execute();
                $number_of_likes = $select_likes->rowCount();
                if ($number_of_likes > 0) {
                    echo $number_of_likes . ' <i class="bi bi-hand-thumbs-down-fill" name="dislike" style="color: #DC3545;"></i>';
                }
                else {
                    echo '0 <i class="bi bi-hand-thumbs-down-fill" name="dislike" style="color: #DC3545;"></i>';
                }
            ?>
            </a>
      </div>
      <?php } ?>
      <?php if ($fetch_product['category'] != "Real Estate") { ?>
        <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
      <?php } else { ?>
        <?php
            $check_cart_numbers = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ?");
            $check_cart_numbers->execute([$fetch_product['id'], 1]);
            if($check_cart_numbers->rowCount() > 0) {
                echo '<a class="btn" id="reservation-btn" style="background: #ff5050;">تم سكن العقار <i class="bi bi-building-check"></i></a>';
            }else{
                $check_cart_number = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ? AND user_id = ?");
                $check_cart_number->execute([$fetch_product['id'], 0, $user_id]);
                if($check_cart_number->rowCount() > 0) {
                    echo '<a class="btn" id="reservation-btn" style="background: #198754;">تم إضافته <i class="bi bi-check-lg"></i></a>';
                }else{
                    echo '<input type="submit" value="حجز العقار" class="btn" name="add_to_reservation">';
                }
            }
        ?>
      <?php } ?>
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