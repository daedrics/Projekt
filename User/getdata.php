

<?php
include("../db_connect.php");
$query = mysqli_query($link,"SELECT * FROM `operator` WHERE `id` = '$pid';");
$row=mysqli_fetch_row($query);
$id=$row[0];
$emer=$row[1];
$mbiemer=$row[2];
$username=$row[3];
$pass=$row[4];

$kontrata= mysqli_query($link,"SELECT * FROM `kliente` WHERE `#id_Operator`='$pid'");

$i=0;
$ko=0;
$pritje=0;
$ok=0;
while ($r=mysqli_fetch_assoc($kontrata)){
    $id_k[$i]=$r['id'];
    $data[$i]=$r['data'];
    $k_emer[$i]=$r['emer'];
    $k_mbiemer[$i]=$r['mbiemer'];
    $codicefiscale[$i]=$r['codice_fiscale'];
    $telfisso[$i]=$r['numero_fisso'];
    $rcell[$i]=$r['recapito_cell'];
    $motivacione[$i]=$r['motivazione'];
    $status[$i]=$r['status'];
    if(strcasecmp($status[$i],'ok')==0)
    {
        $ok++;
    }
    else if (strcasecmp($status[$i],'ko')==0)
        $ko++;
    else $pritje++;
    $i++;

}





?>
