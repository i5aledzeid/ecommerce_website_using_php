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
   $image_folder_01 = '../uploaded_img/ad/'.$image_01;
  
   $select_products = $conn->prepare("SELECT * FROM `advertisement` WHERE id = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `advertisement`(title, subtitle, link, button, image, created_by) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $link, $button, $image_01, $admin_id]);

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
   $delete_product_image = $conn->prepare("SELECT * FROM `advertisement` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `advertisement` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   header('location: ads.php');
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
   <title>add ad</title>

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

   <h1 class="heading">add ad | إضافة إعلان</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>إسم الإعلان (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter ad name" name="name">
         </div>
        <div class="inputBox">
            <span>صور الإعلان (مطلوب)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>تفاصيل الإعلان (مطلوب)</span>
            <textarea name="details" placeholder="enter ad details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>رابط الإعلان (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter ad link" name="link">
         </div>
         <div class="inputBox">
            <span>زر الإعلان (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter ad button" name="button">
         </div>
         <div class="inputBox">
            <span>منشئ الإعلان (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter ad created by" name="created_by">
         </div>
         <div class="inputBox">
            <span>حالة الإعلان (مطلوب)</span>
            <select class="form-select box" aria-label="Default select example" name="status">
              <option selected>Open select status</option>
              <option value="0">جديد</option>
              <option value="1">مفعل</option>
              <option value="2">منتهي</option>
            </select>
         </div>
         <div class="inputBox">
            <span>نوع الإعلان (مطلوب)</span>
            <select class="form-select box" aria-label="Default select example" name="type">
              <option selected>Open select type</option>
              <option value="0">اعلان الصفحة الرئيسية</option>
              <option value="1">إعلان مع المنتجات</option>
              <option value="2">إعلان مختصر</option>
            </select>
         </div>
         <div class="inputBox">
            <span>تاريخ إنشاء الإعلان (مطلوب)</span>
            <input type="datetime" class="box" required maxlength="100" placeholder="<?php echo date('d-m-y H:i:s'); ?>" value="<?php echo date('d-m-y H:i:s'); ?>" name="created_at" disabled>
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