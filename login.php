<?php
    session_start();
    include "config/db.php";

    // Already logged in
    if(isset($_SESSION['user_id'])) {
        header("Location: dashboard.php");
        exit();
    }

    $error = "";

    if(isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $user = mysqli_fetch_assoc($result);

            // MD5 (Assignment version)
            if(md5($password) == $user['password'])
            {
                if($user['role']=="user" && $user['status']=="Pending")
                {
                    $error = "Your account is waiting for Admin approval.";
                }
                else
                {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name']    = $user['name'];
                    $_SESSION['role']    = $user['role'];

                    header("Location: dashboard.php");
                    exit();
                }
            }
            else
            {
                $error = "Invalid Password";
            }
        }
        else
        {
            $error = "Email not found";
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body{
                background:#f4f6f9;
            }

            .card{
                margin-top:100px;
                border-radius:12px;
                box-shadow:0px 0px 15px #ccc;
            }
        </style>
    </head>

    <body>

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-5">

                    <div class="card">

                        <div class="card-header bg-primary text-white text-center">

                            <h3>Login</h3>

                        </div>

                        <div class="card-body">
                            <?php
                            if($error!="") {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                            <?php
                                }
                            ?>

                            <form method="POST">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                                </div>
                                <button class="btn btn-primary w-100" name="login"> Login </button>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a href="register.php"> Create New Account </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>