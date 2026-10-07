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

$cari = trim($_GET['cari'] ?? '');

$currentPage = max(1, (int) ($_GET['page'] ?? 1));

$limit = 10;

$offset = ($currentPage - 1) * $limit;


$where = "";

$params = [];

$types = "";

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

    $types .= "ssss";
}


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


if (!empty($params)) {

    mysqli_stmt_bind_param(
        $stmtCount,
        $types,
        ...$params
    );
}


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


$totalPage = max(
    1,
    (int) ceil($totalData / $limit)
);


if ($currentPage > $totalPage) {

    $currentPage = $totalPage;

    $offset = ($currentPage - 1) * $limit;
}



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


$paramsData = $params;


$typesData = $types . "ii";


$paramsData[] = $limit;


$paramsData[] = $offset;


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    die(
        "Gagal menyiapkan query data: "
        . mysqli_error($conn)
    );
}


mysqli_stmt_bind_param(
    $stmt,
    $typesData,
    ...$paramsData
);


if (!mysqli_stmt_execute($stmt)) {

    die(
        "Gagal menjalankan query data: "
        . mysqli_stmt_error($stmt)
    );
}


$data = mysqli_stmt_get_result($stmt);

function bayarHutang($d){
    global $conn;
    $idTransaksi = (int) ($d['id'] ?? 0);

    if ($idTransaksi <= 0) {
        return [
            'status' => false,
            'bg' => 'danger',
            'pesan' => 'ID Transaksi tidak valid.'
        ];
    } else {

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE transaksi
         SET status_pembayaran = 2,
             uang_diterima = total,
             kembalian = 0
         WHERE id_transaksi = ?
           AND status_transaksi = 1
           AND status_pembayaran = 1
           AND id_metode IS NULL"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $idTransaksi
    );

    if (mysqli_stmt_execute($stmt)) {

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            return [
                'status' => true,
                'bg' => 'success',
                'pesan' => 'Transaksi hutang berhasil jadi lunas.'
            ];
        } else {
            return [
                'status' => false,
                'bg' => 'warning',
                'pesan' => 'Transaksi tidak ditemukan / bukan hutang / sudah lunas.'
            ];
        }

    } else {
        return [
            'status' => false,
            'bg' => 'danger',
            'pesan' => 'Terjadi kesalahan.'
        ];
    }

        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'bayar_hutang') {
        $hasil = bayarHutang($_POST);
        $_SESSION['toast'] = $hasil;
        header("Location: ?route=hutang");
        exit;
    }
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);