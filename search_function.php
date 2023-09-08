<!--<?php

include 'components/connect.php';

/*************** FIX CASH SAVE DATE WHEN CLICK BACK ******************/
//disable validation of form by the browser
header('Cache-Control: no cache'); //no cache

session_cache_limiter('private_no_expire'); // works

//session_cache_limiter('public'); // works too
/*************** FIX CASH SAVE DATE WHEN CLICK BACK ******************/

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';
include 'functions/count_time_ago.php';


     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
        $search_box = $_POST['search_box'];
        $table = $_POST['table'];
        $country_box = $_POST['country'];
        $state_box = $_POST['state'];
        $city_box = $_POST['city'];
        $status = $_POST['status'];
        $type = $_POST['reservation'];
        $store = $_POST['store'];
        $time = $_POST['time'];
        $price = $_POST['price'];
        $reservation = $_POST['reservation'];
        if ($country_box != '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND country = '$country_box'"); 
        }
        else if ($state_box != '' && $country_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND state = '$state_box'"); 
        }
        else if ($city_box != '' && $country_box == '' && $state_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND city = '$city_box'"); 
        }
        else if ($country_box != '' && $state_box != '' && $city_box != '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND country = '$country_box' AND state = '$state_box' AND city = '$city_box'"); 
        }
        ////////////////////////////// Type //////////////////////////////
        else if ($status != '' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND status = '$status'"); 
        }
        else if ($price == '0' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`price` DESC"); 
        }
        else if ($price == '1' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`price` ASC"); 
        }
        else if ($time == '0' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`id` DESC"); 
        }
        else if ($time == '1' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`id` ASC"); 
        }
        else if ($type != '' && $country_box == '' && $state_box == '' && $city_box == '') {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' AND type='$type'"); 
        }
        ////////////////////////////// Type //////////////////////////////
        else {
            $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%'"); 
        }
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          $s = $fetch_product['type'];
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?realestate=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <?php if ($s == 1) { ?>
            <div class="name" id="status-view" style="padding: 4px; background: #198754;">تمليك</div>
      <?php } else { ?>
            <div class="name" id="status-view" style="padding: 4px; background: #FFC107;">إيجار</div>
      <?php } ?>
      <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
        <div class="name" style="font-size: 12px; direction: ltr;"><?php
            $created_at = $fetch_product['created_at'];
            echo time_elapsed_string($created_at, true);
        ?></div><br><br>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
        <?php
                    $check_cart_numbers = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ?");
                    $check_cart_numbers->execute([$fetch_product['id'], 1]);
                    if($check_cart_numbers->rowCount() > 0) {
                        echo '<a class="btn" id="reservation-btn" style="background: #ff5050;">تم سكن العقار <i class="bi bi-building-check"></i></a>';
                    }else{
                        $check_cart_number = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ? AND user_id = ?");
                        $check_cart_number->execute([$fetch_product['id'], 0, $user_id]);
                        if($check_cart_number->rowCount() > 0) {
                            echo '<a class="btn" id="reservation-btn" style="background: #198754;">تم إضافته <i class="bi bi-check-lg"></i></a>';
                        }else{
                            echo '<input type="submit" value="حجز العقار" class="btn" name="add_to_reservation">';
                        }
                    }
                ?>
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة عقار من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no real estate found!</p>';
      }
     }
?>-->

<section class="products" style="padding-top: 0; min-height:100vh;">
    <div class="box-container" id="result">
<?php
    if (isset($_POST['input'])) {
         $search_box = $_POST['input'];
         $table = $_POST['table'];
         $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND name LIKE '%{$search_box}%'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
           $s = $fetch_product['type']; ?>
             <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?realestate=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <?php if ($s == 1) { ?>
            <div class="name" id="status-view" style="padding: 4px; background: #198754;">تمليك</div>
      <?php } else { ?>
            <div class="name" id="status-view" style="padding: 4px; background: #FFC107;">إيجار</div>
      <?php } ?>
      <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
        <div class="name" style="font-size: 12px; direction: ltr;"><?php
            $created_at = $fetch_product['created_at'];
            echo time_elapsed_string($created_at, true);
        ?></div><br><br>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
        <?php if ($user_id != $fetch_product['sid']) { ?>
        <?php
                    $check_cart_numbers = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ?");
                    $check_cart_numbers->execute([$fetch_product['id'], 1]);
                    if($check_cart_numbers->rowCount() > 0) {
                        echo '<a class="btn" id="reservation-btn" style="background: #ff5050;">تم سكن العقار <i class="bi bi-building-check"></i></a>';
                    }else{
                        $check_cart_number = $conn->prepare("SELECT * FROM `reservation` WHERE pid = ? AND status = ? AND user_id = ?");
                        $check_cart_number->execute([$fetch_product['id'], 0, $user_id]);
                        if($check_cart_number->rowCount() > 0) {
                            echo '<a class="btn" id="reservation-btn" style="background: #198754;">تم إضافته <i class="bi bi-check-lg"></i></a>';
                        }else{
                            echo '<input type="submit" value="حجز العقار" class="btn" name="add_to_reservation">';
                        }
                    }
                ?>
        <?php } else { ?>
            <input type="button" value="لا يمكن إضافة عقار من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
   </form>
      <?php }
     }
    }
?>
</div>
</section>