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

    <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<header class="header">

   <section class="flex">

      <a href="../" class="logo">Shopie<span>.delivery</span></a>

      <!--<nav class="navbar">
            <a href="">home</a>
            <a href="">about</a>
            <a href="placed_orders.php">orders</a>
            <a href="../delivery/">
                <i class="bi bi-car-front-fill"></i> delivery
            </a>
            <a href="../contact.php">contact</a>
      </nav>-->
        <nav class="navbar" style="direction: rtl;">
            <a href="index.php">
                <i class="bi bi-house-fill"></i>
                الرئيسية
            </a>
            <a href="../about.php">
                <i class="bi bi-question-circle-fill"></i>
                عنا
            </a>
            <a href="../delivery/dashboard.php?status=pending">
                <i class="bi bi-bag-check-fill"></i>
                الطلبات
            </a>
            <a href="../shop.php">
                <i class="bi bi-shop"></i>
                التسوق
            </a>
            <!--<a href="../admin/stores.php">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i> stores
            </a>-->
            <!--<a href="../delivery/">
                <i class="bi bi-car-front-fill"></i> الموصلين
            </a>
            <a href="../search_realestate.php">
                <i class="bi bi-buildings-fill"></i> العقارات
            </a>-->
            <a href="../contact.php">
                <i class="bi bi-envelope-at-fill"></i>
                تواصل معنا
            </a>
        </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `order_store` WHERE payment_status = ?");
            $count_wishlist_items->execute(["pending"]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$delivery_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="../delivery/dashboard.php?status=pending"><i class="bi bi-app-indicator"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><i class="bi bi-bell-fill"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
        <div id="menu-btn" class="fas fa-bars"></div>

      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `deliveries` WHERE id = ?");
            $select_profile->execute([$delivery_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p style="text-align: right;">
             <?= $fetch_profile["name"] . ' - '; ?>
             مرحباً بك السائق
          </p>
         <a href="../delivery/update_delivery.php" class="btn">تحديث الملف الشخصي</a>
         <!--<div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>-->
         <a href="../components/delivery_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">تسجيل خروج</a> 
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
         <p>من فضلك (السائق) سجل دخول أو أنشئ حساب؟</p>
         <div class="flex-btn">
            <a href="delivery_register.php" class="sign-btn" id="sign-btn">
                إنشاء حساب
                <!--<i class="bi bi-person-plus-fill"></i>-->
            </a>
            <a href="delivery_login.php" class="sign-btn" id="sign-btn">تسجيل دخول</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>