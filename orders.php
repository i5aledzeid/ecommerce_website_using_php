<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<style>
    /** {
        text-align: right;
    }*/
</style>

<section class="orders" style="direction: rtl; text-align: right;">

   <h1 class="heading">الطلبات المقدمة</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         //echo '<p class="empty">please login to see your orders</p>';
        echo '<p class="empty">من فضلك سجل دخول لرؤية طلباتك!</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" style="font-size: 18px; font-weight: bold;">
      <!--<p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>-->
        <p><span>تاريخ الطلب: </span><?= $fetch_orders['placed_on']; ?></p>
        <p><span>الإسم: </span><?= $fetch_orders['name']; ?></p>
        <p><span>البريد الإلكتروني: </span><?= $fetch_orders['email']; ?></p>
        <p><span>رقم الهاتف: </span><?= $fetch_orders['number']; ?></p>
        <p><span>العنوان: </span><?= $fetch_orders['address']; ?></p>
        <p><span>طريقة الدفع او السداد: </span><?= $fetch_orders['method']; ?></p>
        <p><span>الطلب: </span><?= $fetch_orders['total_products']; ?></p>
        <p><span>السعر: </span>-/<?= $fetch_orders['total_price']; ?>$</p>
      <p style="color: #2980b9;">حالة الدفع/الطلب:
        <span style="color:<?php
            if ($fetch_orders['payment_status'] == 'pending') {
                echo '#88A0AD';
                $status = 'معلق';
            } else if ($fetch_orders['payment_status'] == 'delivered') {
                echo '#108510';
                $status = 'تم التوصيل';
            } else if ($fetch_orders['payment_status'] == 'shipped') {
                echo '#8A2BE2';
                $status = 'تم الشحن';
            } else if ($fetch_orders['payment_status'] == 'cancelled') {
                echo '#DC143C';
                $status = 'تم الإلغاء';
            } else {
                echo 'green';
                $status = 'مكتمل';
            };
        ?>"><?= $fetch_orders['payment_status']; echo ' (' . $status . ')'; ?>
        </span>
    </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/orders/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>