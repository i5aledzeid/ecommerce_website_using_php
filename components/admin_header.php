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
        }

    </style>

    <?php if(isset($admin_id)) { ?>
       <section class="flex">
            <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>

            <nav class="navbar">
                <a href="../admin/dashboard.php">home</a>
                <a href="../admin/stores.php">stores</a>
                <a href="../admin/products.php">products</a>
                <a href="../admin/placed_orders.php">orders</a>
                <a href="../admin/admin_accounts.php">admins</a>
                <a href="../admin/users_accounts.php">users</a>
                <a href="../admin/messages.php">messages</a>
            </nav>

          <div class="icons">
             <div id="user-btn" class="fas fa-user"></div>
             <div id="user-btn" class="fas fa-bell">
                 <a href="../admin/messages.php" id="count" class="count">
                    <?php 
                        $select_messages = $conn->prepare("SELECT * FROM `message`");
                        $select_messages->execute();
                        $number_of_messages = $select_messages->rowCount();
                        echo $number_of_messages;
                    ?>
                 </a>
             </div>
             <div id="menu-btn" class="fas fa-bars"></div>
          </div>

          <div class="profile">
             <?php
                $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
             ?>
             <p><?= $fetch_profile['name']; ?></p>
             <a href="../admin/update_profile.php" class="btn">update profile</a>
             <!--<div class="flex-btn">
                <a href="../admin/register_admin.php" class="option-btn">register</a>
                <a href="../admin/admin_login.php" class="option-btn">login</a>
             </div>-->
             <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
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