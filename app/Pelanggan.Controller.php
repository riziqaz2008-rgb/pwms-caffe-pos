<?php
$cari = trim($_GET['cari'] ?? '');
$sql = "SELECT u.*, a.nama, a.telepon, r.nama_role FROM users u LEFT JOIN anggota a ON u.id_anggota = a.id_anggota LEFT JOIN roles r ON u.id_role = r.id_role WHERE 1=1";
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
$stmt = mysqli_prepare($conn, $sql);
if(!empty($params)){
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$dkaryawan = mysqli_stmt_get_result($stmt);
function tambah($d){
    $nama = $d['nama'];
    $telp = $d['telepon'];
    $role = (int)($d['role'] ?? 0);
    $user = $d['username'];
    $pw = $d['password'];

    $ca = query("SELECT username FROM users WHERE username='$user'");
    if($ca){
        return [
            'status' => false,
            'bg' => 'info',
            'icon' => 'info-circle',
            'pesan' => 'Username sudah digunakan. Harap ganti username yang lain.',
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("INSERT INTO anggota (nama, telepon, status) VALUES ('$nama', '$telp', 1)");
        $ida = mysqli_insert_id($conn);
        query("INSERT INTO users (username, password, id_role, id_anggota) VALUES ('$user', '$pw', '$role', '$ida')");
        mysqli_commit($conn);
        return [
            'status' => true,
            'bg' => 'success',
            'icon' => 'check-circle',
            'pesan' => 'Anggota berhasil ditambahkan.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'status' => false,
            'bg' => 'danger',
            'icon' => 'alert-triangle',
            'pesan' => 'Anggota gagal ditambahkan. Harap coba lagi.'
        ];
    }
}

function edit($d){
    $id = $d['id'];
    $nama = $d['nama'];
    $telp = $d['telepon'];
    $role = (int)($d['role'] ?? 0);
    $user = $d['username'];
    $pw = $d['password'];
    $s = isset($d['status']) ? 1 : 0;

    $ca = query("SELECT username FROM users WHERE username='$user'");
    if($ca){
        return [
            'status' => false,
            'bg' => 'info',
            'icon' => 'info-circle',
            'pesan' => 'Username sudah digunakan. Harap ganti username yang lain.',
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("UPDATE anggota SET nama='$nama', telepon='$telp', status='$s' WHERE id_anggota='$id'");
        query("UPDATE users SET username='$user', password='$pw', id_role='$role' WHERE id_anggota='$id'");
        mysqli_commit($conn);
        return [
            'status' => true,
            'bg' => 'success',
            'icon' => 'check-circle',
            'pesan' => 'Anggota berhasil diperbarui.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'status' => false,
            'bg' => 'danger',
            'icon' => 'alert-triangle',
            'pesan' => 'Anggota gagal diperbarui. Harap coba lagi.'
        ];
    }
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
?>