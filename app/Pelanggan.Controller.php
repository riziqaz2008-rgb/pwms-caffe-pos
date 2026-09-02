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
            'bg' => 'warning',
            'pesan' => 'Nama kosong, harap diisi.'
        ];
    }

    if($telp === ''){
        return [
            'bg' => 'warning',
            'pesan' => 'Nomor telepon kosong, harap diisi.'
        ];
    } elseif(!preg_match('/^08[0-9]{9,14}$/', $telp)){
        return [
            'bg' => 'warning',
            'pesan' => 'Nomor telepon harus diawali 08 dan terdiri dari 10 sampai 15 digit angka.'
        ];
    }

    $qcn = query("SELECT * FROM pelanggan WHERE nama_pelanggan='$nama'");
    $cn = mysqli_fetch_assoc($qcn);
    if(mysqli_num_rows($cn) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Nama pelanggan '.$cn['nama_pelanggan'].' sudah ada. Harap ganti nama yang lain'
        ];
    }

    $qct = query("SELECT * FROM pelanggan WHERE telepon='$telp'");
    $ct = mysqli_fetch_assoc($qct);
    if(mysqli_num_rows($ct) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Nomor telepon '.$ct['telepon'].' sudah ada. Harap ganti telepon yang lain'
        ];
    }

    $q = query("INSERT INTO pelanggan (nama_pelanggan, telepon) VALUES ('$nama', '$telp')");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Pelanggan berhasil ditambahkan.'
        ];
    }

    return [
        'bg' => 'danger',
        'pesan' => 'Pelanggan gagal ditambahkan. Harap coba lagi.'
    ];
}

function edit($d){
    $id = (int)$d['id'];
    $nama = $d['nama'];
    $telp = $d['telepon'];

    $cn = query("SELECT * FROM pelanggan WHERE nama='$nama' AND id_pelanggan != '$id'");
    if($cn){
        return [
            'bg' => 'info',
            'pesan' => 'Nama pelanggan tersebut sudah digunakan. Harap ganti nama yang lain.'
        ];
    }

    $q = query("UPDATE pelanggan SET nama_pelanggan='$nama', telepon='$telp' WHERE id_pelanggan='$id'");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Pelanggan berhasil diperbarui.'
        ];
    }

    return [
        'bg' => 'danger',
        'pesan' => 'Pelanggan gagal diperbarui. Harap coba lagi.'
    ];
}

function hapus($d){
    $id = (int)$d['id'];

    $c = query("SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    if(mysqli_num_rows($c) == 0){
        return [
            'bg' => 'info',
            'pesan' => 'ID pelanggan tidak ditemukan.',
        ];
    }

    $q = query("DELETE FROM pelanggan WHERE id_pelanggan='$id'");
    if($q){
        return [
            'bg' => 'success',
            'pesan' => 'Pelanggan berhasil dihapus.',
        ];
    }

    return [
        'bg' => 'danger',
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