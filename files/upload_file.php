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

    <title>Upload Identity File</title>

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
    </style>

</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header bg-primary text-white">

                <div class="d-flex justify-content-between">

                    <h3>Upload Identity File</h3>

                    <a href="../dashboard.php" class="btn btn-light">

                        Dashboard

                    </a>

                </div>

            </div>

            <div class="card-body">

                <form action="save_file.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">

                        <label class="form-label">Document Type</label>

                        <select name="file_type" id="file_type" class="form-select" required>

                            <option value="">Select Document</option>

                            <option value="Aadhaar Card">Aadhaar Card</option>

                            <option value="PAN Card">PAN Card</option>

                            <option value="Passport">Passport</option>

                            <option value="Driving License">Driving License</option>

                            <option value="Voter ID">Voter ID</option>

                            <option value="Other">Other</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Choose File</label>

                        <input type="file" name="identity_file" id="identity_file" class="form-control"
                            accept=".pdf,.jpg,.jpeg,.png" required>

                        <small class="text-muted">

                            Allowed: PDF, JPG, JPEG, PNG (Max: 5MB)

                        </small>

                    </div>

                    <button type="submit" class="btn btn-success">

                        Upload File

                    </button>

                    <button type="reset" class="btn btn-warning">

                        Reset

                    </button>

                    <a href="my_files.php" class="btn btn-info text-white">

                        My Files

                    </a>

                </form>

            </div>

        </div>

    </div>

    <script>

        $("form").submit(function (e) {

            let type = $("#file_type").val();

            let file = $("#identity_file")[0].files[0];

            if (type == "") {
                Swal.fire("Error", "Please select document type.", "error");
                e.preventDefault();
                return;
            }

            if (!file) {
                Swal.fire("Error", "Please choose a file.", "error");
                e.preventDefault();
                return;
            }

            let allowed = [
                "application/pdf",
                "image/jpeg",
                "image/jpg",
                "image/png"
            ];

            if (!allowed.includes(file.type)) {
                Swal.fire("Error", "Only PDF, JPG, JPEG & PNG files are allowed.", "error");
                e.preventDefault();
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                Swal.fire("Error", "Maximum file size is 5 MB.", "error");
                e.preventDefault();
                return;
            }

        });

    </script>

</body>

</html>