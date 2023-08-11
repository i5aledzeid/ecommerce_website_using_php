<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

$select_system = $conn->prepare("SELECT * FROM `system`");
$select_system->execute();
$number_of_system = $select_system->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
       لوحة التحكم
       <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            echo ' | ' . $fetch_profile['name'];
        ?>
   </title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   
        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard | لوحة التحكم</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?= '@' . $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn"><i class="fa fa-database" aria-hidden="true"></i> update profile</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_pendings->execute(['pending']);
            $count = $select_pendings->rowCount();
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_price'];
               }
            }
         ?>
         <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
         <p><?= '(' . $count . ')'; ?> total pendings</p>
         <a href="pending_orders.php" class="btn"><i class="fa fa-table" aria-hidden="true"></i> see orders</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            $count = $select_completes->rowCount();
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
         <h3><span>$</span><?= $total_completes; ?><span>/-</span></h3>
         <p><?= '(' . $count . ')'; ?> completed orders</p>
         <a href="completed_orders.php" class="btn"><i class="fa fa-bookmark" aria-hidden="true"></i> see orders</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>orders placed</p>
         <a href="placed_orders.php" class="btn"><i class="fa fa-list" aria-hidden="true"></i> see orders</a>
      </div>
      
      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="products.php" class="btn"><i class="fa fa-square" aria-hidden="true"></i> see products</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>normal users</p>
         <a href="users_accounts.php" class="btn"><i class="fa fa-user" aria-hidden="true"></i> see users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>admin users</p>
         <a href="admin_accounts.php" class="btn"><i class="fa fa-star" aria-hidden="true"></i> see admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new messages</p>
         <a href="messages.php" class="btn"><i class="fa fa-comments" aria-hidden="true"></i> see messages</a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `wishlist`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new wishlist</p>
         <a href="messagess.php" class="btn"><i class="fa fa-heart" aria-hidden="true"></i> see wishlist</a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `cart`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new cart</p>
         <a href="messagess.php" class="btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> see cart</a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `store`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new store</p>
         <a href="user_stores.php" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> see store</a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `category`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount();
            $select_brand = $conn->prepare("SELECT * FROM `brand`");
            $select_brand->execute();
            $number_of_brand = $select_brand->rowCount();
         ?>
         <h3><?= $number_of_messages; ?> / <?= $number_of_brand; ?></h3>
         <p>new category/brand</p>
         <a href="messagess.php" class="btn"><i class="fa fa-hashtag" aria-hidden="true"></i> see category/brand</a>
      </div>
      
      <div class="box">
         <?php
            $select_system = $conn->prepare("SELECT * FROM `system`");
            $select_system->execute();
            $number_of_system = $select_system->rowCount();
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
         <h3><?= $number_of_system; ?></h3>
         <p><?php echo $fetch_product['title']; ?></p>
         <a href="systems.php" class="btn"><i class="fa fa-microchip" aria-hidden="true"></i> <?php echo $fetch_product['subtitle']; ?></a>
         <?php } } ?>
      </div>
      
      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `delivery`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p><?php
         if ($number_of_products <= 1) {
            echo $number_of_products . ' delivery list';
         }
         else {
             echo $number_of_products . ' delivery lists';
         }
          ?></p>
         <a href="delivery.php" class="btn"><i class="fa fa-truck" aria-hidden="true"></i> see products</a>
      </div>
      
      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `banner`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p><?php
         if ($number_of_products <= 1) {
            echo $number_of_products . ' banner list';
         }
         else {
             echo $number_of_products . ' banner lists';
         }
          ?></p>
         <a href="banner.php" class="btn"><i class="fa fa-credit-card" aria-hidden="true"></i> see banner</a>
      </div>
      
      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `ad`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p><?php
         if ($number_of_products <= 1) {
            echo $number_of_products . ' ad list';
         }
         else {
             echo $number_of_products . ' ad lists';
         }
          ?></p>
         <a href="ad.php" class="btn"><i class="fa fa-window-maximize" aria-hidden="true"></i> see ad</a>
      </div>

   </div>

</section>










<?php include '../components/admin-footer.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>