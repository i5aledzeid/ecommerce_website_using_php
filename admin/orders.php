<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
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
   <title>orders</title>

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

<section class="orders">

<?php
    $select_orderz = $conn->prepare("SELECT * FROM `orders`");
    $select_orderz->execute();
    $count = $select_orderz->rowCount();
    if($select_orderz->rowCount() > 0){
        echo '<h1 class="heading">orders (' . $count . ')</h1>';
    }
?>

<div class="box-container">

   <?php
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status='pending'");
    $select_orders->execute();
    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
    if($select_orders->rowCount() > 0){ ?>
   <div class="box">
       <br><br><br><br><br><br><br><br><br><br>
      <p style="text-align: center;"><span><?= $fetch_orders['payment_status']; ?></span> حالة الطلب</p>
      <br><br><br><br><br><br><br><br><br><br>
      <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
   </div>
   <?php
      }else{ ?>
         <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
          <p style="text-align: center;"><span><?= $fetch_orders['payment_status']; ?></span> حالة الطلب</p>
          <br><br><br><br><br><br><br><br><br><br>
          <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
       </div>
      <?php }
   ?>
   
   
   
   
   
   
   <?php
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status='reservation'");
    $select_orders->execute();
    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
    if($select_orders->rowCount() > 0){ ?>
   <div class="box">
       <br><br><br><br><br><br><br><br><br><br>
      <p style="text-align: center;"><span><?= $fetch_orders['payment_status']; ?></span> حالة الطلب</p>
      <br><br><br><br><br><br><br><br><br><br>
      <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
   </div>
   <?php
      }else{ ?>
         <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
          <p style="text-align: center;">لا توجد حالة <span>محجوزة</span></p>
          <br><br><br><br><br><br><br><br><br><br>
          <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
       </div>
      <?php }
   ?>
   
   
   
   
   
   
   <?php
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status='completed'");
    $select_orders->execute();
    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
    if($select_orders->rowCount() > 0){ ?>
   <div class="box">
       <br><br><br><br><br><br><br><br><br><br>
      <p style="text-align: center;"><span><?= $fetch_orders['payment_status']; ?></span> حالة الطلب</p>
      <br><br><br><br><br><br><br><br><br><br>
      <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
   </div>
   <?php
      }else{ ?>
         <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
          <p style="text-align: center;">لا توجد حالة <span>مكتملة</span></p>
          <br><br><br><br><br><br><br><br><br><br>
          <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
       </div>
      <?php }
   ?>
   
   
   
   
   <?php
    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status='delivery'");
    $select_orders->execute();
    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);
    if($select_orders->rowCount() > 0){ ?>
   <div class="box">
       <br><br><br><br><br><br><br><br><br><br>
      <p style="text-align: center;"><span><?= $fetch_orders['payment_status']; ?></span> حالة الطلب</p>
      <br><br><br><br><br><br><br><br><br><br>
      <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
   </div>
   <?php
      }else{ ?>
         <div class="box">
           <br><br><br><br><br><br><br><br><br><br>
          <p style="text-align: center;">لا توجد حالة تم <span>توصليها</span></p>
          <br><br><br><br><br><br><br><br><br><br>
          <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">رؤية الطلبات</a>
       </div>
      <?php }
   ?>

</div>

</section>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>