<?php
$totalNominalPiutang = mysqli_fetch_assoc(query("SELECT SUM(total) AS total FROM transaksi WHERE status_transaksi = 1 AND status_pembayaran = 1"))['total'];
$totalPiutang = mysqli_fetch_assoc(query("SELECT COUNT(*) AS total FROM transaksi WHERE status_transaksi = 1 AND status_pembayaran = 1"))['total'];

$totalNominalPiutang = mysqli_fetch_assoc(
    query("
        SELECT COALESCE(SUM(total), 0) AS total
        FROM transaksi
        WHERE status_transaksi = 1
          AND status_pembayaran = 1
    ")
)['total'];

$totalPiutang = mysqli_fetch_assoc(
    query("
        SELECT COUNT(*) AS total
        FROM transaksi
        WHERE status_transaksi = 1
          AND status_pembayaran = 1
    ")
)['total'];


// ======================================================
// FILTER & PAGINATION
// ======================================================

$cari = trim($_GET['cari'] ?? '');

$currentPage = max(1, (int) ($_GET['page'] ?? 1));

$limit = 10;

$offset = ($currentPage - 1) * $limit;


// ======================================================
// WHERE DINAMIS
// ======================================================

$where = "";

$params = [];

$types = "";


// ------------------------------------------------------
// PENCARIAN
// ------------------------------------------------------

if ($cari !== '') {

    $where .= "
        AND (
            t.kode_transaksi LIKE ?
            OR t.tanggal LIKE ?
            OR p.nama_pelanggan LIKE ?
            OR t.total LIKE ?
        )
    ";

    $keyword = "%{$cari}%";

    $params[] = $keyword;
    $params[] = $keyword;
    $params[] = $keyword;
    $params[] = $keyword;

    // 4 placeholder = 4 string
    $types .= "ssss";
}


// ======================================================
// HITUNG TOTAL DATA
// ======================================================

$sqlCount = "
    SELECT COUNT(*) AS total_data

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON t.id_pelanggan = p.id_pelanggan

    WHERE t.status_transaksi = 1
      AND t.status_pembayaran = 1

      $where
";

$stmtCount = mysqli_prepare($conn, $sqlCount);

if (!$stmtCount) {
    die(
        "Gagal menyiapkan query count: "
        . mysqli_error($conn)
    );
}


// Bind parameter pencarian jika ada
if (!empty($params)) {

    mysqli_stmt_bind_param(
        $stmtCount,
        $types,
        ...$params
    );
}


// Eksekusi
if (!mysqli_stmt_execute($stmtCount)) {

    die(
        "Gagal menjalankan query count: "
        . mysqli_stmt_error($stmtCount)
    );
}


$resultCount = mysqli_stmt_get_result($stmtCount);

$totalData = (int) (
    mysqli_fetch_assoc($resultCount)['total_data'] ?? 0
);


mysqli_stmt_close($stmtCount);


// ======================================================
// TOTAL HALAMAN
// ======================================================

$totalPage = max(
    1,
    (int) ceil($totalData / $limit)
);


// Jika halaman yang diminta melebihi halaman terakhir
if ($currentPage > $totalPage) {

    $currentPage = $totalPage;

    $offset = ($currentPage - 1) * $limit;
}


// ======================================================
// AMBIL DATA PIUTANG
// ======================================================

$sql = "
    SELECT
        t.id_transaksi,
        t.kode_transaksi,
        t.tanggal,
        p.nama_pelanggan,
        t.total AS total_transaksi

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON t.id_pelanggan = p.id_pelanggan

    WHERE t.status_transaksi = 1
      AND t.status_pembayaran = 1

      $where

    ORDER BY t.id_transaksi DESC

    LIMIT ? OFFSET ?
";


// Parameter untuk query data
$paramsData = $params;


// Tipe parameter pencarian + LIMIT + OFFSET
$typesData = $types . "ii";


// Tambahkan LIMIT
$paramsData[] = $limit;


// Tambahkan OFFSET
$paramsData[] = $offset;


// Prepare
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    die(
        "Gagal menyiapkan query data: "
        . mysqli_error($conn)
    );
}


// Bind semua parameter
mysqli_stmt_bind_param(
    $stmt,
    $typesData,
    ...$paramsData
);


// Execute
if (!mysqli_stmt_execute($stmt)) {

    die(
        "Gagal menjalankan query data: "
        . mysqli_stmt_error($stmt)
    );
}


// Hasil data
$data = mysqli_stmt_get_result($stmt);