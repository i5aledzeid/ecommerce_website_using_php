<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

include 'functions/count_time_ago.php';

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
       <link rel="stylesheet" href="css/home-style.css">
        <link rel="stylesheet" href="css/realestates-style.css">
              
       <!-- https://icons.getbootstrap.com -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
      <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
      
        <style>
            @media only screen and (max-width: 500px) {
                #title {
                    font-size: 10px;
                }
                #subtitle {
                    font-size: 8px;
                }
                .image {
                    height: 64px;
                }
            }
        </style>

    </head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

    <section class="home">

    <div class="swiper home-slider" >
   
   <div class="swiper-wrapper">
       
       <?php
       $select_products = $conn->prepare("SELECT * FROM `advertisement` WHERE type = 0");
            $select_products->execute();
            $number_of_brand = $select_products->rowCount();
            if($select_products->rowCount() > 0) {
                while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
       
       <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/<?= $fetch_accounts['image']; ?>" alt="" style="height: 82px;">
         </div>
         <div class="content">
            <span id="title"><?= $fetch_accounts['title']; ?></span>
            <h3 style="font-size: 10px;"><?= $fetch_accounts['subtitle']; ?></h3>
            <a href="<?= $fetch_accounts['link']; ?>" class="btn"><?= $fetch_accounts['button']; ?></a>
         </div>
      </div>
      
      <?php } } ?>

      <!--<div class="swiper-slide slide" style="height: 250px;">
         <div class="image">
            <img src="images/home-img-1.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>خصم بنسبة %50</span>
            <h3 style="font-size: 16px;">أحدث الهواتف الذكية</h3>
            <a href="shop.php" class="btn">تسوق الآن</a>
         </div>
      </div>

      <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/home-img-2.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>خصم بنسبة %50</span>
            <h3 style="font-size: 16px;">أحدث الساعات الرقمية</h3>
            <a href="shop.php" class="btn">تسوق الآن</a>
         </div>
      </div>

      <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/home-img-3.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3 style="font-size: 16px;">أحدث السماعات الرياضية</h3>
            <a href="shop.php" class="btn">تسوق الآن</a>
         </div>
      </div>
      
      <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/home-img-1.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3 style="font-size: 16px;">latest smartphones</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/home-img-2.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3 style="font-size: 16px;">latest watches</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>

      <div class="swiper-slide slide" style="height: 200px;">
         <div class="image">
            <img src="images/home-img-3.png" alt="" style="height: 100px;">
         </div>
         <div class="content">
            <span>upto 50% off</span>
            <h3 style="font-size: 16px;">latest headsets</h3>
            <a href="shop.php" class="btn">shop now</a>
         </div>
      </div>-->

   </div>

      <div class="swiper-pagination" style="bottom: -4px;"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">تسوق أفضل مع التصنيفات</h1>

   <div class="swiper category-slider">

        <div class="swiper-wrapper">
           
           <?php
            $i = 1;
            $select_products = $conn->prepare("SELECT * FROM `category`");
            $select_products->execute();
            $number_of_brand = $select_products->rowCount();
            if($select_products->rowCount() > 0) {
                while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php
                $title = $fetch_accounts['title'];
                if ($title == 'Real Estate') {
                    echo '<a href="category.php?real_estates='.$fetch_accounts['link'].'" class="swiper-slide slide">';
                }
                else { ?>
                <?php echo '<a href="category.php?category='.$fetch_accounts['link'].'" class="swiper-slide slide">'; ?>
                <?php } ?>
                <?php echo '<img src="images/icon-'.$i++.'.png" alt="category-logo">'; ?>
                <h3><?= $fetch_accounts['title']; ?></h3>
                </a>
            <?php } } ?>
            
        </div>

        <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">آخر المنتجات</h1>

   <div class="swiper realestates-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
      <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
      <div class="name" style="font-size: 12px;">
          <i class="bi bi-tags-fill"></i> <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
              <?= $fetch_product['category']; ?>
          </a> (<?= $fetch_product['brand']; ?>)
      </div>
      <div class="name" style="font-size: 12px;"><?php
        $created_at = $fetch_product['created_at'];
        echo time_elapsed_string($created_at, true);
      ?></div>
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
        <!--<div class="name">
            <i class="bi bi-hand-thumbs-up-fill" style="color: #198754;"></i> 22
            <i class="bi bi-hand-thumbs-down-fill" style="color: #DC3545;"></i> 32
        </div>-->
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="heading">تسوق مع العلامات التجارية</h1>

   <div class="swiper category-slider">

        <div class="swiper-wrapper">
           
           <?php
            $i = 1;
            $select_products = $conn->prepare("SELECT * FROM `brand`");
            $select_products->execute();
            $number_of_brand = $select_products->rowCount();
            if($select_products->rowCount() > 0) {
                while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                <?php echo '<a href="brand.php?brand='.$fetch_accounts['link'].'" class="swiper-slide slide">'; ?>
                <?php echo '<img src="images/brand/'.$fetch_accounts['image'].'" alt="category-logo">'; ?>
                <h3><?= $fetch_accounts['title']; ?></h3>
                </a>
            <?php } } ?>
            
        </div>

        <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">منتجات أبل</h1>

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
          <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
          <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
            <div class="name" style="font-size: 12px;">
                <i class="bi bi-tags-fill"></i> <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
                    <?= $fetch_product['category']; ?>
                    </a> (<?= $fetch_product['brand']; ?>)
            </div>
            <div class="name" style="font-size: 12px;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>
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
          <div class="name">
          <?php
            /*$i = $fetch_product['id'];
            $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE `pid`='$i'"); 
            $select_comments->execute();
            $count = $select_comments->rowCount();*/
            //if($select_comments->rowCount() > 0){
                //while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                    //echo $fetch_comment['pid'];
                    /*if ($count > 999) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> 1K comments';
                    }
                    else if ($count > 99) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> +99 comments';
                    }
                    else if ($count > 0 && $count > 1) {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comments';
                    } else {
                        echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comment';
                    }*/
                //}
            //}
          ?>
      </div>
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
        <!--<div class="name">
            <i class="bi bi-hand-thumbs-up-fill" style="color: #198754;"></i> 22
            <i class="bi bi-hand-thumbs-down-fill" style="color: #DC3545;"></i> 32
        </div>-->
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <!--<div class="swiper-pagination"></div>-->

   </div>

</section>

<section class="realestates-products" >

   <h1 class="heading">
       سوق العقارات الآن متوفر
       <?php
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' LIMIT 12"); 
         $select_products->execute();
         $count = $select_products->rowCount();
         if($count > 0){
            echo '(' . $count . ')';
         } ?>
    </h1>

   <div class="swiper realestates-slider">
       
        <div class="flex">
            <button>Show maps </button>
            <i class="bi bi-chevron-down" onclick="myFunction()" id="myDIV" style="font-size: 16px;"></i>
        </div>
        <style>
            .myStyle {
              background-color: coral;
              padding: 16px;
            }
            .newStyle {
              background-color: lightblue;
              text-align: center;
              font-size: 25px;
              padding: 16px;
            }
            
            .show {
                display: none;
                height: 250px;
            }
            
            .none {
                display: block;
                height: 250px;
            }
            
        </style>

   <div class="swiper-wrapper">

       <?php
        //$select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND status != 1 LIMIT 6"); 
         $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' LIMIT 12"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide open" id="realestate-form">
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
            <div class="name" style="font-size: 12px;">(<?= $fetch_product['details']; ?>)</div>
            <div class="name" style="font-size: 12px;">
                <i class="bi bi-tags-fill"></i> <a href="category.php?real_estates=<?php echo $fetch_product['category']; ?>">
                    <?= $fetch_product['category']; ?>
                    </a>
            </div>
            <div class="name" style="font-size: 12px;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>
          <div class="name" style="font-size: 12px;">
                <a href="https://maps.google.com/maps?q=<?php echo $fetch_product['country']; ?>&output=embed" style="color: green;">
                    <i class="bi bi-geo-alt-fill" style="color: green;"></i>
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
                    <?= $this_country . ', ' . $this_state . ', ' . $this_city; ?>
                </a>
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
             <input type="number" name="qty" class="qty" min="0" max="9999999999" onkeypress="if(this.value.length == 2) return false;" value="0">
          </div>
            <br><br>
          <div class="flex">
             <div class="map" style="font-size: 8px;">
                 <a href="<?php echo $fetch_product['map']; ?>" style="color: red;"> <i class="bi bi-geo-alt-fill"></i><?php echo ' ' . $fetch_product['map']; ?></a>
             </div>
          </div>
          <!--------------------------------------------- MAPS ---------------------------------------------->
        <!--<?php if (isset($_POST["submit_address"])) {
            $address = $_POST["address"];
            $address = str_replace(" ", "+", $address); ?>
            <iframe width="25%" height="500" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
        <?php } if (isset($_POST["submit_coordinates"])) {
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"]; ?>
            <iframe width="25%" height="500" src="https://maps.google.com/maps?q=<?php echo $latitude; ?>,<?php echo $longitude; ?>&output=embed"></iframe>
        <?php } ?>-->
          <!--------------------------------------------- MAPS ---------------------------------------------->
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
        <!------------------------------------------------ MAP last update -------------------------------------------------->
        <br><br>
            <div class="none" id="map-views">
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
                    $address = $this_country . ', ' . $this_city . ', ' . $this_state;
                //$address = $fetch_product['country'] . ', ' . $fetch_product['city'] . ', ' . $fetch_product['state']; ?>
                <iframe width="100%" height="250" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed" id="mapsView"></iframe>
            </div>
        <!------------------------------------------------ MAP last update -------------------------------------------------->
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">منتجات سامسونج</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

       <?php
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE brand='samsung' LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
          <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
          <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
            <div class="name" style="font-size: 12px;">
                <i class="bi bi-tags-fill"></i> <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
                    <?= $fetch_product['category']; ?>
                    </a> (<?= $fetch_product['brand']; ?>)
            </div>
            <div class="name" style="font-size: 12px;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>
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
        <!--<div class="name">
            <i class="bi bi-hand-thumbs-up-fill" style="color: #198754;"></i> 22
            <i class="bi bi-hand-thumbs-down-fill" style="color: #DC3545;"></i> 32
        </div>-->
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <!--<div class="swiper-pagination"></div>-->

   </div>

</section>

<section class="home-products">

    <h1 class="heading">
       قائمة الأسواق
       <?php
         $select_stores = $conn->prepare("SELECT * FROM `store` LIMIT 10"); 
         $select_stores->execute();
         if($select_stores->rowCount() > 0){
            echo '[' . $number_of_store = $select_stores->rowCount() . ']';
         }
       ?>
        <a href="admin/stores.php">رؤية المزيد</a>
    </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

       <?php
         $select_stores = $conn->prepare("SELECT * FROM `store` LIMIT 10"); 
         $select_stores->execute();
         if($select_stores->rowCount() > 0){
          while($fetch_store = $select_stores->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_store['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_store['title']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_store['subtitle']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_store['image']; ?>">
          <!--<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_store['id']; ?>" class="fas fa-eye"></a>-->
          <img src="images/<?= $fetch_store['image']; ?>" alt="">
          <div class="name" style="font-weight: bold;">
              <?= $fetch_store['title']; ?>
              <?php
                        $status = $fetch_store['status'];
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
                        <?php } else if ($status == 7) { ?>
                            <i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>
                        <?php } ?>
          </div>
          <div class="name"><?= '[' . $fetch_store['created_by'] . '] ' . $fetch_store['subtitle']; ?></div>
          <div class="flex">
             <div class="price" style="font-size: 12px;"><?= $fetch_store['created_at']; ?></div>
          </div>
          <a href="../store/store.php?user_id=<?php echo $fetch_store['id'] ?>&id=<?php echo $user_id ?>" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> مشاهدة السوق </a>
          <!--<input type="submit" value="add to cart" class="btn" name="add_to_cart">-->
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">منتجات مقترحة</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

       <?php
         $select_products = $conn->prepare("SELECT * FROM `products` ORDER BY RAND() LIMIT 6"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
          <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
          <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
          <div class="name" style="font-size: 12px;">
                <i class="bi bi-tags-fill"></i>
                <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
                    <?= $fetch_product['category']; ?>
                </a> (<?= $fetch_product['brand']; ?>)
           </div>
           <div class="name" style="font-size: 12px;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>  
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
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <!--<div class="swiper-pagination"></div>-->

   </div>

</section>

<!--<div class="home-bg" style="direction: rtl;">

<section class="home" style="height: 400px;">

    <div class="swiper ad-slider" >
   
   <div class="swiper-wrapper">
       
       <?php
       $select_products = $conn->prepare("SELECT * FROM `users` LIMIT 1");
            $select_products->execute();
            $number_of_brand = $select_products->rowCount();
            if($select_products->rowCount() > 0) {
                while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
       
       <div class="swiper-slide slide" style="height: 400px;">
         <div class="content">
            <span id="title"><?= $fetch_accounts['title']; ?></span>
            <h3>إشترك الآن</h3>
            <div class="flex">
            <div class="flex" style="padding-bottom: 16px;">
            <input type="name" name="name" placeholder="إدخل إسمك بالكامل" required="" maxlength="50" class="box" style="background: #f7f5f5; width: 31.8%; padding: 16px; border-radius: 16px; margin-left: 16px;">
            <input type="name" name="number" placeholder="إدخل رقم هاتفك " required="" maxlength="10" class="box" style="background: #f7f5f5; width: 31.8%; padding: 16px; border-radius: 16px; margin-left: 16px;">
            <input type="email" name="email" placeholder="إدخل بريدك الإلكتروني" required="" maxlength="50" class="box" style="background: #f7f5f5; width: 31.8%; padding: 16px; border-radius: 16px; margin-left: 16px;">
            </div>
            <textarea name="msg" class="box" placeholder="إكتب ما تريد سواء اقتراح أو طلب&#13;&#10;كما يمكنك طلب الخدمة التي تريد الإشتراك بها؟" cols="30" rows="3" style="background: #f7f5f5; width: 100%; padding: 16px; border-radius: 16px;"></textarea>
            </div>
            <input type="submit" value="إشترك الآن" name="send" class="btn" style="border-radius: 16px;">
         </div>
      </div>
      
      <?php } } ?>

   </div>

      <div class="swiper-pagination" style="bottom: -4px;"></div>

   </div>

</section>

</div>-->

<section class="home-products">

   <h1 class="heading">
   <?php
        $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 10"); 
        $select_products->execute();
        if($select_products->rowCount() > 0){
            echo 'المنتجات ' . $select_products->rowCount() . ' الأعلى مبيعاً';
        }
   ?>
   </h1>

   <div class="swiper top-slider">

   <div class="swiper-wrapper">

       <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 10"); 
         $select_products->execute();
         if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
       ?>
       <form action="" method="post" class="swiper-slide slide">
          <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
          <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
          <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
          <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
          <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
          <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
            <div class="name" style="font-size: 12px;">
                <i class="bi bi-tags-fill"></i>
                <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
                    <?= $fetch_product['category']; ?>
                </a> (<?= $fetch_product['brand']; ?>)
            </div>
            <div class="name" style="font-size: 12px;"><?php
                $created_at = $fetch_product['created_at'];
                echo time_elapsed_string($created_at, true);
            ?></div>
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
        <?php if ($user_id != $fetch_product['sid']) { ?>
            <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
       </form>
       <?php
          }
       }else{
          echo '<p class="empty">no products added yet!</p>';
       }
       ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>






<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
    loopedSlides:1,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
        //reverseDirection: false,
    },
    /*navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },*/
});

var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   /*pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
    },*/
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
      /*1400: {
         slidesPerView: 6,
       },*/
       // ADDED NEW 08-08-2023
       
       // ADDED NEW 08-08-2023
      1280: {
         slidesPerView: 6,
       },
       // ADDED NEW 08-08-2023
       1536: {
         slidesPerView: 7,
       },
       1792: {
         slidesPerView: 8,
       },
       
   },
    /*loopedSlides:1,*/
    autoplay: {
        delay: 1000,
        disableOnInteraction: true,
        reverseDirection: false,
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

var swiper = new Swiper(".top-slider", {
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

var swiper = new Swiper(".realestates-slider", {
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
   autoplay: {
        delay: 1000,
        disableOnInteraction: true,
        reverseDirection: false,
    },
});

var swiper = new Swiper(".ad-slider", {
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

<script>
function myFunction() {
    const element = document.getElementById("myDIV");
    const mapView = document.getElementById("realestate-form");
    if (element.className == "bi bi-chevron-down") {
        element.className = "bi bi-chevron-up";
        //alert(mapView.className);
        mapView.className = "swiper-slide open";
    } else {
        element.className = "bi bi-chevron-down";
        //alert(mapView.className);
        mapView.className = "swiper-slide close";
    }
}
</script>

</body>
</html>