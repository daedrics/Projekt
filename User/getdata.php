

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

$j=0;
$ko=0;
$pritje=0;
$ok=0;
$wipi=0; $toti=0;$koi=0;$oki=0;
while ($r=mysqli_fetch_assoc($kontrata)){
    $id_k[$j]=$r['id'];
    $data[$j]=$r['data'];
    $k_emer[$j]=$r['emer'];
    $k_mbiemer[$j]=$r['mbiemer'];
    $codicefiscale[$j]=$r['codice_fiscale'];
    $telfisso[$j]=$r['numero_fisso'];
    $rcell[$j]=$r['recapito_cell'];
    $motivacione[$j]=$r['motivazione'];
    $status[$j]=$r['status'];
    if(strcasecmp($status[$j],'ok')==0)
    {
        $ok++;
    }
    else if (strcasecmp($status[$j],'ko')==0)
        $ko++;
    else if	(strcasecmp($status[$j],'wip')==0)
	$wip++;
else $pritje++;

    $j++;

}

if($j==0){
	
	$wipi=0;
	$toti=0;
	$koi=0;
	$oki=0;
}
else{
	$toti=$j/$j*100;
	$oki=$ok/$j*100;
	$koi=$ko/$j*100;
	$wipi=$wip/$j*100;
	$pritjei=$pritje/$j*100;
}

	
	




?>
