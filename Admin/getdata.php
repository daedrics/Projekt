

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

$tot=0;
$ko=0;
$pritje=0;
$ok=0;
while ($r=mysqli_fetch_assoc($kontrata)){
    $id_k[$tot]=$r['id'];
    $data[$tot]=$r['data'];
    $k_emer[$tot]=$r['emer'];
    $k_mbiemer[$tot]=$r['mbiemer'];
	$codicefiscale[$tot]=$r['codice_fiscale'];
    $telfisso[$tot]=$r['numero_fisso'];
    $rcell[$tot]=$r['recapito_cell'];
    $motivacione[$tot]=$r['motivazione'];
    $status[$tot]=$r['status'];
	if(strcasecmp($status[$tot],'ok')==0)	
	{
	$ok++;
	}
	else if (strcasecmp($status[$tot],'ko')==0)
		$ko++;
else $pritje++;

    $tot++;

	
}








?>
