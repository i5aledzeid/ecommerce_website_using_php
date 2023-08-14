<?php

include '../components/connect.php';

session_start();

//$admin_id = $_SESSION['admin_id'];
$user_id = $_SESSION['user_id'];
$delivery_id = $_SESSION['delivery_id'];

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
   <title>delivery | placed orders</title>

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
    $select_store_orders = $conn->prepare("SELECT * FROM `deliveries` WHERE id='$delivery_id'"); 
    $select_store_orders->execute();
    if($select_store_orders->rowCount() > 0){
        while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){
            echo ' ' . $fetch_store_orders['name'] . 'الطلبات المقدمة لـ ';
            echo '<a href="index.php?delivery_id='.$delivery_id.'"><i class="bi bi-backspace-reverse-fill"></i></a>';
        }
    }
    ?>
</h1>
<div class="row">
    <div class="col">
        <button type="button" class="btn btn-success"> طلبات مكتملة </button>
    </div>
    <div class="col">
        <button type="button" class="btn btn-warning"> طلبات محجوزة </button>
    </div>
    <div class="col">
        <button type="button" class="btn btn-danger"> طلبات غير محجوزة </button>
    </div>
</div>

<br>


<!--<div class="box-container">-->
<div class="container">
    
   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         //while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
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
              <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
        $i = 1;
        $select_store_orders = $conn->prepare("SELECT * FROM `store_orders`"); 
        $select_store_orders->execute();
        if($select_store_orders->rowCount() > 0){
            while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                    <th scope="row">
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_store_orders['id']; ?>">
                            <button type="button" class="btn btn-success editbtn"> تحديث </button>
                        </form>
                    </th>
                    <?php
                        /*if ($fetch_store_orders['payment_status'] == 'pending') {
                            echo '<td scope="row" style="color: green;">معلق</td>';
                        }*/
                        $status = $fetch_store_orders['payment_status'];
                        if ($status == "pending") {
                            echo  '<td>pending</td>';
                        }
                        else {
                            echo  '<td>' .$fetch_store_orders['payment_status']. '</td>';
                        }
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
   
   
    <!--<div class="card">
      <img src="..." class="card-img-top" alt="...">
    
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>-->

    <!--<div class="row">
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card" aria-hidden="true">
                <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
                </div>
            </div>
        </div>
    </div>-->
    
    <!--<div class="row">
        <?php
        $i = 1;
        $select_store_orders = $conn->prepare("SELECT * FROM `store_orders`"); 
        $select_store_orders->execute();
        if($select_store_orders->rowCount() > 0 && $select_store_orders->rowCount() <= 6){
            while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){
                    for ($i = 0; $i < 6; $i++) { ?>
                        <div class="col">
                    <div class="card">
                        <img src="../images/avatar_geisha_japanese_woman_icon.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
        <?php } } } ?>
    </div>-->
    

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
                                    <!--<option selected>إختر حالة الطلب</option>-->
                                  <?php
                                    $select_store_orders = $conn->prepare("SELECT * FROM `store_orders`"); 
                                    $select_store_orders->execute();
                                    $fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC);
                                    $payment_status = $fetch_store_orders['payment_status']; ?>
                                    <?php if ($payment_status == "reservation") { ?>
                                        <option selected><?php echo $payment_status; ?></option>
                                        <option value="unreservation">إلغاء الحجز</option>
                                    <?php } else if ($payment_status == "pending") { ?>
                                        <option selected>معلق</option>
                                        <option value="pending">معلق</option>
                                        <option value="reservation">إحجز الآن</option>
                                    <?php } else { ?>
                                        <option selected><?php echo $payment_status; ?></option>
                                        <option value="reservation">إحجز الآن</option>
                                    <?php }
                                  ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                        <button type="submit" name="updatedata" class="btn btn-primary">تحديث</button>
                    </div>
                </form>

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