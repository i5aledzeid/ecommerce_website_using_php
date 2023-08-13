<?php

include '../components/connect.php';

session_start();

if(isset($_SESSION['delivery_id'])){
   $delivery_id = $_SESSION['delivery_id'];
}else{
   $delivery_id = '';
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

   $select_user = $conn->prepare("SELECT * FROM `deliveries` WHERE email = ? OR phone = ?");
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
         
         $insert_user = $conn->prepare("INSERT INTO `deliveries`(name, phone, email, password) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $phone, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
         header('Location: delivery_login.php');
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
   <link rel="stylesheet" href="../css/home-style.css">
   
   <!-- https://icons.getbootstrap.com -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- phone validation -->
    <!--<link rel="stylesheet" href="../functions/phone-number-validation/css/intlTelInput.css">-->

</head>
<body>
   
<?php include '../components/delivery_header.php'; ?>

<section class="form-container" style="direction: rtl; text-align: right;">

   <form action="" method="post">
      <h3>أنشئ حساب جديد</h3>
      <input type="text" name="name" required placeholder="أدخل إسم مستخدم" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="أدخل بريد إلكتروني" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <!--<input type="tel" id="phone" name="phone" maxlength="3" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required placeholder="1+" class="box" style="text-align: center; width: 110px;" oninput="this.value = this.value.replace(/\s/g, '')">-->
      <input type="tel" id="phone" name="phone" maxlength="10" required placeholder="أدخل رقم هاتفك"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="أدخل كلمة المرور" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="أعد إدخال كلمة المرور" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="أنشئ حساب جديد الآن" class="btn" name="submit">
      <p>تملك حساباً بالفعل؟</p>
      <a href="user_login.php" class="option-btn">سجل دخول الآن</a>
   </form>

</section>













<?php include '../components/footer.php'; ?>

<script src="../js/script.js"></script>

<!--<script src="../functions/phone-number-validation/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {});
</script>-->


</body>
</html>