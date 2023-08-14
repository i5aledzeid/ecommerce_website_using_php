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
   $delete_user = $conn->prepare("DELETE FROM `store` WHERE id = ?");
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
   <title>users stores</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>

   <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">user stores</h1>

   <div class="box-container">

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `store`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
        <img src="../images/<?= $fetch_accounts['image']; ?>" alt="logo" style="width: 72px; position: absolute; padding-top: 12px; z-index: 1;">
        <img src="../images/<?= $fetch_accounts['background']; ?>" alt="background" style="width: 312px; position: relative; top: 0px; left: -12px;">
      <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> title : <span><?= $fetch_accounts['title'] . ' - [' . $fetch_accounts['created_by'] . ']'; ?></span> </p>
      <p> subtitle : <span><?= $fetch_accounts['subtitle']; ?></span> </p>
      <p> status : <span><?= $fetch_accounts['status']; ?></span>
        <?php
            $status = $fetch_accounts['status'];
            if ($status == 0) { ?>
                <i class="fa fa-info-circle" style="color: #0D6EFD; font-size: 18px;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>
            <?php } else if ($status == 1) { ?>
                <i class="bi bi-exclamation-triangle" style="color: #F58F3C; font-size: 18px;" rel="tooltip" title="حظر مؤقت" id="blah"></i>
            <?php } else if ($status == 2) { ?>
                <i class="bi bi-exclamation-circle" style="color: #6C757D; font-size: 18px;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>
            <?php } else if ($status == 3) { ?>
                <i class="fa fa-check" style="color: #198754; font-size: 18px;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>
            <?php } else if ($status == 4) { ?>
                <i class="bi bi-sign-stop-fill" style="color: #DC3545; font-size: 18px;" rel="tooltip" title="حظر تام" id="blah"></i>
            <?php } else if ($status == 5) { ?>
                <i class="bi bi-coin" style="color: #198754; font-size: 18px;" rel="tooltip" title="سوق محترف" id="blah"></i>
            <?php } else if ($status == 6) { ?>
                <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                <script>
                    $(document).ready(function() {
                        $("[rel=tooltip]").tooltip({ placement: 'right'});
                    });
                </script>
            <?php } ?>
        </p>
      <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account? the user related information will also be delete!')" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>