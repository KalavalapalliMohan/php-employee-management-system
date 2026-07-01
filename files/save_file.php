<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['file_type']) && isset($_FILES['identity_file'])) {

    $user_id = $_SESSION['user_id'];
    $file_type = mysqli_real_escape_string($conn, $_POST['file_type']);

    $original_name = $_FILES['identity_file']['name'];
    $tmp_name = $_FILES['identity_file']['tmp_name'];
    $file_size = $_FILES['identity_file']['size'];
    $mime_type = mime_content_type($tmp_name);

    // Allowed MIME Types
    $allowed = [
        "application/pdf",
        "image/jpeg",
        "image/png"
    ];

    if (!in_array($mime_type, $allowed)) {
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
                    title: 'Invalid File',
                    text: 'Only PDF, JPG and PNG files are allowed.'
                }).then(() => {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
        exit();
    }

    // Max 5 MB
    if ($file_size > 5 * 1024 * 1024) {

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
                    title: 'File Too Large',
                    text: 'Maximum file size is 5 MB.'
                }).then(() => {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
        exit();
    }

    // Rename File
    $extension = pathinfo($original_name, PATHINFO_EXTENSION);

    $new_name = time() . "_" . uniqid() . "." . $extension;

    $upload_path = "../uploads/identity/" . $new_name;

    if (move_uploaded_file($tmp_name, $upload_path)) {

        $sql = "INSERT INTO user_files
        (
            user_id,
            file_type,
            original_name,
            file_name,
            file_size,
            file_type_mime
        )
        VALUES
        (
            '$user_id',
            '$file_type',
            '$original_name',
            '$new_name',
            '$file_size',
            '$mime_type'
        )";

        if (mysqli_query($conn, $sql)) {

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
                        title: 'Success',
                        text: 'Identity File Uploaded Successfully'
                    }).then(() => {
                        window.location = 'my_files.php';
                    });
                </script>

            </body>

            </html>
            <?php

        } else {

            unlink($upload_path);

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
                        title: 'Database Error',
                        text: 'Unable to save file information.'
                    }).then(() => {
                        history.back();
                    });
                </script>

            </body>

            </html>
            <?php
        }

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
                    title: 'Upload Failed',
                    text: 'Unable to upload file.'
                }).then(() => {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
    }
}
?>