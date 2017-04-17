

<?php
include("../db_connect.php");
$query = mysqli_query($link,"SELECT * FROM `operator` WHERE `id` = '$pid';");
$row=mysqli_fetch_row($query);
$id=$row[0];
$emer=$row[1];
$mbiemer=$row[2];
$username=$row[3];
$pass=$row[4];







?>
