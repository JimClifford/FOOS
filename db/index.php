<?php
session_start();
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['admin'] == true) {
        header("Location: ../view/admin.php");
        exit();
    }else{
    header("Location: ../user_view/home.php");
    exit();

    }
    
} else{
    header("Location: ../view/login.php");
    exit();

}

?>