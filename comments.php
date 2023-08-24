<?php
if(isset($_GET['update_to_comment'])){
    $id = $_GET['cid'];
    //$comment = $_POST['updated_comment'];
    //$comment = filter_var($comment, FILTER_SANITIZE_STRING);
    
    /*$check_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
    $check_comment->execute([$id]);
    if($check_comment->rowCount() == 0){
        $message[] = 'you can\'t update this comment\'s belong to you!';
    }else{
        $update_wishlist = $conn->prepare("UPDATE `comments` SET `comment` = ? WHERE `comments`.`id` = ?");
        $update_wishlist->execute([$comment, $id]);
        $message[] = 'update to comment!';
    }*/
    //echo '<script>alert("'.$id.'");</script>';
    echo '<script>alert("Hi");</script>';
}

$idx = $_GET['cxid'];
$delete = $_GET['delete'];

?>
<?php if ($idx != '') {
    $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE id='$idx'"); 
    $select_comments->execute();
    if($select_comments->rowCount() > 0){
        $fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC);
?>

<style>
    #edit-button {
        text-decoration: none;
        background-color: #000;
        color: #FF4546;
    }
    #edit-button:hover {
        text-decoration: none;
        background-color: #000;
        color: green;
        font-size: 18px;
        transition: font-size 0.4s;
    }
    #delete-button {
        text-decoration: none;
        background-color: #000;
        color: #FF4546;
    }
    #delete-button:hover {
        text-decoration: none;
        background-color: #000;
        color: blue;
        font-size: 18px;
        transition: font-size 0.4s;
    }
    #delete:hover {
        color: yellow;
    }
    #edit:hover {
        color: yellow;
    }
</style>
<form action="" method="post" class="box">
    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
    <input type="text" name="idx" value="<?php echo 'Comment [' . $idx . ']'; ?>" style="width:98.5%;" readonly>
    <a href="quick_view.php?pid=<?php echo $pid; ?>">
        <i class="bi bi-x-lg" style="color: black;"></i>
    </a><br><br>
    <div class="row">
        <?php
        $sid = $fetch_comments['created_by'];
        $select_storez = $conn->prepare("SELECT * FROM `store` WHERE id='$sid'"); 
        $select_storez->execute();
        if($select_storez->rowCount() > 0){
            $fetch_storez = $select_storez->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <img src="images/<?php echo $fetch_storez['image']; ?>" alt="logo" style="width: 32px; height: 32px;">
        <textarea type="text" name="updated_comment_" style="width: 93%; padding: 8px; background: #EBEBEB;" row="9"><?php echo $fetch_comments['comment']; ?></textarea>
        <button type="submit" name="update_comment" style="">
            <i class="bi bi-pencil-square" id="edit" style="color: black; background: white; cursor: pointer;"></i>
        </button>
        <?php if ($idx != '') { ?>
            <!--<button type="submit" name="update_comment" style="">
                <i class="bi bi-trash-fill" style="color: #FF4546;"></i>
            </button>-->
            <?php } else { ?>
            <a href="quick_view.php?pid=<?php echo $pid; ?>&cid=<?php echo $fetch_comments['id']; ?>">
                <i class="bi bi-pencil-square" style="color: black;"></i>
            </a>
        <?php } ?>
    </div>
</form> 

<?php } } else if ($delete != '') {
    $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE id='$delete'"); 
    $select_comments->execute();
    if($select_comments->rowCount() > 0){
        $fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC);
?>

<form action="" method="post" class="box">
    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
    <input type="text" name="idx" value="<?php echo 'Comment [' . $delete . ']'; ?>" style="width:98%;" readonly>
    <a href="quick_view.php?pid=<?php echo $pid; ?>">
        <i class="bi bi-x-lg" style="color: black;"></i>
    </a><br><br>
    <div class="row">
        <?php
        $sid = $fetch_comments['created_by'];
        $select_storez = $conn->prepare("SELECT * FROM `store` WHERE id='$sid'"); 
        $select_storez->execute();
        if($select_storez->rowCount() > 0){
            $fetch_storez = $select_storez->fetch(PDO::FETCH_ASSOC);
        }
        ?>
        <img src="images/<?php echo $fetch_storez['image']; ?>" alt="logo" style="width: 32px; height: 32px;">
        <textarea type="text" name="updated_comment_" style="width: 93%; padding: 8px; background: #EBEBEB;" row="9"><?php echo $fetch_comments['comment']; ?></textarea>
        <!--<button type="submit" name="update_comment" style="">
            <i class="bi bi-pencil-square" style="color: black;"></i>
        </button>-->
        <?php if ($delete != '') { ?>
            <button type="submit" name="update_comment" style="">
                <i class="bi bi-trash-fill" id="delete" style="color: #FF4546; background: white; cursor: pointer;"></i>
            </button>
            <?php } else { ?>
            <a href="quick_view.php?pid=<?php echo $pid; ?>&cid=<?php echo $fetch_comments['id']; ?>">
                <i class="bi bi-pencil-square" style="color: black;"></i>
            </a>
        <?php } ?>
    </div>
</form> 
<?php } } ?>

<form action="" method="post" class="box">
    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
    <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
    <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
    <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
    <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
    <div class="row">
        <?php
        $select_users = $conn->prepare("SELECT * FROM `users` WHERE id='$user_id'"); 
        $select_users->execute();
        if($select_users->rowCount() > 0){
            $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);
        }
        
        $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE pid='$pid'"); 
        $select_comments->execute();
        if($select_comments->rowCount() > 0){
            while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){ ?>
                <?php
                $by = $fetch_comments['created_by'];
                $select_user = $conn->prepare("SELECT * FROM `users` WHERE id='$by'"); 
                $select_user->execute();
                if($select_user->rowCount() > 0){
                    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
                }
                
                $sid = $fetch_comments['created_by'];
                $select_storez = $conn->prepare("SELECT * FROM `store` WHERE id='$sid'"); 
                $select_storez->execute();
                if($select_storez->rowCount() > 0){
                    $fetch_storez = $select_storez->fetch(PDO::FETCH_ASSOC);
                    $image = $fetch_storez['image'];
                } else {
                    $image = 'avatar_male_man_icon.png';
                }
                ?>
                <a href="store/store.php?user_id=<?php echo $sid; ?>&id=<?php echo $user_id; ?>"><img src="images/<?php echo $image; ?>" alt="logo" style="width: 32px; height: 32px;"></a>
                <div>
                    <input type="hidden" name="idz" value="<?= $fetch_comments['id']; ?>" style="width: 32px;">
                    <div>
                        <?php echo '@' . $fetch_user['name']; ?>
                        <?php $status = $fetch_storez['status'];
                        //echo $status;
                        //echo $sid;
                        if ($status == 0) {
                    echo '<i class="fa fa-info-circle" style="color: #0D6EFD; font-size: 12px;" aria-hidden="true" rel="tooltip" title="جديد" id="blah"></i>';
                        } else if ($status == 1) {
                    echo '<i class="bi bi-exclamation-triangle" style="color: #F58F3C; font-size: 12px;" rel="tooltip" title="حظر مؤقت" id="blah"></i>';
                        } else if ($status == 2) {
                    echo '<i class="bi bi-exclamation-circle" style="color: #6C757D; font-size: 12px;" rel="tooltip" title="بإنتظار التوثيق" id="blah"></i>';
                        } else if ($status == 3) {
                    echo '<i class="fa fa-check" style="color: #198754; font-size: 12px;" aria-hidden="true" rel="tooltip" title="تم التوثيق" id="blah"></i>';
                        } else if ($status == 4) {
                    echo '<i class="bi bi-sign-stop-fill" style="color: #DC3545; font-size: 12px;" rel="tooltip" title="حظر تام" id="blah"></i>';
                        } else if ($status == 5) {
                    echo '<i class="bi bi-coin" style="color: #198754; font-size: 12px;" rel="tooltip" title="سوق محترف" id="blah"></i>';
                        } else if ($status == 6 && $sid == 1) {
                    echo '<i class="bi bi-patch-check-fill" style="color: #1D9BF0; font-size: 12px;" rel="tooltip" title="المالك" id="blah"></i>';
                        } else if ($status == 6 && $sid != 1) {
                echo '<i class="bi bi-bag-x-fill" style="color: #FF4546; font-size: 12px;" aria-hidden="true" rel="tooltip" title="لا يوجد سوق" id="blah"></i>';
                        }
                        ?>
                        <script>
                            $(document).ready(function() {
                                $("[rel=tooltip]").tooltip({ placement: 'right'});
                            });
                        </script>
                    </div>
                    <div><?php echo $fetch_user['email']; ?></div>
                    <div><?php echo $fetch_comments['created_at']; ?></div>
                </div>
                <textarea type="text" placeholder="Enter your comments" style="padding: 8px; background: #EBEBEB; width: 75%;" name="updated_comment" readonly><?php echo $fetch_comments['comment']; ?></textarea>
                <!--<input type="submit" placeholder="Enter your comments" value="تعديل" style="padding: 8px; background: #994409; width: 8%; color: white;" name="update_to_comment">-->
                <button type="submit" name="update" style="">
                <?php
                if ($fetch_comments['created_by'] == $user_id) { ?>
                <a href="quick_view.php?pid=<?php echo $pid; ?>&cxid=<?php echo $fetch_comments['id']; ?>" style="border-radius: 8px; padding: 8px; background: #EBEBEB; padding-right: 8px; padding-left: 8px;" id="edit-button">تعديل 
                    <!--<i class="bi bi-pencil-square" style="color: black;"></i>-->
                </a>&nbsp;
                <a href="quick_view.php?pid=<?php echo $pid; ?>&delete=<?php echo $fetch_comments['id']; ?>" style="border-radius: 8px; padding: 8px; background: #EBEBEB; padding-right: 8px; padding-left: 8px; color: red;" id="delete-button">حذف 
                    <!--<i class="bi bi-pencil-square" style="color: black;"></i>-->
                </a>
                <?php } else { ?>
                <a href="" style="border-radius: 8px; padding: 8px; background: #EBEBEB; padding-right: 8px; padding-left: 8px; color: red;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>&nbsp;
                <a href="" style="border-radius: 8px; padding: 8px; background: #EBEBEB; padding-right: 8px; padding-left: 8px;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a>
                <?php } ?>
                </button>
        <?php
            }
        }
        else {
            echo '<p>No comments, be first one.</p>';
        }
      ?>    

    </div>
    <br><br>
    <div class="row">
        <textarea type="text" placeholder="Enter your comments" style="padding: 8px; background: #EBEBEB; width: 100%;" name="comment" rows="6" required></textarea>
        <input class="option-btn" type="submit" name="add_to_comment" style="background: #FF4546;" value="تعليق">
    </div>
</form>