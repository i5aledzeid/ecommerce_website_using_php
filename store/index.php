<?php

include '../components/connect.php';

session_start();
$user_id = $_GET['user_id'];
$id = $_SESSION['user_id'];
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include '../components/wishlist_cart.php';

// those lines to check if you have store or not, 'you can own olny one store'. 
$check_stores = 0;
$select_users = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
$select_users->execute();
if($select_users->rowCount() == 0) {
    $check_stores = 0;
}
else {
    $check_stores = 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/home-style.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        @media (max-width:768px){
            .btn.add-product {
                /*background: red;
                color: blue;*/
            }
        }
        
        @media (max-width:450px){
            .btn.add-product {
                padding: 8px;
                margin: 8px;
                position: absolute;
                top: 32px;
                color: white;
                content: 'hhhh';
            }
            .btn.add-product:after {
                content: 'إضافة منتج';
            }
        }
    </style>

</head>
<body>
   
<?php include '../components/store_header.php'; ?>

<?php
    $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
    $select_products->execute();
    if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
?>

<div class="home-bg" style="background: url(../images/<?= $fetch_products['background']; ?>) no-repeat;">
    
    <?php } } ?>

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">
       
        <?php
            $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
        ?>

        <div class="swiper-slide slide" style="height: 200px;">
            <div class="image">
                <img src="../images/<?= $fetch_products['image']; ?>" alt="" style="height: 100px; ">
            </div>
            <div class="content">
                <span>
                    <?= $fetch_products['title']; ?>
                    <?php
                        $status = $fetch_products['status'];
                        if ($status == 0) { ?>
                            <i class="fa fa-info-circle" style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>
                        <?php } else if ($status == 1) { ?>
                            <i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>
                        <?php } else if ($status == 2) { ?>
                            <i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>
                        <?php } else if ($status == 3) { ?>
                            <i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>
                        <?php } else if ($status == 4) { ?>
                            <i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>
                        <?php } else if ($status == 5) { ?>
                            <i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>
                        <?php } else if ($status == 6) { ?>
                            <!--<svg style="color: #1D9BF0;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                            </svg>-->
                            <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                            <script>
                                $(document).ready(function() {
                                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                                });
                            </script>
                        <?php } ?>
                </span><br>
                <h3 style="font-size: 12px;"><?= $fetch_products['subtitle']; ?></h3>
                <h3 style="font-size: 8px;"><?= $fetch_products['created_at']; ?></h3>
                <a href="" class="btn">shop now</a>
                
            <?php
            $select_products6 = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id' AND status='6'");
            $select_products6->execute();
            $select_products5 = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id' AND status='5'");
            $select_products5->execute();
            $select_products3 = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id' AND status='3'");
            $select_products3->execute();
            if($select_products6->rowCount() > 0){
                //while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ ?>
                    <a href="products.php" class="btn add-product">+</a>
                <?php //}
            } if($select_products5->rowCount() > 0){ ?>
                <a href="products.php" class="btn add-product">+</a>
            <?php } if($select_products3->rowCount() > 0){ ?>
                <a href="products.php" class="btn add-product">+</a>
            <?php }
            ?>
            </div>
      </div>
      
      <?php } } else { ?>
      
      <div class="swiper-slide slide" style="height: 200px;">
            <div class="image">
                <img src="../images/avatar_male_man_portrait_icon.png" alt="profile-logo" style="height: 100px; ">
            </div>
            <div class="content">
                <span>
                    Store Name
                    <?php
                        $status = $fetch_products['status'];
                        if ($status == 0) { ?>
                            <i class="fa bi-asterisk style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="حالة المتجر" id="blah"></i>
                        <?php } else if ($status == 1) { ?>
                            <i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>
                        <?php } else if ($status == 2) { ?>
                            <i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>
                        <?php } else if ($status == 3) { ?>
                            <i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>
                        <?php } else if ($status == 4) { ?>
                            <i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>
                        <?php } else if ($status == 5) { ?>
                            <i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>
                        <?php } else if ($status == 6) { ?>
                            <!--<svg style="color: #1D9BF0;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                            </svg>-->
                            <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                            <script>
                                $(document).ready(function() {
                                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                                });
                            </script>
                        <?php } else { ?>
                            <i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>
                        <?php } ?>
                </span><br>
                <h3 style="font-size: 12px;"><?= $fetch_products['subtitle']; ?></h3>
                <h3 style="font-size: 8px;"><?= $fetch_products['created_at']; ?></h3>
                <a href="" class="btn">shop now</a>
            </div>
      </div>
      
      <?php } ?>

   </div>

      <div class="swiper-pagination" style="bottom: -4px;"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">shop by category</h1>

   <div class="swiper category-slider">

        <div class="swiper-wrapper">
           
           <?php
                $i = 1;
                $select_products = $conn->prepare("SELECT * FROM `category`");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <?php echo '<a href="../category.php?category='.$fetch_accounts['link'].'" class="swiper-slide slide">'; ?>
                            <?php echo '<img src="../images/icon-'.$i++.'.png" alt="">'; ?>
                            <h3><?= $fetch_accounts['title']; ?></h3>
                       </a>
            <?php } } ?>
            
        </div>

        <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

<style>
#alink:hover {
  background-color: yellow;
}
</style>
    <h1 class="heading">
    <?php
        $select_stores = $conn->prepare("SELECT * FROM `store_orders` WHERE sid='$user_id'"); 
        $select_stores->execute();
        if($select_stores->rowCount() > 0){
            $number_of_store = $select_stores->rowCount();
        }
        else {
            $number_of_store = 0;
        }

        $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                $name = $fetch_products['title'];
                echo '<a style="color: #FE4445;">' . $name . '</a>\'s store [<a style="color: #FE4445;">' . $number_of_store . '</a>] orders | <i style="color: blue;" class="bi bi-eye-fill"></i><a id="alink" style="color: blue;" href="placed_orders.php"> SEE MORE</a>';
            }
        }
   ?>
   </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `store_orders` WHERE sid='$user_id' LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
      <!--<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="../images/<?= $fetch_product['image']; ?>" alt="">-->
      <div class="name" style="font-weight: bold;"><?= $fetch_product['total_products']; ?></div>
      <div class="name"><?= '<i class="bi bi-bag-check-fill"></i> ' . $fetch_product['name']; ?> <a style="font-size: 12px;">(<?= $fetch_product['payment_status']; ?>)</a></div>
      <div class="name" style="font-size: 16px; color: #198754;">
            <i class="bi bi-shop"></i> <?= '[SID:' . $fetch_product['sid'] . '] ' . $fetch_product['store']; ?>
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
         <div class="price"><span>$</span><?= $fetch_product['total_price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_product['qty']; ?>">
      </div>
        <?php
            if ($user_id != $id) { ?>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
        <?php } else { ?>
                <input type="button" value="" class="btn" name="" style="background: white;">
        <?php } ?>
   </form>
   <?php
      }
   }else{
        echo '<p class="empty">no orders added yet!</p>&nbsp;';
        if ($check_stores == 0) {
            //echo '<p class="empty"><a href="create_store.php">!أنشئ متجر الآن</a></p>';
        }
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

    <h1 class="heading">
    <?php
        $select_stores = $conn->prepare("SELECT * FROM `products` WHERE sid='$user_id'"); 
        $select_stores->execute();
        if($select_stores->rowCount() > 0){
            $number_of_store = $select_stores->rowCount();
        }

        $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                $name = $fetch_products['title'];
                echo '<a style="color: #FE4445;">' . $name . '</a>\'s store products [' . $number_of_store . ']';
            }
        }
   ?>
   </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE created_by='$name' LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
      <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
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
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
        <?php
            if ($user_id != $id) { ?>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
        <?php } else { ?>
                <input type="button" value="" class="btn" name="" style="background: white;">
        <?php } ?>
   </form>
   <?php
      }
   }else{
        echo '<p class="empty">no products added yet!</p>&nbsp;';
        if ($check_stores == 0) {
            echo '<p class="empty"><a href="create_store.php">!أنشئ متجر الآن</a></p>';
        }
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<!--<section class="home-products">

   <h1 class="heading">new products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

       <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE brand='apple' LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="../uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name"><?= $fetch_product['name']; ?></div>
          <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
          <div class="flex">
             <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
             <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
          </div>
          <input type="submit" value="add to cart" class="btn" name="add_to_cart">
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>-->

   <!--<div class="swiper-pagination"></div>-->

   <!--</div>

</section>

<section class="home-products">

   <h1 class="heading">recommanded products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

       <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE brand='apple' LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="../uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name"><?= $fetch_product['name']; ?></div>
          <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
          <div class="flex">
             <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
             <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
          </div>
          <input type="submit" value="add to cart" class="btn" name="add_to_cart">
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>-->

   <!--<div class="swiper-pagination"></div>-->

   <!--</div>

</section>-->







<?php include '../components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
      // ADDED NEW 08-08-2023
      1400: {
         slidesPerView: 6,
      },
      // ADDED NEW 08-08-2023
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
      // ADDED NEW 08-08-2023
      1400: {
        slidesPerView: 4,
      },
      // ADDED NEW 08-08-2023
   },
});

</script>

</body>
</html>