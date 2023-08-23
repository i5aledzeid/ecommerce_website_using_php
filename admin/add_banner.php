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
   $name4 = filter_var($name, FILTER_SANITIZE_STRING);
   $details4 = $_POST['details4'];
   $details4 = filter_var($details4, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;
   
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = '../uploaded_img/'.$image_04;

   $select_products = $conn->prepare("SELECT * FROM `banner` WHERE id = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `banner`(title_1, title_2, title_3, title_4, subtitle_1, subtitle_2, subtitle_3, subtitle_4, image_1, image_2, image_3, image_4, created_by) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $name2, $details2, $name3, $details3, $name4, $details4, $image_01, $image_02, $image_03, $image_04, $admin_id]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000 OR $image_size_04 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_04, $image_folder_04);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
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
   <title>add banner</title>

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

<section class="add-products">

   <h1 class="heading">add banner | إضافة بانر</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>إسم البانر 1 (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
         </div>
         <div class="inputBox">
            <span>إسم البانر 2 (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name2">
         </div>
         <div class="inputBox">
            <span>إسم البانر 3 (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name3">
         </div>
         <div class="inputBox">
            <span>إسم البانر 4 (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name4">
         </div>
        <div class="inputBox">
            <span>صور 1 المنتج (مطلوب)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 2 المنتج (مطلوب)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 3 المنتج (مطلوب)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>صور 4 المنتج (مطلوب)</span>
            <input type="file" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>تفاصيل المنتج 1 (مطلوب)</span>
            <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>تفاصيل المنتج 2 (مطلوب)</span>
            <textarea name="details2" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>تفاصيل المنتج 3 (مطلوب)</span>
            <textarea name="details3" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>تفاصيل المنتج 4 (مطلوب)</span>
            <textarea name="details4" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
          <div class="inputBox">
            <span>المنشئ (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name0" value="<?php echo $admin_id; ?>" readonly>
         </div>
      </div>
      
      <input type="submit" value="add banner | إضافة بانر" class="btn" name="add_product">
   </form>

</section>

<!--<section>
    <div class="wrapper">
        <header>File Uploader JavaScript</header>
        <form action="#">
          <input class="file-input" type="file" name="file" hidden>
          <i class="fas fa-cloud-upload-alt"></i>
          <p>Browse File to Upload</p>
        </form>
        <section class="progress-area"></section>
        <section class="uploaded-area"></section>
    </div>
</section>-->








<script src="../js/admin_script.js"></script>
  <script src="scripts.js"></script>

   
</body>
</html>