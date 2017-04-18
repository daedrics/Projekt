<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['username'] != '')
    echo true;

else
    echo false;
?>