<?php

include '../components/connect.php';

session_start();

$delivery_id = $_SESSION['delivery_id'];

if(!isset($delivery_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   echo '<script>alert('.$order_id.');</script>';
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
        الطلبات
       <?php
            $select_profile = $conn->prepare("SELECT * FROM `deliveries` WHERE id = ?");
            $select_profile->execute([$delivery_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            echo ' | ' . $fetch_profile['name'];
        ?>
   </title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/delivery-style.css">
      <link rel="stylesheet" href="../css/home-style.css">
   
        <?php
            if($select_system->rowCount() > 0){
                while($fetch_product = $select_system->fetch(PDO::FETCH_ASSOC)){
         ?>
    <link rel="icon" type="image/x-icon" href="/images/admin/<?php echo $fetch_product['icon']; ?>">
        <?php } } ?>
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<body>

<?php include '../components/delivery_header.php'; ?>

<section class="dashboard">

    <h1 class="heading">
        الطلبات
        <a href="dashboard.php">المتاحة</a>
        |
        <a href="rdashboard.php">المحجوزة</a>
        |
        <a href="cdashboard.php" style="color: red; text-decoration: underline;">المكتملة</a>
    </h1>
        
   <div class="box-container" style="direction: rtl;">
       
       <style>
           #number {
               position: absolute;
               font-size: 12px;
           }
           #oid {
               /*position: relative;*/
               left: 0px;
               font-size: 16px;
           }
       </style>

    <?php
        $i = 1;
        $select_store_orders = $conn->prepare("SELECT * FROM `store_orders` WHERE payment_status='complated' OR payment_status='delivered'"); 
        $select_store_orders->execute();
        $count = $select_store_orders->rowCount();
        
        if($select_store_orders->rowCount() > 0){
            while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){
                //for ($x = 1; $x < $count; $x++) { ?>
                    <div class="box">
                        <h3 id="number"><?php echo '#' . $i++; ?></h3>
                        <h3 class="id" id="oid"><?php echo '#' . $fetch_store_orders['oid']; ?></h3>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['payment_status']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['total_price']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['qty']; ?></p>
                        <!--<p><?= $fetch_store_orders['qty'] * $fetch_store_orders['total_price']; ?></p>-->
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['qty'] * $fetch_store_orders['total_price']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['user_id']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['name']; ?></p>
                        <p style="font-size: 12px;"><?= $fetch_store_orders['total_products']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['oid']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['placed_on']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['id']; ?></p>
                        <div class="row">
                            <div class="col-4">
                                <p style="font-size: 12px;"><?= $fetch_store_orders['payment_status']; ?></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"><?= $fetch_store_orders['placed_on']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px;"><?= $fetch_store_orders['total_price']; ?></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"><?= $fetch_store_orders['qty']; ?></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"><?= $fetch_store_orders['total_price'] * $fetch_store_orders['qty']; ?></p>
                            </div>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_store_orders['id']; ?>">
                        <?php
                            $status = $fetch_store_orders['payment_status'];
                            if ($status == 'pending') { ?>
                                <!--<a href="" class="btn editbtn">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    حجز الطلب
                                </a>-->
                                <!--<button type="button" class="btn btn-success editbtn"> حجز الطلب </button>-->
                        <?php } else { ?>
                                <!--<button type="button" class="btn btn-success editbtn"> إلغاء حجز الطلب </button>-->
                        <?php }
                        ?>
                        </form>
                    </div>
        <?php       //}
                }
            } ?>
      
   </div>

</section>













<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="direction: rtl;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <div class="p-3"><h5 class="modal-title" id="exampleModalLabel"> تحديث البيانات </h5></div>
                  <div class="p-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>

                <form action="dashboard.php" method="POST">

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
                                <label for="exampleFormControlInput1" class="form-label">حالة الدفع</label>
                                <input type="text" class="form-control" name="methods" id="methods" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">تاريخ الطلب</label>
                                <input type="text" class="form-control" name="order-date" id="order-date" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                                <select class="form-select" aria-label="Default select example" name="status" id="status">
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
                        <button type="submit" name="updatedata" class="btn btn-primary">تحديث</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- JS EDIT/UPDATE STATUS -->
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

                $tr = $(this).closest('div');

                var data = $tr.children("p").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#status').val(data[0]);
                $('#qty').val(data[1]);
                $('#price').val(data[2]);
                $('#total').val(data[3]);
                $('#method').val(data[4]);
                $('#order-by').val(data[5]);
                $('#product-name').val(data[6]);
                $('#order-number').val(data[7]);
                $('#order-date').val(data[8]);
                $('#methods').val(data[9]);

            });
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<!-- JS EDIT/UPDATE STATUS -->



<script src="../js/admin_script.js"></script>
   
</body>
</html>