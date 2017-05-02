<?php
include ("../db_connect.php");






$output='';

if(isset($_POST["export_excel"]))
{

        $sql = "SELECT * FROM `kliente` ORDER BY id DESC";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $output .= '
		<table class="table" bordered="1">
		<tr>
		<th> Id</th>
		<th> emri </th>
		<th> mbiemri </th>
		<th> data </th>
		<th> status </th>
		<th> id operatori </th>';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
			<tr>
			<td> ' . $row["id"] . '</td>
			<td> ' . $row["emer"] . '</td>
			<td> ' . $row["mbiemer"] . '</td>
			<td> ' . $row["data"] . '</td>
			<td> ' . $row["status"] . '</td>
			<td> ' . $row["#id_Operator"] . '</td>
			</tr> ';

            }
            $output .= '</table>';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=raporti.xls");

            echo $output;


        }

	
	
}

?>
























