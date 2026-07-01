<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM user_files
        WHERE user_id='$user_id'
        ORDER BY uploaded_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Identity Files</title>

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

                    <h3>My Identity Files</h3>

                    <div>

                        <a href="upload_file.php" class="btn btn-light">

                            Upload New

                        </a>

                        <a href="../dashboard.php" class="btn btn-warning">

                            Dashboard

                        </a>

                    </div>

                </div>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>S.No</th>

                            <th>Document Type</th>

                            <th>Original File</th>

                            <th>Uploaded Date</th>

                            <th width="250">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                <tr>

                                    <td><?= $i++; ?></td>

                                    <td><?= htmlspecialchars($row['file_type']); ?></td>

                                    <td><?= htmlspecialchars($row['original_name']); ?></td>

                                    <td><?= $row['uploaded_at']; ?></td>

                                    <td>

                                        <a href="../uploads/identity/<?= urlencode($row['file_name']); ?>" target="_blank"
                                            class="btn btn-primary btn-sm">

                                            View

                                        </a>

                                        <a href="../uploads/identity/<?= urlencode($row['file_name']); ?>" download
                                            class="btn btn-success btn-sm">

                                            Download

                                        </a>

                                        <a href="delete_file.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this file?')">

                                            Delete

                                        </a>

                                    </td>

                                </tr>

                                <?php
                            }
                        } else {
                            ?>

                            <tr>

                                <td colspan="5" class="text-center">

                                    No Files Uploaded

                                </td>

                            </tr>

                            <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>