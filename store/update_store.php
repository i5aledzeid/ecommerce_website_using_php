<?php

include '../components/connect.php';

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

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
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
   <title>تحديث بيانات متجري</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/home-style.css">
   
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   
   <style>
        /*color: #1D9BF0;*/
        #blah {
            font-size: 20px;
            position: absolute;
            top: 28%;
            left: 50.5%;
            z-index: 999;
        }
        .background {
            position: absolute;
            top: 18%;
            left: 36.2%;
            width: 27.5%;
            z-index: 6;
        }
        .image-profile {
            position: absolute;
            top: 21%;
            left: 48%;
            width: 82px;
            z-index: 99;
        }
        #created-at {
            font-size: 14px;
            position: absolute;
            top: 32%;
            right: 37.5%;
            color: white;
            z-index: 9999;
        }
        #fileList {
            list-style: none;
            text-align: right;
        }
        #fileList2 {
            list-style: none;
            text-align: right;
        }
        input[type="file"] {
            display: none;
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            border-radius: 16px;
            display: inline-block;
            padding: 16px 12px;
            width: 100%;
            cursor: pointer;
        }
        .custom-file-upload:hover {
            border: 1px solid #FF4546;
            color: #FF4546;
        }
   </style>

</head>
<body>
   
<?php //include '../components/user_header.php'; 
include '../components/store_header.php'; ?>

<section class="form-container">
    
    <?php
    $select_store = $conn->prepare("SELECT * FROM `store` WHERE id = ?");
    $select_store->execute([$user_id]);
    if($select_store->rowCount() > 0){
        $fetch_store = $select_store->fetch(PDO::FETCH_ASSOC);
    ?>

   <form action="" method="post">
      <h3>بيانات متجري</h3>
      <img src="../images/<?= $fetch_store["background"]; ?>" alt="store_logo" class="background" id="background">
      <img src="../images/<?= $fetch_store["image"]; ?>" alt="store_logo" class="image-profile" id="image-profile">
      <a href="" id="created-at">
          <?php
            /*
            $earlier = new DateTime($fetch_store['created_at']);
            $later = new DateTime(date("Y-m-d h:i:s"));
            echo $abs_diff = $later->diff($earlier)->format("تم إنشاء السوق منذ %a يوماً"); //3
            */
            
            $created_at = $fetch_store['created_at'];
            include '../functions/count_time_ago.php';
            //echo '<br>Online ' . time_elapsed_string($created_at);
            //echo time_elapsed_string('@1367367755'); # timestamp input
            echo time_elapsed_string($created_at, true);
          ?>
      </a>
       <?php
        $status = $fetch_store['status'];
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
            <i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 18px;" rel="tooltip" title="المالك" id="blah"></i>
            <script>
                $(document).ready(function() {
                    $("[rel=tooltip]").tooltip({ placement: 'right'});
                });
            </script>
        <?php } else if ($status == 7) { ?>
            <i class="bi bi-buildings-fill" style="color: #198754;" rel="tooltip" title="سوق عقارات" id="blah"></i>
        <?php } ?>
      <input type="hidden" name="prev_pass" value="<?= $fetch_store["password"]; ?>">
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" value="<?= $fetch_store["title"]; ?>" style="margin-top: 180px;">
        <a href="">Created at <?= $fetch_store["created_at"]; ?>, Last seen 4 days ago</a>
      <textarea type="email" name="email" required placeholder="enter your email" maxlength="50" rows="3" class="box" oninput="this.value = this.value.replace(/\s/g, '')"><?= $fetch_store["subtitle"]; ?></textarea>
        
        <label class="custom-file-upload" title="تحميل صورة العرض">
            <input type="file" name="file" id="file" class="box file" multiple onchange="javascript:updateList()" />
            تحميل الصورة الشخصية
            &nbsp;<i class="bi bi-upload" style="font-size: 16px;"></i>
        </label><br><br>
        <label class="custom-file-upload" title="تحميل صورة الغلاف">
            <input type="file" name="file2" id="file2" class="box file" multiple onchange="javascript:updateList2()" />
            تحميل صورة الغلاف
            &nbsp;<i class="bi bi-upload" style="font-size: 16px;"></i>
        </label>
        <br><div id="fileList"></div>
        <br><div id="fileList2"></div>
        
      <input type="submit" value="تحديث بيانات المتجر" class="btn" name="submit">
   </form>
   
   <?php } ?>

</section>













<?php include '../components/footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
updateList = function() {
  var input = document.getElementById('file');
  var output = document.getElementById('fileList');

  output.innerHTML = '<br><ul>';
  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<li>' + input.files.item(i).name + ' [' + i + ']إسم الملف' + '</li>';
  }
  output.innerHTML += '</ul>';
}

updateList2 = function() {
  var input2 = document.getElementById('file2');
  var output2 = document.getElementById('fileList2');
  
  output2.innerHTML = '<ul>';
  for (var i = 0; i < input2.files.length; ++i) {
    //output2.innerHTML += '<li>Selected file[' + i + '] > ' + input2.files.item(i).name + '</li>';
    output2.innerHTML += '<li>' + input2.files.item(i).name + ' [' + i + ']إسم الغلاف' + '</li>';
  }
  output2.innerHTML += '</ul>';
}
</script>

<script src="../js/script.js"></script>

</body>
</html>