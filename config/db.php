<?php

    $host="localhost";
    $user="root";
    $password="";
    $database="php_task";

    $conn=mysqli_connect($host,$user,$password,$database);

    if(!$conn) {
        die("Database Connection Failed");
    }

?>