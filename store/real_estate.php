<?php

include '../components/connect.php';

session_start();

//$admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

/*if(!isset($admin_id)){
   header('location:admin_login.php');
};*/

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $brand = $_POST['brand'];
   $store = $_POST['store'];
   $sid = $_POST['sid'];
   $map = $_POST['map'];
   
   $country = $_POST['country'];
   $city = $_POST['city'];
   $state = $_POST['state'];
    $type = $_POST['type'];

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/real_estate/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/real_estate/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/real_estate/'.$image_03;
   
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = '../uploaded_img/real_estate/'.$image_04;
   
   $image_05 = $_FILES['image_05']['name'];
   $image_05 = filter_var($image_05, FILTER_SANITIZE_STRING);
   $image_size_05 = $_FILES['image_05']['size'];
   $image_tmp_name_05 = $_FILES['image_05']['tmp_name'];
   $image_folder_05 = '../uploaded_img/real_estate/'.$image_05;
   
   $image_06 = $_FILES['image_06']['name'];
   $image_06 = filter_var($image_06, FILTER_SANITIZE_STRING);
   $image_size_06 = $_FILES['image_06']['size'];
   $image_tmp_name_06 = $_FILES['image_06']['tmp_name'];
   $image_folder_06 = '../uploaded_img/real_estate/'.$image_06;

   $select_products = $conn->prepare("SELECT * FROM `real_estates` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `real_estates`(name, details, price, image_01, image_02, image_03, image_04, image_05, image_06, map, category, brand, country, city, state, type, created_by, sid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03, $image_04, $image_05, $image_06, $map, $category, $brand, $country, $city, $state, $type, $store, $sid]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000 OR $image_size_04 > 2000000 OR $image_size_05 > 2000000 OR $image_size_06 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_04, $image_folder_04);
            move_uploaded_file($image_tmp_name_05, $image_folder_05);
            move_uploaded_file($image_tmp_name_06, $image_folder_06);
            $message[] = 'new product added!';
         }

      }
      
      include 'Location: ../index.php';

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `real_estates` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>real estates</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
     <link rel="stylesheet" href="style.css">
     
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">add real estate | إضافة عقار</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>إسم للعقار (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter real estate name" name="name">
         </div>
         <div class="inputBox">
            <span>سعر للعقار (مطلوب)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter real estate price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>صور 1 للعقار (مطلوب)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 2 للعقار (مطلوب)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 3 للعقار (مطلوب)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 4 للعقار (مطلوب)</span>
            <input type="file" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 5 للعقار (مطلوب)</span>
            <input type="file" name="image_05" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 6 للعقار (مطلوب)</span>
            <input type="file" name="image_06" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>صنف للعقار (مطلوب)</span>
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product category" name="category">-->
            <select class="box" name="category" id="category">
                <?php
                    $select_category = $conn->prepare("SELECT * FROM `category` WHERE id='9'");
                    $select_category->execute();
                    $number_of_category = $select_category->rowCount();
                    if($select_category->rowCount() > 0) {
                        while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $fetch_category['title']; ?>">
                                <?php //echo $number_of_category; ?>
                                <?= $fetch_category['title']; ?>
                            </option>
                <?php } } ?>
            </select>
         </div>
        <div class="inputBox">
            <span>نوع العقار (مطلوب)</span>
            <select class="form-select box" aria-label="Default select example" name="type">
              <option selected>إختر نوع العقار</option>
              <option value="0">إيجار</option>
              <option value="1">تمليك</option>
            </select>
         </div>
         <div class="inputBox">
            <span>الدولة للعقار (مطلوب)</span>
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product brand" name="brand">-->
            <select class="box" name="brand" id="brand">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `country`");
                    $select_products->execute();
                    $number_of_brand = $select_products->rowCount();
                    if($select_products->rowCount() > 0) {
                        while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $fetch_accounts['nicename']; ?>">
                                <?= $fetch_accounts['nicename']; ?>
                            </option>
                <?php } } ?>
            </select>
         </div>
         <div class="inputBox">
            <span>الدولة للعقار (مطلوب)</span>
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product brand" name="brand">-->
            <select class="box" name="country" id="country">
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
         </div>
         <div class="inputBox">
            <span>الولاية للعقار (مطلوب)</span>
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product brand" name="brand">-->
            <select class="box" name="state" id="state">
                <option selected disabled>إختر الولاية/المحافظة</option>
            </select>
         </div>
         <div class="inputBox">
            <span>المدينة للعقار (مطلوب)</span>
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product brand" name="brand">-->
            <select class="box" name="city" id="city">
                <option selected disabled>إختر المدينة</option>
            </select>
         </div>
         <div class="inputBox">
            <span>المكان (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter real estate place" name="map">
         </div>
         <div class="inputBox">
            <span>رقم السوق (مطلوب)</span>
            <?php
                $select_products = $conn->prepare("SELECT * FROM `store` WHERE id='$user_id'");
                $select_products->execute();
                $number_of_brand = $select_products->rowCount();
                if($select_products->rowCount() > 0) {
                    while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                        <input type="text" name="sid" value="<?php echo $fetch_accounts['id']; ?>" class="box" readonly required>
            <?php } } ?>
         </div>
         <div class="inputBox">
            <span>إسم السوق (مطلوب)</span>
            <select class="box" name="store" id="store">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `store` WHERE id='$user_id'");
                    $select_products->execute();
                    $number_of_brand = $select_products->rowCount();
                    if($select_products->rowCount() > 0) {
                        while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?= $fetch_accounts['title']; ?>">
                                <?= $fetch_accounts['title']; ?>
                            </option>
                <?php } } ?>
            </select>
         </div>
         
      </div><br>
        <div class="inputBox">
            <span>تفاصيل للعقار (مطلوب)</span>
            <textarea name="details" placeholder="enter real estate details&#10;(max: 500 letter)" class="box" required maxlength="500" cols="30" rows="10" style="height: 250px;"></textarea>
            <a>لا تتعدى 500 كلمة.</a>
        </div>
      
      <input type="submit" value="add real estate | إضافة عقار" class="btn" name="add_product">
   </form>

</section>











<script src="../js/admin_script.js"></script>
  <script src="scripts.js"></script>
  
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