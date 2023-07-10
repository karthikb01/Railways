<?php
    require("connection.php");
    if(isset($_SESSION['IS_LOGIN'])){
        unset($_SESSION['IS_LOGIN']);
    }
    if(isset($_SESSION['is_admin_login'])){
        $_SESSION['is_admin_login']="no";
    }
   
    if(isset($_SESSION['P_id'])){
        unset($_SESSION['P_id']);
    }
    
    header('location:../index.php');
            die();
?>
