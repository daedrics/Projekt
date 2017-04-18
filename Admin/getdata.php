

<?php
include("../db_connect.php");
$query = mysqli_query($link,"SELECT * FROM `admin` WHERE `id` = '$pid';");
$row=mysqli_fetch_row($query);
$id=$row[0];
$emer=$row[1];
$mbiemer=$row[2];
$username=$row[3];
$pass=$row[4];


$kontrata= mysqli_query($link,"SELECT * FROM `kliente`");

$i=0;
while ($r=mysqli_fetch_assoc($kontrata)){
    $id_k[$i]=$r['id'];
    $data[$i]=$r['data'];
    $k_emer[$i]=$r['emer'];
    $k_mbiemer[$i]=$r['mbiemer'];
    $status[$i]=$r['status'];
    $i++;

}






?>
