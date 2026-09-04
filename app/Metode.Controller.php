<?php
$tipe = fetchAllAssoc("SELECT * FROM tipe");
$totalMetode = mysqli_fetch_assoc(query("SELECT COUNT(*) AS total FROM metode"))['total'];
$totalMetodeAktif = mysqli_fetch_assoc(query("SELECT COUNT(*) AS total FROM metode WHERE status=1"))['total'];

$cari = trim($_GET['cari'] ?? '');
$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$limit = 10;
$offset = ($currentPage - 1) * $limit;
$where = "";
$params = [];
$types = "";

if($cari !== ''){
    $where .= " AND ( m.nama_metode LIKE ? OR t.nama_tipe LIKE ? )";
    $keyword = "%$cari%";
    $params[] = $keyword;
    $params[] = $keyword;
    $types .= "ss";
}

$sqlCount = "SELECT COUNT(*) AS total FROM metode m LEFT JOIN tipe t ON m.id_tipe = t.id_tipe WHERE 1=1 $where";
$stmtCount = mysqli_prepare($conn, $sqlCount);

if(!empty($params)){
    mysqli_stmt_bind_param($stmtCount, $types, ...$params);
}

mysqli_stmt_execute($stmtCount);
$resultCount = mysqli_stmt_get_result($stmtCount);
$totalData = mysqli_fetch_assoc($resultCount)['total'];
$totalPage = max(1, (int) ceil($totalData / $limit));
mysqli_stmt_close($stmtCount);

$sql = "SELECT * FROM metode m LEFT JOIN tipe t ON m.id_tipe = t.id_tipe WHERE 1=1 $where LIMIT ? OFFSET ?";
$paramsData = $params;
$typesData = $types . "ii";
$paramsData[] = $limit;
$paramsData[] = $offset;
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $typesData, ...$paramsData);
mysqli_stmt_execute($stmt);
$data = mysqli_stmt_get_result($stmt);

function tambah($d){
    $nama = trim($d['nama'] ?? '');
    $desk = trim($d['deskripsi'] ?? '');
    $tipe = (int)($d['tipe'] ?? 0);
    $desk = empty($desk) ? "NULL" : "'$desk'";

    if($nama === ''){
        return [
            'bg' => 'warning',
            'pesan' => 'Nama kosong, harap diisi.'
        ];
    }

    if($desk === ''){
        return [
            'bg' => 'warning',
            'pesan' => 'Deksripsi kosong, harap diisi.'
        ];
    }

    $ct = query("SELECT * FROM tipe WHERE id_tipe='$tipe'");
    if($tipe <= 0 || mysqli_num_rows($ct) == 0){
        return [
            'bg' => 'warning',
            'pesan' => 'Tipe metode tidak valid.'
        ];
    }

    $qcn = query("SELECT * FROM metode WHERE nama_metode='$nama'");
    $cn = mysqli_fetch_assoc($qcn);
    if(mysqli_num_rows($qcn) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Metode '.$cn['nama_metode'].' sudah ada. Harap ganti metode yang lain'
        ];
    }

    $q = query("INSERT INTO metode (nama_metode, id_tipe, deskripsi, status) VALUES ('$nama', '$tipe', $desk, 1)");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Metode berhasil ditambahkan.'
        ];
    }

    return [
        'bg' => 'danger',
        'pesan' => 'Metode gagal ditambahkan. Harap coba lagi.'
    ];
}

function edit($d){
    $id = (int)$d['id'];
    $nama = trim($d['nama'] ?? '');
    $desk = trim($d['deskripsi'] ?? '');
    $desk = empty($desk) ? "NULL" : "'$desk'";
    $tipe = (int)($d['tipe'] ?? 0);
    $s = isset($d['status']) ? 1 : 0;

    $qcn = query("SELECT nama_metode FROM metode WHERE nama_metode='$nama' AND id_metode != '$id'");
    $cn = mysqli_fetch_assoc($qcn);
    if(mysqli_num_rows($qcn) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Metode '.$cn['nama_metode'].'  sudah ada. Harap ganti metode yang lain.'
        ];
    }

    $q = query("UPDATE metode SET nama_metode='$nama', deskripsi=$desk, id_tipe='$tipe', status='$s' WHERE id_metode='$id'");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Metode berhasil diperbarui.'
        ];
    }

    return [
        'bg' => 'danger',
        'pesan' => 'Metode gagal diperbarui. Harap coba lagi.'
    ];
}

function hapus($d){
    $id = (int)$d['id'];

    $c = query("SELECT * FROM metode WHERE id_metode='$id'");
    if(mysqli_num_rows($c) == 0){
        return [
            'bg' => 'info',
            'pesan' => 'ID metode tidak ditemukan.',
        ];
    }

    $q = query("DELETE FROM metode WHERE id_metode='$id'");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Metode berhasil dihapus.',
        ];
    }

    return [
        'bg' => 'danger',
        'pesan' => 'Metode gagal dihapus. Harap coba lagi',
    ];
}

if(isset($_POST['aksi'])){
  if($_POST['aksi'] == 'tambah'){
    $hasil = tambah($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=metode");
    exit;
  } elseif($_POST['aksi'] == 'edit'){
    $hasil = edit($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=metode");
    exit;
  } elseif($_POST['aksi'] == 'hapus'){
    $hasil = hapus($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=metode");
    exit;
  }
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);
?>