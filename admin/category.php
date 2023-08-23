<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
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
   <title>
        التصنيفات 
       <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            echo ' | ' . $fetch_profile['name'];
        ?>
   </title>

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

<section class="dashboard">

   <h1 class="heading">dashboard | لوحة التحكم</h1>

   <div class="box-container" style="direction: rtl;">
       
       <?php
          $select_orders = $conn->prepare("SELECT * FROM `category`");
          $select_orders->execute();
          if($select_orders->rowCount() > 0){
             while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
       ?>

      <div class="box">
         <h3><?= $fetch_orders['title']; ?></h3>
         <p><img src="../images/<?php echo $fetch_orders['image']; ?>" alt="logo" style="width: 64px;"></p>
         <p style="height: 220px; text-align: left; direction: ltr;"><?= $fetch_orders['subtitle']; ?></p>
         <a href="update_profile.php" class="btn">تحديث الملف الشخصي <i class="fa fa-database" aria-hidden="true"></i></a>
      </div>
      
      <?php } } ?>

   </div>

</section>










<?php include '../components/admin-footer.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>