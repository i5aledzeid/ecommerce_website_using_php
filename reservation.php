<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `reservation` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `reservation` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:reservation.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `reservation` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'reservation quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reservation cart</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">reservation cart</h3>
   
    <style>
        .w3-light-grey,
        .w3-hover-light-grey:hover,
        .w3-light-gray,
        .w3-hover-light-gray:hover {
            color: #000 !important;
            background-color: #f1f1f1 !important
        }
        .w3-container:after,
        .w3-container:before,
        .w3-panel:after,
        .w3-panel:before,
        .w3-row:after,
        .w3-row:before,
        .w3-row-padding:after,
        .w3-row-padding:before,
        .w3-container:after,
        .w3-container:before,
        .w3-panel:after,
        .w3-panel:before,
        .w3-row:after,
        .w3-row:before,
        .w3-row-padding:after,
        .w3-row-padding:before,
        .w3-container,
        .w3-panel {
            padding: 0.01em 16px
        }
        .w3-panel {
            margin-top: 16px;
            margin-bottom: 16px
        }
        .w3-green,
        .w3-hover-green:hover {
            color: #fff !important;
            background-color: #4CAF50 !important
            /*#F44336 red #2196F3 blue*/
        }
        .w3-red,
        .w3-hover-red:hover {
            color: #fff !important;
            background-color: #F44336 !important
        }
        .w3-yellow,
        .w3-hover-yellow:hover {
            color: #fff !important;
            background-color: #ffc107 !important
        }
        .w3-nan,
        .w3-hover-nan:hover {
            color: #000 !important;
            background-color: #f1f1f1 !important
        }
        .w3-center {
            text-align: center !important
        }
    </style>
    
    <style>
    #alink:hover {
      background-color: yellow;
    }
    
    #status {
        color: white;
        padding: 8px;
        background: red;
        position: absolute;
        font-size: 12px;
        top: 8px;
        right: 8px;
        width: 72px;
        transition: width 1s;
    }
    
    #status:hover {
        width: 82px;
    }
    </style>
    
   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `reservation` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box" style="direction: rtl;">
       <?php if ($fetch_cart['status'] == 0) {
            echo '<a id="status" href="#" style="background: #6C757D;">' . 'محجوز فقط' . '</a>';
        } else if ($fetch_cart['status'] == 1) {
            echo '<a id="status" href="#" style="background: #198754;">' . 'تم السكن' . '</a>';
        } else if ($fetch_cart['status'] == 2) {
            echo '<a id="status" href="#" style="background: #DC3545;">' . 'باقي سبعة أيام' . '</a>';
        } ?>
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <a href="quick_view.php?realestate=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/real_estate/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?> <i class="bi bi-shop-window" style="color: #FF4546;"></i> <?= $fetch_cart['store']; ?></div>
      <div class="price" style="font-size: 24px; font-weight: bold;">$<?= number_format($fetch_cart['price'], 2); ?>/-</div><br>
      <div class="flex">
         <input type="text" name="qty" class="qty" min="0" max="999999999" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>" style="width: 180px;">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total">
          <?php if ($fetch_cart['price'] == $fetch_cart['quantity']) { ?>
          <span style="color: #994409;">$<?php echo $fetch_cart['quantity']; ?>/-</span> 
          <?php } else if ($fetch_cart['price'] < $fetch_cart['quantity']) { ?>
          <span style="color: green;">$<?php echo $fetch_cart['quantity']; ?>/-</span> 
          <?php } else if ($fetch_cart['price'] > $fetch_cart['quantity']) { ?>
          <span style="color: red;">$<?php echo $fetch_cart['quantity']; ?>/-</span> 
          <?php } ?>
          السوم المعروض</div>
      <p style="text-align: right; font-size: 16px; color: red;">
      فاوض على السعر للحصول على أفضل صفقة*
      </p>
      <!--<div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>-->
       
        <?php
            $ss = $fetch_cart['start_date'];
            $dd = $fetch_cart['end_date'];
            $bday = new DateTime(''.$ss.'');
            $today = new DateTime(''.$dd.'');
            $diff = $today->diff($bday);
            printf('متبقي %d سنة %d شهر %d يوم', $diff->y, $diff->m, $diff->d);
            printf("\n");
        ?>
        <div class="w3-light-grey">
            <?php
            $ss = $fetch_cart['start_date'];
            $dd = $fetch_cart['end_date'];
            $date1 = strtotime($ss);
            $date2 = strtotime($dd);
            $diff = $date2 - $date1;
            $days = floor($diff / (60 * 60 * 24));
            //echo $days;
            $dateNow = strtotime(date('Y-m-d'));
            $date3 = strtotime($ss);
            $diff2 = $dateNow - $date3;
            $dayz = floor($diff2 / (60 * 60 * 24));
            $percentage = ($dayz / $days) * 100;
            if ($percentage > 90) {
            ?>
          <div class="w3-container w3-red w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if ($percentage > 50) { ?>
          <div class="w3-container w3-green w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if (is_nan($percentage)) { ?>
          <div class="w3-container w3-nan w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format(0) . '%'; ?>
          </div>
          <?php } else { ?>
          <div class="w3-container w3-yellow w3-light-grey" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } ?>
        </div><br>
        <?php if ($fetch_cart['status'] == 0) { ?>
            <input type="submit" value="حذف الحجز" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
        <?php } ?>
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   </div>

   <!--<div class="cart-total">
      <p>grand total : <span>$<?= number_format($grand_total); ?>/-</span></p>
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="reservation.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>-->

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>