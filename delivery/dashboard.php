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

////////////////////////////// STATUS //////////////////////////////
if (isset($_GET['status']) == 'pending') {
    $status = $_GET['status'];
}
else if (isset($_GET['status']) == 'reservation') {
    $status = $_GET['status'];
}
else if (isset($_GET['status']) == 'completed') {
    $status = $_GET['status'];
}
////////////////////////////// STATUS //////////////////////////////

if(isset($_POST['updatedata'])) {
    $oid = $_POST['order-number'];
    $oid = filter_var($oid, FILTER_SANITIZE_STRING);
    
    $id = $_POST['methods'];
    $id = filter_var($id, FILTER_SANITIZE_STRING);
    
    $payment_status = $_POST['status'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    
    $delivery_price = $_POST['delivery_price'];
    $delivery_price = filter_var($delivery_price, FILTER_SANITIZE_STRING);
    
    $update_payment = $conn->prepare("UPDATE `order_store` SET payment_status = ?, delivery_by = ?, delivery_price = ? WHERE id = ?");
    $update_payment->execute([$payment_status, $delivery_id, $delivery_price, $id]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET payment_status = ? delivery_by = ?, delivery_price = ? WHERE id = ?");
    $update_payment_order->execute([$payment_status, $delivery_id, $delivery_price, $id]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث البيانات!"); </script>';
    }
    
    /*$update_payment = $conn->prepare("UPDATE `order_store` SET payment_status = ? WHERE oid = ?");
    $update_payment->execute([$payment_status, $oid]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE oid = ?");
    $update_payment_order->execute([$payment_status, $oid]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث البيانات!"); </script>';
    }*/
    echo '<script> alert("'.$delivery_price. '-'.$id. '"); </script>';
    
}

if(isset($_POST['updatedata0'])) {
    $oid = $_POST['order-number0'];
    $oid = filter_var($oid, FILTER_SANITIZE_STRING);
    
    $id = $_POST['methods0'];
    $id = filter_var($id, FILTER_SANITIZE_STRING);
    
    $payment_status = $_POST['status0'];
    $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
    
    $defualt_delivery_by = 0;
    $defualt_delivery_price = 0;
    
    $update_payment = $conn->prepare("UPDATE `order_store` SET payment_status = ?, delivery_by = ?, delivery_price = ? WHERE id = ?");
    $update_payment->execute([$payment_status, $defualt_delivery_by, $defualt_delivery_price, $id]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET payment_status = ?, delivery_by = ?, delivery_price = ? WHERE id = ?");
    $update_payment_order->execute([$payment_status, $defualt_delivery_by, $defualt_delivery_price, $id]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث البيانات!"); </script>';
    }
    /*$update_payment = $conn->prepare("UPDATE `order_store` SET payment_status = ? WHERE oid = ?");
    $update_payment->execute([$payment_status, $oid]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE oid = ?");
    $update_payment_order->execute([$payment_status, $oid]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث البيانات!"); </script>';
    }*/
    echo '<script> alert("'.$oid. '-'.$payment_status.'-'. $id.'"); </script>';
    
}

if(isset($_POST['updatedata1'])) {
    $oid = $_POST['order-number1'];
    $oid = filter_var($oid, FILTER_SANITIZE_STRING);
    
    $id = $_POST['methods1'];
    $id = filter_var($id, FILTER_SANITIZE_STRING);
    
    $defualt_delivery_by = 0;
    $defualt_delivery_price = $_POST['delivery_by1'];
    
    $update_payment = $conn->prepare("UPDATE `order_store` SET delivery_price = ? WHERE id = ?");
    $update_payment->execute([$defualt_delivery_price, $id]);
    
    $update_payment_order = $conn->prepare("UPDATE `orders` SET delivery_price = ? WHERE id = ?");
    $update_payment_order->execute([$defualt_delivery_price, $id]);
        
    if($update_payment) {
        echo '<script> alert("تم التحديث للسعر بنجاح!"); </script>';
    }
    else {
        echo '<script> alert("لم يتم تحديث السعر!"); </script>';
    }
    
    echo '<script> alert("'.$defualt_delivery_price.'"); </script>';
    
}


$select_deliveries = $conn->prepare("SELECT * FROM `deliveries` WHERE id='$delivery_id'");
$select_deliveries->execute();
$number_of_deliveries = $select_deliveries->rowCount();
$fetch_deliveries = $select_deliveries->fetch(PDO::FETCH_ASSOC);

$select_order_store = $conn->prepare("SELECT * FROM `order_store`");
$select_order_store->execute();
$number_of_order_store = $select_order_store->rowCount();
$fetch_order_store = $select_order_store->fetch(PDO::FETCH_ASSOC);

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
    
    <style>
        img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{ display: none; }

    </style>

</head>
<body>

<?php include '../components/delivery_header.php'; ?>

<section class="dashboard">

    <h1 class="heading" style="font-size: 16px;">
        <a style="text-decoration: none; color: black; font-weight: bold;">الطلبات: </a>
        <?php if ($status == 'pending') { ?>
        <a href="dashboard.php?status=all" style="text-decoration: none; color: black;">الكل</a>
        |
        <a href="dashboard.php?status=pending" style="background: red; padding: 8px; border-radius: 16px; color: white; text-decoration: underline;">المتاحة</a>
        |
        <a href="dashboard.php?status=reservation" style="text-decoration: none; color: black;">المحجوزة</a>
        |
        <a href="dashboard.php?status=completed" style="text-decoration: none; color: black;">المكتملة</a>
        <?php } else if ($status == 'reservation') {?>
        <a href="dashboard.php?status=all" style="text-decoration: none; color: black;">الكل</a>
        |
        <a href="dashboard.php?status=pending" style="text-decoration: none; color: black;">المتاحة</a>
        |
        <a href="dashboard.php?status=reservation" style="background: red; padding: 8px; border-radius: 16px; color: white; text-decoration: underline;">المحجوزة</a>
        |
        <a href="dashboard.php?status=completed" style="text-decoration: none; color: black;">المكتملة</a>
        <?php } else if ($status == 'completed') {?>
        <a href="dashboard.php?status=all" style="text-decoration: none; color: black;">الكل</a>
        |
        <a href="dashboard.php?status=pending" style="text-decoration: none; color: black;">المتاحة</a>
        |
        <a href="dashboard.php?status=reservation" style="text-decoration: none; color: black;">المحجوزة</a>
        |
        <a href="dashboard.php?status=completed" style="background: red; padding: 8px; border-radius: 16px; color: white; text-decoration: underline;">المكتملة</a>
        <?php } else { ?>
        <a href="dashboard.php?status=all" style="background: red; padding: 8px; border-radius: 16px; color: white; text-decoration: underline;">الكل</a>
        |
        <a href="dashboard.php?status=pending" style="text-decoration: none; color: black;">المتاحة</a>
        |
        <a href="dashboard.php?status=reservation" style="text-decoration: none; color: black;">المحجوزة</a>
        |
        <a href="dashboard.php?status=completed" style="text-decoration: none; color: black;">المكتملة</a>
        <?php } ?>
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
        if ($status == 'all') {
            $select_store_orders = $conn->prepare("SELECT * FROM `order_store`"); 
        }
        else {
            $select_store_orders = $conn->prepare("SELECT * FROM `order_store` WHERE payment_status='$status' OR payment_status='$status'"); 
        }
        $select_store_orders->execute();
        $count = $select_store_orders->rowCount();

        if($select_store_orders->rowCount() > 0){
            while($fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC)){
                
                /*$select = $conn->prepare("SELECT oid, count(*) AS c FROM order_store GROUP BY oid HAVING c > 1"); 
                $select->execute();
                if($select->rowCount() > 0){
                    $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                }
                else {
                    $rand = "433443";
                }*/
                
                //for ($x = 1; $x < $count; $x++) { ?>
                    <div class="box" style="background: <?php //echo('#' . $rand); ?>;">
                        <h3 id="number"><?php echo '' . $i++ . '#'; ?></h3>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['payment_status']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['total_price']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['qty']; ?></p>
                        <!--<p><?= $fetch_store_orders['qty'] * $fetch_store_orders['total_price']; ?></p>-->
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['qty'] * $fetch_store_orders['total_price']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['user_id']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['name']; ?></p>
                        <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['total_products']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['oid']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['placed_on']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['id']; ?></p>
                        
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['id']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['delivery_price']; ?></p>
                        
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['delivery_by']; ?></p>
                        <p style="font-size: 12px; display:none;"><?= $fetch_store_orders['address']; ?></p>
                        <div class="row">
                            <div class="col-4">
                                <?php if ($fetch_store_orders['payment_status'] == 'pending') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #826880;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } else if ($fetch_store_orders['payment_status'] == 'delivery') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #65a63f;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } else if ($fetch_store_orders['payment_status'] == 'shipped') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #d6a033;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } else if ($fetch_store_orders['payment_status'] == 'reservation') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #a63f57;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } else if ($fetch_store_orders['payment_status'] == 'completed') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #3f46a6;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } else if ($fetch_store_orders['payment_status'] == 'cancelled') { ?>
                                    <p style="font-size: 12px; padding: 0; color: white; background: #c2152c;"><?= $fetch_store_orders['payment_status']; ?></p>
                                <?php } ?>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['placed_on']; ?> <i class="bi bi-calendar3"></i></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['total_price']; ?></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['qty']; ?></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['total_price'] * $fetch_store_orders['qty']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php if ($fetch_store_orders['delivery_by'] == "0") { ?>
                                    <p style="font-size: 12px; padding: 0;"><?= 'delivery_by: ' . $fetch_store_orders['delivery_by']; ?></p>
                                <?php } else { ?>
                                    <p style="font-size: 12px; padding: 0;"><?= 'By: ' . $fetch_deliveries['name']; ?> <i class="bi bi-car-front-fill"></i></p>
                                <?php } ?>
                            </div>
                            <div class="col-4">
                                <p style="font-size: 12px; padding: 0;"><?= '$' . $fetch_store_orders['delivery_price']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px; padding: 0;"><?= $fetch_store_orders['address'] . ' '; ?><i class="bi bi-geo-alt-fill"></i></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px; padding: 0; direction: ltr; background: white;">
                                    <i class="bi bi-image" style="display: none;"></i>
                                    <img src="../uploaded_img/<?php echo $fetch_store_orders['image']; ?>" alt="product" style="width: 64px;">
                                </p>
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
                                <button type="button" class="btn btn-success editbtn"> حجز الطلب </button>
                        <?php } else if ($status == 'reservation') {?>
                            <!--<div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-success editbtn0"> إلغاء حجز الطلب </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success editbtn0"> تحديث الحجز </button>
                                </div>
                            </div>-->
                            <button type="button" class="btn btn-success editbtn1"> تحديث الحجز </button>
                            <button type="button" class="btn btn-success editbtn0"> إلغاء حجز الطلب </button>
                        <?php } else { ?>
                                <button type="button" class="btn btn-success editbtn0"> إلغاء حجز الطلب </button>
                        <?php }
                        ?>
                        </form>
                    </div>
            <?php   //}
            }
        } else { 
            for ($n = 1; $n <= 10; $n++) { ?>
                    <div class="box">
                        <h3 id="number"><?php echo '' . $i++ . '#'; ?></h3>
                        <p style="font-size: 12px;"></p>
                        <div class="row">
                            <div class="col-4">
                                <p style="font-size: 8px;"></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 8px;"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p style="font-size: 12px;"></p>
                            </div>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?= $fetch_store_orders['id']; ?>">
                            <button type="button" class="btn btn-success"> ~ </button>
                        </form>
                    </div>

        <?php }
        
        }?>
      
   </div>

</section>













<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="direction: rtl;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <div class="p-3"><h5 class="modal-title" id="exampleModalLabel"> حجز الطلب </h5></div>
                  <div class="p-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>

                <form action="dashboard.php?status=reservation" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">رقم الطلب</label>
                              <input type="text" class="form-control" name="order-number" id="order-number" placeholder="XYZ-XXXXX" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">إسم الطالب</label>
                              <input type="text" class="form-control" name="order-by" id="order-by" placeholder="إسم الطالب" readonly>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
                            <input type="text" class="form-control" name="product-name" id="product-name" placeholder="إسم المنتج" readonly>
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
                                <label for="exampleFormControlInput1" class="form-label">رقم المشتري التسلسلي</label>
                                <input type="text" class="form-control" name="method" id="method" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col" style="display: none;">
                                <label for="exampleFormControlInput1" class="form-label">methods</label>
                                <input type="text" class="form-control" name="uid" id="uid" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">تاريخ الطلب</label>
                                <input type="text" class="form-control" name="order-date" id="order-date" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                                <select class="form-select" aria-label="Default select example" name="status" id="status" required>
                                  <?php
                                    $select_store_orders = $conn->prepare("SELECT * FROM `order_store`"); 
                                    $select_store_orders->execute();
                                    $fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC);
                                    $payment_status = $fetch_store_orders['payment_status'];
                                     if ($payment_status == '') { ?>
                                        <option value="<?php echo $payment_status; ?>" selected disabled><?php echo $payment_status; ?></option>
                                        <option value="reservation">إحجز الآن</option>
                                        <?php } else if ($payment_status == 'pending') { ?>
                                            <option value="reservation">إحجز الآن</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $payment_status; ?>" selected>إحجز الآن</option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">uid</label>
                                <input type="text" class="form-control" name="methods" id="methods" placeholder="حالة الدفع" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_price</label>
                                <input type="text" class="form-control" name="delivery_price" id="delivery_price" placeholder="توصيل بوسطة" min="10" max="1000" required>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_by</label>
                                <input type="text" class="form-control" name="delivery_by" id="delivery_by" placeholder="سعر التوصيل" min="10" max="1000" required readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">المكان</label>
                                <input type="text" class="form-control is-invalid" name="address" id="address" placeholder="المكان" readonly>
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    لا يمكن تغير الخانة المحددة باللون الأحمر إلا من قبل المشتري
                                </div>
                            </div>
                        </div>
                        <!-- Confirm code -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    في حال الموافقة سيتم حجز الطلب لك فقط.
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                 </div>
                            </div>
                        </div>
                        <!-- Confirm code -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatedata" class="btn btn-primary">تحديث</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="direction: rtl;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <div class="p-3"><h5 class="modal-title" id="exampleModalLabel"> إلغاء حجز الطلب </h5></div>
                  <div class="p-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>

                <form action="dashboard.php?status=pending" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">رقم الطلب</label>
                              <input type="text" class="form-control" name="order-number0" id="order-number0" placeholder="XYZ-XXXXX" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">إسم الطالب</label>
                              <input type="text" class="form-control" name="order-by0" id="order-by0" placeholder="إسم الطالب" readonly>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
                            <input type="text" class="form-control" name="product-name0" id="product-name0" placeholder="إسم المنتج" readonly>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الكمية</label>
                              <input type="text" class="form-control" name="qty0" id="qty0" placeholder="الكمية" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">السعر</label>
                              <input type="text" class="form-control" name="price0" id="price0" placeholder="السعر" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الإجمالي</label>
                              <input type="text" class="form-control" name="total0" id="total0" placeholder="السعر X الكمية" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">رقم المشتري التسلسلي</label>
                                <input type="text" class="form-control" name="method0" id="method0" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col" style="display: none;">
                                <label for="exampleFormControlInput1" class="form-label">methods</label>
                                <input type="text" class="form-control" name="uid0" id="uid0" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">تاريخ الطلب</label>
                                <input type="text" class="form-control" name="order-date0" id="order-date0" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                                <select class="form-select" aria-label="Default select example" name="status0" id="status0" required>
                                  <?php
                                    $select_store_orders = $conn->prepare("SELECT * FROM `order_store`"); 
                                    $select_store_orders->execute();
                                    $fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC);
                                    $payment_status = $fetch_store_orders['payment_status'];
                                    if ($payment_status == '') { ?>
                                        <option value="<?php echo $payment_status; ?>" selected disabled><?php echo $payment_status; ?></option>
                                        <option value="pending">إلغاء الحجز</option>
                                        <?php } else if ($payment_status == 'reservation') { ?>
                                        <option value="pending">إلغاء الحجز</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $payment_status; ?>" selected><?php echo $payment_status; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">uid</label>
                                <input type="text" class="form-control" name="methods0" id="methods0" placeholder="حالة الدفع" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_price</label>
                                <input type="text" class="form-control" name="delivery_by0" id="delivery_by0" placeholder="توصيل بوسطة">
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_by</label>
                                <input type="text" class="form-control" name="delivery_price0" id="delivery_price0" placeholder="سعر التوصيل" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatedata0" class="btn btn-primary">إلغاء الحجز</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- UPDATE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="direction: rtl;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                  <div class="p-3"><h5 class="modal-title" id="exampleModalLabel"> تحديث الحجز </h5></div>
                  <div class="p-3"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                </div>

                <form action="dashboard.php?status=reservation" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">رقم الطلب</label>
                              <input type="text" class="form-control" name="order-number1" id="order-number1" placeholder="XYZ-XXXXX" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">إسم الطالب</label>
                              <input type="text" class="form-control" name="order-by1" id="order-by1" placeholder="إسم الطالب" readonly>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <label for="exampleFormControlInput1" class="form-label">إسم المنتج</label>
                            <input type="text" class="form-control" name="product-name1" id="product-name1" placeholder="إسم المنتج" readonly>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الكمية</label>
                              <input type="text" class="form-control" name="qty1" id="qty1" placeholder="الكمية" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">السعر</label>
                              <input type="text" class="form-control" name="price1" id="price1" placeholder="السعر" readonly>
                            </div>
                            <div class="col">
                              <label for="exampleFormControlInput1" class="form-label">الإجمالي</label>
                              <input type="text" class="form-control" name="total1" id="total1" placeholder="السعر X الكمية" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">رقم المشتري التسلسلي</label>
                                <input type="text" class="form-control" name="method1" id="method1" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col" style="display: none;">
                                <label for="exampleFormControlInput1" class="form-label">methods</label>
                                <input type="text" class="form-control" name="uid1" id="uid1" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">تاريخ الطلب</label>
                                <input type="text" class="form-control" name="order-date1" id="order-date1" placeholder="حالة الدفع" readonly>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">الحالة</label>
                                <select class="form-select" aria-label="Default select example" name="status1" id="status1" readonly required>
                                  <?php
                                    $select_store_orders = $conn->prepare("SELECT * FROM `order_store`"); 
                                    $select_store_orders->execute();
                                    $fetch_store_orders = $select_store_orders->fetch(PDO::FETCH_ASSOC);
                                    $payment_status = $fetch_store_orders['payment_status'];
                                    if ($payment_status == '') { ?>
                                        <option value="<?php echo $payment_status; ?>" selected disabled><?php echo $payment_status; ?></option>
                                        <option value="pending">إلغاء الحجز</option>
                                        <?php } else if ($payment_status == 'reservation') { ?>
                                        <option value="reservation" selected>تم الحجز</option>
                                        <?php } else { ?>
                                            <option value="<?php echo $payment_status; ?>" selected><?php echo $payment_status; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">uid</label>
                                <input type="text" class="form-control" name="methods1" id="methods1" placeholder="حالة الدفع" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_price</label>
                                <input type="text" class="form-control" name="delivery_by1" id="delivery_by1" placeholder="توصيل بوسطة">
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">delivery_by</label>
                                <input type="text" class="form-control" name="delivery_price1" id="delivery_price1" placeholder="سعر التوصيل" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatedata1" class="btn btn-primary">إلغاء الحجز</button>
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
                $('#uid').val(data[10]);
                $('#delivery_by').val(data[11]);
                $('#delivery_price').val(data[12]);
                $('#address').val(data[13]);
            });
        });
        
        $(document).ready(function () {

            $('.editbtn0').on('click', function () {
                
                $('#editmodal0').modal('show');

                $tr = $(this).closest('div');

                var data = $tr.children("p").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#status0').val(data[0]);
                $('#qty0').val(data[1]);
                $('#price0').val(data[2]);
                $('#total0').val(data[3]);
                $('#method0').val(data[4]);
                $('#order-by0').val(data[5]);
                $('#product-name0').val(data[6]);
                $('#order-number0').val(data[7]);
                $('#order-date0').val(data[8]);
                $('#methods0').val(data[9]);
                $('#uid0').val(data[10]);
                $('#delivery_by0').val(data[11]);
                $('#delivery_price0').val(data[12]);
            });
        });
        
        $(document).ready(function () {

            $('.editbtn1').on('click', function () {
                
                $('#editmodal1').modal('show');

                $tr = $(this).closest('div');

                var data = $tr.children("p").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#status1').val(data[0]);
                $('#qty1').val(data[1]);
                $('#price1').val(data[2]);
                $('#total1').val(data[3]);
                $('#method1').val(data[4]);
                $('#order-by1').val(data[5]);
                $('#product-name1').val(data[6]);
                $('#order-number1').val(data[7]);
                $('#order-date1').val(data[8]);
                $('#methods1').val(data[9]);
                $('#uid1').val(data[10]);
                $('#delivery_by1').val(data[11]);
                $('#delivery_price1').val(data[12]);
            });
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<!-- JS EDIT/UPDATE STATUS -->



<script src="../js/admin_script.js"></script>
   
</body>
</html>