<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

if(isset($_POST['update_comment'])){
    $cid = $_GET['cxid'];
    $delete = $_GET['delete'];
    $comment = $_POST['updated_comment_'];
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);
    
    if ($cid != '') {
        $update_wishlist = $conn->prepare("UPDATE `comments` SET `comment` = ? WHERE `comments`.`id` = ? AND created_by = ?");
        $update_wishlist->execute([$comment, $cid, $user_id]);
        $message[] = 'update to comment! where, cid['. $cid .']!';
    } else  {
        $delete_wishlist = $conn->prepare("DELETE FROM `comments` WHERE `comments`.`id` = ?");
        $delete_wishlist->execute([$delete]);
        $message[] = 'delete to comment! where, id['. $delete .']!';
    }
}

if(isset($_POST['update'])){
    $id = $_POST['idz'];
    $cid = $_GET['cxid'];
    echo '<script>alert("'.$cid.'");</script>';
}

if(isset($_POST['update_to_comment'])){
    $id = $_GET['cid'];
    //$idz = $_POST['idz'];
    //$idz = filter_var($idz, FILTER_SANITIZE_STRING);
    /*$comment = $_POST['updated_comment'];
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);
    
    $check_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ? AND created_by = ?");
    $check_comment->execute([$id, $user_id]);
    if($check_comment->rowCount() == 0){
        $message[] = 'you can\'t update this comment\'s belong to you!';
    }else{
        $update_wishlist = $conn->prepare("UPDATE `comments` SET `comment` = ? WHERE `comments`.`id` = ? AND created_by = ?");
        $update_wishlist->execute([$comment, $id, $user_id]);
        $message[] = 'update to comment!';
    }*/
    
    echo '<script>alert("'.$id.'");</script>';
}

if(isset($_POST['add_to_comment'])){

   /*if($user_id == ''){
      header('location:user_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $store = $_POST['store'];
      $store = filter_var($store, FILTER_SANITIZE_STRING);
      $sid = $_POST['sid'];
      $sid = filter_var($sid, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$name, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'already added to comment!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image, store, sid) VALUES(?,?,?,?,?,?,?)");
         $insert_wishlist->execute([$user_id, $pid, $name, $price, $image, $store, $sid]);
         $message[] = 'added to comment!';
      }

   }*/
   
    $comment = $_POST['comment'];
    $comment = filter_var($comment, FILTER_SANITIZE_STRING);
    $pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $insert_wishlist = $conn->prepare("INSERT INTO `comments`(pid, comment, created_by) VALUES(?,?,?)");
    $insert_wishlist->execute([$pid, $comment, $user_id]);
    $message[] = 'added to comment!';
   

}

if(isset($_POST['add_to_likes'])){
    $like = $_POST['like'];
    $like = filter_var($like, FILTER_SANITIZE_STRING);
    $dislike = $_POST['dislike'];
    $dislike = filter_var($dislike, FILTER_SANITIZE_STRING);
    $pid = $_GET['pid'];
    $d = 0;
    $l = 1;
    
    $check_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid = ? AND created_by = ?");
    $check_likes->execute([$pid, $user_id]);
    if($check_likes->rowCount() == 0){
        $insert_likez = $conn->prepare("INSERT INTO `likes` (`pid`, `likes`, `dislike`, `created_by`) VALUES(?,?,?,?)");
        $insert_likez->execute([$pid, $l, $d, $user_id]);
        header('location: quick_view.php?pid='.$pid.'');
    }
    else {
        $check_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid = ? AND created_by = ? AND likes != ? AND dislike != ?");
        $check_likes->execute([$pid, $user_id, $l, $l]);
        if($check_likes->rowCount() > 0){
            $update_like = $conn->prepare("UPDATE `likes` SET `likes` = ?, `dislike` = ? WHERE created_by = ?");
            $update_like->execute([$l, $d, $user_id]);
        }
        else {
            $update_like = $conn->prepare("UPDATE `likes` SET `likes` = ?, `dislike` = ? WHERE created_by = ?");
            $update_like->execute([$l, $d, $user_id]);
        }
    }
}

if(isset($_POST['add_to_dislikes'])){
    $like = $_POST['like'];
    $like = filter_var($like, FILTER_SANITIZE_STRING);
    $dislike = $_POST['dislike'];
    $dislike = filter_var($dislike, FILTER_SANITIZE_STRING);
    $pid = $_GET['pid'];
    $d = 0;
    $l = 1;
    
    $check_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid = ? AND created_by = ? AND dislike = ?");
    $check_likes->execute([$pid, $user_id, $d]);
    if($check_likes->rowCount() > 0){
        $update_like = $conn->prepare("UPDATE `likes` SET `likes` = ?, `dislike` = ? WHERE created_by = ?");
        $update_like->execute([$d, $l, $user_id]);
    }
    
    /*$pid = $_POST['pid'];
    $pid = filter_var($pid, FILTER_SANITIZE_STRING);
    $insert_like = $conn->prepare("INSERT INTO `likes`(pid, like, dislike, created_by) VALUES(?,?,?,?)");
    $insert_like->execute([$pid, $like, $dislike, $user_id]);
    $message[] = 'added to like!';*/
    //header("Location: home.php");
}

if(isset($_POST['delete_like'])) {
    $like = $_POST['like'];
    $like = filter_var($like, FILTER_SANITIZE_STRING);
    $dislike = $_POST['dislike'];
    $dislike = filter_var($dislike, FILTER_SANITIZE_STRING);
    $pid = $_GET['pid'];
    $d = 0;
    $l = 1;
    
    $check_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid = ? AND created_by = ? AND likes = ? OR likes = ? AND dislike = ? OR dislike = ?");
    $check_likes->execute([$pid, $user_id, $l, $d, $l, $d]);
    if($check_likes->rowCount() > 0){
        //$message[] = 'There is like!';
        $update_like = $conn->prepare("UPDATE `likes` SET `likes` = ?, `dislike` = ? WHERE created_by = ?");
        $update_like->execute([$d, $d, $user_id]);
        header('location: quick_view.php?pid='.$pid.'');
    }
    else {
        $message[] = 'There is not like!';
    }
    //$message[] = 'delete likes/dislikes now!';
}

include 'functions/count_time_ago.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   
   <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
    #edit-button {
        text-decoration: none;
        background-color: #000;
        color: #FF4546;
    }
    #edit-button:hover {
        text-decoration: none;
        background-color: #000;
        color: green;
        font-size: 18px;
        transition: font-size 0.4s;
    }
    #delete-button {
        text-decoration: none;
        background-color: #000;
        color: #FF4546;
    }
    #delete-button:hover {
        text-decoration: none;
        background-color: #000;
        color: blue;
        font-size: 18px;
        transition: font-size 0.4s;
    }
    #delete:hover {
        color: yellow;
    }
    #edit:hover {
        color: yellow;
    }
    #like-button, #dislike-button {
        font-size: 24px;
    }
    #like-button:hover, #dislike-button:hover,
    .bi-hand-thumbs-down-fill:hover,
    .bi-hand-thumbs-up-fill:hover {
        color: orange;
    }
</style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">quick view | نظرة سريعة</h1>

   <?php
     $pid = $_GET['pid'];
     $delete = $_GET['delete'];
     if ($pid != '') {
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
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
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
            <div class="name" style="font-size: 16px; color: #198754;">
            <i class="bi bi-shop"></i> <?= $fetch_product['created_by']; ?>
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
            <style>
                .details p {
                    /*white-space: nowrap;*/
                    height: 100px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    transition: height 1s;
                }
                .details.active p {
                    height: 250px;
                    white-space: normal;
                    overflow: visible;
                }
                .details .less {
                    display: none;
                }
                .details.active .less {
                    display: inline;
                }
                .details.active .more {
                    display: none;
                }
                /*.quick-view form .row .image-container .main-image img {
                    width: 100%;
                }*/
                .quick-view form .row .image-container .main-image img #main-image {
                    width: 100%;
                }
                @media only screen and (max-width: 600px) {
                    /*.quick-view form .row .image-container .main-image img {
                        width: 78%;
                    }*/
                    .quick-view form .row .image-container .main-image img #main-image {
                        width: 78%;
                    }
                }
            </style>
            <div class="name" style="font-size: 12px; direction: ltr;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>
            <div class="details">
                <p><?= $fetch_product['details']; ?></p>
                <a class="purple-head hover-black" onclick="changeIcon(this)" id="myBtn">
                    <i class="bi bi-chevron-bar-down more"></i>
                    <span class="more">إقرأ المزيد</span>
                    <i class="bi bi-chevron-bar-up less"></i>
                    <span class="less">إخفاء التفاصيل</span>
                </a>
            </div>
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
            <br>
            <div class="flex-btn">
            <?php if ($user_id != $fetch_product['sid']) { ?>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
            <?php } else { ?>
                <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
            <?php } ?>
               <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
            </div>
         </div>
      </div>
   </form>
   
   <!------------------------------ COMMENT SYSTEM ------------------------------>
   <?php include 'likes.php'; ?>
   <?php include 'comments.php'; ?>
   <!------------------------------ COMMENT SYSTEM ------------------------------>

   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
     }
    ///////////////////////////////////////////////////// ELSE /////////////////////////////////////////////////////
    else {
        //echo 'Hi else';
    }
    ///////////////////////////////////////////////////// ELSE /////////////////////////////////////////////////////
    $realestate = $_GET['realestate'];
    if ($realestate != '') {
   $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE id = ?"); 
     $select_products->execute([$realestate]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box" style="direction: rtl;">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
        <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
        <input type="hidden" name="map" value="<?= $fetch_product['map']; ?>">
          <div class="row">
             <div class="content">
                <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div><br>
                <div class="details"><?= $fetch_product['details']; ?></div>
                <div class="name" style="font-size: 12px; direction: ltr;"><?php
                    $created_at = $fetch_product['created_at'];
                    echo time_elapsed_string($created_at, true);
                ?></div>
                <br><br>
                <div class="details"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
                <div class="name" style="font-size: 16px; color: #198754;">
                <i class="bi bi-shop"></i> <?= '[' . $fetch_product['sid'] .'] '. $fetch_product['created_by']; ?>
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
            <div class="flex">
               <div class="price" style="direction: ltr;"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="flex">
                <div class="map">
                    <a href="<?php echo $fetch_product['map']; ?>" style="color: red;">
                        <i class="bi bi-geo-alt-fill"></i><?php echo $fetch_product['map']; ?>
                    </a>
                </div>
            </div>
            <div class="flex-btn">
            <?php if ($user_id != $fetch_product['sid']) { ?>
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
            <?php } else { ?>
                <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
            <?php } ?>
                <button class="option-btn" type="submit" name="add_to_wishlist">
                    أضف للمفضلة
                    <i class="bi bi-heart-fill"></i>
                </button>
               <!--<input class="option-btn" type="submit" name="add_to_wishlist" value="أضف للمفضلة">-->
            </div>
         </div>
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="" id="main-image">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_02']; ?>" alt="">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_03']; ?>" alt="">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_04']; ?>" alt="">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_05']; ?>" alt="">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_06']; ?>" alt="">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
    }
   ?>

</section>

<section class="quick-view">
    
    <div class="flex" onClick="showMap()">
        <i class="bi bi-map-fill"></i>
        Map view
    </div>
    
   <?php
     $pid = $_GET['pid'];
     $delete = $_GET['delete'];
     if ($pid != '') {
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
     $select_products->execute([$pid]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          echo 'There is no map.';
   ?>
   
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
     }
    ///////////////////////////////////////////////////// ELSE /////////////////////////////////////////////////////
    else {
        //echo 'Hi else';
    }
    ///////////////////////////////////////////////////// ELSE /////////////////////////////////////////////////////
    $realestate = $_GET['realestate'];
    if ($realestate != '') {
   $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE id = ?"); 
     $select_products->execute([$realestate]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
    <form action="" method="post" class="box map" style="direction: rtl;" id="map-view">
        <div class="row">
            <div class="flex">
                <?php
                $country = $fetch_product['country'];
                $city = $fetch_product['city'];
                $state = $fetch_product['state'];
                $select_country = $conn->prepare("SELECT * FROM `countries` WHERE `id`='$country'"); 
                $select_country->execute();
                if($select_country->rowCount() > 0){
                    $fetch_country = $select_country->fetch(PDO::FETCH_ASSOC);
                    $this_country = $fetch_country['name'];
                }
                $select_city = $conn->prepare("SELECT * FROM `cities` WHERE `id`='$city'"); 
                $select_city->execute();
                if($select_city->rowCount() > 0){
                    $fetch_city = $select_city->fetch(PDO::FETCH_ASSOC);
                    $this_city = $fetch_city['name'];
                }
                $select_state = $conn->prepare("SELECT * FROM `states` WHERE `id`='$state'"); 
                $select_state->execute();
                if($select_state->rowCount() > 0){
                    $fetch_state = $select_state->fetch(PDO::FETCH_ASSOC);
                    $this_state = $fetch_state['name'];
                }
                ?>
                <!--<div class="name"><?= 'دولة ' . $this_country; ?></div>
                <div class="name"><?= 'مدينة ' . $this_city; ?></div>
                <div class="name"><?= 'ولاية '. $this_state; ?></div>-->
            </div>
            <br>
            <div class="content">
                <!--<div class="flex">
                    <div class="name">الخريطة</div>
                    <div class="none">
                    <?php $address = $this_country . ', ' . $this_city . ', ' . $this_state; ?>
                    <iframe width="100%" height="250" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                </div>-->
                <?php $address = $this_country . ', ' . $this_city . ', ' . $this_state; ?>
                <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                </div>
            </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
    }
   ?>

</section>












<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

<script>
    function changeIcon(anchor) {
        anchor.closest('.details').classList.toggle('active');
    }
    
    function showMap() {
        
    }
</script>

</body>
</html>