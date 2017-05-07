<?php
session_start();
?>


<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/16/2017
 * Time: 11:45 AM
 */

include ("../db_connect.php");

if(isset($_POST['login_submit'])) {
    $usrn = $_POST['username'];
    $pass = $_POST["password"];
    $query = mysqli_query($link, "SELECT * FROM `admin` WHERE `username` = '$usrn' AND `password` = '$pass';");
    $rows=mysqli_num_rows($query);
    if($rows!=0){
        $r=mysqli_fetch_row($query);
        $pid=$r[0];
        $_SESSION['user']=$r[3];
        $_SESSION['pid'] = $pid;
        $_SESSION['logged']='admin';
        header("Location: ../Admin/arkiv.php");

    }
    $query = mysqli_query($link, "SELECT * FROM `operator` WHERE `username` = '$usrn' AND `password` = '$pass';");
    $rows=mysqli_num_rows($query);
     if($rows!=0){

        $r=mysqli_fetch_row($query);
        $pid=$r[0];
         $_SESSION['user']=$r[3];
        $_SESSION['pid'] = $pid;
         $_SESSION['logged']='user';
        header("Location: ../User/arkiv.php");
    }
	 $query = mysqli_query($link, "SELECT * FROM `backoffice` WHERE `username` = '$usrn' AND `password` = '$pass';");
    $rows=mysqli_num_rows($query);
     if($rows!=0){

        $r=mysqli_fetch_row($query);
        $pid=$r[0];
         $_SESSION['user']=$r[3];
        $_SESSION['pid'] = $pid;
         $_SESSION['logged']='user';
        header("Location: ../Backoffice/arkiv.php");
    }
	
    else {
        echo '<script language="javascript">';
        echo 'alert("Te dhenat nuk jane te sakta!")';
        echo '</script>';
        echo "<script type='text/javascript'>location.href = 'index.php';</script>";

    }
}






?>