<?php
include ("../db_connect.php");
session_start();
if($_SESSION!=NULL){
    $user = $_SESSION['user'];
    $query = mysqli_query($link, "SELECT username FROM `admin` WHERE `username` = '$user' ;");
$rows=mysqli_num_rows($query);
if($rows!=0){
    header("Location: ../Admin/arkiv.php");
}
    else{
        header("Location: ../User/arkiv.php");
    }
}


?>


<!DOCTYPE html>

<html>
<head>
    <title>Icon Albania</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="login.css" type="text/css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora" rel="stylesheet" type="text/css">


</head>
<body class="backg" >
<div class="transp">
    <div id="titulli">
        <h2>Icon Albania</h2>
    </div>
    <div id="login">

        <form  method="post" action="login.php">
            <input type="text" name="username"  placeholder="Username" required><br>
            <input type="password" name="password"   placeholder="Password" required><br>

            <input type="submit" name="login_submit" value="Log in" style="color: white">
        </form>
    </div>

</div>
</body>
</html>
