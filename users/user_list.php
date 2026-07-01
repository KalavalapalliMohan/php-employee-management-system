<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

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

            <div class="card-header bg-primary text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h3>User Management</h3>
                    <div>
                        <?php if ($_SESSION['role'] == 'super_admin' || $_SESSION['role'] == 'admin') { ?>

                            <a href="add_users.php" class="btn btn-success">
                                Add User
                            </a>

                        <?php } ?>

                        <a href="../dashboard.php" class="btn btn-light">

                            Dashboard

                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>S No</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Mobile</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th width="220">Action</th>

                        </tr>

                    </thead>

                    <tbody id="userData">

                        <tr>

                            <td colspan="7" class="text-center">

                                Loading Users...

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let currentUserRole = "<?php echo $_SESSION['role']; ?>";
function loadUsers()
{
    $.ajax({
        url: "get_users.php",
        type: "GET",
        dataType: "json",

        success: function(response)
        {
            let output = "";

            if(response.length > 0)
            {
                $.each(response, function(index, user){

                    output += "<tr>";

                    output += "<td>"+(index + 1)+"</td>";
                    output += "<td>"+user.name+"</td>";
                    output += "<td>"+user.email+"</td>";
                    output += "<td>"+user.mobile+"</td>";
                    output += "<td>"+user.role+"</td>";

                    if(user.status=="Approved")
                    {
                        output += "<td><span class='badge bg-success'>Approved</span></td>";
                    }
                    else
                    {
                        output += "<td><span class='badge bg-warning text-dark'>Pending</span></td>";
                    }

                    output += "<td>";

                    if (currentUserRole == "super_admin") {

                        // Super Admin - All Access

                        if (user.status == "Pending") {
                            output += "<button class='btn btn-success btn-sm approveBtn' data-id='"+user.id+"'>Approve</button> ";
                        }

                        output += "<button class='btn btn-primary btn-sm editBtn' data-id='"+user.id+"'>Edit</button> ";

                        if (user.role != "super_admin") {
                            output += "<button class='btn btn-danger btn-sm deleteBtn' data-id='"+user.id+"'>Delete</button>";
                        }

                    }
                    else if (currentUserRole == "admin") {

                        // Admin - Only Delete and Approve

                        if (user.status == "Pending") {
                            output += "<button class='btn btn-success btn-sm approveBtn' data-id='"+user.id+"'>Approve</button> ";
                        }

                        if (user.role != "super_admin") {
                            output += "<button class='btn btn-danger btn-sm deleteBtn' data-id='"+user.id+"'>Delete</button>";
                        }

                    }

                    output += "</td>";

                    output += "</tr>";

                });
            }
            else
            {
                output = "<tr><td colspan='7' class='text-center'>No Users Found</td></tr>";
            }

            $("#userData").html(output);
        }
    });
}

// Load Users on Page Load
$(document).ready(function(){

    loadUsers();

});

// Approve User
$(document).on("click",".approveBtn",function(){

    let id = $(this).data("id");

    $.post("approve.php",{id:id},function(res){

        if(res.trim()=="success")
        {
            Swal.fire({
                icon:'success',
                title:'Approved',
                text:'User Approved Successfully',
                timer:1500,
                showConfirmButton:false
            });
            loadUsers();
        }
        else
        {
            Swal.fire({
                icon:'error',
                title:'Error',
                text:'Approval Failed'
            });
        }

    });

});

// Delete User
$(document).on("click",".deleteBtn",function(){

    let id=$(this).data("id");

    Swal.fire({

        title:'Are you sure?',

        text:'You want to delete this user.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonColor:'#d33',

        cancelButtonColor:'#3085d6',

        confirmButtonText:'Yes, Delete'

    }).then((result)=>{

        if(result.isConfirmed)
        {

            $.post("delete_user.php",{id:id},function(res){

                if(res.trim()=="success")
                {

                    Swal.fire({

                        icon:'success',

                        title:'Deleted',

                        text:'User Deleted Successfully',

                        timer:1500,

                        showConfirmButton:false

                    });

                    loadUsers();

                }
                else
                {

                    Swal.fire({

                        icon:'error',

                        title:'Error',

                        text:'Delete Failed'

                    });

                }

            });

        }

    });

});

// Edit User
$(document).on("click",".editBtn",function(){

    let id=$(this).data("id");

    window.location.href="edit_user.php?id="+id;

});

</script>

</body>

</html>
