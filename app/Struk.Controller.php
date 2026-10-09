<?php

$idTransaksi = (int) ($_GET['id'] ?? 0);

if ($idTransaksi <= 0) {
    exit('ID transaksi tidak valid.');
}


// ==============================
// TRANSAKSI
// ==============================

$sql = "
    SELECT
        t.id_transaksi,
        a.nama AS nama_user,
        t.kode_transaksi,
        t.tanggal,
        t.tipe_pesanan,
        t.id_pelanggan,
        COALESCE(
            p.nama_pelanggan,
            t.nama_pelanggan
        ) AS pelanggan,
        t.subtotal,
        t.total_diskon,
        t.total,
        t.status_transaksi,
        t.status_pembayaran,
        t.id_metode,
        m.nama_metode,
        t.uang_diterima,
        t.kembalian

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan

    LEFT JOIN metode m
        ON m.id_metode = t.id_metode

    LEFT JOIN users u
        ON t.id_user = u.id_user

    LEFT JOIN anggota a
        ON u.id_anggota = a.id_anggota

    WHERE t.id_transaksi = ?

    LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    'i',
    $idTransaksi
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if (!$data) {
    exit('Transaksi tidak ditemukan.');
}


// ==============================
// PEMBAYARAN
// ==============================

$data['pembayaran'] = !empty($data['nama_metode'])
    ? $data['nama_metode']
    : 'Hutang';


// ==============================
// DETAIL
// ==============================

$sql = "
    SELECT
        dt.id_menu,
        m.nama,
        dt.qty,
        dt.harga,
        dt.diskon,
        dt.catatan,
        dt.subtotal,
        dt.total

    FROM detail_transaksi dt

    INNER JOIN menu m
        ON m.id_menu = dt.id_menu

    WHERE dt.id_transaksi = ?

    ORDER BY dt.id_menu ASC
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    'i',
    $idTransaksi
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$detail = [];

while ($row = mysqli_fetch_assoc($result)) {

    $detail[] = $row;

}

mysqli_stmt_close($stmt);