<?php
$role = fetchAllAssoc("SELECT * FROM roles");

$cari = trim($_GET['cari'] ?? '');
$rolef = (int)($_GET['rolef'] ?? 0);
$statusf = $_GET['statusf'] ?? '';
$sql = "SELECT u.*, a.nama, a.telepon, a.status, r.nama_role FROM users u LEFT JOIN anggota a ON u.id_anggota = a.id_anggota LEFT JOIN roles r ON u.id_role = r.id_role WHERE 1=1";
$params = [];
$types = "";
if(!empty($cari)){
    $sql .= " AND ( a.nama LIKE ? OR a.telepon LIKE ? OR u.username LIKE ? )";
    $keyword = "%$cari%";
    $params[] = $keyword;
    $params[] = $keyword;
    $params[] = $keyword;
    $types .= "sss";
}
if($rolef > 0){
    $sql .= " AND u.id_role = ?";
    $params[] = (int)$rolef;
    $types .= "i";
}
if($statusf !== ''){
    $sql .= " AND a.status = ?";
    $params[] = (int)$statusf;
    $types .= "i";
}
$stmt = mysqli_prepare($conn, $sql);
if(!empty($params)){
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$danggota = mysqli_stmt_get_result($stmt);

function tambah($d){
    global $conn;
    $nama = $d['nama'];
    $telp = trim($d['telepon'] ?? '');
    $role = (int)($d['role'] ?? 0);
    $user = $d['username'];
    $pw = $d['password'];

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

    $qcu = query("SELECT username FROM users WHERE username='$user'");
    $cu = mysqli_fetch_assoc($qcu);
    if($cu){
        return [
            'bg' => 'info',
            'pesan' => 'Username '.$cu['username'].' sudah digunakan. Harap ganti username yang lain.',
        ];
    }

    // ERROR
    $qct = query("SELECT * FROM anggota WHERE telepon='$telp'");
    $ct = mysqli_fetch_assoc($qct);
    if(mysqli_num_rows($qct) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Nomor telepon '.$ct['telepon'].' sudah ada. Harap ganti telepon yang lain.'
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("INSERT INTO anggota (nama, telepon, status) VALUES ('$nama', '$telp', 1)");
        $ida = mysqli_insert_id($conn);
        query("INSERT INTO users (username, password, id_role, id_anggota) VALUES ('$user', '$pw', '$role', '$ida')");
        mysqli_commit($conn);
        return [
            'bg' => 'success',
            'pesan' => 'Anggota berhasil ditambahkan.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'bg' => 'danger',
            'pesan' => 'Anggota gagal ditambahkan. Harap coba lagi.'
        ];
    }
}

function edit($d){
    global $conn;
    $id = $d['id'];
    $nama = $d['nama'];
    $telp = $d['telepon'];
    $role = (int)($d['role'] ?? 0);
    $user = $d['username'];
    $pw = $d['password'];
    $s = isset($d['status']) ? 1 : 0;

    $qca = query("SELECT username FROM users WHERE username='$user' AND id_user != '$id'");
    $ca = mysqli_fetch_assoc($qca);
    if(mysqli_num_rows($qca) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Username '.$ca['username'].' sudah digunakan. Harap ganti username yang lain.'
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("UPDATE anggota SET nama='$nama', telepon='$telp', status='$s' WHERE id_anggota='$id'");
        query("UPDATE users SET username='$user', password='$pw', id_role='$role' WHERE id_anggota='$id'");
        mysqli_commit($conn);
        return [
            'bg' => 'success',
            'pesan' => 'Anggota berhasil diperbarui.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'bg' => 'danger',
            'pesan' => 'Anggota gagal diperbarui. Harap coba lagi.'
        ];
    }
}

function hapus($d){
    $id = (int)$d['id'];

    $c = query("SELECT * FROM users WHERE id_users='$id'");
    if(mysqli_num_rows($c) == 0){
        return [
            'bg' => 'info',
            'pesan' => 'ID pelanggan tidak ditemukan.',
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("DELETE FROM users WHERE id_anggota='$id'");
        query("DELETE FROM anggota WHERE id_anggota='$id'");
        mysqli_commit($conn);
        return [
            'bg' => 'success',
            'pesan' => 'Anggota berhasil dihapus.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'bg' => 'danger',
            'pesan' => 'Anggota gagal dihapus. Harap coba lagi.'
        ];
    }
}

if(isset($_POST['aksi'])){
  if($_POST['aksi'] == 'tambah'){
    $hasil = tambah($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=anggota");
    exit;
  } elseif($_POST['aksi'] == 'edit'){
    $hasil = edit($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=anggota");
    exit;
  } elseif($_POST['aksi'] == 'hapus'){
    $hasil = hapus($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=anggota");
    exit;
  }
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);
?>