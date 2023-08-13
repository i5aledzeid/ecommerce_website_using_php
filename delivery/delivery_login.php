<?php

include '../components/connect.php';

session_start();

if(isset($_SESSION['delivery_id'])){
   $delivery_id = $_SESSION['delivery_id'];
}else{
   $delivery_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `deliveries` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['delivery_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/home-style.css">
   
   <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body>
   
<?php include '../components/delivery_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>سجل دخولك الآن</h3>
      <input type="email" name="email" required placeholder="enter your email" maxlength="50" value="deliveries@gmail.com" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" value="12345678" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="تسجيل دخول" class="btn" name="submit">
      <p>لا تملك حساباً؟</p>
      <a href="delivery_register.php" class="option-btn">أنشئ حساب</a>
   </form>

</section>













<?php include '../components/footer.php'; ?>

<script src="../js/script.js"></script>

</body>
</html>