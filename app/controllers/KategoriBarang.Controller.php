<?php 
require_once __DIR__ . '../../../config/database.php';

$result = mysqli_query($conn, "SELECT * FROM kategoribarang");
$data_kategori = mysqli_fetch_all(
    $result, 
    MYSQLI_ASSOC
);

$limit = 10;
$current = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current < 1) $current = 1;

$offset = ($current - 1) * $limit;

$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategoribarang");
$total_data  = mysqli_fetch_assoc($total_query)['total'];

$last = ceil($total_data / $limit);

$query = mysqli_query($conn, "SELECT * FROM kategoribarang LIMIT $limit OFFSET $offset");
$data_kategori = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>