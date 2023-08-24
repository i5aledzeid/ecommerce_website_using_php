<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR phone = ?");
   $select_user->execute([$email, $phone]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
    /******************* CREATE NEW STORE *********************/
    /*$subtitle = $name + " store.";
    $image = "avatar_male_man_portrait_icon.png";
    $background = "home-bg-1.png";
    $status = 0;*/
    /******************* CREATE NEW STORE *********************/

   if($select_user->rowCount() > 0){
      $message[] = 'email/phone already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
        /*$insert_strore = $conn->prepare("INSERT INTO `store`(title, subtitle, status, image, background) VALUES(?,?,?,?,?,?)");
        $insert_strore->execute([$name, $subtitle, $status, $image, $background]);*/
         
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, phone, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $phone, $cpass]);
         $message[] = 'registered successfully, login now please!';
         header('Location: user_login.php');
         //header('Location: splash.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container" style="direction: rtl; text-align: right;">

   <form action="" method="post">
      <h3>أنشئ حساب جديد</h3>
      <input type="text" name="name" required placeholder="أدخل إسم مستخدم" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="أدخل بريد إلكتروني" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="tel" name="phone" required placeholder="أدخل رقم الهاتف" maxlength="10" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="أدخل كلمة المرور" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="أعد إدخال كلمة المرور" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="أنشئ حساب جديد الآن" class="btn" name="submit">
      <p>تملك حساباً بالفعل؟</p>
      <a href="user_login.php" class="option-btn">سجل دخول الآن</a>
   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>