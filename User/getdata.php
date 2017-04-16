

<?php
include("../db_connect.php");
$query = mysqli_query($link,"SELECT * FROM `operator` WHERE `Id_Student` = '$pid';");




?>
