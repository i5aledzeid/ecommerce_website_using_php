<?php

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>real estate search page</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   
    <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <style>
        #status-view {
            position: relative;
            top: 195px;
            right: -205px;
            width: 82px;
            border-top-left-radius: 8px;
            text-align: center;
            color: white;
            transition: height 2s;
        }
        #status-view:hover {
            font-weight: bold;
            color: #000;
            height: 32px;
        }
        
        #country, #city, #state, #status, #statuss, #price, #time, #store, #reservation {
            border-radius: 8px;
            text-align: right;
            padding-right: 16px;
            border-style: solid;
            border-color: #000;
            border-width: 1px;
            -moz-appearance: none; /* Firefox */
            -webkit-appearance: none; /* Safari and Chrome */
            -webkit-box-shadow: inset 0px 0px 10px 1px #FEFEFE;
            box-shadow: inset 0px 0px 10px 1px #FEFEFE;
        }
        
        #filter {
            font-size: 18px;
            background: #7330F8;
        }
        
        #filter-more {
            width: 8%;
            border-radius: 50%;
            font-size: 18px;
            background: #7330F8;
        }
        
        .toggle {
            width: 8%;
            border-radius: 50%;
            font-size: 18px;
            background: #7330F8;
        }
        
        .fa {
            font-size: 24px;
            color: #fff;
            padding-left: 12px;
            padding-top: 12px;
        }
        
        .box.hidden {
            display: none;
        }
        
        .box.show {
            display: inline;
        }
        
        #look {
            color: #FF4546;
            font-size: 20px;
        }
        
        @media only screen and (max-width: 600px) {
            #status-view {
                position: relative;
                top: 195px;
                right: -188px;
                width: 64px;
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
                text-align: center;
                color: white;
            }
            #country, #city, #state, #status, #statuss, #price, #time, #store, #reservation {
                border-radius: 8px;
                text-align: right;
                padding-right: 16px;
                -moz-appearance: none; /* Firefox */
                -webkit-appearance: none; /* Safari and Chrome */
            }
        }
        
        @media only screen and (max-width: 400px) {
            #status-view {
                position: relative;
                top: 195px;
                right: -188px;
                width: 64px;
                border-top-left-radius: 8px;
                border-bottom-left-radius: 8px;
                text-align: center;
                color: white;
            }
            #country, #city, #state, #status, #statuss, #price, #time, #store, #reservation {
                border-radius: 8px;
                text-align: right;
                padding-right: 16px;
                -moz-appearance: none; /* Firefox */
                -webkit-appearance: none; /* Safari and Chrome */
            }
        }
    </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
        <input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box" style="text-align: right;">
      <!--<input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box" style="text-align: right;" required>-->
      <button type="submit" class="fas fa-search" name="search_btn" style="width: 10%"></button>
   </form>
</section>
<section class="search-form">
   <form action="" method="post">
       <button type="button" id="filter-more" onClick="showMore(this)">
            <i class="bi bi-plus-lg" id="filter-icon"></i>
        </button>
       <select class="box hidden" name="price" id="price" style="width: 33%;">
            <option selected disabled value="">إختر السعر</option>
            <option value="0">أعلى</option>
            <option value="1">أقل</option>
        </select>
        <select class="box hidden" name="time" id="time" style="width: 33%;">
            <option selected disabled value="">إختر الزمن</option>
            <option value="0">حديث</option>
            <option value="1">قديم</option>
        </select>
        <select class="box hidden" name="store" id="store" style="width: 33%;">
            <option selected disabled value="">إختر السوق</option>
        </select>
        <select class="box hidden" name="reservation" id="reservation" style="width: 33%;">
            <option selected disabled value="">إختر الحجوزات</option>
        </select>
        <!--<input type="range" class="form-range box" id="customRange1" style="width: 23%;">-->
        <select class="box" name="city" id="city" style="width: 33%;">
            <option selected disabled value="">إختر المدينة</option>
        </select>
        <select class="box" name="state" id="state" style="width: 33%;">
            <option selected disabled value="">إختر الولاية/المحافظة</option>
        </select>
        <select class="box" name="country" id="country" style="width: 33%;">
            <option selected disabled value="">إختر الدولة</option>
            <?php
                $select_products = $conn->prepare("SELECT * FROM `countries`");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $fetch_accounts['id']; ?>">
                            <?= $fetch_accounts['name']; ?>
                        </option>
            <?php } } ?>
        </select>
        <select class="box" name="status" id="status" style="width: 33%;">
            <option selected disabled>إختر حالة العقار</option>
            <option value="0">إيجار</option>
            <option value="1">تمليك</option>
        </select>
        <button type="submit" name="filter_btn" id="filter" style="width: 14%;">
          <i class="bi bi-funnel"></i>
        </button>
   </form>
   <br>
   <div class="name" style="direction: rtl;">
       <a style="font-size: 20px; font-weight: bold;">
       جاري البحث عن: 
       </a>
       <a style="font-size: 20px;">
        <?php
            $search_box = $_POST['search_box'];
            $country_box = $_POST['country'];
            $state_box = $_POST['state'];
            $city_box = $_POST['city'];
            $status = $_POST['status'];
            $store = $_POST['store'];
            $time = $_POST['time'];
            $price = $_POST['price'];
            $reservation = $_POST['reservation'];
            
        /***************************************** $select_country search ******************************************/
        $select_country = $conn->prepare("SELECT * FROM `countries` WHERE id = '$country_box'"); 
        $select_country->execute();
        $fetch_country = $select_country->fetch(PDO::FETCH_ASSOC);
        $country_id = $fetch_country['name'];
        /***************************************** $select_country search ******************************************/
        /***************************************** $select_city search ******************************************/
        $select_city = $conn->prepare("SELECT * FROM `cities` WHERE id = '$city_box'"); 
        $select_city->execute();
        $fetch_city = $select_city->fetch(PDO::FETCH_ASSOC);
        $city_id = $fetch_city['name'];
        /***************************************** $select_city search ******************************************/
        /***************************************** $select_state search ******************************************/
        $select_state = $conn->prepare("SELECT * FROM `states` WHERE id = '$state_box'"); 
        $select_state->execute();
        $fetch_state = $select_state->fetch(PDO::FETCH_ASSOC);
        $state_id = $fetch_state['name'];
        /***************************************** $select_state search ******************************************/

            /*if ($price == 1) {
                $output = "من الأقل سعراً";
            } else if ($price == 2) {
                $output = "من الأعلى سعراً";
            } else {
                $output = "";
            }*/
            
            echo 'search <span id="look">' . $search_box .
            '</span> country<span id="look">' . $country_id .
            '</span> state<span id="look">' . $state_id .
            '</span> city<span id="look">'. $city_id .
            '</span> status<span id="look">' . $status .
            '</span> store<span id="look">' . $store .
            '</span> time<span id="look">' . $time .
            '</span> price<span id="look">' . $price .
            '</span> reservation<span id="look">'. $reservation .
            '</span>';
        ?>
        <a href="#" style="font-size: 20px; font-weight: bold; text-decoration: none; color: #000;"> الكل </a>
       </a>
   </div>
</section>

<!--<section class="search-form">
   <form action="" method="post">
        <div class="toggle" style="width: 48px; height: 48px;;">
            <i class="fa fa-search" style="width: 48px;"></i>
        </div>
        <input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box input-show" style="text-align: right;" id="search">
       <select class="box input-hide" name="price" id="price" style="width: 33%;">
            <option selected disabled value="">إختر السعر</option>
            <option value="0">أعلى</option>
            <option value="1">أقل</option>
        </select>
        <select class="box input-hide" name="time" id="time" style="width: 33%;">
            <option selected disabled value="">إختر الزمن</option>
            <option value="0">حديث</option>
            <option value="1">قديم</option>
        </select>
        <select class="box input-hide" name="store" id="store" style="width: 33%;">
            <option selected disabled value="">إختر السوق</option>
        </select>
        <select class="box input-hide" name="reservation" id="reservation" style="width: 33%;">
            <option selected disabled value="">إختر الحجوزات</option>
        </select>
        <select class="box input-hide" name="city" id="city" style="width: 33%;">
            <option selected disabled value="">إختر المدينة</option>
        </select>
        <select class="box input-hide" name="state" id="state" style="width: 33%;">
            <option selected disabled value="">إختر الولاية/المحافظة</option>
        </select>
        <select class="box input-hide" name="country" id="country" style="width: 33%;">
            <option selected disabled value="">إختر الدولة</option>
            <?php
                $select_products = $conn->prepare("SELECT * FROM `countries`");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $fetch_accounts['id']; ?>">
                            <?= $fetch_accounts['name']; ?>
                        </option>
            <?php } } ?>
        </select>
        <select class="box input-hide" name="status" id="statuss" style="width: 33%;">
            <option selected disabled>إختر حالة العقار</option>
            <option value="0">إيجار</option>
            <option value="1">تمليك</option>
        </select>
        <button type="submit" name="filter_btn" id="filter" style="width: 14%;">
          <i class="bi bi-funnel"></i>
        </button>
   </form>
   <br>
   <div class="name" style="direction: rtl;">
       <a style="font-size: 20px; font-weight: bold;">
       جاري البحث عن: 
       </a>
       <a style="font-size: 20px;">
        <?php
            $search_box = $_POST['search_box'];
            $country_box = $_POST['country'];
            $state_box = $_POST['state'];
            $city_box = $_POST['city'];
            $status = $_POST['status'];
            $store = $_POST['store'];
            $time = $_POST['time'];
            $price = $_POST['price'];
            $reservation = $_POST['reservation'];
            
        /***************************************** $select_country search ******************************************/
        $select_country = $conn->prepare("SELECT * FROM `countries` WHERE id = '$country_box'"); 
        $select_country->execute();
        $fetch_country = $select_country->fetch(PDO::FETCH_ASSOC);
        $country_id = $fetch_country['name'];
        /***************************************** $select_country search ******************************************/
        /***************************************** $select_city search ******************************************/
        $select_city = $conn->prepare("SELECT * FROM `cities` WHERE id = '$city_box'"); 
        $select_city->execute();
        $fetch_city = $select_city->fetch(PDO::FETCH_ASSOC);
        $city_id = $fetch_city['name'];
        /***************************************** $select_city search ******************************************/
        /***************************************** $select_state search ******************************************/
        $select_state = $conn->prepare("SELECT * FROM `states` WHERE id = '$state_box'"); 
        $select_state->execute();
        $fetch_state = $select_state->fetch(PDO::FETCH_ASSOC);
        $state_id = $fetch_state['name'];
        /***************************************** $select_state search ******************************************/
            echo 'search <span id="look">' . $search_box .
            '</span> country<span id="look">' . $country_id .
            '</span> state<span id="look">' . $state_id .
            '</span> city<span id="look">'. $city_id .
            '</span> status<span id="look">' . $status .
            '</span> store<span id="look">' . $store .
            '</span> time<span id="look">' . $time .
            '</span> price<span id="look">' . $price .
            '</span> reservation<span id="look">'. $reservation .
            '</span>';
        ?>
        <a href="#" style="font-size: 20px; font-weight: bold; text-decoration: none; color: #000;"> الكل </a>
       </a>
   </div>
</section>

    <style>
        .input-show {
            visibility: visible;
            display: block;
        }
        .input-hide {
            /*visibility: hidden;*/
            display: none;
        }
    </style>

<!--<section>
<input type="text" name="search_box" placeholder="1111111111111111" maxlength="100" class="box input-show" style="text-align: right;" id="search_form">
<input type="text" name="search_box" placeholder="2222222222222222" maxlength="100" class="box input-hide" style="text-align: right;" id="search_form1">
<input type="text" name="search_box" placeholder="3333333333333333" maxlength="100" class="box input-hide" style="text-align: right;" id="search_form2">
</section>-->

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     /***************************************** $select_country search ******************************************/
     /*$select_country = $conn->prepare("SELECT * FROM `countries` WHERE name LIKE '%{$search_box}' OR name = '$search_box'"); 
     $select_country->execute();
     $fetch_country = $select_country->fetch(PDO::FETCH_ASSOC);
     $country_id = $fetch_country['id'];*/
     /***************************************** $select_country search ******************************************/
     /***************************************** $select_city search ******************************************/
     /*$select_city = $conn->prepare("SELECT * FROM `cities` WHERE name LIKE '%{$search_box}' OR name = '$search_box'"); 
     $select_city->execute();
     $fetch_city = $select_city->fetch(PDO::FETCH_ASSOC);
     $city_id = $fetch_city['id'];*/
     /***************************************** $select_city search ******************************************/
     /***************************************** $select_state search ******************************************/
     /*$select_state = $conn->prepare("SELECT * FROM `states` WHERE name LIKE '%{$search_box}' OR name = '$search_box'"); 
     $select_state->execute();
     $fetch_state = $select_state->fetch(PDO::FETCH_ASSOC);
     $state_id = $fetch_state['id'];*/
     /***************************************** $select_state search ******************************************/
     $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND name LIKE '%{$search_box}%'"); 
     //$select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' OR brand LIKE '%{$search_box}%' OR country LIKE '%{$search_box}%' OR city LIKE '%{$search_box}%' OR state LIKE '%{$search_box}%' OR country LIKE '%{$country_id}%'"); 
    //$select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' OR brand LIKE '%{$search_box}%' OR country LIKE '%{$search_box}%' OR city LIKE '%{$search_box}%' OR state LIKE '%{$search_box}%' OR country LIKE '%{$country_id}' OR city LIKE '%{$city_id}' OR state LIKE '%{$state_id}'"); 
    //$select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE category='Real Estate' AND country LIKE '%{$country_id}'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
          $s = $fetch_product['status'];
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
            <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
        <?php } ?>
        <!--<div class="name"><?= $search_box . ' > ' . $country_id; ?></div>-->
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no real estate found!</p>';
      }
     } else if(isset($_POST['country']) OR isset($_POST['filter_btn'])){
        $country_box = $_POST['country'];
        $state_box = $_POST['state'];
        $city_box = $_POST['city'];
        $status = $_POST['status'];
        $store = $_POST['store'];
        $time = $_POST['time'];
        $price = $_POST['price'];
        $reservation = $_POST['reservation'];
        /***************************************** $select_country search ******************************************/
         $select_country = $conn->prepare("SELECT * FROM `countries` WHERE id = '$country_box'"); 
         $select_country->execute();
         $fetch_country = $select_country->fetch(PDO::FETCH_ASSOC);
         $country_id = $fetch_country['name'];
         /***************************************** $select_country search ******************************************/
         /***************************************** $select_city search ******************************************/
         $select_city = $conn->prepare("SELECT * FROM `cities` WHERE id = '$city_box'"); 
         $select_city->execute();
         $fetch_city = $select_city->fetch(PDO::FETCH_ASSOC);
         $city_id = $fetch_city['name'];
         /***************************************** $select_city search ******************************************/
         /***************************************** $select_state search ******************************************/
         $select_state = $conn->prepare("SELECT * FROM `states` WHERE id = '$state_box'"); 
         $select_state->execute();
         $fetch_state = $select_state->fetch(PDO::FETCH_ASSOC);
         $state_id = $fetch_state['name'];
         /***************************************** $select_state search ******************************************/
        if ($country_box != '' && $state_box == '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' OR state ='$state_box' OR city ='$city_box'"); 
        } /*else if ($country_box == '' && $state_box != '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' OR city ='$city_box'"); 
        } else if ($country_box == '' && $state_box == '' && $city_box != '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' OR city ='$city_box'"); 
        }*/ else if ($country_box != '' && $state_box != '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' OR city ='$city_box'"); 
        } else if ($country_box != '' && $state_box != '' && $city_box != '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' AND city ='$city_box'"); 
        } else if ($status == 0 && $price == '' && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status = '$status'"); 
        } else if ($status == 1 && $price == '' && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status = '$status'"); 
        } else if ($time == 0 && $status == '' && $price == '' && $status == '' && $country_box == '' && $state_box == '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` ORDER BY `real_estates`.`id` DESC"); 
        } else if ($time == 1 && $status == '' && $price == '' && $status == '' && $country_box == '' && $state_box == '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` ORDER BY `real_estates`.`id` ASC"); 
        } else if ($price == 0 && $status == '' && $time == '' && $status == '' && $country_box == '' && $state_box == '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` ORDER BY `real_estates`.`price` DESC"); 
        } else if ($price == 1 && $status == '' && $time == '' && $status == '' && $country_box == '' && $state_box == '' && $city_box == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` ORDER BY `real_estates`.`price` ASC"); 
        }/* else if ($country_box == '' && $state_box == '' && $city_box == '' && $status == '' && $store == '' && $time == '' && $price == '' && $reservation == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates`"); 
        }*/ else if ($status == 0 && $price == 0 && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`price` DESC"); 
        } else if ($status == 0 && $price == 1 && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`price` ASC"); 
        } else if ($status == 1 && $price == 1 && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`price` ASC"); 
        } else if ($status == 1 && $price == 0 && $time == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`price` DESC"); 
        } else if ($status == 0 && $time == 0 && $price == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`id` DESC"); 
        } else if ($status == 0 && $time == 1 && $price == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`id` ASC"); 
        } else if ($status == 1 && $time == 1 && $price == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`id` ASC"); 
        } else if ($status == 1 && $time == 0 && $price == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status ='$status' ORDER BY `real_estates`.`id` DESC"); 
        }
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){ ?>
                <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                <a href="quick_view.php?realestate=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                <!--<div class="name" style="padding: 4px; background: #198754; color: white; border-radius: 16px;">
                    <?= ($fetch_product['status'] == 1) ? 'تمليك' : 'إيجار'; ?>
                </div>-->
                <?php if ($fetch_product['status'] == 1) { ?>
                    <div class="name" id="status-view" style="padding: 4px; background: #198754;">تمليك</div>
                <?php } else { ?>
                    <div class="name" id="status-view" style="padding: 4px; background: #FFC107;">إيجار</div>
                <?php } ?>
                <img src="uploaded_img/real_estate/<?= $fetch_product['image_01']; ?>" alt="">
                <div class="name"><?= $fetch_product['name']; ?></div>
                <div class="name"><?= $fetch_product['category']; ?> (<?= $fetch_product['brand']; ?>)</div>
                <div class="details" style="font-size: 16px; color: #198754;"><i class="bi bi-geo-fill"></i> <?= $country_id . ', ' .$state_id. ', ' . $city_id; ?></div><br>
                <div class="name" style="font-size: 12px; direction: ltr;"><?php
                    $created_at = $fetch_product['created_at'];
                    echo time_elapsed_string($created_at, true);
                ?></div><br><br>
                <div class="flex">
                   <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                   <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2)   return false;" value="1">
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
                    <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
                <?php } ?>
                <!--<div class="name"><?= $country_box . ', ' . $state_box; ?></div>-->
            </form>
            <?php }
        }
     } else {
       $search_box = $_POST['search_box'];
       if($search_box == ''){
     $select_products = $conn->prepare("SELECT * FROM `real_estates`"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
        while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
            $s = $fetch_product['status']; ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                  <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
                  <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
                  <input type="hidden" name="map" value="<?= $fetch_product['map']; ?>">
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
                   <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2)   return false;" value="1">
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
                    <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
                <?php } ?>
            </form>
   <?php    }
        }
       }
   }
   ?>

   </div>

</section>












<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

<script>
    // County State

    $('#country').on('change', function() {
        var country_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: '../functions/ajax/state.php',
            type: "POST",
            data: {
                country_data: country_id
            },
            success: function(result) {
                $('#state').html(result);
                // console.log(result);
            }
        })
    });
    // state city
    $('#state').on('change', function() {
        var state_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: '../functions/ajax/city.php',
            type: "POST",
            data: {
                state_data: state_id
            },
            success: function(data) {
                $('#city').html(data);
                // console.log(data);
            }
        })
    });
</script>

<script type="text/javascript">
    function showMore(anchor){
        //document.getElementById("price").className = "box show";
        var price = document.getElementById("price").classList.toggle("show");
        var time = document.getElementById("time").classList.toggle("show");
        var store = document.getElementById("store").classList.toggle("show");
        var reservation = document.getElementById("reservation").classList.toggle("show");
        var country = document.getElementById("country").classList.toggle("hidden");
        var city = document.getElementById("city").classList.toggle("hidden");
        var state = document.getElementById("state").classList.toggle("hidden");
        var status = document.getElementById("status").classList.toggle("hidden");
        //alert("Hello");
        //var icon = document.getElementById("filter-icon").classList.toggle("bi-dash-lg");
        var icon = anchor.querySelector("i");
        icon.classList.toggle('bi-plus-lg');
        icon.classList.toggle('bi-dash-lg');
        icon.classList.toggle('bi-search');
        //anchor.querySelector("span").textContent = icon.classList.contains('fa-plus') ? "Read more" : "Read less";
    }
    
    let btn = document.querySelector(".toggle");
    let icon = btn.querySelector(".fa-search");
    /*var search = document.getElementById("search_form");
    var search1 = document.getElementById("search_form1");
    var search2 = document.getElementById("search_form2");*/
    
    var time = document.getElementById("time");
    var price = document.getElementById("price");
    var store = document.getElementById("store");
    var reservation = document.getElementById("reservation");
    var state = document.getElementById("state");
    var city = document.getElementById("city");
    var country = document.getElementById("country");
    var statuss = document.getElementById("statuss");
    var searchz = document.getElementById("search");
    
    /*icon.style.color = "red";
    icon.style.fontSize = "32px";*/
    btn.onclick = function() {
        if (icon.classList.contains("fa-search")){
            icon.classList.replace("fa-search", "fa-plus");
            /*search1.classList.replace("input-hide", "input-show");
            search.classList.replace("input-show", "input-hide");
            search2.classList.replace("input-show", "input-hide");*/
            /*search.classList.add("hidden");
            search.classList.remove("show");
            search1.classList.add("show");
            search1.classList.remove("hidden");*/
            searchz.classList.replace("input-show", "input-hide");
            
            time.classList.replace("input-hide", "input-show");
            price.classList.replace("input-hide", "input-show");
            store.classList.replace("input-hide", "input-show");
            reservation.classList.replace("input-hide", "input-show");
            state.classList.replace("input-show", "input-hide");
            city.classList.replace("input-show", "input-hide");
            country.classList.replace("input-show", "input-hide");
            statuss.classList.replace("input-show", "input-hide");
        } else if(icon.classList.contains("fa-minus")){
            icon.classList.replace("fa-minus", "fa-search");
            /*search.classList.add("box");
            search.classList.remove("hidden");*/
            /*search.classList.replace("input-hide", "input-show");
            search1.classList.replace("input-show", "input-hide");
            search2.classList.replace("input-show", "input-hide");*/
            
            searchz.classList.replace("input-hide", "input-show");
            price.classList.replace("input-show", "input-hide");
            store.classList.replace("input-show", "input-hide");
            reservation.classList.replace("input-show", "input-hide");
            state.classList.replace("input-show", "input-hide");
            city.classList.replace("input-show", "input-hide");
            country.classList.replace("input-show", "input-hide");
            statuss.classList.replace("input-show", "input-hide");
            time.classList.replace("input-show", "input-hide");
        } else if(icon.classList.contains("fa-plus")){
            icon.classList.replace("fa-plus", "fa-minus");
            /*search2.classList.replace("input-hide", "input-show");
            search1.classList.replace("input-show", "input-hide");
            search.classList.replace("input-show", "input-hide");*/
            /*search.classList.add("hidden");
            search.classList.remove("show");
            search2.classList.add("show");
            search2.classList.remove("hidden");*/
            searchz.classList.replace("input-show", "input-hide");
            
            time.classList.replace("input-show", "input-hide");
            price.classList.replace("input-show", "input-hide");
            store.classList.replace("input-show", "input-hide");
            reservation.classList.replace("input-show", "input-hide");
            
            state.classList.replace("input-hide", "input-show");
            city.classList.replace("input-hide", "input-show");
            country.classList.replace("input-hide", "input-show");
            statuss.classList.replace("input-hide", "input-show");
        } 
        /*else{
            icon.classList.replace("fa-times", "fa-bars");
        }*/
    }
</script>

</body>
</html>