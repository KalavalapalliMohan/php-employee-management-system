<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    exit();
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";

$limit = 5; // ఒక్క page కి 5 records
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

$offset = ($page - 1) * $limit;

$where = " WHERE employee_name LIKE '%$search%'
        OR email LIKE '%$search%'
        OR mobile LIKE '%$search%'
        OR designation LIKE '%$search%'
        OR blood_group LIKE '%$search%'";

$countQuery = "SELECT COUNT(*) AS total FROM employees $where";
$countResult = mysqli_query($conn, $countQuery);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $limit);

$sql = "SELECT * FROM employees
        $where
        ORDER BY id DESC
        LIMIT $offset, $limit";

$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "employees" => $data,
    "totalPages" => $totalPages,
    "currentPage" => $page
]);