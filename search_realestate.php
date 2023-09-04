<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

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
        }
    </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
        <input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box" style="text-align: right;" >
      <!--<input type="text" name="search_box" placeholder="...إبحث عن عقار باستخدام المكان او الاسم" maxlength="100" class="box" style="text-align: right;" required>-->
      <button type="submit" class="fas fa-search" name="search_btn" style="width: 10%"></button>
   </form>
</section>
<section class="search-form">
   <form action="" method="post">
        <!--<input type="range" class="form-range box" id="customRange1" style="width: 23%;">-->
        <select class="box" name="city" id="city"style="width: 33%;">
            <option selected disabled>إختر المدينة</option>
        </select>
        <select class="box" name="state" id="state" style="width: 33%;">
            <option selected disabled>إختر الولاية/المحافظة</option>
        </select>
        <select class="box" name="country" id="country" style="width: 33%;">
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
      <button type="submit" class="fas fa-filter" name="filter_btn" style="width: 10%;"></button>
   </form>
</section>

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
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
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
        if ($country_box != '' && $state_box == '' && $city_box == '' && $status == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' OR state ='$state_box' OR city ='$city_box'"); 
        } else if ($country_box != '' && $state_box != '' && $city_box == '' && $status == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' OR city ='$city_box'"); 
        } else if ($country_box != '' && $state_box != '' && $city_box != '' && $status == '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE country ='$country_box' AND state ='$state_box' AND city ='$city_box'"); 
        } else if ($status != '') {
        $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE status = '$status'"); 
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
                <div class="flex">
                   <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                   <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2)   return false;" value="1">
                </div>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
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
                <div class="flex">
                   <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                   <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2)   return false;" value="1">
                </div>
                <input type="submit" value="add to cart" class="btn" name="add_to_cart">
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

</body>
</html>