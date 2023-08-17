<?php

include '../components/connect.php';

session_start();

//$admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];

/*if(!isset($admin_id)){
   header('location:admin_login.php');
}*/

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   /*$payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';*/
   echo '<script>alert('.$order_id.');</script>';
}

if(isset($_GET['delete'])){
   /*$delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location: placed_orders.php');*/
}

if(isset($_POST['updatedata'])) {
    $oid = $_POST['order-number'];
    $oid = filter_var($oid, FILTER_SANITIZE_STRING);
    
    $payment_status = $_POST['status'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    
    $update_payment = $conn->prepare("UPDATE `store_orders` SET payment_status = ? WHERE oid = ?");
    $update_payment->execute([$payment_status, $oid]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE oid = ?");
    $update_payment_order->execute([$payment_status, $oid]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث البيانات!"); </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>store | placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        .table th, td {
           text-align: center;   
        }
    </style>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>

<?php //include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">
    <?php
    $select_store_orders = $conn->prepare("SELECT * FROM `store` WHERE id='$user_id'"); 
    $select_store_orders->execute();
    if($select_store_orders->rowCount() > 0){
        while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){
            echo ' ' . $fetch_store_orders['title'] . 'الطلبات المقدمة لـ ';
            echo '<a href="index.php?user_id='.$user_id.'"><i class="bi bi-backspace-reverse-fill"></i></a>';
        }
    }
    ?>
</h1>

<!--<div class="box-container">-->
<div class="container">
    
   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         //while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <!--<div class="box">
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pending">معلق</option>
            <option value="delivered">تم التوصيل</option>
            <option value="shipped">تم شحنها</option>
            <option value="completed">مكتمل</option>
            <option value="cancelled">تم إلغاء الطلب</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>-->
   <table class="table">
        <thead>
            <tr>
              <th scope="col">العمليات</th>
              <th scope="col">الحالة</th>
              <th scope="col">التاريخ</th>
              <th scope="col">حالة الدفع</th>
              <th scope="col">الإجمالي</th>
              <th scope="col">الكمية</th>
              <th scope="col">السعر</th>
              <th scope="col">إسم الطالب</th>
              <th scope="col">إسم المنتج</th>
              <th scope="col">رقم الطلب</th>
              <th scope="col">صورة المنتج</th>
              <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
            $i = 1;
            $select_store_orders = $conn->prepare("SELECT * FROM `order_store` WHERE sid='$user_id'"); 
            $select_store_orders->execute();
            if($select_store_orders->rowCount() > 0){
                while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                    <th scope="row">
                    <!--<button type="submit" value="update" name="update_payment">
                        <i class="bi bi-pencil-square"></i> تحديث
                    </button>-->
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_store_orders['id']; ?>">
                            <!--<button type="submit" value="update" name="update_payment">
                                <i class="bi bi-pencil-square"></i>
                            </button>-->
                            <button type="button" class="btn btn-success editbtn"> EDIT </button>
                            <!-- Button trigger modal -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a href="placed_orders.php?delete=<?= $fetch_store_orders['id']; ?>" onclick="return confirm('هل أنت متاكد من حذف الطلب؟');">
                                <i style="color: #FE4445;" class="bi bi-trash-fill"></i>
                            </a>
                        </form>
                    </th>
                    <?php
                        /*if ($fetch_store_orders['payment_status'] == 'pending') {
                            echo '<td scope="row" style="color: green;">معلق</td>';
                        }*/
                        echo  '<td>' .$fetch_store_orders['payment_status']. '</td>';
                        echo '<td scope="row">'.$fetch_store_orders['placed_on'].'</td>';
                        if ($fetch_store_orders['method'] == 'cash on delivery') {
                            echo '<td scope="row">الدفع عند الاستلام</td>';
                        }
                          echo '<td>$' .$fetch_store_orders['total_price'] * $fetch_store_orders['qty']. '</td>
                          <td>' .$fetch_store_orders['qty']. '</td>
                          <td>$' .$fetch_store_orders['total_price']. '</td>
                          <td>' .$fetch_store_orders['name']. '</td>
                          <td>' .$fetch_store_orders['total_products']. '</td>
                          <td><a id="id" style="color: #D49797; text-decoration: none;" href=""></a>' .$fetch_store_orders['oid']. '</td>
                          <td>'.$fetch_store_orders['image'].'</td>
                          <!--<td>'.$fetch_store_orders['image'].'<a href="#"><img src="../uploaded_img/'.$fetch_store_orders['image'].'" alt="logo" style="width: 64px;"></a></td>-->
                          <td>'. $i++ .'</td>
                        </tr>'; ?>
            <?php } } ?>
                    </tbody>
    </table>
    <?php
            
         //}
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>
   
   
</div>

</section>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="direction: rtl;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تحديث البيانات </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>-->
                <div class="modal-header d-flex justify-content-between">
                  <div class="p-3"><h5 class="modal-title" id="exampleModalLabel"> تحديث البيانات </h5></div>
                  <div class="p-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>

                <form action="placed_orders.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">
                        
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">رقم الطلب</label>
                              <input type="text" class="form-control" name="order-number" id="order-number" placeholder="XYZ-XXXXX" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
                              <input type="text" class="form-control" name="product-name" id="product-name" placeholder="إسم المنتج" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">إسم الطالب</label>
                          <input type="text" class="form-control" name="order-by" id="order-by" placeholder="إسم الطالب" readonly>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الكمية</label>
                              <input type="text" class="form-control" name="qty" id="qty" placeholder="الكمية" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">السعر</label>
                              <input type="text" class="form-control" name="price" id="price" placeholder="السعر" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الإجمالي</label>
                              <input type="text" class="form-control" name="total" id="total" placeholder="السعر X الكمية" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">حالة الدفع</label>
                                <input type="text" class="form-control" name="method" id="method" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">تاريخ الطلب</label>
                                <input type="text" class="form-control" name="order-date" id="order-date" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                                <!--<input type="text" class="form-control" name="status" id="status" placeholder="حالة الطلب">-->
                                <select class="form-select" aria-label="Default select example" name="status" id="status">
                                  <option selected disabled>إختر حالة الطلب</option>
                                  <option value="pending">تم التأكيد</option>
                                  <option value="delivery">تم التوصيل</option>
                                  <option value="completed">مكتمل</option>
                                  <option value="cancelled">ملغي</option>
                                </select>
                            </div>
                            <!--<div class="d-flex justify-content-center">
                                <?php
                                $select_store_orders = $conn->prepare("SELECT * FROM `order_store` WHERE sid='$user_id'"); 
                                $select_store_orders->execute();
                                $select_store_orders->rowCount();
                                $fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC);
                                echo '
                                    <img src="../uploaded_img/'.$fetch_store_orders['image'].'" alt="logo" style="width: 64px;" name="order-image" id="order-image">
                                ';
                                ?>
                            </div>-->
                            
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">صورة المنتج</label>
                            <input style="direction: ltr;" type="text" class="form-control" name="order-image" id="order-image" placeholder="حالة الدفع" readonly>
                        </div>
                        <!--<div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="fname" id="fname" class="form-control"
                                placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="lname" id="lname" class="form-control"
                                placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label> Course </label>
                            <input type="text" name="course" id="course" class="form-control"
                                placeholder="Enter Course">
                        </div>

                        <div class="form-group">
                            <label> Phone Number </label>
                            <input type="text" name="contact" id="contact" class="form-control"
                                placeholder="Enter Phone Number">
                        </div>-->
                        
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                        <button type="submit" name="updatedata" class="btn btn-primary">تحديث</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="direction: rtl;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">رقم الطلب</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="XYZ-XXXXX">
            </div>
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="إسم المنتج">
            </div>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">إسم الطالب</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="إسم الطالب">
        </div>
        <div class="row mb-3">
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">الكمية</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="الكمية">
            </div>
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">السعر</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="السعر">
            </div>
            <div class="col">
              <label for="exampleFormControlInput1" class="form-label">الإجمالي</label>
              <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="السعر X الكمية">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">حالة الدفع</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="حالة الدفع">
            </div>
            <div class="col">
                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="حالة الطلب">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">حفظ التغيرات</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
    </div>
  </div>
</div>








    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script>
    
    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#order-image').val(data[9]);
                $('#status').val(data[0]);
                $('#qty').val(data[4]);
                $('#price').val(data[5]);
                $('#total').val(data[3]);
                $('#method').val(data[2]);
                $('#order-by').val(data[6]);
                $('#product-name').val(data[7]);
                $('#order-number').val(data[8]);
                $('#order-date').val(data[1]);

            });
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script src="../js/admin_script.js"></script>
   
</body>
</html>