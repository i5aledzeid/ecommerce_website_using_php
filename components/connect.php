<?php

// If you are using localhost
/*$db_name = 'mysql:host=localhost;dbname=id21113871_shopy';
$user_name = 'root';
$user_password = '';*/

// If you are not using localhost
$db_name = 'mysql:host=localhost;dbname=id21113871_shopy';
$user_name = 'id21113871_shopy';
$user_password = 'Zxijinc1996#';

$conn = new PDO($db_name, $user_name, $user_password);

?>