<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    exit();
}

if(isset($_POST['id']))
{
    $id = (int)$_POST['id'];

    $sql = "DELETE FROM employees WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "success";
    }
    else
    {
        echo "error";
    }
}
?>