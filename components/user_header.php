<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<style>
    .realestate-counter {
        background: red;
        color: white;
        font-size: 12px;
        position: absolute;
        top: 30px;
        right: 140px;
        border-radius: 50%;
        padding: 3px 6px 3px 6px;
    }
    
    .wishlist-counter {
        background: red;
        color: white;
        font-size: 12px;
        position: absolute;
        top: 30px;
        right: 95px;
        border-radius: 50%;
        padding: 3px 6px 3px 6px;
    }
    
    .cart-counter {
        background: red;
        color: white;
        font-size: 12px;
        position: absolute;
        top: 30px;
        right: 55px;
        border-radius: 50%;
        padding: 3px 6px 3px 6px;
    }
    
    @media only screen and (max-width: 600px) {
        .realestate-counter {
            background: red;
            color: white;
            font-size: 8px;
            position: absolute;
            top: 28px;
            right: 140px;
            border-radius: 50%;
            padding: 3px 6px 3px 6px;
        }
        
        .wishlist-counter {
            background: red;
            color: white;
            font-size: 8px;
            position: absolute;
            top: 28px;
            right: 105px;
            border-radius: 50%;
            padding: 3px 6px 3px 6px;
        }
        
        .cart-counter {
            background: red;
            color: white;
            font-size: 8px;
            position: absolute;
            top: 28px;
            right: 70px;
            border-radius: 50%;
            padding: 3px 6px 3px 6px;
        }
    }
</style>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Shopy<span>.space</span></a>

      <nav class="navbar" style="direction: rtl;">
            <a href="https://shopy101.000webhostapp.com/home.php">
                <i class="bi bi-house-fill"></i>
                الرئيسية
            </a>
            <a href="about.php">
                <i class="bi bi-question-circle-fill"></i>
                عنا
            </a>
            <a href="orders.php">
                <i class="bi bi-bag-check-fill"></i>
                الطلبات
            </a>
            <a href="shop.php">
                <i class="bi bi-shop"></i>
                التسوق
            </a>
            <!--<a href="../admin/stores.php">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i> stores
            </a>-->
            <a href="../delivery/">
                <i class="bi bi-car-front-fill"></i> الموصلين
            </a>
            <a href="../search_realestate.php">
                <i class="bi bi-buildings-fill"></i> العقارات
            </a>
            <a href="contact.php">
                <i class="bi bi-envelope-at-fill"></i>
                تواصل معنا
            </a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
            
            $count_reservation_items = $conn->prepare("SELECT * FROM `reservation` WHERE user_id = ?");
            $count_reservation_items->execute([$user_id]);
            $total_reservation_counts = $count_reservation_items->rowCount();
         ?>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="reservation.php">
            <i class="bi bi-building-fill-check"></i>
            <div class="realestate-counter"><?= $total_reservation_counts; ?></div>
         </a>
         <a href="wishlist.php">
            <i class="fas fa-heart"></i>
            <div class="wishlist-counter">
            <?php
            if ($total_wishlist_counts < 10) {
                echo $total_wishlist_counts;
            }
            else {
                echo '+9';
            }
            ?></div>
         </a>
         <a href="cart.php">
            <i class="fas fa-shopping-cart"></i>
            <div class="cart-counter">
            <?php
            if ($total_cart_counts < 10) {
                echo $total_cart_counts;
            }
            else {
                echo '+9';
            }
            ?></div>
         </a>
         <!--<a href="cart.php"><i class="fas fa-shopping-cart">
            </i><span>(<?= $total_cart_counts; ?>)</span>
         </a>-->
         <div id="user-btn" class="fas fa-user"></div>
        <div id="menu-btn" class="fas fa-bars"></div>

      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p style="text-align: right;">
             <?= $fetch_profile["name"] . ' - '; ?>
             مرحباً بك
          </p>
         <a href="update_user.php" class="btn">تحديث الملف الشخصي</a>
         <!--<a href="update_user.php" class="btn" style="height: 48px; font-size: 18px;">تحديث الملف الشخصي</a>-->
         <a href="store/index.php?user_id=<?php echo $user_id; ?>" class="option-btn">متجري</a>
         <!--<div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>-->
         <a href="../components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">تسجيل خروج</a> 
         <?php
            }else{
         ?>
         <style>
            #sign-btn {
               display: block;
               width: 100%;
               margin-top: 1rem;
               border-radius: .5rem;
               padding:1rem 3rem;
               font-size: 1.3rem;
               text-transform: capitalize;
               color:var(--white);
               cursor: pointer;
               text-align: center;
               background-color: var(--orange);
            }
            
            #sign-btn:hover{
               background-color: var(--black);
            }
         </style>
         <p>من فضلك سجل دخول أو أنشئ حساب؟</p>
         <div class="flex-btn">
            <a href="user_register.php" class="sign-btn" id="sign-btn">
                إنشاء حساب
                <!--<i class="bi bi-person-plus-fill"></i>-->
            </a>
            <a href="user_login.php" class="sign-btn" id="sign-btn">تسجيل دخول</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>