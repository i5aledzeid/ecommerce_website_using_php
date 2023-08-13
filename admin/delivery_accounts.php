<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
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
   <title>delivery accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>
        
        <!-- https://icons.getbootstrap.com/ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">delivery accounts</h1>

   <div class="box-container">

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `deliveries`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box" style="direction: rtl;">
      <p> <i class="bi bi-hash"></i> <span><?= $fetch_accounts['id']; ?></span> </p>
      <?php
        $status = $fetch_accounts['status'];
        if ($status != 0) { ?>
            <p> <i class="bi bi-person-check-fill"></i> <span><?= $fetch_accounts['name']; ?></span> </p>
        <?php }
        else { ?>
            <p> <i class="bi bi-person-fill"></i> <span><?= $fetch_accounts['name']; ?></span> </p>
        <?php }
      ?>
      <p> <i class="bi bi-envelope-fill"></i> <span><?= $fetch_accounts['email']; ?></span> </p>
      <p> رفم الهاتف : <span><?= $fetch_accounts['phone']; ?></span> </p>
      <?php
        $status = $fetch_accounts['status'];
        if ($status == 0) { ?>
            <p> الحالة : <span>غير موثق</span> </p>
        <?php }
        else { ?>
            <p> الحالة : <span>تم التوثيق</span> </p>
        <?php }
      ?>
      <p> أنشئ بتاريخ : <span><?= $fetch_accounts['created_at']; ?></span> </p>
      <div class="flex-btn">
            <a href="update_profile.php" class="option-btn">تعديل</a>
            <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn">حذف</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no deliveries available!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>