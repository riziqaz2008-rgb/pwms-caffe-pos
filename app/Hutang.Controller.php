<?php
$totalNominalPiutang = mysqli_fetch_assoc(query("SELECT SUM(total) AS total FROM transaksi WHERE status_transaksi = 1 AND status_pembayaran = 1"))['total'];
$totalPiutang = mysqli_fetch_assoc(query("SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 1 AND status_pembayaran = 1"))['total'];

$cari = trim($_GET['cari'] ?? '');
$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$limit = 10;
$offset = ($currentPage - 1) * $limit;
$where = "";
$params = [];
$types = "";

if($cari !== ''){
    $where .= " AND ( kode_transaksi LIKE ? OR tanggal LIKE ? OR nama_pelanggan LIKE ? OR total_transaksi LIKE ? )";
    $keyword = "%$cari%";
    $params[] = $keyword;
    $params[] = $keyword;
    $params[] = $keyword;
    $params[] = $keyword;
    $types .= "ssss";
}

$sqlCount = "SELECT COUNT(*) AS total FROM transaksi WHERE 1=1 $where AND status_transaksi = 1 AND status_pembayaran = 1";
$stmtCount = mysqli_prepare($conn, $sqlCount);

if(!empty($params)){
    mysqli_stmt_bind_param($stmtCount, $types, ...$params);
}

mysqli_stmt_execute($stmtCount);
$resultCount = mysqli_stmt_get_result($stmtCount);
$totalData = mysqli_fetch_assoc($resultCount)['total'];
$totalPage = max(1, (int) ceil($totalData / $limit));
mysqli_stmt_close($stmtCount);

$sql = "SELECT t.id_transaksi, t.kode_transaksi, t.tanggal, p.nama_pelanggan, t.total AS total_transaksi FROM transaksi t LEFT JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan WHERE 1=1 AND t.status_transaksi = 1 AND t.status_pembayaran = 1 $where LIMIT ? OFFSET ?";
$paramsData = $params;
$typesData = $types . "ii";
$paramsData[] = $limit;
$paramsData[] = $offset;
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $typesData, ...$paramsData);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);