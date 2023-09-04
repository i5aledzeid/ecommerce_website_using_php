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
   
   $link = $_POST['link'];
   $link = filter_var($link, FILTER_SANITIZE_STRING);
   $button = $_POST['button'];
   $button = filter_var($button, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $created_by = $_POST['created_by'];
   $created_by = filter_var($created_by, FILTER_SANITIZE_STRING);
   $updated_at = date("Y-m-d h:i:s");

   $update_product = $conn->prepare("UPDATE `advertisement` SET title = ?, subtitle = ?, link = ?, button = ?, status = ?, type = ?, updated_at = ?, created_by = ? WHERE id = ?");
   $update_product->execute([$name, $details, $link, $button, $status, $type, $updated_at, $admin_id, $pid]);

   $message[] = 'advertisement updated successfully!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image']['size'];
   $image_tmp_name_01 = $_FILES['image']['tmp_name'];
   $image_folder_01 = '../uploaded_img/ad/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `advertisement` SET image = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/ad/'.$old_image_01);
         $message[] = 'ad image updated successfully!';
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
   <title>update ad</title>

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
      $select_products = $conn->prepare("SELECT * FROM `advertisement` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/ad/<?= $fetch_products['image']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/ad/<?= $fetch_products['image']; ?>" alt="">
         </div>
      </div>

      <span>ad name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter ad name" value="<?= $fetch_products['title']; ?>">
      <!--<span>update price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">-->
      <span>ad details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle']; ?></textarea>
      <span>ad link</span>
      <input type="text" name="link" required class="box" maxlength="100" placeholder="enter ad link" value="<?= $fetch_products['link']; ?>">
      <span>ad button</span>
      <input type="text" name="button" required class="box" maxlength="100" placeholder="enter ad button" value="<?= $fetch_products['button']; ?>">
        <span>ad status</span>
        <select class="form-select box" aria-label="Default select example" name="status">
          <option selected>Open select status</option>
          <option value="0">جديد</option>
          <option value="1">مفعل</option>
          <option value="2">منتهي</option>
        </select>
        <span>ad type</span>
        <select class="form-select box" aria-label="Default select example" name="type">
          <option selected>Open select type</option>
          <option value="0">اعلان الصفحة الرئيسية</option>
          <option value="1">إعلان مع المنتجات</option>
          <option value="2">إعلان مختصر</option>
        </select>
      <span>ad image 01</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>ad created at</span>
      <input type="text" name="created_at" required class="box" maxlength="100" placeholder="enter ad created at" value="<?= $fetch_products['created_at']; ?>" disabled>
      <span>ad created by</span>
      <input type="text" name="created_by" required class="box" maxlength="100" placeholder="enter ad created by" value="<?= $fetch_products['created_by']; ?>">
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