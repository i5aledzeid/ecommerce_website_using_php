<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
$name = $fetch_user['name'];
$email = $fetch_user['email'];

$select_store = $conn->prepare("SELECT * FROM `store` WHERE id = ?");
$select_store->execute([$user_id]);
$fetch_store = $select_store->fetch(PDO::FETCH_ASSOC);
$store = $fetch_store['title'];

$check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$check_cart->execute([$user_id]);
$cart_count = $check_cart->rowCount();

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. '. $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);
   
    //////////////////////// TRICKS ////////////////////////
    $c = $cart_count;
    $xx = 0;
    $sid_array = array();
    for ($x = 0; $x < $c; $x++) {
        $sid_array[$x] = $_POST['name_' . $xx++];
    }
    $image = "";
    $store = "Khaled Zeid";
    $sido = 1;
    //////////////////////// TRICKS ////////////////////////

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) 
        VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
      
      $insert_store_order = $conn->prepare("INSERT INTO `store_orders`(user_id, name, number, email, method, address, total_products, total_price) 
        VALUES(?,?,?,?,?,?,?,?)");
      $insert_store_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);
      
        for ($x = 0; $x < $cart_count; $x++) {
            $insert_store_order = $conn->prepare("INSERT INTO `store_orders`(user_id, name, number, email, method, address, image, total_products, total_price, store, sid) 
                VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $insert_store_order->execute([$user_id, $name, $number, $email, $method, $address, $image, $sid_array[$x], $total_price, $store, $sido]);
        }

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

        <h3>your orders</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= 'SID[<span>' . $fetch_cart['sid'] . '</span>] ' . $fetch_cart['name']; ?> <span>(<?= '$'.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">grand total : <span>$<?= $grand_total; ?>/-</span></div>
      </div>
      
        <!-- your store orders -->
        <h3>your store orders</h3>
        
        <div class="display-orders">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col" style="text-align: center;">SID</th>
                      <th scope="col" style="text-align: center;">Product Name</th>
                      <th scope="col" style="text-align: center;">Price</th>
                      <th scope="col" style="text-align: center;">Quantity</th>
                      <th scope="col" style="text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                        $i = 1;
                        //////////////////////// TRICKS ////////////////////////
                        $sids = 0;
                        $names = 0;
                        $prices = 0;
                        $quantitys = 0;
                        $totals = 0;
                        //////////////////////// TRICKS ////////////////////////
                         $grand_total = 0;
                         $cart_items[] = '';
                         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                         $select_cart->execute([$user_id]);
                         if($select_cart->rowCount() > 0){
                            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                               $total_products = implode($cart_items);
                               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                            ?>
                                <tr>
                                  <th scope="row"><?php echo $i++; ?></th>
                                  <td><input style="text-align: center;" type="text" name="sid_<?php echo $sids++;?>" value="<?= $fetch_cart['sid']; ?>" readonly></td>
                                  <td><input style="text-align: center;" type="text" name="name_<?php echo $names++;?>" value="<?= $fetch_cart['name']; ?>" readonly></td>
                                  <td><input style="text-align: center;" type="text" name="price_<?php echo $prices++;?>" value="<?= $fetch_cart['price']; ?>" readonly></td>
                                  <td><input style="text-align: center;" type="text" name="quantity_<?php echo $quantitys++;?>" value="<?= $fetch_cart['quantity']; ?>" readonly></td>
                                  <td><input style="text-align: center;" type="text" name="total_<?php echo $totals++;?>" value="<?= $fetch_cart['price'] * $fetch_cart['quantity']; ?>" readonly></td>
                                </tr>
                                
                    <?php } ?>
          </tbody>
        </table>
         <?php echo 'Cart Length: ' . $select_cart->rowCount(); echo ' CART COUNT(' . $cart_count . ')'; }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
      </div><br>
        <!-- your store orders -->

        <h3>place your orders</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Your Name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" value="<?php echo $name; ?>" required>
         </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input type="number" name="number" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="email" placeholder="enter your email" class="box" maxlength="50" value="<?php echo $email; ?>" required>
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paytm">paytm</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Address line 02 :</span>
            <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" placeholder="e.g. tokyo" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" placeholder="e.g. hokkaido" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" placeholder="e.g. Japan" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Pin Code :</span>
            <input type="number" min="0" name="pin_code" placeholder="e.g. 〒060-8588" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
         <div class="inputBox">
            <span>Date :</span>
            <?php
                $dateNow = date('d-m-Y');
                echo '<input type="datetime" name="store" placeholder="e.g. '.$dateNow.'" value="'.$dateNow.'" class="box" maxlength="50" readonly required>';
            ?>
         </div>
         <div class="inputBox">
            <span>Store :</span>
            <input type="text" name="store" placeholder="e.g. India" class="box" maxlength="50" value="<?php echo $store; ?>" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>