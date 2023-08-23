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

$status = $_GET['status'];
$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
       التحويلات البنكية
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
        
    <style>
        #customers {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: right;
          background-color: #04AA6D;
          color: white;
        }
        
        #customers {
            direction: ltr;
            text-align: right;
        }
        tr {
            text-align: center;
        }
    </style>

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading"> التحويلات البنكية </h1>
   
   <style>
        #links-container {
            direction: rtl;
        }
       #links {
           color: white;
           border-top-left-radius: 16px;
           background: #04AA6D;
           font-size: 18px;
           /*font-weight: bold;*/
           padding-top: 4px;
           padding-left: 8px;
           padding-right: 8px;
       }
       #back {
           color: white;
           border-top-right-radius: 16px;
           background: #04AA6D;
           font-size: 18px;
           /*font-weight: bold;*/
           padding-top: 4px;
           padding-left: 8px;
           padding-right: 8px;
       }
   </style>
   <div id="links-container">
       <?php
       if ($status == '') {
       ?>
       <a id="back" href="bank_transfers.php"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
       <a id="links" href="">المزيد من المعلومات</a>
       <?php } ?>
   </div>

   <div class="box-container" style="direction: rtl;">

      <div class="box" style="max-height: 530px; overflow: auto;">
      
      <table id="customers">
          <tr>
            <th style="text-align: center;">الوقت والتاريخ</th>
            <th style="text-align: center;">الحالة</th>
            <th style="text-align: center;">رابط الصورة</th>
            <th style="text-align: center; width: 400px;">الوصف / الصورة</th>
            <th style="text-align: center; width: 190px;">العنوان / المبلغ</th>
            <th style="text-align: center; width: 64px;">رقم التحويل</th>
          </tr>
          <?php
                if ($id != '') {
              $select_bank_transfers = $conn->prepare("SELECT * FROM `bank_transfers` WHERE tid='$id'");
                } else {
              $select_bank_transfers = $conn->prepare("SELECT * FROM `bank_transfers` WHERE tid='$id'");
                }
              $select_bank_transfers->execute();
              if($select_bank_transfers->rowCount() > 0){
                 while($fetch_bank_transfers = $select_bank_transfers->fetch(PDO::FETCH_ASSOC)){ 
                     if ($fetch_bank_transfers['status'] == 0) {
                         $status = 'معلق';
                         $color = "#2980B9";
                         $background = '';
                     }
                     else if ($fetch_bank_transfers['status'] == 1) {
                         $status = 'مكتمل';
                         $color = "#04AA6D";
                         $background = '';
                     }
                     else if ($fetch_bank_transfers['status'] == 2) {
                         $status = 'تم الإلغاء';
                         $color = "#FE4445";
                         $background = "#f2827a4a";
                     }
                  echo '<tr style="background: '.$background.';">
                    <td>'.$fetch_bank_transfers['created_at'].'</td>
                    <td style="color: '.$color.';">'.$status.'</td>
                    <td>'.$fetch_bank_transfers['image'].'</td>
                    <td>'.$fetch_bank_transfers['subtitle'].'</td>
                    <td>'.$fetch_bank_transfers['title'].'</td>
                    <td>'.$fetch_bank_transfers['tid'].'</td>
                  </tr>';
                  
                  echo '<tr style="background: '.$background.';">
                    
                    <td colspan="4"><img src="../uploaded_img/bank_transfers/'.$fetch_bank_transfers['image'].'" alt="logo" style="width: 800px; height: 350px;">
                        <a href="../uploaded_img/bank_transfers/'.$fetch_bank_transfers['image'].'">تكبير الصورة</a>
                    </td>
                    <td rowspan="1">$'.$fetch_bank_transfers['price'].'</td>';
                    
                    $user_id = $fetch_bank_transfers['created_by'];
                    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id='$user_id'");
                    $select_user->execute();
                    $number_of_user = $select_user->rowCount();
                    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                    
                  echo '<td rowspan="1">'.$fetch_user['name'].'</td>
                  </tr>
                  <tr>
                    <td>تمت الموافقة من المسؤول</td>
                  </tr>
                  ';
            } } ?>
          
        </table>
        
      </div>
      

   </div>

</section>










<?php //include '../components/admin-footer.php'; ?>

<script src="../js/admin_script.js"></script>
   
</body>
</html>