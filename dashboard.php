<?php

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    include "config/db.php";

    // Dashboard Counts
    $totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"));
    $pendingUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE status='Pending'"));
    $totalEmployees = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM employees"));
    $totalFiles = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM user_files"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #343a40;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        }
    </style>

</head>

<body>

    <!-- Navbar -->

    <nav class="navbar navbar-dark bg-dark">

        <div class="container-fluid">

            <span class="navbar-brand">
                PHP User Management System
            </span>

            <div class="text-white">

                Welcome,
                <strong><?php echo $_SESSION['name']; ?></strong>

                |

                <?php echo ucfirst($_SESSION['role']); ?>

                |

                <a href="logout.php" class="btn btn-danger btn-sm">

                    Logout

                </a>

            </div>

        </div>

    </nav>

    <div class="container-fluid">

        <div class="row">

            <!-- Sidebar -->

            <div class="col-md-2 sidebar">

                <h4 class="text-white text-center mt-3">

                    MENU

                </h4>

                <hr class="text-white">

                <a href="dashboard.php">

                    🏠 Dashboard

                </a>

                <?php
                if ($_SESSION['role'] == "super_admin" || $_SESSION['role'] == "admin") {
                    ?>

                    <a href="users/user_list.php">

                        👤 Manage Users

                    </a>

                    <a href="employees/employee_list.php">

                        👨‍💼 Employees

                    </a>

                    <?php
                }
                ?>

                <a href="files/upload_file.php">

                    📂 Upload File

                </a>

                <a href="users/profile.php">

                    ⚙ My Profile

                </a>

            </div>

            <!-- Main Content -->

            <div class="col-md-10">

                <div class="container mt-4">

                    <h3>

                        Dashboard

                    </h3>

                    <hr>

                    <div class="row">

                        <div class="col-md-3">

                            <div class="card text-center">

                                <div class="card-body">

                                    <h5>Total Users</h5>

                                    <h2>

                                        <?php echo $totalUsers['total']; ?>

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card text-center">

                                <div class="card-body">

                                    <h5>Pending Users</h5>

                                    <h2>

                                        <?php echo $pendingUsers['total']; ?>

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card text-center">

                                <div class="card-body">

                                    <h5>Employees</h5>

                                    <h2>

                                        <?php echo $totalEmployees['total']; ?>

                                    </h2>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="card text-center">

                                <div class="card-body">

                                    <h5>Uploaded Files</h5>

                                    <h2>

                                        <?php echo $totalFiles['total']; ?>

                                    </h2>

                                </div>

                            </div>

                        </div>

                    </div>

                    <br>

                    <div class="card">

                        <div class="card-header bg-primary text-white">

                            Welcome

                        </div>

                        <div class="card-body">

                            <h4>

                                Hello,

                                <?php echo $_SESSION['name']; ?>

                            </h4>

                            <p>

                                Role :

                                <strong>

                                    <?php echo ucfirst($_SESSION['role']); ?>

                                </strong>

                            </p>

                            <p>

                                Welcome to the PHP User Management System Dashboard.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>