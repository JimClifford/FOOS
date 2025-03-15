<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['admin'] == true) {
        header("Location: admin.php");
        exit();
    }else{
    header("Location: login.php");
    exit();

    }
    
} else{
    header("Location: login.php");
    exit();

}

?> 