<?php
include("../db_connect.php");


$kontrata= mysqli_query($link,"SELECT * FROM `draft` WHERE `#id_Operator`='$pid'");

$j=0;

$id_ki=NULL;
while ($r=mysqli_fetch_assoc($kontrata)){
    $id_ki[$j]=$r['id'];
    $datai[$j]=$r['data'];
    $k_emeri[$j]=$r['emer'];
    $k_mbiemeri[$j]=$r['mbiemer'];
    $codicefiscalei[$j]=$r['codice_fiscale'];
    $telfissoi[$j]=$r['numero_fisso'];
    $rcelli[$j]=$r['recapito_cell'];
    $motivacionei[$j]=$r['motivazione'];
    $statusi[$j]=$r['status'];


    $j++;

}









?>