<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['id'];
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $subtitle = $_POST['subtitle'];
   $subtitle = filter_var($subtitle, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `bank_transfers` SET status = ? WHERE id = ?");
   $update_product->execute([$status, $pid]);

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
         $update_image_01 = $conn->prepare("UPDATE `bank_transfers` SET image = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/banner/'.$old_image_01);
         $message[] = 'image updated successfully!';
      }
   }
   
   header("Location: bank_transfers.php");
   
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
   <title>update bank transfers</title>

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

    <?php
      $update_id = $_GET['id'];
      $select_products = $conn->prepare("SELECT * FROM `bank_transfers` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <h1 class="heading">update bank transfers</h1>
   <p class="heading">TID[<?= $fetch_products['tid']; ?>]</p>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/bank_transfers/<?= $fetch_products['image']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/bank_transfers/<?= $fetch_products['image']; ?>" alt="">
         </div>
      </div>

      <span>bank transfers name</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="enter product name" value="<?= $fetch_products['title']; ?>">
      <span>bank transfers details</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['subtitle']; ?></textarea>
      <span>bank transfers price</span>
      <input type="text" name="price" required class="box" maxlength="100" placeholder="enter product price" value="<?= $fetch_products['price']; ?>">
      <span>bank transfers status</span>
      <select class="form-select box" aria-label="Default select example" name="status">
          <?php if ($fetch_products['status'] == 0) {
                $status = 'pending';
            }
            if ($fetch_products['status'] == 1) {
                $status = 'completed';
            }
            if ($fetch_products['status'] == 2) {
                $status = 'cancelled';
            }
          ?>
          <option class="box" selected disabled><?= $status ?></option>
          <option class="box" value="0">معلق</option>
          <option class="box" value="1">تأكيد</option>
          <option class="box" value="2">إلغاء</option>
        </select>
      <span>bank transfers image</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="تحديث">
         <a href="bank_transfers.php" class="option-btn">العودة للخلف</a>
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