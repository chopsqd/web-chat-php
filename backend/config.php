<?php

    $connection = mysqli_connect("localhost", "root","", "chat");
    if(!$connection) {
        echo mysqli_connect_error();
    }

?>