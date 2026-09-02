<?php
$cari = trim($_GET['cari'] ?? '');
$sql = "SELECT p.* FROM pelanggan p WHERE 1=1";
$params = [];
$types = "";
if(!empty($cari)){
    $sql .= " AND ( p.nama_pelanggan LIKE ? OR p.telepon LIKE ? )";
    $keyword = "%$cari%";
    $params[] = $keyword;
    $params[] = $keyword;
    $types .= "ss";
}
$stmt = mysqli_prepare($conn, $sql);
if(!empty($params)){
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$dpelanggan = mysqli_stmt_get_result($stmt);

function tambah($d){
    $nama = $d['nama'];
    $telp = trim($d['telepon'] ?? '');

    if(empty($nama) || $nama == ''){
        return [
            'status' => false,
            'bg' => 'warning',
            'icon' => 'info-circle',
            'pesan' => 'Nama kosong, harap diisi.'
        ];
    }

    if($telp === ''){
        return [
            'status' => false,
            'bg' => 'warning',
            'icon' => 'info-circle',
            'pesan' => 'Nomor telepon kosong, harap diisi.'
        ];
    } elseif(!preg_match('/^08[0-9]{9,14}$/', $telp)){
        return [
            'status' => false,
            'bg' => 'warning',
            'icon' => 'info-circle',
            'pesan' => 'Nomor telepon harus diawali 08 dan terdiri dari 10 sampai 15 digit angka.'
        ];
    }

    $q = query("INSERT INTO pelanggan (nama_pelanggan, telepon) VALUES ('$nama', '$telp')");
    if($q){
        return [
            'status' => true,
            'bg' => 'success',
            'icon' => 'check-circle',
            'pesan' => 'Pelanggan berhasil ditambahkan.'        
        ];
    }

    return [
        'status' => false,
        'bg' => 'danger',
        'icon' => 'alert-triangle',
        'pesan' => 'Pelanggan gagal ditambahkan. Harap coba lagi.'
    ];
}

function edit($d){
    $id = $d['id'];
    $nama = $d['nama'];
    $telp = $d['telepon'];

    $q = query("UPDATE pelanggan SET nama_pelanggan='$nama', telepon='$telp' WHERE id_pelanggan='$id'");
    if($q){
        return [
            // 'status' => true,
            'bg' => 'success',
            'pesan' => 'Pelanggan berhasil diperbarui.'
        ];
    }

    return [
        // 'status' => false,
        'bg' => 'danger',
        'pesan' => 'Pelanggan gagal diperbarui. Harap coba lagi.'
    ];
}

function hapus($d){
    $id = $d['id'];

    $q = query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    if($q){
        return [
            'status' => true,
            'bg' => 'success',
            'icon' => 'check-circle',
            'pesan' => 'Pelanggan berhasil dihapus.',
        ];
    }

    return [
        'status' => false,
        'bg' => 'danger',
        'icon' => 'alert-triangle',
        'pesan' => 'Pelanggan gagal dihapus. Harap coba lagi',
    ];
}

if(isset($_POST['aksi'])){
  if($_POST['aksi'] == 'tambah'){
    $hasil = tambah($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=pelanggan");
    exit;
  } elseif($_POST['aksi'] == 'edit'){
    $hasil = edit($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=pelanggan");
    exit;
  } elseif($_POST['aksi'] == 'hapus'){
    $hasil = hapus($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=pelanggan");
    exit;
  }
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);
?>