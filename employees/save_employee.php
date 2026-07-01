<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['employee_name'])) {

    $employee_name = mysqli_real_escape_string($conn, $_POST['employee_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Default Photo
    $photo = "";

    // Duplicate Email Check
    $check = mysqli_query($conn, "SELECT id FROM employees WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
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
                    title: 'Duplicate Email',
                    text: 'Employee email already exists.'
                }).then(function () {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
        exit();
    }

    // Mobile Validation
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
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
                    title: 'Invalid Mobile',
                    text: 'Enter a valid 10-digit mobile number.'
                }).then(function () {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
        exit();
    }

    // Photo Upload
    if (!empty($_FILES['photo']['name'])) {

        $photo = time() . "_" . basename($_FILES['photo']['name']);

        move_uploaded_file(
            $_FILES['photo']['tmp_name'],
            "../uploads/employees/" . $photo
        );
    }

    // Insert Query
    $sql = "INSERT INTO employees (employee_name, designation, dob, doj, blood_group, mobile, email, address, photo) VALUES ('$employee_name', '$designation', '$dob', '$doj', '$blood_group', '$mobile', '$email', '$address', '$photo')";

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
                    text: 'Employee Added Successfully',
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
                    text: 'Unable to save employee.'
                }).then(function () {
                    history.back();
                });
            </script>

        </body>

        </html>
        <?php
    }
}
?>