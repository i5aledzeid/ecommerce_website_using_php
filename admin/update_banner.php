<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $name2 = $_POST['name2'];
   $name2 = filter_var($name2, FILTER_SANITIZE_STRING);
   $details2 = $_POST['details2'];
   $details2 = filter_var($details2, FILTER_SANITIZE_STRING);
   $name3 = $_POST['name3'];
   $name3 = filter_var($name3, FILTER_SANITIZE_STRING);
   $details3 = $_POST['details3'];
   $details3 = filter_var($details3, FILTER_SANITIZE_STRING);
   $name4 = $_POST['name4'];
   $name4 = filter_var($name4, FILTER_SANITIZE_STRING);
   $details4 = $_POST['details4'];
   $details4 = filter_var($details4, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `banner` SET title_1 = ?, subtitle_1 = ?, title_2 = ?, subtitle_2 = ?, title_3 = ?, subtitle_3 = ?, title_4 = ?, subtitle_4 = ? WHERE id = ?");
   $update_product->execute([$name, $details, $name2, $details2, $name3, $details3, $name4, $details4, $pid]);

   $message[] = 'product updated successfully!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/banner/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `banner` SET image_1 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/banner/'.$old_image_01);
         $message[] = 'image updated successfully!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/banner/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `banner` SET image_2 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/banner/'.$old_image_02);
         $message[] = 'background updated successfully!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/banner/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `banner` SET image_3 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/banner/'.$old_image_03);
         $message[] = 'icon updated successfully!';
      }
   }

   $old_image_04 = $_POST['old_image_04'];
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = '../uploaded_img/banner/'.$image_04;

   if(!empty($image_04)){
      if($image_size_04 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_04 = $conn->prepare("UPDATE `banner` SET image_4 = ? WHERE id = ?");
         $update_image_04->execute([$image_04, $pid]);
         move_uploaded_file($image_tmp_name_04, $image_folder_04);
         unlink('../uploaded_img/banner/'.$old_image_04);
         $message[] = 'icon updated successfully!';
      }
   }

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
   <title>update banner</title>

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

<section class="update-product">

   <h1 class="heading">update banner</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `banner` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_1']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_2']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_3']; ?>">
      <input type="hidden" name="old_image_04" value="<?= $fetch_products['image_4']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/banner/<?= $fetch_products['image_1']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/banner/<?= $fetch_products['image_1']; ?>" alt="">
            <img src="../uploaded_img/banner/<?= $fetch_products['image_2']; ?>" alt="">
            <img src="../uploaded_img/banner/<?= $fetch_products['image_3']; ?>" alt="">
            <img src="../uploaded_img/banner/<?= $fetch_products['image_4']; ?>" alt="">
         </div>
      </div>

      <span>system name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['title_1']; ?>">
      <!--<span>update price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">-->
      <span>system details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle_1']; ?></textarea>
      <span>system image 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      
      <span>system name2</span>
      <input type="text" name="name2" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['title_2']; ?>">
      <span>system details2</span>
      <textarea name="details2" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle_2']; ?></textarea>
      <span>system image 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      
      <span>system name3</span>
      <input type="text" name="name3" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['title_3']; ?>">
      <span>system details3</span>
      <textarea name="details3" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle_3']; ?></textarea>
      <span>system image 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      
      <span>system name4</span>
      <input type="text" name="name4" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['title_4']; ?>">
      <span>system details4</span>
      <textarea name="details4" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle_4']; ?></textarea>
      <span>system image 04</span>
      <input type="file" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">

      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="banners.php" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no sysyem found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>