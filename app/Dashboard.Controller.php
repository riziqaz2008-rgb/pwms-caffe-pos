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

$sqlStatistik = "
    SELECT
        COALESCE(SUM(t.uang_diterima), 0) AS total_pendapatan,
        COUNT(t.id_transaksi) AS total_transaksi

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan

    WHERE
    DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan'
";

$statistik = mysqli_fetch_assoc(query($sqlStatistik));

$totalPendapatan = (int) ($statistik['total_pendapatan'] ?? 0);
$totalTransaksi = (int) ($statistik['total_transaksi'] ?? 0);