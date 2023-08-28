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
   
    $active = $_GET['active'];
    $active1 = $_GET['active1'];
    $active2 = $_GET['active2'];
    $active3 = $_GET['active3'];
    $active4 = $_GET['active4'];
    $active5 = $_GET['active5'];

    if(isset($active)){
        $color = "orange";
    }
    if(isset($active1)){
        $color2 = "orange";
    }
    if(isset($active2)){
        $color3 = "orange";
    }
    if(isset($active3)){
        $color4 = "orange";
    }
    if(isset($active4)){
        $color5 = "orange";
    }
    if(isset($active5)){
        $color6 = "orange";
    }
    if(isset($active6)){
        $color7 = "orange";
    }
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<header class="header">
    
    <style>
        img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
            display: none;
        }
        
        .count {
            background: red;
        }
        
        #count {
            position: absolute;
            color: white;
            padding: 0 2px 0 2px;
            border-radius: 50%;
            font-size: 12px;
            right: 18px;
            top: 24px;
        }
        
        .tcount {
            background: red;
        }
        
        #tcount {
            position: absolute;
            color: white;
            padding: 0 2px 0 2px;
            border-radius: 50%;
            font-size: 12px;
            right: 62px;
            top: 24px;
        }
        
        #sub-menu {
            position: absolute;
            top: 23.5px;
            left: 59.8%;
            opacity: 0;
            /*display: none;*/
            transition: 1s;
        }
        
        #sub-menu:hover {
            /*display: block;*/
            opacity: 1;
            z-index: 99;
            position: absolute;
            background: white;
            top: 72px;
            left: 59%;
            padding-left: 8px;
            padding-top: 16px;
            padding-right: 16px;
            padding-bottom: 16px;
        }
        
        @media (max-width:768px) {
            
            .navbar {
                /*direction: rtl;
                text-align: right;*/
            }
            
            .count {
                background: red;
            }
            
            #count {
                position: absolute;
                color: white;
                font-size: 12px;
                right: 48px;
                top: 16px;
            }
            
            .tcount {
                background: red;
            }
            
            #tcount {
                position: absolute;
                color: white;
                font-size: 12px;
                right: 84px;
                top: 16px;
            }
        }

    </style>

    <?php if(isset($admin_id)) { ?>
       <section class="flex">
            <a href="../admin/dashboard.php" class="logo">Shopy<span>.sapce</span></a>
            <!--<a href="../admin/dashboard.php" class="logo">لوحة<span> الإدارة</span></a>-->

            <nav class="navbar" style="direction: rtl;">
                <a href="../admin/dashboard.php?active=1" style="color: <?php echo $color; ?>;"><i class="fa fa-home" aria-hidden="true"></i> الرئيسية</a>
                <!--<a href="../admin/stores.php">المتاجر</a>-->
                <a href="../admin/products.php?active1=1" style="color: <?php echo $color2; ?>;"><i class="bi bi-box-seam"></i> المنتجات</a>
                <a href="../admin/category.php?active1=1" id="sub-menu" style="color: <?php echo $color2; ?>;"><i class="bi bi-view-list"></i> التصنيفات</a>
                <a href="../admin/placed_orders.php?active2=1" style="color: <?php echo $color3; ?>;"><i class="bi bi-bag-check"></i> الطلبات</a>
                <a href="../admin/admin_accounts.php?active3=1" style="color: <?php echo $color4; ?>;"><i class="bi bi-at"></i> المسؤولين</a>
                <a href="../admin/users_accounts.php?active4=1" style="color: <?php echo $color5; ?>;"><i class="bi bi-person"></i> المستخدمين</a>
                <a href="../admin/user_stores.php?active5=1" style="color: <?php echo $color6; ?>;"><i class="bi bi-shop-window"></i> المتاجر</a>
                <!--<a id="bb" href="../admin/messages.php"><i class="bi bi-chat-dots"></i> الرسائل</a>-->
            </nav>

          <div class="icons">
             <div id="user-btn" class="fas fa-user"></div>
             <div id="user-btn" class="fas fa-bell">
                 <a href="../admin/messages.php" id="tcount" class="count">
                    <?php 
                        $select_messages = $conn->prepare("SELECT * FROM `message`");
                        $select_messages->execute();
                        $number_of_messages = $select_messages->rowCount();
                        echo $number_of_messages;
                    ?>
                 </a>
             </div>
             <?php 
                $select_bank_transfers = $conn->prepare("SELECT * FROM `bank_transfers`");
                $select_bank_transfers->execute();
                $number_of_bank_transfers = $select_bank_transfers->rowCount();
                if ($number_of_bank_transfers > 0) { ?>
             <div id="user-btn" class="fas bi bi-app">
                 <a href="../admin/bank_transfers.php" id="count" class="count">
                    <?= $number_of_bank_transfers; ?>
                 </a>
             </div>
             <?php } else { ?>
             <div id="user-btn" class="fas bi-app-indicator">
                 <a href="../admin/bank_transfers.php" id="count" class="count">
                    <?= $number_of_bank_transfers; ?>
                 </a>
             </div>
             <?php } ?>
             <div id="menu-btn" class="fas fa-bars"></div>
          </div>

          <div class="profile">
             <?php
                $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
             ?>
             <p>Hi, <a href="#"><?= '@' . $fetch_profile['name']; ?></a></p>
             <a href="../admin/update_profile.php" class="btn">تحديث الملف الشخصي</a>
             <!--<div class="flex-btn">
                <a href="../admin/register_admin.php" class="option-btn">register</a>
                <a href="../admin/admin_login.php" class="option-btn">login</a>
             </div>-->
             <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">تسجيل خروج</a> 
          </div>

        </section>
        <?php }
            else if (isset($user_id)) { ?>
                <section class="flex">
                    <a href="" class="logo"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Store<span>s</span></a>
                    <div class="icons">
                        <a href="../home.php" class="logo">الرئيسية <i class="fa fa-home" aria-hidden="true"></i></a>
                    </div>
                </section>
            <?php }
        ?>

</header>
