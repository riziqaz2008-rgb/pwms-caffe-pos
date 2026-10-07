<?php
function pengaturan($d){
    global $conn;
    global $p;
    $namaUsaha = trim($d['nama'] ?? '');
    $telepon   = trim($d['telepon'] ?? '');
    $email     = trim($d['email'] ?? '');
    $jam       = trim($d['jam'] ?? '');
    $alamat    = trim($d['alamat'] ?? '');
    
    if ($namaUsaha === '' || $alamat === '') {
    
        return [
            'status' => false,
            'bg' => 'warning',
            'pesan' => 'Nama usaha, nomor telepon, dan alamat harap diisi.'
        ];
    
    } else {
    
        $stmt = mysqli_prepare(
            $conn,
            "UPDATE pengaturan
             SET nama_usaha = ?,
                 telepon = ?,
                 email = ?,
                 jam = ?,
                 alamat = ?
             WHERE id = ?"
        );
    
        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $namaUsaha,
            $telepon,
            $email,
            $jam,
            $alamat,
            $p['id']
        );
    
        if (mysqli_stmt_execute($stmt)) {
    
            return [
                'status' => true,
                'bg' => 'success',
                'pesan' => 'Pengaturan berhasil disimpan.'
            ];
    
        } else {
    
            return [
                'status' => false,
                'bg' => 'danger',
                'pesan' => 'Pengaturan gagal disimpan.'
            ];
        }
    
        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hasil = pengaturan($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=pengaturan");
    exit;
}

$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);