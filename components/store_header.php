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
   
   $myid = $_GET['id'];
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Shopie<span>.</span></a>

      <nav class="navbar">
            <a href="https://shopy101.000webhostapp.com/home.php">home</a>
            <a href="../about.php">about</a>
            <a href="../orders.php">orders</a>
            <a href="../shop.php">shop</a>
            <a href="../admin/stores.php">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i> my stores
            </a>
            <a href="../contact.php">contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            //$count_wishlist_items->execute([$user_id]);
            // I fix cart item show when user id that improve website oh yaa!
            $count_wishlist_items->execute([$myid]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            //$count_cart_items->execute([$user_id]);
            $count_cart_items->execute([$myid]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <a href="../search_page.php"><i class="fas fa-search"></i></a>
         <a href="../wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="../cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
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
         <a href="index.php?user_id=<?php echo $user_id; ?>" class="option-btn">متجري</a>
         <!--<div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>-->
         <a href="../components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">تسجيل خروج</a> 
         <?php
            }else{
         ?>
         <!--<p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>-->
         <p>من فضلك سجل دخول أو أنشئ حساب؟</p>
         <div class="flex-btn">
            <a href="user_register.php" class="sign-btn" id="sign-btn">
                إنشاء حساب<i class="bi bi-person-plus-fill"></i>
            </a>
            <a href="user_login.php" class="sign-btn" id="sign-btn">تسجيل دخول</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>