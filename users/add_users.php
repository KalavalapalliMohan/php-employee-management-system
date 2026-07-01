<?php
include "../config/db.php";

$message = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $password = md5($_POST['password']);

    // Check Email
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert alert-danger'>Email already exists.</div>";
    } else {
        // Profile Picture
        $profile = "";

        if (!empty($_FILES['profile_picture']['name'])) {
            $profile = time() . "_" . $_FILES['profile_picture']['name'];

            move_uploaded_file(
                $_FILES['profile_picture']['tmp_name'],
                "uploads/profiles/" . $profile
            );
        }

        // Signature
        $signature = "";

        if (!empty($_FILES['signature']['name'])) {
            $signature = time() . "_" . $_FILES['signature']['name'];

            move_uploaded_file(
                $_FILES['signature']['tmp_name'],
                "uploads/signatures/" . $signature
            );
        }

        $sql = "INSERT INTO users (name, role, mobile, email, password, address, gender, dob, profile_picture, signature, status) VALUES ('$name', 'user', '$mobile', '$email', '$password', '$address', '$gender', '$dob', '$profile', '$signature', 'Pending')";
        if (mysqli_query($conn, $sql)) {
            $success = true;
        } else {
            $error = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>User Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0px 0px 10px #ccc;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-7">

                <div class="card">

                    <div class="card-header bg-success text-white">

                        <h3>User Registration</h3>

                    </div>

                    <div class="card-body">

                        <?php echo $message; ?>

                        <form method="POST" enctype="multipart/form-data" id="registerForm">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>

                            <br>

                            <label>Address</label>
                            <textarea name="address" id="address" class="form-control"></textarea>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Select</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label>Signature</label>
                                    <input type="file" name="signature" id="signature" class="form-control">
                                </div>
                            </div>

                            <br>

                            <button type="submit" name="register" class="btn btn-success">
                                Register
                            </button>

                            <a href="user_list.php" class="btn btn-secondary">

                                Back

                            </a>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if (isset($success)) { ?>
    <script>
    Swal.fire({
        title: "Success!",
        text: "Registration Successful.",
        icon: "success",
        confirmButtonText: "OK"
    }).then(() => {
        window.location.href = "user_list.php";
    });
    </script>
    <?php } ?>

    <?php if (isset($error)) { ?>
    <script>
    Swal.fire({
        title: "Error!",
        text: "Registration Failed.",
        icon: "error"
    });
    </script>
    <?php } ?>

    <script>
        // Allow only numbers in mobile field
        $("#mobile").on("input", function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $("#registerForm").submit(function (e) {

            let name = $("#name").val().trim();
            let mobile = $("#mobile").val().trim();
            let email = $("#email").val().trim();
            let password = $("#password").val();
            let address = $("#address").val().trim();
            let gender = $("#gender").val();
            let dob = $("#dob").val();

            // Name
            if (!/^[A-Za-z ]{3,50}$/.test(name)) {
                Swal.fire("Error", "Enter a valid name (letters only)", "error");
                e.preventDefault();
                return;
            }

            // Mobile
            if (!/^[0-9]{10}$/.test(mobile)) {
                Swal.fire("Error", "Enter a valid 10-digit mobile number", "error");
                e.preventDefault();
                return;
            }

            // Email
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                Swal.fire("Error", "Enter a valid email address", "error");
                e.preventDefault();
                return;
            }

            // Password
            if (password.length < 6) {
                Swal.fire("Error", "Password must be at least 6 characters", "error");
                e.preventDefault();
                return;
            }

            // Address
            if (address.length < 3) {
                Swal.fire("Error", "Address must be at least 3 characters", "error");
                e.preventDefault();
                return;
            }

            // Gender
            if (gender == "") {
                Swal.fire("Error", "Please select gender", "error");
                e.preventDefault();
                return;
            }

            // DOB
            if (dob == "") {
                Swal.fire("Error", "Please select Date of Birth", "error");
                e.preventDefault();
                return;
            }

            // Profile Picture Validation
            let profile = $("#profile_picture")[0].files[0];
            if (profile) {
                let ext = profile.name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
                    Swal.fire("Error", "Profile picture must be JPG, JPEG or PNG", "error");
                    e.preventDefault();
                    return;
                }

                if (profile.size > 2 * 1024 * 1024) {
                    Swal.fire("Error", "Profile picture size must be less than 2MB", "error");
                    e.preventDefault();
                    return;
                }
            }

            // Signature Validation
            let sign = $("#signature")[0].files[0];
            if (sign) {
                let ext = sign.name.split('.').pop().toLowerCase();
                if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
                    Swal.fire("Error", "Signature must be JPG, JPEG or PNG", "error");
                    e.preventDefault();
                    return;
                }

                if (sign.size > 2 * 1024 * 1024) {
                    Swal.fire("Error", "Signature size must be less than 2MB", "error");
                    e.preventDefault();
                    return;
                }
            }

        });
    </script>

</body>

</html>