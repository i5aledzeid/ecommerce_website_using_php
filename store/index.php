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
   <link rel="stylesheet" href="../css/progress.css">
   
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
        
        #see-more {
            content: 'hhhh';
        }
        
        #see-more:hover::after {
            content: ' See more';
            color: red;
        }
        
        
        .empty-reservation {
            padding:1.5rem;
            width: 100%;
            background-color: var(--white);
            border: var(--border);
            box-shadow: var(--box-shadow);
            text-align: center;
            color:var(--red);
            border-radius: .5rem;
            font-size: 2rem;
            text-transform: capitalize;
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
            $store_status = $fetch_products['status'];
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
                            <i class="bi bi-patch-check-fill" style="color: #ffffff; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                            <script>
                                $(document).ready(function() {
                                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                                });
                            </script>
                        <?php } else if ($status == 7) { ?>
                            <i class="bi bi-buildings-fill" style="color: #702CF6;" rel="tooltip" title="سوق عقارات" id="blah"></i>
                        <?php } ?>
                </span><br>
                <h3 style="font-size: 12px;"><?= $fetch_products['subtitle']; ?></h3>
                <h3 style="font-size: 8px;"><?= $fetch_products['created_at']; ?></h3>
                <a href="" class="btn">shop now</a>
                
            <?php
            $select_products7 = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id' AND status='7'");
            $select_products7->execute();
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
                <a href="product.php" class="btn add-product">+</a>
            <?php } if($select_products3->rowCount() > 0){ ?>
                <a href="product.php" class="btn add-product">+</a>
            <?php } if($select_products7->rowCount() > 0){ ?>
                <a href="real_estate.php" class="btn add-product"><i class="bi bi-buildings-fill"></i>+</a>
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
                        <?php } else if ($status == 7) { ?>
                            <i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>
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

   <h1 class="heading">خدمتنا</h1>

   <div class="swiper category-slider">

        <div class="swiper-wrapper">
           
           <?php
                $i = 1;
                $select_products = $conn->prepare("SELECT * FROM `category`");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $cat = $fetch_accounts['title'];
                        if ($cat != 'Real Estate') {?>
                            <?php echo '<a href="../../category.php?category='.$fetch_accounts['link'].'" class="swiper-slide slide">'; ?>
                        <?php } else { ?>
                            <?php echo '<a href="../../category.php?real_estates='.$fetch_accounts['link'].'" class="swiper-slide slide">'; ?>
                        <?php } ?>
                        <?php echo '<img src="../images/icon-'.$i++.'.png" alt="">'; ?>
                        <h3><?= $fetch_accounts['title']; ?></h3>
                    </a>
            <?php } } ?>
            
        </div>

        <div class="swiper-pagination"></div>

   </div>

</section>

<?php if ($store_status != 7) { ?>

<section class="home-products">

<style>
#alink:hover {
  background-color: yellow;
}
</style>
    <h1 class="heading">
    <?php
        $select_stores = $conn->prepare("SELECT * FROM `order_store` WHERE sid='$user_id'"); 
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
     $select_products = $conn->prepare("SELECT * FROM `order_store` WHERE sid='$user_id' LIMIT 6"); 
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
      <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>-->
      <img src="../uploaded_img/<?= $fetch_product['image']; ?>" alt="">
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
                        } else if ($status == 7) {
                            echo '<i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>';
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
                echo '<a style="color: #FE4445;">' . $name . '</a>\'s store products [' . $number_of_store . '] | <a id="see-more" href="products.php"><i class="bi bi-eye-fill"></i></a>';
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
                        } else if ($status == 7) {
                            echo '<i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>';
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

<?php } else { ?>

<section class="home-products">

<style>
#alink:hover {
  background-color: yellow;
}

#status {
    color: white;
    padding: 8px;
    background: red;
    position: absolute;
    font-size: 12px;
    top: 8px;
    right: 8px;
    width: 72px;
    transition: width 1s;
}

#status:hover {
    width: 82px;
}
</style>
    <h1 class="heading">
    <?php
        $select_stores = $conn->prepare("SELECT * FROM `reservation` WHERE sid='$user_id'"); 
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
                echo '<a style="color: #FE4445;">' . $name . '</a>\'s REAL ESTATE [<a style="color: #FE4445;">' . $number_of_store . '</a>] orders | <i style="color: blue;" class="bi bi-eye-fill"></i><a id="alink" style="color: blue;" href="realestates.php"> SEE MORE</a>';
            }
        }
   ?>
   </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `reservation` WHERE sid='$user_id' LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
        <?php if ($fetch_product['status'] == 0) {
            echo '<a id="status" href="#" style="background: #6C757D;">' . 'محجوز فقط' . '</a>';
        } else if ($fetch_product['status'] == 1) {
            echo '<a id="status" href="#" style="background: #198754;">' . 'تم السكن' . '</a>';
        } else if ($fetch_product['status'] == 2) {
            echo '<a id="status" href="#" style="background: #DC3545;">' . 'باقي سبعة أيام' . '</a>';
        } ?>
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
      <!--<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="../quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>-->
      <img src="../uploaded_img/real_estate/<?= $fetch_product['image']; ?>" alt="real estates logo">
      <div class="name" style="font-weight: bold;"><?= $fetch_product['total_products']; ?></div>
      <div class="name">
        <?= '<i class="bi bi-building-fill"></i> ' . $fetch_product['name']; ?>
      </div>
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
                        } else if ($status == 7) {
                            echo '<i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>';
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
      <div class="name">
            <i class="bi bi-person-fill"></i> <?= '[UID:' . $fetch_product['user_id'] . '] '; ?>
            <?php
            $id = $fetch_product['user_id'];
            $select_stores = $conn->prepare("SELECT * FROM `users` WHERE `id`='$id'"); 
            $select_stores->execute();
            if($select_stores->rowCount() > 0){
                while($fetch_store = $select_stores->fetch(PDO::FETCH_ASSOC)){
                    echo $fetch_store['name'] . '<br><i class="bi bi-telephone-fill" style="color: #7633FA;"></i>';
                    echo '<a href="tel:'.$fetch_store['phone'].'" style="color: #7633FA;">' . $fetch_store['phone'] . '</a>';
                }
            }
            ?>
      </div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="text" name="qty" class="qty" min="1" max="9999999999" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_product['quantity']; ?>" style="width: 120px;">
      </div>
      <div class="flex">
         <div class="name">
            <br>
            <a style="font-size: 16px;"><?= $fetch_product['start_date']; ?><span class="price"> >>> </span><?= $fetch_product['end_date']; ?></a>
         </div>
      </div>
        <!--<div class="w3-light-grey">
          <div class="w3-container w3-green w3-center" style="width:75%; font-size: 15px; direction: ltr;">
              <?php
                $bday = new DateTime(''.$ss.'');
                $today = new DateTime(''.$dd.'');
                $diff = $today->diff($bday);
                printf('متبقي %d سنة %d شهر %d يوم', $diff->y, $diff->m, $diff->d);
                printf("\n");
              ?>
          </div>
        </div><br>-->
        <div class="w3-light-grey">
            <?php
            $ss = $fetch_product['start_date'];
            $dd = $fetch_product['end_date'];
            $date1 = strtotime($ss);
            $date2 = strtotime($dd);
            $diff = $date2 - $date1;
            $days = floor($diff / (60 * 60 * 24));
            //echo $days;
            $dateNow = strtotime(date('Y-m-d'));
            $date3 = strtotime($ss);
            $diff2 = $dateNow - $date3;
            $dayz = floor($diff2 / (60 * 60 * 24));
            $percentage = ($dayz / $days) * 100;
            if ($percentage > 90) {
            ?>
          <div class="w3-container w3-red w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if ($percentage > 50) { ?>
          <div class="w3-container w3-green w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if (is_nan($percentage)) { ?>
          <div class="w3-container w3-nan w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format(0) . '%'; ?>
          </div>
          <?php } else { ?>
          <div class="w3-container w3-yellow w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } ?>
        </div><br>
        <?php
            if ($user_id != $id) { ?>
                <!--<input type="submit" value="إتمام الصفقة" class="btn" name="add_to_cart">-->
                <a href="update_reservation.php?update=<?php echo $fetch_product['id']; ?>" class="btn">إتمام الصفقة</a>
        <?php } else { ?>
                <input type="button" value="" class="btn" name="" style="background: white;">
        <?php } ?>
   </form>
   <?php
      }
   }else{
        echo '<p class="empty-reservation" style="direction: rtl;">لا توجد حجوزات تم حجزها حتى الآن!</p>&nbsp;';
        if ($check_stores == 0) {
            //echo '<p class="empty"><a href="create_store.php">!أنشئ متجر الآن</a></p>';
        }
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>


<!---------------------------------------------- else ------------------------------------------>

<section class="home-products">

    <h1 class="heading">
    <?php
        $select_stores = $conn->prepare("SELECT * FROM `real_estates` WHERE sid='$user_id'"); 
        $select_stores->execute();
        if($select_stores->rowCount() > 0){
            $number_of_store = $select_stores->rowCount();
        }

        $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
        $select_products->execute();
        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                $name = $fetch_products['title'];
                echo '<a style="color: #FE4445;">' . $name . '</a>\'s real estate [' . $number_of_store . ']';
            }
        }
   ?>
   </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE sid='$user_id' LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['title']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="../quick_view.php?realestate=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name" style="font-weight: bold;"><?= $fetch_product['title']; ?></div>
      <div class="name">
        <?= $fetch_product['name']; ?><br></i><i class="bi bi-pin-map-fill"></i> <?= $fetch_product['brand'] . '<a href="../category.php?real_estates='.$fetch_product['category'] .'" style="font-size: 12px;"> <i class="bi bi-tag-fill"></i>(' . $fetch_product['category'] . ')</a>'; ?>
      </div>
      <div class="name" style="font-weight: bold; font-size: 12px;">
        <!--<?= '<i class="bi bi-geo-alt-fill"></i> '.$fetch_product['country'] . ', ' .$fetch_product['city']. ', ' .$fetch_product['state']; ?>-->
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
        <?= '<i class="bi bi-geo-alt-fill"></i> ' . $this_country . ', ' . $this_state . ', ' . $this_city; ?>
      </div>
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
                        } else if ($status == 7) {
                            echo '<i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>';
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
        echo '<p class="empty">no real estate added yet!</p>&nbsp;';
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

<?php } ?>





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