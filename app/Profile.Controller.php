<?php
function profile($d){
    global $conn;
    
    $id = (int)$d['id'] ?? 0;
    $nama = trim($d['nama'] ?? '');
    $telepon = trim($d['telepon'] ?? '');
    $username = trim($d['username'] ?? '');
    $password = trim($d['password'] ?? '');
    
    $qcid = query("SELECT * FROM users WHERE id_user = '$id'");
    if ($id <= 0 || mysqli_num_rows($qcid) == 0) {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'User tidak valid.'
        ];

    }

    if ($nama === '' || $telepon === '' || $username === '' || $password === '') {
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'Semua data harap diisi.'
        ];

    }
    
    $qca = query("SELECT username FROM users WHERE username='$username' AND id_user != '$id'");
    $ca = mysqli_fetch_assoc($qca);
    if(mysqli_num_rows($qca) > 0){
        return [
            'bg' => 'info',
            'pesan' => 'Username '.$ca['username'].' sudah digunakan. Harap ganti username yang lain.'
        ];
    }

    mysqli_begin_transaction($conn);
    try{
        query("UPDATE anggota SET nama='$nama', telepon='$telepon' WHERE id_anggota='$id'");
        query("UPDATE users SET username='$username', password='$password' WHERE id_anggota='$id'");
        mysqli_commit($conn);
        return [
            'bg' => 'success',
            'pesan' => 'Profil berhasil diperbarui.'        
        ];
    } catch(Exception $e){
        mysqli_rollback($conn);
        return [
            'bg' => 'danger',
            'pesan' => 'Profil gagal diperbarui. Harap coba lagi.'
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hasil = profile($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=profile");
    exit;
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);