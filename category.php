<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
      
   <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">

    <?php if ($category = $_GET['category'] != '') { ?>
   <h1 class="heading">category <span style="color: #FE4445;"><?php echo $category = $_GET['category']; ?></span></h1>
    <?php } else { ?>
       <h1 class="heading">category <span style="color: #FE4445;"><?php echo $category = $_GET['real_estates']; ?></span></h1>
    <?php } ?>

   <div class="box-container">

   <?php
   $real_estates = $_GET['real_estates'];
     $category = $_GET['category'];
     if ($category != '') {
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE category LIKE '%{$category}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
      <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
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
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>
   <?php }
   else if ($real_estates != '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category LIKE '%{$category}%'"); 
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
          <input type="hidden" name="map" value="<?= $fetch_product['map']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?realestate=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
          <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
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
          </div><br>
          <div class="flex">
                <div class="map">
                    <a href="<?php echo $fetch_product['map']; ?>" style="color: red;">
                        <i class="bi bi-geo-alt-fill"></i><?php echo $fetch_product['map']; ?>
                    </a>
                </div>
            </div><br>
          <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
        <?php
            /*$check_cart_numbers = $conn->prepare("SELECT * FROM `reservation` WHERE user_id = ? AND pid = ?");
            $check_cart_numbers->execute([$user_id, $fetch_product['id']]);
            
            $check_cart_status = $conn->prepare("SELECT * FROM `reservation` WHERE user_id = ? AND pid = ? AND status = ?");
            $check_cart_status->execute([$user_id, $fetch_product['id'], 1]);*/
            
            $check_cart_numbers = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND user_id = ?");
            $check_cart_numbers->execute([$fetch_product['id'], $user_id]);
            
            $check_cart_status = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ?");
            $check_cart_status->execute([$fetch_product['id'], 1]);

            if($check_cart_numbers->rowCount() > 0) {
                if($check_cart_status->rowCount() > 0) {
                    echo '<a class="btn" id="reservation-btn" style="background: #ff5050;">تم سكن العقار <i class="bi bi-building-check"></i></a>';
                }
                else {
                    echo '<a class="btn" id="reservation-btn" style="background: #198754;">تم إضافته <i class="bi bi-check-lg"></i></a>';
                }
            }else{
                echo '<input type="submit" value="حجز العقار" class="btn" name="add_to_reservation">';
            }
        ?>
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
   </form>
   
   <?php } 
        }
   }?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>