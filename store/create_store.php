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

   $select_products = $conn->prepare("SELECT * FROM `store` WHERE id = ?");
   $select_products->execute([$user_id]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
        $date = date('Y-m-d H:i:s');
      $insert_products = $conn->prepare("INSERT INTO `store`(title,	subtitle, status, created_by, created_at) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $user_id, $date]);
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
   header('location: products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Store [<?php echo 'UID:' . $user_id; ?>]</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<?php
    $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
    $select_products->execute();
    if($select_products->rowCount() == 0) {
?>

<section class="add-products" style="direction: rtl;">

   <h1 class="heading">
       إضافة سوق
       <?php echo $date = date('Y-m-d H:i:s');?>
   </h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>إسم السوق (مطلوب)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter store name" name="name">
         </div>
        <!--<div class="inputBox">
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
        </div>-->
         <div class="inputBox">
            <span>وصف السوق (مطلوب)</span>
            <textarea name="details" placeholder="enter store details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
         <div class="inputBox">
            <span>حالة السوق (مطلوب)</span>
            <input type="number" min="0" class="box" required max="9" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price" value="0" readonly>
         </div>
         <!--<div class="inputBox">
            <span>العلامة التجارية للمنتج (مطلوب)</span>-->
            <!--<input type="text" class="box" required maxlength="100" placeholder="enter product brand" name="brand">-->
            <!--<select class="box" name="brand" id="brand">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `brand`");
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
      </div>-->
      
      <input type="submit" value="إضافة سوق" class="btn" name="add_product">
   </form>

</section>
<?php } ?>

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

<?php
    $select_products = $conn->prepare("SELECT * FROM `store` WHERE created_by='$user_id'");
    $select_products->execute();
    if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
?>

<section class="show-products" style="position: absolute; z-index: -1; width: 100%; left: -32px; top: 0px;">
    <img src="../images/<?= $fetch_products['background']; ?>" alt="logo" style="position: absolute; z-index: -1; width: 115%; height: 328px;">
</section>

<section class="show-products">

   <h1 class="heading" style="font-size: 16px;">stores added</h1>

   <div class="box-container">

    <div class="box" style="width: 600px;">
        <img src="../images/<?= $fetch_products['image']; ?>" alt="" style="width: 72px; position: absolute; top: 210px; left: 50.5%;">
        <img src="../images/<?= $fetch_products['background']; ?>" alt="" style="width: 100%;">
        <div class="name" style="width: 172px; position: absolute; top: 310px; left: 40%;"><?= $fetch_products['title']; ?>
        <?php
        $status = $fetch_products['status'];
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
        <?php } ?>
        </div>
        <div class="price" style="font-size: 12px;"><?= $fetch_products['subtitle']; ?></div>
        <div class="details" style="font-size: 8px;"><span><?= $fetch_products['created_at']; ?></span></div>
        <!--<div class="details">
            <span><?= $fetch_products['category']; ?></span>
            <span>(<?= $fetch_products['brand']; ?>)</span>
        </div>-->
        <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">تحديث</a>
         <a href="products.php" class="btn">إضافة منتج</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">حذف</a>
        </div>
    </div>
   <?php
         }
      }else{
         //echo '<p class="empty">no stores added yet!</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>
  <script src="scripts.js"></script>

   
</body>
</html>