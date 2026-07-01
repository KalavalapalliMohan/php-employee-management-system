<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $doj = mysqli_real_escape_string($conn, $_POST['doj']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $photo = "";

    $getPhoto = mysqli_query($conn,"SELECT photo FROM employees WHERE id='$id'");
    $oldPhoto = mysqli_fetch_assoc($getPhoto);

    $photo = $oldPhoto['photo'];

    if(!empty($_FILES['photo']['name']))
    {
        $photo = time()."_".$_FILES['photo']['name'];

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../uploads/employees/".$photo
        );
    }

    $sql = "UPDATE employees SET

            employee_name='$employee_name',
            email='$email',
            mobile='$mobile',
            designation='$designation',
            blood_group='$blood_group',
            doj='$doj',
            address='$address',
            photo='$photo'

            WHERE id='$id'";

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
                    text: 'Employee Updated Successfully',
                    timer:2000,
                    showConfirmButton:false
                }).then(function () {
                    window.location = 'employee_list.php';
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
                    text: 'Employee Update Failed'
                }).then(function () {
                    history.back();
                });

            </script>

        </body>

        </html>
        <?php
    }
} else {
    header("Location: employee_list.php");
}
?>