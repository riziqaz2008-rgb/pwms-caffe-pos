<?php
function totalmenuaktif() {
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM menu WHERE status_menu = 1");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}

function formatRupiahLaporan($nominal): string
{
    return 'Rp ' . number_format((int) $nominal, 0, ',', '.');
}

$bulan = date('Y-m');
$idUserLogin = (int) ($_SESSION['id_user'] ?? 0);
$roleLogin = $_SESSION['role'] ?? '';

$where = "
    WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = ?
";

$params = [$bulan];
$types = 's';

if ($roleLogin === 'kasir') {
    $where .= " AND t.id_user = ?";

    $params[] = $idUserLogin;
    $types .= 'i';
}

$sqlStatistik = "
    SELECT
        COALESCE(SUM(t.total), 0) AS total_pendapatan_bersih,
        COALESCE(SUM(t.uang_diterima), 0) AS total_pendapatan_kotor,
        COUNT(t.id_transaksi) AS total_transaksi
    FROM transaksi t
    $where
";

$stmt = mysqli_prepare($conn, $sqlStatistik);

mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$statistik = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);