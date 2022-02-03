<?php

    session_start();
    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($connection, $_GET['logout_id']);
        if(isset($logout_id)) {
            $sql = mysqli_query($connection, "UPDATE users SET status = 'Offline now' WHERE unique_id = {$logout_id}");
            if($sql) {
                session_unset();
                session_destroy();
                header("location: ../frontend/login.php");
            }
        } else {
            header("location: ../frontend/users.php");
        }
    } else {
        header("location: ../frontend/login.php");
    }

?>
