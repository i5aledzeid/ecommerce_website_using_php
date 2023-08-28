<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

if(!isset($admin_id) && !isset($user_id)){
   header('location: index.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   
   $start = $_POST['start_date'];
   $start = filter_var($start, FILTER_SANITIZE_STRING);
   $end = $_POST['end_date'];
   $end = filter_var($end, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `reservation` SET status = ?, start_date = ?, end_date = ? WHERE id = ?");
   $update_product->execute([$status, $start, $end, $pid]);

   $message[] = 'product updated successfully!';
   header ('Location: index.php?user_id='.$user_id.'');
   
   /*$old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `reservation` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'image 01 updated successfully!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `reservation` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/'.$old_image_02);
         $message[] = 'image 02 updated successfully!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `reservation` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/'.$old_image_03);
         $message[] = 'image 03 updated successfully!';
      }
   }*/

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update reservation</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">update reservation</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `reservation` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/real_estate/<?= $fetch_products['image']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/real_estate/<?= $fetch_products['image']; ?>" alt="">
            <img src="../uploaded_img/real_estate/<?= $fetch_products['image']; ?>" alt="">
            <img src="../uploaded_img/real_estate/<?= $fetch_products['image']; ?>" alt="">
         </div>
      </div>
      <span>update name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['name']; ?>">
      <span>update status (<?= $fetch_products['status']; ?>)</span>
      <br>
        <select class="form-select box" aria-label="Default select example" name="status" required>
          <option selected disabled>إختر حالة العقار</option>
          <option value="0">تم الحجز</option>
          <option value="1">تم التأكيد</option>
          <option value="2">قاربت على الإنتهاء</option>
        </select>
      <br>
      <span>update price</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
      <!--<span>update details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      <span>update image 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>update image 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>update image 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">-->
      <div class="flex-btn">
          <div>
            <span>start date</span>
            <!--<input type="date" id="start_date" name="start_date" value="<?php echo $date = date('Y-m-d'); ?>" min="1996-06-09" max="2060-12-31" required class="box"/>-->
            <?php $date = $fetch_products['start_date'];
            $end_date = $fetch_products['end_date']; ?>
            <input type="date" id="start_date" name="start_date" value="<?php echo $date; ?>" min="1996-06-09" max="2060-12-31" class="box"/>
          </div>
          <div>
            <span>end date</span>
            <!--<input type="date" id="end_date" name="end_date" placeholder="<?php echo date('Y-m-d', strtotime($date. ' + 30 days')); ?>" min="1996-06-09" max="2060-12-31" class="box"/>-->
            <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>" min="1996-06-09" max="2060-12-31" class="box"/>
          </div>
      </div>
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="update">
         <a href="index.php?user_id=<?= $user_id; ?>" class="option-btn">go back</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>