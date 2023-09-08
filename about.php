<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">
   
    <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row" style="direction: rtl;">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>لماذا أخترتنا؟</h3>
         <p>
             معنا تستطيع ان تكون مستخدم حيث يتيح لك الاستطلاع عن المنتجات والاسواق والعقارات. كما يمكنك فتح سوق عام أو سوق عقاري حيث يمكنك عرض منتجاتك/عقارك باشتراك سنوي ب١٠٠ دولار فقط. أو يمكنك نشر إعلان بدولار واحد لشهر كامل ومتابعة حركة السوق فيما في ذلك الأرباح والإعلانات وغير من المميزات. كما يمكنك أيضاً الانضمام كموصل طلبات ومتابعة الطلبات وعرض سعر التوصيل. في الختام هناك مستخدم وسوق عام وعقاري وموصل طلبات كل تلك الخدمات بمقابل لا يتعدى ١٠٠ دولار في السنة وسنبقى محافظين على الجودة لذا نرجوا منكم إرسال الاقتراحات لرفع مستوى خدمتنا لكل العملاء.
         </p>
         <a href="contact.php" class="btn">اتصل بنا</a>
         <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=id21113871_shopy" class="btn">قاعدة البيانات</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">آراء العملاء</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">
       
        <?php
        $i = 1;
        $select_products = $conn->prepare("SELECT * FROM `store` WHERE status=6 OR status=3 OR status=5");
        $select_products->execute();
        $number_of_brand = $select_products->rowCount();
        if($select_products->rowCount() > 0) {
            while($fetch_accounts = $select_products->fetch(PDO::FETCH_ASSOC)) { ?>

      <div class="swiper-slide slide">
         <img src="images/<?= $fetch_accounts['image']; ?>" alt="">
         <p>
             نشركم على حسن خدمتكم ، وشكراً.
         </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3><?= $fetch_accounts['title']; ?></h3>
      </div>
      
      <?php } } ?>

      <!--<div class="swiper-slide slide">
         <img src="images/pic-2.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-3.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-4.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-5.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-6.png" alt="">
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>john deo</h3>
      </div>-->

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'components/footer.php'; ?>

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