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

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view">

   <h1 class="heading">quick view</h1>

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
            <div class="details"><?= $fetch_product['details']; ?></div>
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
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
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
         <div class="content">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <div class="flex">
               <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
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
            <div class="details"><?= $fetch_product['details']; ?></div>
            <div class="flex">
                <div class="map">
                    <a href="<?php echo $fetch_product['map']; ?>" style="color: red;">
                        <i class="bi bi-geo-alt-fill"></i><?php echo $fetch_product['map']; ?>
                    </a>
                </div>
            </div>
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

</body>
</html>