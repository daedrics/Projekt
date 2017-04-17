<?php

$db_hostname = 'localhost';
$db_database = 'crm';
$db_username = 'root';
$db_password = '';

$link = mysqli_connect($db_hostname,$db_username , $db_password, $db_database);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$output='';
if(isset($_POST["export_excel"]))
{
	$sql="SELECT * FROM `kliente` ORDER BY id DESC" ;
	$result=mysqli_query($link,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$output .= '
		<table class="table" bordered="1">
		<tr>
		<th> Id</th>
		<th> emri </th>
		<th> mbiemri </th>
		<th> data </th>
		<th> status </th>
		<th> id operatori </th>';
		while ($row=mysqli_fetch_array($result))
		{
			$output .='
			<tr>
			<td> ' .$row["id"].'</td>
			<td> ' .$row["emer"].'</td>
			<td> ' .$row["mbiemer"].'</td>
			<td> ' .$row["data"].'</td>
			<td> ' .$row["status"].'</td>
			<td> ' .$row["#id_Operator"].'</td>
			</tr> ';
		
		}
		$output .= '</table>' ;
		header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=raporti.xls");  

		echo $output;
		
		
	}
	
	
}

?>
























