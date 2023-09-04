<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $brand = $_POST['brand'];

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/banner/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/banner/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/banner/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `banner` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `banner`(name, details, price, image_01, image_02, image_03, category, brand) VALUES(?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `banner` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_04']);
   $delete_product = $conn->prepare("DELETE FROM `banner` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   header('location:banners.php');
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
   <title>banners</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
     <link rel="stylesheet" href="style.css">
     
        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="show-products" style="direction: rtl;">

   <h1 class="heading">
       الإعلانات
        <a href="add_ad.php?add=<?= $fetch_products['id']; ?>"><i class="fa fa-plus" aria-hidden="true" style="color: black;"></i></a>
   </h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `advertisement`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box" style="overflow-y: auto; height: 450px;">
       <br>
      <img src="../uploaded_img/ad/<?= $fetch_products['image']; ?>" alt="photo" style="height: 100px;">
      <br>
      <div class="name" style="font-weight: bold;"><?= $fetch_products['title']; ?></div>
      <div class="name"><?= $fetch_products['subtitle']; ?></div>
      <div class="price"><span><?= $fetch_products['link']; ?></span></div>
      <br>
      <div class="name" style="font-weight: bold;"><i class="bi bi-circle-fill"></i> <?= 'الحالة: ' . $fetch_products['status'] . '<br><i class="bi bi-circle-fill"></i> النوع: ' . $fetch_products['type']; ?></div>
      <div class="details">
          <span><?= $fetch_products['created_at']; ?></span>
      </div>
      <div class="flex-btn">
         <a href="update_ad.php?update=<?= $fetch_products['id']; ?>" class="option-btn">تحديث</a>
         <a href="ads.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this banner?');">
             <i class="fa fa-trash" aria-hidden="true"></i>
         </a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no banners added yet!</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>
  <script src="scripts.js"></script>

   
</body>
</html>