<?php
    session_start();
    include "../config/db.php";

    if(!isset($_SESSION['user_id']))
    {
        exit("Unauthorized");
    }

    if($_SESSION['role']!="admin" && $_SESSION['role']!="super_admin")
    {
        exit("Access Denied");
    }

    if(isset($_POST['id']))
    {
        $id = intval($_POST['id']);

        $sql = "DELETE FROM users WHERE id='$id'";

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