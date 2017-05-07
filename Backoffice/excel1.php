<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

$db_hostname = 'localhost';
$db_database = 'crm';
$db_username = 'root';
$db_password = '';

$Connect = @mysql_connect($db_hostname, $db_username, $db_password) 
or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno()); 

$Db = @mysql_select_db($db_database, $Connect) 
or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());


$dat_f = $_POST['d_inX'];
 $dat_mb = $_POST['d_outX'];
	if($dat_f==NULL || $dat_mb==NULL)
	{
	        $sql = "SELECT * FROM `kliente` ORDER BY id DESC";


$result = @mysql_query($sql,$Connect) 
or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());










// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 1;  


//start of printing column names as names of MySQL fields  

 $column = 'A';

for ($i = 1; $i < mysql_num_fields($result); $i++)  

{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysql_field_name($result,$i));
    $column++;
}



// Set document properties



$rowCount = 2;  

while($row = mysql_fetch_row($result))  

{  
    $column = 'A';

   for($j=1; $j<mysql_num_fields($result);$j++)  
    {  
        if(!isset($row[$j]))  

            $value = NULL;  

        elseif ($row[$j] != "")  

            $value = strip_tags($row[$j]);  

        else  

            $value = "";  


        $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        $column++;
    }  

    $rowCount++;
} 


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="results.xlsx"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save('php://output');
}
else
{
	$sql = "SELECT * FROM `kliente` WHERE `data` >= '$dat_f' AND `data` <= '$dat_mb' ORDER BY id DESC";


$result = @mysql_query($sql,$Connect) 
or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());










// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0); 

$rowCount = 1;  


//start of printing column names as names of MySQL fields  

 $column = 'A';

for ($i = 1; $i < mysql_num_fields($result); $i++)  

{
    $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, mysql_field_name($result,$i));
    $column++;
}



// Set document properties



$rowCount = 2;  

while($row = mysql_fetch_row($result))  

{  
    $column = 'A';

   for($j=1; $j<mysql_num_fields($result);$j++)  
    {  
        if(!isset($row[$j]))  

            $value = NULL;  

        elseif ($row[$j] != "")  

            $value = strip_tags($row[$j]);  

        else  

            $value = "";  


        $objPHPExcel->getActiveSheet()->setCellValue($column.$rowCount, $value);
        $column++;
    }  

    $rowCount++;
} 


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename="results.xlsx"'); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save('php://output');
}

exit;
