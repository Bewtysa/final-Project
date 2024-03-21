<?php 

    session_start();
    unset($_SESSION['customer_login']);
    unset($_SESSION['admin_login']);
    header('location: login.php');

?>