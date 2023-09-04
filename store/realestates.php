<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

if(!isset($admin_id) && !isset($user_id)){
   header('location: index.php');
};

    $select_system = $conn->prepare("SELECT * FROM `system`");
    $select_system->execute();
    $number_of_system = $select_system->rowCount();
    
    $select_products = $conn->prepare("SELECT * FROM `reservation` WHERE sid='$user_id'");
    $select_products->execute();
    $count = $select_products->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>طلبات العقارات الخاصة بك</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
     <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="../css/progress.css">
        
        <style>
        #alink:hover {
          background-color: yellow;
        }
        
        #status {
            color: white;
            padding: 8px;
            background: red;
            position: relative;
            font-size: 12px;
            top: 8px;
            right: 8px;
            width: 72px;
            transition: width 1s;
        }
        
        #status:hover {
            width: 82px;
        }
        </style>

        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="show-products">

   <h1 class="heading">
       طلبات العقارات الخاصة بك
    <?php echo '(' . $count . ')'; ?>
    </h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `reservation` WHERE sid='$user_id' ORDER BY `reservation`.`user_id` ASC");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
       <?php if ($fetch_products['status'] == 0) {
            echo '<a id="status" href="#" style="background: #6C757D;">' . 'محجوز فقط' . '</a>';
        } else if ($fetch_products['status'] == 1) {
            echo '<a id="status" href="#" style="background: #198754;">' . 'تم السكن' . '</a>';
        } else if ($fetch_products['status'] == 2) {
            echo '<a id="status" href="#" style="background: #DC3545;">' . 'باقي سبعة أيام' . '</a>';
        } ?>
      <img src="../uploaded_img/real_estate/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
        <?php
            $id = $fetch_products['user_id'];
            $select_product = $conn->prepare("SELECT * FROM `users` WHERE id='$id'");
            $select_product->execute();
            if($select_product->rowCount() > 0){
            $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC); ?>
                <div class="name"><?= '[' . $id . '] by: ' . $fetch_product['name']; ?></div>
        <?php } ?>
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
        <!--<div class="w3-light-grey">
          <div class="w3-container w3-green w3-center" style="width:75%; font-size: 15px; direction: ltr;">
              <?php
                $bday = new DateTime(''.$ss.'');
                $today = new DateTime(''.$dd.'');
                $diff = $today->diff($bday);
                printf('متبقي %d سنة %d شهر %d يوم', $diff->y, $diff->m, $diff->d);
                printf("\n");
              ?>
          </div>
        </div><br>-->
        <div class="w3-light-grey">
            <?php
            $ss = $fetch_products['start_date'];
            $dd = $fetch_products['end_date'];
            $date1 = strtotime($ss);
            $date2 = strtotime($dd);
            $diff = $date2 - $date1;
            $days = floor($diff / (60 * 60 * 24));
            //echo $days;
            $dateNow = strtotime(date('Y-m-d'));
            $date3 = strtotime($ss);
            $diff2 = $dateNow - $date3;
            $dayz = floor($diff2 / (60 * 60 * 24));
            $percentage = ($dayz / $days) * 100;
            if ($percentage > 90) {
            ?>
          <div class="w3-container w3-red w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if ($percentage > 50) { ?>
          <div class="w3-container w3-green w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } else if (is_nan($percentage)) { ?>
          <div class="w3-container w3-nan w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format(0) . '%'; ?>
          </div>
          <?php } else { ?>
          <div class="w3-container w3-yellow w3-center" style="width: <?= $percentage; ?>%; font-size: 15px; direction: ltr;">
              <?= number_format($percentage) . '%'; ?>
          </div>
          <?php } ?>
        </div><br>
      <div class="details">
          <span><?= $fetch_products['sid']; ?></span>
          <span>(<?= $fetch_products['store']; ?>)</span>
      </div>
      <div class="flex-btn">
         <a href="update_reservation.php?update=<?= $fetch_products['id']; ?>" class="option-btn">تحديث الحالة</a>
         <!--<a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>-->
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>
  <script src="scripts.js"></script>

   
</body>
</html>