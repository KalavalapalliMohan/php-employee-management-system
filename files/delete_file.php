<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: my_files.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id = (int) $_GET['id'];

// Logged-in user's file మాత్రమే fetch చేయాలి
$sql = "SELECT * FROM user_files
        WHERE id='$id' AND user_id='$user_id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'File not found.'
            }).then(() => {
                window.location = 'my_files.php';
            });
        </script>

    </body>

    </html>
    <?php
    exit();
}

$file = mysqli_fetch_assoc($result);

$file_path = "../uploads/identity/" . $file['file_name'];

// Database record delete
$delete = mysqli_query(
    $conn,
    "DELETE FROM user_files
     WHERE id='$id' AND user_id='$user_id'"
);

if ($delete) {

    if (file_exists($file_path)) {
        unlink($file_path);
    }

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: 'File deleted successfully.'
            }).then(() => {
                window.location = 'my_files.php';
            });
        </script>

    </body>

    </html>
    <?php

} else {

    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Unable to delete file.'
            }).then(() => {
                window.location = 'my_files.php';
            });
        </script>

    </body>

    </html>
    <?php
}
?>