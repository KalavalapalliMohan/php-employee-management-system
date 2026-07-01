<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found");
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $sql = "UPDATE users SET
            name='$name',
            mobile='$mobile',
            address='$address',
            gender='$gender'
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: user_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-5">

        <div class="card">

            <div class="card-header bg-primary text-white">

                <h3>Edit User</h3>

            </div>

            <div class="card-body">

                <form method="POST">

                    <label>Name</label>

                    <input type="text" name="name" class="form-control"
                        value="<?php echo htmlspecialchars($user['name']); ?>" required>

                    <br>

                    <label>Mobile</label>

                    <input type="text" name="mobile" class="form-control"
                        value="<?php echo htmlspecialchars($user['mobile']); ?>" required>

                    <br>

                    <label>Address</label>

                    <textarea name="address" class="form-control"
                        required><?php echo htmlspecialchars($user['address']); ?></textarea>

                    <br>

                    <label>Gender</label>

                    <select name="gender" class="form-control">

                        <option value="Male" <?php if ($user['gender'] == "Male")
                            echo "selected"; ?>>Male</option>

                        <option value="Female" <?php if ($user['gender'] == "Female")
                            echo "selected"; ?>>Female</option>

                        <option value="Other" <?php if ($user['gender'] == "Other")
                            echo "selected"; ?>>Other</option>

                    </select>

                    <br>

                    <button type="submit" name="update" class="btn btn-success">

                        Update User

                    </button>

                    <a href="user_list.php" class="btn btn-secondary">

                        Back

                    </a>

                </form>

            </div>

        </div>

    </div>

</body>

</html>