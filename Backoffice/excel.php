<?php
include ("../db_connect.php");






$output='';


if(isset($_POST["export_excelD"]))
{
		$dat_f = $_POST['d_inX'];
    $dat_mb = $_POST['d_outX'];
if($dat_f==NULL || $dat_mb==NULL)
{
	        $sql = "SELECT * FROM `kliente` ORDER BY id DESC";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $output .= '
		<table class="table" bordered="1">
		<tr>
		<th> Id</th>
		<th> Nome </th>
		<th> Cognome </th>
		<th> Data </th>
		<th> Stato </th>
		<th> Gestore Telefonico</th>
		<th> Tipologia CNT </th>
		<th> APP/CNT </th>
		<th> Numero Fisso </th>
		<th> Comune </th>
		<th> Provincia</th>
		<th> Frazione </th>
		<th> Cap </th>
		<th> Via </th>
		<th> Nr Civico </th>
		<th>  Luogo di nascita</th>
		<th> N. Documento </th>
		<th> Comune di Emessione </th>
		<th> Data di Rilascio </th>
		<th> Data di Scadenza </th>
		<th> Codice Fiscale</th>
		<th> Codice di Migrazione</th>
		<th> Recapito di Cell</th>
		<th> Operatore Cell</th>
		<th> Offerta Scelta</th>
		<th> Cell Off TSM</th>
		<th> ICCID (TSM)</th>
		<th> Codice Op</th>
		<th> Motivazione</th>
		<th> Note</th>
		<th> Id operatore </th>';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
			<tr>
			<td> ' . $row["id"] . '</td>
			<td> ' . $row["emer"] . '</td>
			<td> ' . $row["mbiemer"] . '</td>
			<td> ' . $row["data"] . '</td>
			<td> ' . $row["status"] . '</td>
			<td> ' . $row["gestore_tel"] . '</td>
			<td> ' . $row["tipologia_cnt"] . '</td>
			<td> ' . $row["app_cnt"] . '</td>
			<td> ' . $row["numero_fisso"] . '</td>
			<td> ' . $row["comune"] . '</td>
			<td> ' . $row["provincia"] . '</td>
			<td> ' . $row["frazione"] . '</td>
			<td> ' . $row["cap"] . '</td>
			<td> ' . $row["via"] . '</td>
			<td> ' . $row["nr_civico"] . '</td>
			<td> ' . $row["luogo_di_nascita"] . '</td>
			<td> ' . $row["nr_documento"] . '</td>
			<td> ' . $row["comune_emmissione"] . '</td>
			<td> ' . $row["data_rilascio"] . '</td>
			<td> ' . $row["data_scadenza"] . '</td>
			<td> ' . $row["codice_fiscale"] . '</td>
			<td> ' . $row["codice_migrazione"] . '</td>
			<td> ' . $row["recapito_cell"] . '</td>
			<td> ' . $row["operatore_cell"] . '</td>
			<td> ' . $row["offerta_scelta"] . '</td>
			<td> ' . $row["cell_off_tsm"] . '</td>
			<td> ' . $row["iccid"] . '</td>
			<td> ' . $row["codice_op"] . '</td>
			<td> ' . $row["motivazione"] . '</td>
			<td> ' . $row["note"] . '</td>
			<td> ' . $row["#id_Operator"] . '</td>
			
			</tr> ';

            }
            $output .= '</table>';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=raporti.xls");

            echo $output;


        }
	
}
else {
        $sql = "SELECT * FROM `kliente` WHERE `data` >= '$dat_f' AND `data` <= '$dat_mb' ORDER BY id DESC";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            $output .= '
		<table class="table" bordered="1">
		<tr>
		<th> Id</th>
		<th> Nome </th>
		<th> Cognome </th>
		<th> Data </th>
		<th> Stato </th>
		<th> Gestore Telefonico</th>
		<th> Tipologia CNT </th>
		<th> APP/CNT </th>
		<th> Numero Fisso </th>
		<th> Comune </th>
		<th> Provincia</th>
		<th> Frazione </th>
		<th> Cap </th>
		<th> Via </th>
		<th> Nr Civico </th>
		<th>  Luogo di nascita</th>
		<th> N. Documento </th>
		<th> Comune di Emessione </th>
		<th> Data di Rilascio </th>
		<th> Data di Scadenza </th>
		<th> Codice Fiscale</th>
		<th> Codice di Migrazione</th>
		<th> Recapito di Cell</th>
		<th> Operatore Cell</th>
		<th> Offerta Scelta</th>
		<th> Cell Off TSM</th>
		<th> ICCID (TSM)</th>
		<th> Codice Op</th>
		<th> Motivazione</th>
		<th> Note</th>
		<th> Id operatore </th>';
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
			<tr>
			<td> ' . $row["id"] . '</td>
			<td> ' . $row["emer"] . '</td>
			<td> ' . $row["mbiemer"] . '</td>
			<td> ' . $row["data"] . '</td>
			<td> ' . $row["status"] . '</td>
			<td> ' . $row["gestore_tel"] . '</td>
			<td> ' . $row["tipologia_cnt"] . '</td>
			<td> ' . $row["app_cnt"] . '</td>
			<td> ' . $row["numero_fisso"] . '</td>
			<td> ' . $row["comune"] . '</td>
			<td> ' . $row["provincia"] . '</td>
			<td> ' . $row["frazione"] . '</td>
			<td> ' . $row["cap"] . '</td>
			<td> ' . $row["via"] . '</td>
			<td> ' . $row["nr_civico"] . '</td>
			<td> ' . $row["luogo_di_nascita"] . '</td>
			<td> ' . $row["nr_documento"] . '</td>
			<td> ' . $row["comune_emmissione"] . '</td>
			<td> ' . $row["data_rilascio"] . '</td>
			<td> ' . $row["data_scadenza"] . '</td>
			<td> ' . $row["codice_fiscale"] . '</td>
			<td> ' . $row["codice_migrazione"] . '</td>
			<td> ' . $row["recapito_cell"] . '</td>
			<td> ' . $row["operatore_cell"] . '</td>
			<td> ' . $row["offerta_scelta"] . '</td>
			<td> ' . $row["cell_off_tsm"] . '</td>
			<td> ' . $row["iccid"] . '</td>
			<td> ' . $row["codice_op"] . '</td>
			<td> ' . $row["motivazione"] . '</td>
			<td> ' . $row["note"] . '</td>
			<td> ' . $row["#id_Operator"] . '</td>
			
			</tr> ';

            }
            $output .= '</table>';
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=raporti.xls");

            echo $output;


        }
}
}

?>
























