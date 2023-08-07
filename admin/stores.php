<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
// user permission
$user_id = $_SESSION['user_id'];

// if(!isset($admin_id)){
if(!isset($admin_id) && !isset($user_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>لوحة التحكم</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">
        stores
        <?php
            $select_messages = $conn->prepare("SELECT * FROM `store`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
        ?>
        <?= '('. $number_of_messages .')'; ?>
       |
       الأسواق
       <?php
            $select_messages = $conn->prepare("SELECT * FROM `store`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
        ?>
        <?= '('. $number_of_messages .')'; ?>
   </h1>

   <div class="box-container">
    
    <?php
    $select_messages = $conn->prepare("SELECT * FROM `store`");
    $select_messages->execute();
    $number_of_messages = $select_messages->rowCount();
    if($number_of_messages > 0){
        /*for ($x = 0; $x < $number_of_messages; $x++) {
            ?>
            <div class="box">
             <?php
                $select_messages = $conn->prepare("SELECT * FROM `store`");
                $select_messages->execute();
                $number_of_messages = $select_messages->rowCount()
             ?>
             <!--<h3><?= $number_of_messages; ?></h3>-->
             <h3></h3>
             <p>new store</p>
             <a href="messagess.php" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> مشاهدة السوق </a>
          </div>
            <?php
        }*/
        while($fetch_product = $select_messages->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="box">
                <h3><?= $fetch_product['title'] ?></h3>
                <p>new store</p>
                <a href="../store/store.php?user_id=<?php echo $fetch_product['id'] ?>" class="btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i> مشاهدة السوق </a>
            </div>
        <?php }
    }
    ?>
     
   </div>

</section>










<script src="../js/admin_script.js"></script>
   
</body>
</html>