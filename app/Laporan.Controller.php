<?php

$cari = trim($_GET['cari'] ?? '');

$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$limit = 10;
$offset = ($currentPage - 1) * $limit;

$pembayaran = $_GET['pembayaran'] ?? '';
$statusPembayaranFilter = $_GET['status_pembayaran'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$pengguna = $_GET['pengguna'] ?? '';
$tanggalMulai = $_GET['tanggal_mulai'] ?? '';
$tanggalSampai = $_GET['tanggal_sampai'] ?? '';

$idUserLogin = (int) ($_SESSION['id_user'] ?? 0);
$roleLogin = $_SESSION['role'] ?? '';

$where = "";

$params = [];
$types = "";

if ($cari !== '') {

    $where .= "
        AND (
            t.kode_transaksi LIKE ?
            OR t.tanggal LIKE ?
            OR COALESCE(p.nama_pelanggan, '') LIKE ?
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

if ($pembayaran !== '') {

    $where .= " AND t.id_metode = ?";

    $params[] = (int) $pembayaran;
    $types .= "i";
}

if ($statusPembayaranFilter !== '') {
    $where .= " AND t.status_pembayaran = ?";
    $params[] = (int) $statusPembayaranFilter;
    $types .= "i";
}


if ($kategori !== '') {

    $where .= "
        AND EXISTS (
            SELECT 1
            FROM detail_transaksi dt2
            INNER JOIN menu m2
                ON m2.id_menu = dt2.id_menu
            WHERE dt2.id_transaksi = t.id_transaksi
            AND m2.id_kategori = ?
        )
    ";

    $params[] = (int) $kategori;
    $types .= "i";
}

if ($roleLogin === 'kasir') {

    $where .= " AND t.id_user = ?";

    $params[] = $idUserLogin;
    $types .= "i";

} elseif ($roleLogin === 'admin') {

    $where .= "
        AND EXISTS (
            SELECT 1
            FROM users ux
            LEFT JOIN roles rx ON ux.id_role = rx.id_role
            WHERE ux.id_user = t.id_user
            AND rx.kode_role <> 'super_admin'
        )
    ";

    if ($pengguna !== '') {

        $where .= " AND t.id_user = ?";

        $params[] = (int) $pengguna;
        $types .= "i";
    }

} elseif ($roleLogin === 'super_admin') {

    if ($pengguna !== '') {

        $where .= " AND t.id_user = ?";

        $params[] = (int) $pengguna;
        $types .= "i";
    }
}


if ($tanggalMulai !== '') {

    $where .= " AND DATE(t.tanggal) >= ?";

    $params[] = $tanggalMulai;
    $types .= "s";
}


if ($tanggalSampai !== '') {

    $where .= " AND DATE(t.tanggal) <= ?";

    $params[] = $tanggalSampai;
    $types .= "s";
}


$sqlCount = "
    SELECT COUNT(*) AS total
    FROM transaksi t
    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan
    WHERE 1=1
    $where
";

$stmtCount = mysqli_prepare($conn, $sqlCount);

if (!$stmtCount) {
    die("Gagal menyiapkan query count: " . mysqli_error($conn));
}

if (!empty($params)) {
    mysqli_stmt_bind_param(
        $stmtCount,
        $types,
        ...$params
    );
}

mysqli_stmt_execute($stmtCount);

$resultCount = mysqli_stmt_get_result($stmtCount);

$rowCount = mysqli_fetch_assoc($resultCount);

$totalData = (int) ($rowCount['total'] ?? 0);

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
        u.id_user,
        a.nama AS nama_user,
        ap.nama AS nama_pelunas,
        t.kode_transaksi,
        t.tanggal,
        t.tipe_pesanan,
        t.id_pelanggan,
        t.nama_pelanggan,
        p.nama_pelanggan AS nama_pelanggan_terdaftar,
        t.subtotal,
        t.total_diskon,
        t.total,
        t.status_transaksi,
        t.status_pembayaran,
        t.id_metode,
        t.uang_diterima,
        t.kembalian,
        m.nama_metode

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan

    LEFT JOIN metode m
        ON m.id_metode = t.id_metode

    LEFT JOIN users u
        ON t.id_user = u.id_user

    LEFT JOIN anggota a
        ON u.id_anggota = a.id_anggota

    LEFT JOIN users up
        ON t.id_user = up.id_user

    LEFT JOIN anggota ap
        ON up.id_anggota = ap.id_anggota

    WHERE 1=1
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
    die("Gagal menyiapkan query laporan: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    $typesData,
    ...$paramsData
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

mysqli_stmt_close($stmt);

function namaPelangganLaporan(array $data): string
{
    if (!empty($data['nama_pelanggan'])) {
        return $data['nama_pelanggan'];
    }

    if (!empty($data['nama_pelanggan_terdaftar'])) {
        return $data['nama_pelanggan_terdaftar'];
    }

    return '-';
}

function statusTransaksiLaporan(?int $status): string
{
    return match ($status) {
        1 => 'Selesai',
        2 => 'Menunggu',
        default => '-'
    };
}


function statusPembayaranLaporan(?int $status): string
{
    return match ($status) {
        1 => 'Belum Lunas',
        2 => 'Lunas',
        default => '-'
    };
}


function tipePesananLaporan(?int $tipe): string
{
    return match ($tipe) {
        1 => 'Dine In',
        2 => 'Takeaway',
        default => '-'
    };
}


$metode = fetchAllAssoc("
    SELECT
        m.id_metode,
        m.nama_metode,
        m.id_tipe,
        t.kode_tipe,
        t.nama_tipe
    FROM metode m
    INNER JOIN tipe t
        ON t.id_tipe = m.id_tipe
    WHERE m.status = 1
    ORDER BY m.nama_metode ASC
");


$kategoriData = fetchAllAssoc("
    SELECT
        id_kategori,
        nama_kategori
    FROM kategori
    ORDER BY nama_kategori ASC
");

$kategori = $kategoriData;

if ($roleLogin === 'super_admin') {

    $penggunaData = fetchAllAssoc("
        SELECT
            u.id_user,
            a.nama
        FROM users u

        LEFT JOIN anggota a
            ON u.id_anggota = a.id_anggota

        ORDER BY a.nama ASC
    ");

} elseif ($roleLogin === 'admin') {

    $penggunaData = fetchAllAssoc("
        SELECT
            u.id_user,
            a.nama
        FROM users u

        LEFT JOIN anggota a
            ON u.id_anggota = a.id_anggota

        LEFT JOIN roles r
            ON u.id_role = r.id_role

        WHERE r.kode_role <> 'super_admin'

        ORDER BY a.nama ASC
    ");

} else {

    $penggunaData = fetchAllAssoc("
        SELECT
            u.id_user,
            a.nama
        FROM users u

        LEFT JOIN anggota a
            ON u.id_anggota = a.id_anggota

        WHERE u.id_user = $idUserLogin

        ORDER BY a.nama ASC
    ");
}

$pengguna = $penggunaData;


$sqlStatistik = "
    SELECT
        COALESCE(SUM(t.total), 0) AS total_pendapatan_bersih,
        COALESCE(SUM(t.uang_diterima), 0) AS total_pendapatan_kotor,
        COUNT(t.id_transaksi) AS total_transaksi

    FROM transaksi t

    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan

    WHERE 1=1
    $where
";

$stmtStatistik = mysqli_prepare($conn, $sqlStatistik);

if (!$stmtStatistik) {
    die("Gagal menyiapkan statistik: " . mysqli_error($conn));
}

if (!empty($params)) {
    mysqli_stmt_bind_param(
        $stmtStatistik,
        $types,
        ...$params
    );
}

mysqli_stmt_execute($stmtStatistik);

$resultStatistik = mysqli_stmt_get_result($stmtStatistik);

$statistik = mysqli_fetch_assoc($resultStatistik);

$totalPendapatanBersih  = (int) ($statistik['total_pendapatan_bersih'] ?? 0);
$totalPendapatanKotor = (int) ($statistik['total_pendapatan_kotor'] ?? 0);
$totalTransaksi = (int) ($statistik['total_transaksi'] ?? 0);

mysqli_stmt_close($stmtStatistik);


$sqlMenuTerjual = "
    SELECT
        COALESCE(SUM(dt.qty), 0) AS total_menu

    FROM transaksi t

    INNER JOIN detail_transaksi dt
        ON dt.id_transaksi = t.id_transaksi

    LEFT JOIN pelanggan p
        ON p.id_pelanggan = t.id_pelanggan

    WHERE 1=1
    $where
";

$stmtMenuTerjual = mysqli_prepare($conn, $sqlMenuTerjual);

if (!$stmtMenuTerjual) {
    die("Gagal menyiapkan total menu: " . mysqli_error($conn));
}

if (!empty($params)) {
    mysqli_stmt_bind_param(
        $stmtMenuTerjual,
        $types,
        ...$params
    );
}

mysqli_stmt_execute($stmtMenuTerjual);

$resultMenuTerjual = mysqli_stmt_get_result($stmtMenuTerjual);

$rowMenuTerjual = mysqli_fetch_assoc($resultMenuTerjual);

$totalMenuTerjual = (int) ($rowMenuTerjual['total_menu'] ?? 0);

mysqli_stmt_close($stmtMenuTerjual);


$detailLaporan = [];

if (!empty($data)) {

    $ids = array_column($data, 'id_transaksi');

    $ids = array_map('intval', $ids);

    $idList = implode(',', $ids);

    $sqlDetail = "
        SELECT
            dt.id_transaksi,
            dt.id_menu,
            dt.qty,
            dt.harga,
            dt.catatan,
            dt.diskon,
            dt.subtotal,
            dt.total,
            m.nama

        FROM detail_transaksi dt

        INNER JOIN menu m
            ON m.id_menu = dt.id_menu

        WHERE dt.id_transaksi IN ($idList)

        ORDER BY dt.id_transaksi DESC
    ";

    $resultDetail = mysqli_query($conn, $sqlDetail);

    if ($resultDetail) {

        while ($detail = mysqli_fetch_assoc($resultDetail)) {

            $idTransaksi = (int) $detail['id_transaksi'];

            if (!isset($detailLaporan[$idTransaksi])) {
                $detailLaporan[$idTransaksi] = [];
            }

            $detailLaporan[$idTransaksi][] = $detail;
        }
    }
}

function bayarHutang($d){
    global $conn;

    $idUser = (int) ($_SESSION['id_user'] ?? 0);
    $idTransaksi = (int) ($d['id'] ?? 0);

    $qc = query("SELECT * FROM users WHERE id_user='$idUser'");
    if ($idUser <= 0 || mysqli_num_rows($qc) == 0) {
        return [
            'status' => false,
            'pesan' => 'User tidak valid.',
            'bg' => 'warning'
        ];
    }

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
             kembalian = 0,
             id_pelunas = $idUser
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

function hapusTransaksi($d){
    global $conn;
    $idTransaksi = (int) ($d['id'] ?? 0);

    if ($idTransaksi <= 0) {
        return [
            'status' => false,
            'bg' => 'danger',
            'pesan' => 'ID Transaksi tidak valid.'
        ];
    }

    mysqli_begin_transaction($conn);

    try {

        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM detail_transaksi
             WHERE id_transaksi = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $idTransaksi);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception(mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);


        $stmt = mysqli_prepare(
            $conn,
            "DELETE FROM transaksi
             WHERE id_transaksi = ?"
        );

        mysqli_stmt_bind_param($stmt, "i", $idTransaksi);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception(mysqli_stmt_error($stmt));
        }

        if (mysqli_stmt_affected_rows($stmt) === 0) {
            throw new Exception('Transaksi tidak ditemukan.');
        }

        mysqli_stmt_close($stmt);

        mysqli_commit($conn);

        return [
            'status' => true,
            'bg' => 'success',
            'pesan' => 'Transaksi berhasil dihapus.'
        ];

    } catch (Throwable $e) {

        mysqli_rollback($conn);

        return [
            'status' => false,
            'bg' => 'danger',
            'pesan' => 'Transaksi gagal dihapus.'
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $aksi = $_POST['aksi'] ?? '';

    if ($aksi === 'hapus') {
        $hasil = hapusTransaksi($_POST);
        $_SESSION['toast'] = $hasil;
        header("Location: ?route=laporan");
        exit;
    }

    if ($aksi === 'bayar_hutang') {
        $hasil = bayarHutang($_POST);
        $_SESSION['toast'] = $hasil;
        header("Location: ?route=laporan");
        exit;
    }
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);