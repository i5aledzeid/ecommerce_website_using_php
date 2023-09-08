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
        
        #country, #city, #state, #table, #status, #price, #time, #store, #reservation {
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
            #country, #city, #state, #status, #table, #price, #time, #store, #reservation {
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
            #country, #city, #state, #status, #table, #price, #time, #store, #reservation {
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
        <div class="toggle" style="width: 48px; height: 48px;;">
            <i class="fa fa-search" style="width: 48px;"></i>
        </div>
        <input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box input-show" style="text-align: right; width: 90%;" id="search">
        <select class="box input-show" name="table" id="table" style="width: 15%; text-align: right;">
            <?php
                $table = $_POST['table'];
                $val = "";
                if ($table == 'real_estates') {
                    $val = "العقارات";
                } else if ($table == 'store') {
                    $val = "الأسواق";
                } else if ($table == 'users') {
                    $val = "المستخدمين";
                } else if ($table == 'products') {
                    $val = "المنتجات";
                } else if ($table == 'deliveries') {
                    $val = "الموصل";
                }
                //$tables_ar = array("users"=>"المستخدمين", "store"=>"الأسواق", "products"=>"المنتجات", "real_estates"=>"العقارات", "deliveries"=>"الموصل");
                if ($table != '') { ?>
                    <option disabled value="">إختر نوع البحث</option>
                    <option selected value="<?= $table; ?>"><?= $val; ?></option>
                    <?php
                        $tables = array("users", "store", "products", "real_estates", "deliveries");
                        $tables_ar = array("المستخدمين", "الأسواق", "المنتجات", "العقارات", "الموصل");
                        for ($i = 0; $i < count($tables); $i++) {
                            if ($tables[$i] != $table) { ?>
                            <option value="<?= $tables[$i]; ?>"><?= $tables_ar[$i]; ?></option>
                        <?php } }
                    ?>
                <?php } else { ?>
                    <option selected disabled value="">إختر نوع البحث</option>
                    <option value="users">المستخدمين</option>
                    <option value="store">الأسواق</option>
                    <option value="products">المنتجات</option>
                    <option value="real_estates">العقارات</option>
                    <option value="deliveries">الموصلين</option>
                <?php }
            ?>
        </select>
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
            <?php
                $select_products = $conn->prepare("SELECT * FROM `store`");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?= $fetch_accounts['id']; ?>">
                            <?= $fetch_accounts['title']; ?>
                        </option>
            <?php } } ?>
        </select>
        <select class="box input-hide" name="reservation" id="reservation" style="width: 33%;">
            <option selected disabled value="">إختر الحجوزات</option>
            <option value="0">غير محجوز</option>
            <option value="1">محجوز</option>
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
        <select class="box input-hide" name="status" id="status" style="width: 33%;">
            <option selected disabled>إختر حالة العقار</option>
            <option value="0">إيجار</option>
            <option value="1">تمليك</option>
        </select>
        <button type="submit" name="search_btn" id="filter" style="width: 14%;">
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
        if ($price == 0 && $price != '') {
            $p = 'الأعلى سعر';
        } else if ($price == 1 && $price != '') {
            $p = 'الأقل سعر';
        }
        if ($time == 0 && $time != '') {
            $t = 'الأحدث';
        } else if ($time == 1 && $time != '') {
            $t = 'الأقدم';
        }
            echo 'search <span id="look">' . $search_box .
            '</span> country<span id="look">' . $country_id .
            '</span> state<span id="look">' . $state_id .
            '</span> city<span id="look">'. $city_id .
            '</span> status<span id="look">' . $status .
            '</span> store<span id="look">' . $store .
            '</span> time<span id="look">' . $t .
            '</span> price<span id="look">' . $p .
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

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
    $table = $_POST['table'];
    if ($table == 'real_estates') {
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
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
            ////////////////////////////// PRICE & TIME //////////////////////////////
            else if ($time == '1' && $price == '1' && $country_box == '' && $state_box == '' && $city_box == '') {
                $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`price` ASC, `real_estates`.`created_at` ASC"); 
            }
            else if ($time == '0' && $price == '0' && $country_box == '' && $state_box == '' && $city_box == '') {
                $select_products = $conn->prepare("SELECT * FROM `$table` WHERE category='Real Estate' AND name LIKE '%{$search_box}%' ORDER BY `real_estates`.`price` DEC, `real_estates`.`created_at` DEC"); 
            }
            ////////////////////////////// PRICE & TIME //////////////////////////////
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
    }
    else if ($table == 'store') {
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            if ($search_box != '') {
                $select_store = $conn->prepare("SELECT * FROM `$table` WHERE title LIKE '%{$search_box}%'"); 
            }
            else {
                $select_store = $conn->prepare("SELECT * FROM `$table`"); 
            }
         $select_store->execute();
         if($select_store->rowCount() > 0){
          while($fetch_store = $select_store->fetch(PDO::FETCH_ASSOC)){ ?>
            <form action="" method="post" class="box">
          <input type="hidden" name="pid" value="<?= $fetch_store['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_store['title']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_store['subtitle']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_store['image']; ?>">
          <!--<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_store['id']; ?>" class="fas fa-eye"></a>-->
          <img src="images/<?= $fetch_store['image']; ?>" alt="">
          <div class="name" style="font-weight: bold;">
              <?= $fetch_store['title']; ?>
              <?php
                        $status = $fetch_store['status'];
                        if ($status == 0) { ?>
                            <i class="fa fa-info-circle" style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>
                        <?php } else if ($status == 1) { ?>
                            <i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>
                        <?php } else if ($status == 2) { ?>
                            <i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>
                        <?php } else if ($status == 3) { ?>
                            <i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>
                        <?php } else if ($status == 4) { ?>
                            <i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>
                        <?php } else if ($status == 5) { ?>
                            <i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>
                        <?php } else if ($status == 6) { ?>
                            <!--<svg style="color: #1D9BF0;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                            </svg>-->
                            <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                            <script>
                                $(document).ready(function() {
                                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                                });
                            </script>
                        <?php } else if ($status == 7) { ?>
                            <i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>
                        <?php } ?>
          </div>
          <div class="name"><?= '[' . $fetch_store['created_by'] . '] ' . $fetch_store['subtitle']; ?></div>
          <div class="flex">
             <div class="price" style="font-size: 12px;"><?= $fetch_store['created_at']; ?></div>
          </div>
          <a href="../store/store.php?user_id=<?php echo $fetch_store['id'] ?>&id=<?php echo $user_id ?>" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> مشاهدة السوق </a>
          <!--<input type="submit" value="add to cart" class="btn" name="add_to_cart">-->
       </form>
        <?php }
          } else {
             echo '<p class="empty">no real estate found!</p>';
          }
        }
    }
    else if ($table == 'users') {
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            if ($search_box != '') {
                $select_users = $conn->prepare("SELECT * FROM `$table` WHERE name LIKE '%{$search_box}%'"); 
            }
            else {
                $select_users = $conn->prepare("SELECT * FROM `$table`"); 
            }
         $select_users->execute();
         if($select_users->rowCount() > 0){
          while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){ ?>
            <form action="" method="post" class="box">
          <input type="hidden" name="pid" value="<?= $fetch_users['id']; ?>">
          <input type="hidden" name="name" value="<?= $fetch_users['name']; ?>">
          <input type="hidden" name="price" value="<?= $fetch_users['subtitle']; ?>">
          <input type="hidden" name="image" value="<?= $fetch_users['image']; ?>">
          <!--<button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
          <a href="quick_view.php?pid=<?= $fetch_users['id']; ?>" class="fas fa-eye"></a>-->
          <?php
            $id = $fetch_users['id'];
            $select_user = $conn->prepare("SELECT * FROM `store` WHERE id = '$id'"); 
            $select_user->execute();
            if($select_user->rowCount() > 0){
                while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
                    $image = $fetch_user['image']; ?>
                      <img src="images/<?= $image; ?>" alt="logo">
                      <div class="name" style="font-weight: bold;">
                          <?= '@' . $fetch_users['name']; ?>
                          <?php
                                    $status = $fetch_user['status'];
                                    if ($status == 0) { ?>
                                        <i class="fa fa-info-circle" style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>
                                    <?php } else if ($status == 1) { ?>
                                        <i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>
                                    <?php } else if ($status == 2) { ?>
                                        <i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>
                                    <?php } else if ($status == 3) { ?>
                                        <i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>
                                    <?php } else if ($status == 4) { ?>
                                        <i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>
                                    <?php } else if ($status == 5) { ?>
                                        <i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>
                                    <?php } else if ($status == 6) { ?>
                                        <!--<svg style="color: #1D9BF0;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                        </svg>-->
                                        <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
                                        <script>
                                            $(document).ready(function() {
                                                $("[rel=tooltip]").tooltip({ placement: 'right'});
                                            });
                                        </script>
                                    <?php } else if ($status == 7) { ?>
                                        <i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>
                                    <?php } ?>
                      </div>
          <?php
                }
            }
          ?>
          <div class="name"><?= '<i class="bi bi-envelope-check-fill"></i> ' . $fetch_users['email']; ?></div>
          <div class="flex">
             <div class="price" style="font-size: 16px;"><i class="bi bi-telephone-fill"></i> <?= $fetch_users['phone']; ?></div>
          </div>
          <a href="../store/store.php?user_id=<?php echo $fetch_users['id'] ?>&id=<?php echo $user_id ?>" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> مشاهدة السوق </a>
          <!--<input type="submit" value="add to cart" class="btn" name="add_to_cart">-->
       </form>
        <?php }
          } else {
             echo '<p class="empty">no real estate found!</p>';
          }
        }
    }
    else if ($table == 'products') {
        if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
            $search_box = $_POST['search_box'];
            if ($search_box != '') {
                $select_product = $conn->prepare("SELECT * FROM `$table` WHERE name LIKE '%{$search_box}%'"); 
            }
            else {
                $select_product = $conn->prepare("SELECT * FROM `$table`"); 
            }
         $select_product->execute();
         if($select_product->rowCount() > 0){
          while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){ ?>
                 <form action="" method="post" class="box">
                      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                      <input type="hidden" name="store" value="<?= $fetch_product['created_by']; ?>">
                      <input type="hidden" name="sid" value="<?= $fetch_product['sid']; ?>">
                      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                      <div class="name" style="font-weight: bold;"><?= $fetch_product['name']; ?></div>
                        <div class="name" style="font-size: 12px;">
                            <i class="bi bi-tags-fill"></i> <a href="category.php?category=<?php echo $fetch_product['category']; ?>">
                                <?= $fetch_product['category']; ?>
                                </a> (<?= $fetch_product['brand']; ?>)
                        </div>
                        <div class="name" style="font-size: 12px;"><?php
                            $created_at = $fetch_product['created_at'];
                            echo time_elapsed_string($created_at, true);
                        ?></div>
                      <div class="name" style="font-size: 16px; color: #198754;">
                        <i class="bi bi-shop"></i> <?= '[' . $fetch_product['sid'] . '] ' . $fetch_product['created_by']; ?>
                        <?php
                        $by = $fetch_product['created_by'];
                        $select_stores = $conn->prepare("SELECT * FROM `store` WHERE `title`='$by'"); 
                        $select_stores->execute();
                        if($select_stores->rowCount() > 0){
                            while($fetch_store = $select_stores->fetch(PDO::FETCH_ASSOC)){ ?>
                                <?php
                                    $status = $fetch_store['status'];
                                    if ($status == 0) {
                                        echo '<i class="fa fa-info-circle" style="color: #0D6EFD;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>';
                                    } else if ($status == 1) {
                                        echo '<i class="bi bi-exclamation-triangle" style="color: #F58F3C;" rel="tooltip" title="حظر مؤقت" id="blah"></i>';
                                    } else if ($status == 2) {
                                        echo '<i class="bi bi-exclamation-circle" style="color: #6C757D;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>';
                                    } else if ($status == 3) {
                                        echo '<i class="fa fa-check" style="color: #198754;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>';
                                    } else if ($status == 4) {
                                        echo '<i class="bi bi-sign-stop-fill" style="color: #DC3545;" rel="tooltip" title="حظر تام" id="blah"></i>';
                                    } else if ($status == 5) {
                                        echo '<i class="bi bi-coin" style="color: #198754;" rel="tooltip" title="سوق محترف" id="blah"></i>';
                                    } else if ($status == 6) {
                                        echo '<i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>';
                                    }
                                
                            }
                        }
                        ?>
                        <script>
                            $(document).ready(function() {
                                $("[rel=tooltip]").tooltip({ placement: 'right'});
                            });
                        </script>
                    </div>
                      <div class="flex">
                         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                      </div>
                      <div class="name">
                      <?php
                        /*$i = $fetch_product['id'];
                        $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE `pid`='$i'"); 
                        $select_comments->execute();
                        $count = $select_comments->rowCount();*/
                        //if($select_comments->rowCount() > 0){
                            //while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                                //echo $fetch_comment['pid'];
                                /*if ($count > 999) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> 1K comments';
                                }
                                else if ($count > 99) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> +99 comments';
                                }
                                else if ($count > 0 && $count > 1) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comments';
                                } else {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comment';
                                }*/
                            //}
                        //}
                      ?>
                  </div>
                  <br>
                    <div class="flex" style="font-size: 16px;">
                      <?php
                        $i = $fetch_product['id'];
                        $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE `pid`='$i'"); 
                        $select_comments->execute();
                        $count = $select_comments->rowCount();
                        //if($select_comments->rowCount() > 0){
                            //while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){
                                //echo $fetch_comment['pid'];
                                if ($count > 999) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> 1K comments';
                                }
                                else if ($count > 99) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> +99 comments';
                                }
                                else if ($count > 0 && $count > 1) {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comments';
                                } else {
                                    echo '<i class="bi bi-chat-left-fill" style="font-size: 16px;"></i> ' . $count . ' comment';
                                }
                            //}
                        //}
                      ?>
                      <br>
                        <a id="like-button" name="like">
                        <?php
                            $pid = $fetch_product['id'];
                            $like = 1;
                            $dislike = 1;
                            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid='$pid' AND likes='1'");
                            $select_likes->execute();
                            $number_of_likes = $select_likes->rowCount();
                            if ($number_of_likes > 0) {
                                echo $number_of_likes . ' <i class="bi bi-hand-thumbs-up-fill" name="like" style="color: #198754;"></i>';
                            }
                            else {
                                echo '0 <i class="bi bi-hand-thumbs-up-fill" name="like" style="color: #198754;"></i>';
                            }
                        ?>
                        </a>
                        <a id="dislike-button" name="dislike">
                        <?php
                            $pid = $fetch_product['id'];
                            $like = 1;
                            $dislike = 1;
                            $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE pid='$pid' AND dislike='1'");
                            $select_likes->execute();
                            $number_of_likes = $select_likes->rowCount();
                            if ($number_of_likes > 0) {
                                echo $number_of_likes . ' <i class="bi bi-hand-thumbs-down-fill" name="dislike" style="color: #DC3545;"></i>';
                            }
                            else {
                                echo '0 <i class="bi bi-hand-thumbs-down-fill" name="dislike" style="color: #DC3545;"></i>';
                            }
                        ?>
                        </a>
                  </div>
                    <?php if ($user_id != $fetch_product['sid']) { ?>
                        <input type="submit" value="أضف للسلة" class="btn" name="add_to_cart">
                    <?php } else { ?>
                        <input type="button" value="لا يمكن إضافة منتج من نفس السوق" class="btn" name="" style="background: white; color: black;">
                    <?php } ?>
       </form>

        <?php }
          } else {
             echo '<p class="empty">no real estate found!</p>';
          }
        }
    }
   ?>

   </div>

</section>

<!--<section class="products" style="padding-top: 0; min-height:100vh;">
   
   <div class="box-container" id="result"></div>

</section>-->











<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#search").keyup(function() {
            var input = $(this).val();
            //alert(input);
            if (input != "") {
                $.ajax({
                   url: "search_function.php",
                   method: "POST",
                   data: {input:input},
                   success: function(data) {
                       $("#result").html(data);
                       $("#result").css("display", "block");
                   }
                });
            }
            else {
                $("#result").css("display", "none");
            }
        });
        
        /*$('#table').on('change', function() {
            //var table = $(this).val();
            //alert(table);
            var table = this.value;
            if (table != "") {
                alert(table);
                $.ajax({
                   url: "search_function.php",
                   method: "POST",
                   data: {input:table},
                   success: function(data) {
                       $("#result").html(data);
                       $("#result").css("display", "block");
                   }
                });
            }
            else {
                $("#result").css("display", "none");
            }
        });*/
    });
</script>

<script>
    
</script>

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
    let btn = document.querySelector(".toggle");
    let icon = btn.querySelector(".fa-search");
    
    var time = document.getElementById("time");
    var price = document.getElementById("price");
    var store = document.getElementById("store");
    var reservation = document.getElementById("reservation");
    var state = document.getElementById("state");
    var city = document.getElementById("city");
    var country = document.getElementById("country");
    var statuss = document.getElementById("status");
    var searchz = document.getElementById("search");
    var table = document.getElementById("table");
    
    btn.onclick = function() {
        if (icon.classList.contains("fa-search")){
            icon.classList.replace("fa-search", "fa-plus");
            
            searchz.classList.replace("input-show", "input-hide");
            table.classList.replace("input-show", "input-hide");
            
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
            
            searchz.classList.replace("input-hide", "input-show");
            table.classList.replace("input-hide", "input-show");
            
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
            searchz.classList.replace("input-show", "input-hide");
            
            table.classList.replace("input-show", "input-hide");
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