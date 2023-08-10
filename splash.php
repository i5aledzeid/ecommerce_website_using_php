<?php

include 'components/connect.php';

session_start();

$user_id = $_SESSION['user_id'];

/*if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};*/

if(isset($_POST['add_product'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $subtitle = "New Store";

   $select_products = $conn->prepare("SELECT * FROM `store` WHERE id = ?");
   $select_products->execute([$user_id]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
        $date = date('Y-m-d H:i:s');
      $insert_products = $conn->prepare("INSERT INTO `store`(title,	subtitle, status, created_by, created_at) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $subtitle, $price, $user_id, $date]);
      header("location: home.php");
   }
   header("location: home.php");
};
if(isset($_POST['skip_product'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $subtitle = "New Store";

   $select_products = $conn->prepare("SELECT * FROM `store` WHERE id = ?");
   $select_products->execute([$user_id]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
        $date = date('Y-m-d H:i:s');
      $insert_products = $conn->prepare("INSERT INTO `store`(title,	subtitle, status, created_by, created_at) VALUES(?,?,?,?,?)");
      $insert_products->execute([$name, $subtitle, $price, $user_id, $date]);
      header("location: home.php");
   }
   header("location: home.php");
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>شاشة ترحيب</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">

    <style><?php //include 'components/hide-brand-000webhost.css'; ?></style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content" style="direction: rtl;">
         <h3>مرحبا بك
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                echo $fetch_profile["name"];
            }
          ?>
         </h3>
         <p>عزيز العميل إذا كنت تريد إنشاء متجر لك حيث يتيح لك ذلك عرض منتجاتك واستقبال الطلبات من العملاء ومعرفة حالة الطلب والكثير من المميزات بالإضافة إلى التصنيف حيث يساعد هذا في نشر متجرك للإستفادة من ذلك في زيادة الأرباح.</p>
         <form action="" method="post" enctype="multipart/form-data">
            <button type="submit" class="btn" name="add_product" style="background: #FE4445;">
                إنشاء سوق <i class="bi bi-shop"></i>
            </button>&nbsp;
            <button type="submit" class="btn" name="skip_product" style="background: #FE4445;">
                المتابعة على كل حال
                <i class="bi bi-arrow-left-circle"></i>
            </button>
      </div>
      
          <div class="flex" style="direction: rtl; visibility: hidden;">
             <div class="inputBox">
                <span>إسم السوق (مطلوب)</span>
                <?php          
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                 ?>
                <input type="text" value="<?php echo $fetch_profile["name"]; ?>" class="box" required maxlength="100" placeholder="enter store name" name="name">
                <?php } ?>
             </div>
             <div class="inputBox">
                <span>صاحب السوق (مطلوب)</span>
                <input type="text" value="<?php echo $user_id; ?>" class="box" required maxlength="100" placeholder="enter store id" name="details" readonly>
             </div>
             <div class="inputBox">
                <span>حالة السوق (مطلوب)</span>
                <input type="number" min="0" class="box" required max="9" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price" value="0" readonly>
             </div>
            
        </form>
   </div>

</section>








<?php //include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>