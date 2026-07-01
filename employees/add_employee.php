<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header bg-success text-white">

                <div class="d-flex justify-content-between">

                    <h3>Add Employee</h3>

                    <a href="employee_list.php" class="btn btn-light">
                        Employee List
                    </a>

                </div>

            </div>

            <div class="card-body">

                <form action="save_employee.php" method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Employee Name</label>

                            <input type="text" name="employee_name" id="employee_name" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Email</label>

                            <input type="email" name="email" id="email" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Mobile</label>

                            <input type="text" name="mobile" id="mobile" class="form-control" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Designation</label>

                            <input type="text" name="designation" id="designation" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Date of Birth</label>

                            <input type="date" name="dob" id="dob" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Date of Joining</label>

                            <input type="date" name="doj" id="doj" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Blood Group</label>

                            <select name="blood_group" id="blood_group" class="form-select">

                                <option value="">Select</option>

                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Employee Photo</label>

                            <input type="file" name="photo" id="photo" class="form-control" accept=".jpg,.jpeg,.png">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Address</label>

                        <textarea name="address" id="address" class="form-control" rows="4"></textarea>

                    </div>

                    <button type="submit" class="btn btn-success">

                        Save Employee

                    </button>

                    <button type="reset" class="btn btn-warning">

                        Reset

                    </button>

                    <a href="employee_list.php" class="btn btn-secondary">

                        Back

                    </a>

                </form>

            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $("form").submit(function (e) {

            let name = $("#employee_name").val().trim();
            let email = $("#email").val().trim();
            let mobile = $("#mobile").val().trim();
            let designation = $("#designation").val().trim();
            let dob = $("#dob").val();
            let doj = $("#doj").val();
            let blood = $("#blood_group").val();
            let address = $("#address").val().trim();

            if (name == "") {
                Swal.fire("Error", "Employee Name is required", "error");
                e.preventDefault();
                return;
            }

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                Swal.fire("Error", "Enter valid Email", "error");
                e.preventDefault();
                return;
            }

            let mobilePattern = /^[0-9]{10}$/;

            if (!mobilePattern.test(mobile)) {
                Swal.fire("Error", "Enter valid 10-digit Mobile Number", "error");
                e.preventDefault();
                return;
            }


            if (designation == "") {
                Swal.fire("Error", "Designation is required", "error");
                e.preventDefault();
                return;
            }

            if (dob == "") {
                Swal.fire("Error", "Select Date of Birth", "error");
                e.preventDefault();
                return;
            }

            if (doj == "") {
                Swal.fire("Error", "Select Date of Joining", "error");
                e.preventDefault();
                return;
            }

            if (blood == "") {
                Swal.fire("Error", "Select Blood Group", "error");
                e.preventDefault();
                return;
            }

            if (address == "") {
                Swal.fire("Error", "Address is required", "error");
                e.preventDefault();
                return;
            }

            // Optional Photo Validation
            let file = $("#photo")[0].files[0];

            if (file) {
                let allowed = ["image/jpeg", "image/jpg", "image/png"];

                if (!allowed.includes(file.type)) {
                    Swal.fire("Error", "Only JPG, JPEG & PNG files are allowed.", "error");
                    e.preventDefault();
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire("Error", "Image size must be less than 2 MB.", "error");
                    e.preventDefault();
                    return;
                }
            }

        });

    </script>
</body>

</html>