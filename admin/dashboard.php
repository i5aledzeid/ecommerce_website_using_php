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

   <div class="box-container" style="direction: rtl;">

      <div class="box">
         <h3>!مرحباً بك</h3>
         <p style="direction: ltr;"><?= '@' . $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">تحديث الملف الشخصي <i class="fa fa-database" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= 'إجمالي الطلبات (' . $number_of_orders . ')'; ?></h3>
         <p>
         <select class="form-select" style="background: transparent; direction: rtl;" aria-label="Default select example">
            <option selected>إختر نوع الطلب؟</option>
            <option value="1"><?= '(' . $number_of_orders . ') الطلبات المعلقة'; ?></option>
            <option value="2"><?= '(' . $number_of_orders * 0 . ') الطلبات التي سلمت'; ?></option>
            <option value="3"><?= '(' . $total_completes . ') الطلبات المكتملة'; ?></option>
            <option value="4"><?= '(' . $number_of_orders * 0 . ') الطلبات المحجوزة'; ?></option>
         </select>
         </p>
         <!--<p>orders placed</p>-->
         <!--<a href="placed_orders.php" class="btn">رؤية الطلبات <i class="fa fa-list" aria-hidden="true"></i></a>-->
         <a href="orders.php" class="btn">رؤية الطلبات <i class="fa fa-list" aria-hidden="true"></i></a>
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
         <h3 style="direction: ltr;"><span>$</span><?= number_format($total_pendings, 2); ?><span>/-</span></h3>
         <p><?= '(' . $count . ')'; ?> total pendings</p>
         <a href="pending_orders.php" class="btn">رؤية الطلبات المعلقة <i class="fa fa-table" aria-hidden="true"></i></a>
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
         <h3 style="direction: ltr;"><span>$</span><?= number_format($total_completes, 2); ?><span>/-</span></h3>
         <p><?= '(' . $count . ')'; ?> completed orders</p>
         <a href="completed_orders.php" class="btn">رؤية الطلبات المكتملة <i class="fa fa-bookmark" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="products.php" class="btn">رؤية المنتجات <i class="fa fa-square" aria-hidden="true"></i></a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>normal users</p>
         <a href="users_accounts.php" class="btn">روية المستخدمين <i class="fa fa-user" aria-hidden="true"></i></a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>admin users</p>
         <a href="admin_accounts.php" class="btn">رؤية المسؤولين <i class="fa fa-star" aria-hidden="true"></i></a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new messages</p>
         <a href="messages.php" class="btn">رؤية الرسائل <i class="fa fa-comments" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `wishlist`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new wishlist</p>
         <a href="messagess.php" class="btn">رؤية الإعجابات <i class="fa fa-heart" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `cart`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new cart</p>
         <a href="carts.php" class="btn">رؤية السلة <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `category`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount();
         ?>
         <h3 style="direction: ltr;"><?= $number_of_messages; ?></h3>
         <p>new category</p>
         <a href="category.php" class="btn"> التصنيفات <i class="fa fa-hashtag" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_brand = $conn->prepare("SELECT * FROM `brand`");
            $select_brand->execute();
            $number_of_brand = $select_brand->rowCount();
         ?>
         <h3 style="direction: ltr;"><?= $number_of_brand; ?></h3>
         <p>new brand</p>
         <a href="brand.php" class="btn"> العلامات التجارية <i class="fa fa-hashtag" aria-hidden="true"></i></a>
      </div>
      
      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `store`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>new store</p>
         <a href="user_stores.php" class="btn">رؤية المتاجر <i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
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
         <a href="banners.php" class="btn">رؤية البنرات <i class="fa fa-credit-card" aria-hidden="true"></i></a>
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
         <a href="ad.php" class="btn">رؤية الإعلانات <i class="fa fa-window-maximize" aria-hidden="true"></i></a>
      </div>
      
      <?php
        $select_bank_transfers = $conn->prepare("SELECT * FROM `order_store`");
        $select_bank_transfers->execute();
        $number_of_bank_transfers = $select_bank_transfers->rowCount();
        if($select_bank_transfers->rowCount() > 0){
            //while($fetch_bank_transfers = $select_bank_transfers->fetch(PDO::FETCH_ASSOC)){
         ?>
      <div class="box">
         <h3><?= 'جدول الطلبات' ?></h3>
         <p>
             <?php echo '(' . $number_of_bank_transfers . ')'; ?>
             منتجات تم طلبها
         </p>
         <a href="delivery_dashboard.php?status=all" class="btn">قائمة الطلبات <i class="fa fa-bar-chart" aria-hidden="true"></i></a>
      </div>
      <?php } //}
      else { ?>
      <div class="box">
         <h3><?= 'جدول الطلبات' ?></h3>
         <p>
             <?php echo '(' . $number_of_bank_transfers . ')'; ?>
             منتجات تم طلبها
         </p>
         <a href="delivery_dashboard.php?status=all" class="btn">قائمة الطلبات <i class="fa fa-bar-chart" aria-hidden="true"></i></a>
      </div>
      <?php } ?>

      <div class="box">
          <style>
              #notify {
                  position: relative;
                  top: -12px;
                  left: -120px;
                  padding: 8px;
                  background: red;
                  color: white;
              }
              @media only screen and (max-width: 600px) {
              #notify {
                  position: relative;
                  top: -8px;
                  left: -160px;
                  padding: 8px;
                  background: red;
                  color: white;
              }
            }
          </style>
        <?php
            $dateTimeNow = date("Y-m-d h:i:s");
            // echo $dateNow = date("Y-m-d");
            $dateNow = date("Y-m-d");
            //echo $SevenDaysAgo = strtotime("-7 day");
            //echo date("d.m.Y", $SevenDaysAgo);
            $SevenDaysAgo = strtotime("-1 day");
            // echo $dateAgo = date("Y-m-d", $SevenDaysAgo);
            $dateAgo = date("Y-m-d", $SevenDaysAgo);
            $select_bank_transfers = $conn->prepare("SELECT * FROM `bank_transfers` WHERE `created_at` <='$dateNow' AND `created_at` >='$dateAgo';");
            $select_bank_transfers->execute();
            $number_of_bank_transfers = $select_bank_transfers->rowCount();
            if($select_bank_transfers->rowCount() > 0){
                //while($fetch_bank_transfers = $select_bank_transfers->fetch(PDO::FETCH_ASSOC)){
         ?>
          <!--<a href="#" id="notify"><?php
            if ($number_of_bank_transfers > 99) {
                echo '+99';
            }
            else {
                echo $number_of_bank_transfers;
            }
          ?></a>-->
         <h3><?= 'التحويلات البنكية' ?></h3>
         <p style="font-size: 16px;">
             <?php echo '[' . date("Y-m-d h:i:s") . ']'; ?>
         </p>
         <a href="bank_transfers.php" class="btn">التحويلات البنكية <i class="fa fa-university" aria-hidden="true"></i></a>
         <?php } //} 
         else { ?>
            <!--<a href="#" id="notify">
             <?php
             if ($number_of_bank_transfers > 99) {
                echo '+99';
            }
            else {
                echo $number_of_bank_transfers;
            } ?>
            </a>-->
          <h3><?= 'التحويلات البنكية' ?></h3>
         <p style="font-size: 16px;">
             <?php echo '[' . date("Y-m-d h:i:s") . ']'; ?>
         </p>
         <a href="bank_transfers.php" class="btn">التحويلات البنكية <i class="fa fa-university" aria-hidden="true"></i></a>
         <?php }
         ?>
      </div>

      <div class="box">
         <?php
            $select_bank_transfers = $conn->prepare("SELECT * FROM `deliveries`");
            $select_bank_transfers->execute();
            $number_of_bank_transfers = $select_bank_transfers->rowCount();
            if($select_bank_transfers->rowCount() > 0){
                //while($fetch_bank_transfers = $select_bank_transfers->fetch(PDO::FETCH_ASSOC)){
         ?>
         <h3><?= 'الموصلين' ?></h3>
         <p>
             يعمل
             <?php echo '<a style="color: #FE4445;" href=""> ' . $number_of_bank_transfers . '</a>'; ?>
             من الموصلين
         </p>
         <a href="delivery_accounts.php" class="btn">قائمة الموصلين <i class="fa fa-car" aria-hidden="true"></i></a>
         <?php } //} ?>
      </div>
      
      <div class="box">
         <?php
            $select_system = $conn->prepare("SELECT * FROM `reservation`");
            $select_system->execute();
            $number_of_system = $select_system->rowCount();
            if($select_system->rowCount() > 0){
                //while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
         <h3><?= 'عدد ' . $number_of_system . ' حجوزات'; ?></h3>
         <p>الحجوزات الخاصة بالعقارات</p>
         <a href="systems.php" class="btn">هناك حجز <i class="bi bi-building-fill-add"></i></a>
         <?php } //} 
         else { ?>
            <h3>عدد 0 جوازات</h3>
            <p>الحجوزات الخاصة بالعقارات</p>
            <a href="systems.php" class="btn">ليس هناك أي حجز <i class="bi bi-building-fill-add"></i></a>
        <?php } ?>
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
         <a href="systems.php" class="btn"><?php echo $fetch_product['subtitle']; ?> <i class="fa fa-microchip" aria-hidden="true"></i></a>
         <?php } } ?>
      </div>

   </div>

</section>










<?php include '../components/admin-footer.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>