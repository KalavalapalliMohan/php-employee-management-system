
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}


if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = $_POST['dob'];

    // Existing Images
    $profile = $user['profile_picture'];
    $signature = $user['signature'];

    // Profile Picture Upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile = time() . "_" . $_FILES['profile_picture']['name'];

        move_uploaded_file(
            $_FILES['profile_picture']['tmp_name'],
            "../uploads/profiles/" . $profile
        );
    }

    // Signature Upload
    if (!empty($_FILES['signature']['name'])) {
        $signature = time() . "_" . $_FILES['signature']['name'];

        move_uploaded_file(
            $_FILES['signature']['tmp_name'],
            "../uploads/signatures/" . $signature
        );
    }

    $sql = "UPDATE users SET

            name='$name',
            mobile='$mobile',
            gender='$gender',
            address='$address',
            dob='$dob',
            profile_picture='$profile',
            signature='$signature'

            WHERE id='$user_id'";

            $success = false;
            $error = false;

            if(mysqli_query($conn,$sql))
            {
                $_SESSION['name']=$name;
                $success = true;
            }
            else
            {
                $error = true;
            }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        }

        .preview {
            width: 120px;
            height: 120px;
            border: 1px solid #ccc;
            object-fit: cover;
            padding: 5px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header bg-primary text-white d-flex justify-content-between">

                <h3>My Profile</h3>

                <a href="../dashboard.php" class="btn btn-light">

                    Dashboard

                </a>

            </div>

            <div class="card-body">

                <form method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6">

                            <label>Name</label>

                            <input type="text" name="name" class="form-control"
                                value="<?php echo htmlspecialchars($user['name']); ?>">

                        </div>

                        <div class="col-md-6">

                            <label>Email</label>

                            <input type="email" class="form-control"
                                value="<?php echo htmlspecialchars($user['email']); ?>" readonly>

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col-md-6">

                            <label>Mobile</label>

                            <input type="text" name="mobile" class="form-control"
                                value="<?php echo htmlspecialchars($user['mobile']); ?>">

                        </div>

                        <div class="col-md-6">

                            <label>Gender</label>

                            <select name="gender" class="form-control">

                                <option value="Male" <?php if ($user['gender'] == "Male")
                                    echo "selected"; ?>>Male</option>

                                <option value="Female" <?php if ($user['gender'] == "Female")
                                    echo "selected"; ?>>Female
                                </option>

                                <option value="Other" <?php if ($user['gender'] == "Other")
                                    echo "selected"; ?>>Other
                                </option>

                            </select>

                        </div>

                    </div>

                    <br>

                    <label>Address</label>

                    <textarea name="address" class="form-control"
                        rows="3"><?php echo htmlspecialchars($user['address']); ?></textarea>

                    <br>

                    <div class="row">

                        <div class="col-md-6">

                            <label>Date of Birth</label>

                            <input type="date" name="dob" class="form-control" value="<?php echo $user['dob']; ?>">

                        </div>

                        <div class="col-md-6">

                            <label>Role</label>

                            <input type="text" class="form-control" value="<?php echo ucfirst($user['role']); ?>"
                                readonly>

                        </div>

                    </div>

                    <br>

                    <div class="row">

                        <div class="col-md-6">

                            <label>Profile Picture</label>

                            <input type="file" name="profile_picture" id="profile_picture" class="form-control">

                            <br>

                            <?php
                            if (!empty($user['profile_picture'])) {
                                ?>

                                <img src="../uploads/profiles/<?php echo $user['profile_picture']; ?>" class="preview">

                                <?php
                            }
                            ?>

                        </div>

                        <div class="col-md-6">

                            <label>Signature</label>

                            <input type="file" name="signature" id="signature" class="form-control">

                            <br>

                            <?php
                            if (!empty($user['signature'])) {
                                ?>

                                <img src="../uploads/signatures/<?php echo $user['signature']; ?>" class="preview">

                                <?php
                            }
                            ?>

                        </div>

                    </div>

                    <br>

                    <button type="submit" name="update" class="btn btn-success">

                        Update Profile

                    </button>

                    <a href="../dashboard.php" class="btn btn-secondary">

                        Back

                    </a>

                </form>

            </div>

        </div>

    </div>

    <?php if(isset($success) && $success){ ?>
        <script>

        Swal.fire({

            icon:'success',

            title:'Success',

            text:'Profile Updated Successfully'

        }).then(()=>{

            window.location='profile.php';

        });

        </script>
    <?php } ?>

    <?php if(isset($error) && $error){ ?>
        <script>

        Swal.fire({

            icon:'error',

            title:'Error',

            text:'Update Failed'

        });

        </script>
    <?php } ?>


    <script>
        function validateImage(input, previewId) {
            const file = input.files[0];

            if (!file) {
                return;
            }

            const allowed = [
                "image/jpeg",
                "image/jpg",
                "image/png"
            ];

            if (!allowed.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File',
                    text: 'Only JPG, JPEG and PNG files are allowed.'
                });

                input.value = "";
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'Maximum file size is 2 MB.'
                });

                input.value = "";
                return;
            }

            let reader = new FileReader();

            reader.onload = function (e) {

                document.getElementById(previewId).src = e.target.result;

            }

            reader.readAsDataURL(file);
        }

        document.getElementById("profile_picture").addEventListener("change", function () {

            validateImage(this, "profilePreview");

        });

        document.getElementById("signature").addEventListener("change", function () {

            validateImage(this, "signaturePreview");

        });

    </script>
</body>

</html>