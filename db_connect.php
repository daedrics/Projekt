<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/16/2017
 * Time: 11:38 AM
 */


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





?>