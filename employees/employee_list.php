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

    <title>Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                    <h3>Employee List</h3>

                    <div>

                        <a href="add_employee.php" class="btn btn-success">
                            Add Employee
                        </a>

                        <a href="../dashboard.php" class="btn btn-light">
                            Dashboard
                        </a>

                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="row mb-3">

                    <div class="col-md-4">

                        <input type="text" id="search" class="form-control" placeholder="Search Employee...">

                    </div>

                </div>

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>S No</th>

                            <th>Employee Name</th>

                            <th>Email</th>

                            <th>Mobile</th>

                            <th>Blood Group</th>

                            <th>Designation</th>

                            <th>Date of Joining</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody id="employeeData">

                        <tr>

                            <td colspan="8" class="text-center">

                                Loading Employees...

                            </td>

                        </tr>

                    </tbody>

                </table>

                <div id="pagination" class="mt-3"></div>

            </div>

        </div>

    </div>

    <script>

        function loadEmployees(search = "", page = 1)
        {
            $.ajax({

                url: "get_employees.php",

                type: "GET",

                data: {
                    search: search,
                    page: page
                },

                dataType: "json",

                success: function(response){

                    let output = "";

                    if(response.employees.length > 0)
                    {
                        $.each(response.employees,function(index,employee){

                            output += "<tr>";

                            output += "<td>"+(((page-1)*5)+index+1)+"</td>";
                            output += "<td>"+employee.employee_name+"</td>";
                            output += "<td>"+employee.email+"</td>";
                            output += "<td>"+employee.mobile+"</td>";
                            output += "<td>"+employee.blood_group+"</td>";
                            output += "<td>"+employee.designation+"</td>";
                            output += "<td>"+employee.doj+"</td>";

                            output += "<td>";

                            output += "<button class='btn btn-primary btn-sm editBtn' data-id='"+employee.id+"'>Edit</button> ";

                            output += "<button class='btn btn-danger btn-sm deleteBtn' data-id='"+employee.id+"'>Delete</button>";

                            output += "</td>";

                            output += "</tr>";

                        });
                    }
                    else
                    {
                        output = "<tr><td colspan='8' class='text-center'>No Employees Found</td></tr>";
                    }

                    $("#employeeData").html(output);

                    // Pagination
                    let pagination = "";

                    for(let i=1; i<=response.totalPages; i++)
                    {
                        pagination += `<button class="btn btn-sm ${i==response.currentPage ? 'btn-primary' : 'btn-outline-primary'} m-1 pageBtn" data-page="${i}">${i}</button>`;
                    }

                    $("#pagination").html(pagination);

                }

            });
        }

        $(document).ready(function(){

            loadEmployees();

            $("#search").keyup(function(){

                loadEmployees($(this).val(),1);

            });

            $(document).on("click",".pageBtn",function(){

                let page = $(this).data("page");

                let search = $("#search").val();

                loadEmployees(search,page);

            });

        });


        // Delete Employee
        $(document).on("click", ".deleteBtn", function () {

            let id = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                text: "This employee will be deleted permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete"
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: "delete_employee.php",

                        type: "POST",

                        data: {
                            id: id
                        },

                        success: function (response) {

                            if (response.trim() == "success") {

                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Employee deleted successfully.",
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                let search = $("#search").val();
                                loadEmployees(search);

                            }
                            else {

                                Swal.fire({
                                    icon: "error",
                                    title: "Error",
                                    text: "Unable to delete employee."
                                });

                            }

                        }

                    });

                }

            });

        });
            

        $(document).on("click",".editBtn",function(){

            let id = $(this).data("id");

            window.location = "edit_employee.php?id=" + id;

        });
    </script>

</body>

</html>