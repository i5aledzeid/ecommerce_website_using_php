<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send_bank_transfers'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $subtitle = $_POST['subtitle'];
   $subtitle = filter_var($subtitle, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $note = $_POST['note'];
   $note = filter_var($note, FILTER_SANITIZE_STRING);
   
   $tid = rand(10, 100000000000);

   $image_01 = $_FILES['image']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image']['size'];
   $image_tmp_name_01 = $_FILES['image']['tmp_name'];
   $image_folder_01 = 'uploaded_img/bank_transfers/'.$image_01;

   $select_products = $conn->prepare("SELECT * FROM `bank_transfers` WHERE tid = ?");
   $select_products->execute([$tid]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `bank_transfers`(tid, title, subtitle, price, image, note, created_by) VALUES(?,?,?,?,?,?,?)");
      $insert_products->execute([$tid, $title, $subtitle, $price, $image_01, $note, $user_id]);

      if($insert_products){
         //if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000 OR $image_size_04 > 2000000){
         if($image_size_01 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            /*move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_04, $image_folder_04);*/
            $message[] = 'new product added!';
         }

      }

   }  
   

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>send bank transfers</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="contact">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>get bank transfers</h3>
      <input type="text" name="title" placeholder="enter your title" required maxlength="20" class="box">
      <input type="text" name="subtitle" placeholder="enter your subtitle" required maxlength="255" class="box">
      <input type="number" name="price" min="0" max="9999999999" placeholder="enter your price" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
      <textarea name="note" class="box" placeholder="enter your note" cols="30" rows="10"></textarea>
      <input type="submit" value="send bank transfers" name="send_bank_transfers" class="btn">
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>