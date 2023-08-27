<?php

//$conn = mysqli_connect('localhost','root','','id21113871_shopy');

$conn = mysqli_connect("localhost","id21113871_shopy","Zxijinc1996#","id21113871_shopy") or die("Error " . mysqli_error($conn));
$sql="SELECT substationid,substationcode FROM wms_substation WHERE assemblylineid = '".$q."'";

echo $result = mysqli_query($con,$sql);