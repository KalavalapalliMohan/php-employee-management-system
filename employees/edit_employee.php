<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: employee_list.php");
    exit();
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM employees WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Employee not found.");
}

$employee = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Employee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
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

            <div class="card-header bg-warning">

                <div class="d-flex justify-content-between">

                    <h3>Edit Employee</h3>

                    <a href="employee_list.php" class="btn btn-dark">
                        Back
                    </a>

                </div>

            </div>

            <div class="card-body">

                <form action="update_employee.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Employee Name</label>

                            <input type="text" name="employee_name" class="form-control"
                                value="<?php echo htmlspecialchars($employee['employee_name']); ?>" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input type="email" name="email" class="form-control"
                                value="<?php echo htmlspecialchars($employee['email']); ?>" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Mobile</label>

                            <input type="text" name="mobile" class="form-control" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                value="<?php echo htmlspecialchars($employee['mobile']); ?>" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Designation</label>

                            <input type="text" name="designation" class="form-control"
                                value="<?php echo htmlspecialchars($employee['designation']); ?>" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Blood Group</label>

                            <input type="text" name="blood_group" class="form-control"
                                value="<?php echo htmlspecialchars($employee['blood_group']); ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Date of Joining</label>

                            <input type="date" name="doj" class="form-control" value="<?php echo $employee['doj']; ?>">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Address</label>

                        <textarea name="address" class="form-control"
                            rows="3"><?php echo htmlspecialchars($employee['address']); ?></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Employee Photo</label>

                        <input type="file" name="photo" id="photo" class="form-control" accept=".jpg,.jpeg,.png">

                        <br>

                        <?php
                        if (!empty($employee['photo'])) {
                            ?>
                            <img src="../uploads/employees/<?php echo $employee['photo']; ?>" id="photoPreview" width="120"
                                height="120" style="object-fit:cover;border:1px solid #ccc;padding:5px;">
                            <?php
                        } else {
                            ?>
                            <img src="https://placehold.co/120x120?text=No+Photo" id="photoPreview" width="120" height="120"
                                style="object-fit:cover;border:1px solid #ccc;padding:5px;">
                            <?php
                        }
                        ?>

                    </div>

                    <button type="submit" class="btn btn-success">

                        Update Employee

                    </button>

                    <a href="employee_list.php" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>
<script>

document.getElementById("photo").addEventListener("change",function(){

    let file=this.files[0];

    if(!file)
    {
        return;
    }

    let allowed=["image/jpeg","image/png","image/jpg"];

    if(!allowed.includes(file.type))
    {
        Swal.fire({
            icon:"error",
            title:"Invalid File",
            text:"Only JPG, JPEG and PNG allowed."
        });

        this.value="";

        return;
    }

    if(file.size>2*1024*1024)
    {
        Swal.fire({
            icon:"error",
            title:"File Too Large",
            text:"Maximum 2MB allowed."
        });

        this.value="";

        return;
    }

    let reader=new FileReader();

    reader.onload=function(e){

        document.getElementById("photoPreview").src=e.target.result;

    }

    reader.readAsDataURL(file);

});

</script>
</body>

</html>