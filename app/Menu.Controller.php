<?php

function totalkategori() {
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategori ");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}
function totalmenu() {
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM menu ");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}
function totalaktif() {
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM menu WHERE status_menu = 1");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}
function totalnonaktif() {
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM menu WHERE status_menu = 0");
    return mysqli_fetch_assoc($q)['total'] ?? 0;
}
function getKategori()
{
    $sql = "SELECT * FROM kategori ORDER BY id_kategori ASC";

    $result = query($sql);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function tambahmenu($d){

    global $conn;

    $n = trim($d['nama'] ?? '');
    $h = trim($d['harga'] ?? '');
    $k = trim($d['kategori'] ?? '');
    $deskripsi = trim($d['deskripsi'] ?? '');

    $m = isset($d['menu']) ? 1 : 0;
    $s = isset($d['status']) ? 1 : 0;

   
    $h = str_replace('.', '', $h);
    $n = mysqli_real_escape_string($conn, $n);
    $h = (int) $h;
    $k = (int) $k;
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);
    $cek = query("
        SELECT id_menu
        FROM menu
        WHERE nama = '$n'
    ");

    if(mysqli_num_rows($cek) > 0){

        return [
            'bg' => 'info',
            'pesan' => 'Nama menu sudah ada.'
        ];
    }
    $foto = '';

    if(isset($_FILES['gambarBarang']) && $_FILES['gambarBarang']['error'] === 0){

        $namaFoto = $_FILES['gambarBarang']['name'];
        $tmpFoto  = $_FILES['gambarBarang']['tmp_name'];
        $ukuran   = $_FILES['gambarBarang']['size'];

        if($ukuran > 2 * 1024 * 1024){

            return [
                'bg' => 'error',
                'pesan' => 'Ukuran foto maksimal 2MB.'
            ];
        }
        $ext = strtolower(pathinfo($namaFoto, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if(!in_array($ext, $allowed)){

            return [
                'bg' => 'error',
                'pesan' => 'Format foto tidak valid. Gunakan JPG, PNG, atau WEBP.'
            ];
        }
        $namaFile = uniqid('menu_') . '.' . $ext;

        $folder = 'public/images/';

        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }

        if(!move_uploaded_file($tmpFoto, $folder . $namaFile)){

            return [
                'bg' => 'error',
                'pesan' => 'Foto gagal diupload.'
            ];
        }
        $foto = mysqli_real_escape_string($conn, $namaFile);
    }

    $q = query("
        INSERT INTO menu
        (
            foto,
            nama,
            harga,
            id_kategori,
            deskripsi,
            menu_tersedia,
            status_menu
        )
        VALUES
        (
            '$foto',
            '$n',
            '$h',
            '$k',
            '$deskripsi',
            '$m',
            '$s'
        )
    ");


    if($q){

        return [
            'bg' => 'success',
            'pesan' => 'Menu berhasil ditambahkan.'
        ];
    }


    return [
        'bg' => 'error',
        'pesan' => 'Menu gagal ditambahkan. Harap coba lagi.'
    ];
}


function editMenu($d){

    global $conn;

    $id = (int) ($d['id'] ?? 0);

    $n = trim($d['nama'] ?? '');
    $h = trim($d['harga'] ?? '');
    $k = trim($d['kategori'] ?? '');
    $deskripsi = trim($d['deskripsi'] ?? '');
    $m = isset($d['menu']) ? 1 : 0;
    $s = isset($d['status']) ? 1 : 0;

    $h = str_replace('.', '', $h);
    $n = mysqli_real_escape_string($conn, $n);
    $h = (int) $h;
    $k = (int) $k;
    $deskripsi = mysqli_real_escape_string($conn, $deskripsi);

    if($id <= 0){

        return [
            'bg' => 'error',
            'pesan' => 'Data menu tidak valid.'
        ];
    }

    $cek = query("
        SELECT id_menu
        FROM menu
        WHERE nama = '$n'
        AND id_menu != $id
    ");

    if(mysqli_num_rows($cek) > 0){

        return [
            'bg' => 'info',
            'pesan' => 'Nama menu sudah digunakan.'
        ];
    }

    $dataLama = query("
        SELECT foto
        FROM menu
        WHERE id_menu = $id
    ");

    if(mysqli_num_rows($dataLama) == 0){

        return [
            'bg' => 'error',
            'pesan' => 'Data menu tidak ditemukan.'
        ];
    }

    $menuLama = mysqli_fetch_assoc($dataLama);
    $fotoLama = $menuLama['foto'] ?? '';
    $foto = $fotoLama;

    if(isset($_FILES['gambarBarang']) && $_FILES['gambarBarang']['error'] === 0){

        $namaFoto = $_FILES['gambarBarang']['name'];
        $tmpFoto  = $_FILES['gambarBarang']['tmp_name'];
        $ukuran   = $_FILES['gambarBarang']['size'];
        if($ukuran > 2 * 1024 * 1024){

            return [
                'bg' => 'error',
                'pesan' => 'Ukuran foto maksimal 2MB.'
            ];
        }
        $ext = strtolower(pathinfo($namaFoto, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if(!in_array($ext, $allowed)){
            return [
                'bg' => 'error',
                'pesan' => 'Format foto tidak valid. Gunakan JPG, PNG, atau WEBP.'
            ];
        }
        $folder = 'public/images/';
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
        }
        $namaFile = uniqid('menu_') . '.' . $ext;
        if(!move_uploaded_file($tmpFoto, $folder . $namaFile)){

            return [
                'bg' => 'error',
                'pesan' => 'Foto gagal diupload.'
            ];
        }
        $foto = mysqli_real_escape_string($conn, $namaFile);
        if(!empty($fotoLama)){
            $fileLama = $folder . $fotoLama;

            if(file_exists($fileLama)){
                unlink($fileLama);
            }
        }
    }

    $q = query("
        UPDATE menu SET
            foto = '$foto',
            nama = '$n',
            harga = '$h',
            id_kategori = '$k',
            deskripsi = '$deskripsi',
            menu_tersedia = '$m',
            status_menu = '$s'
        WHERE id_menu = $id
    ");
    if($q){

        return [
            'bg' => 'success',
            'pesan' => 'Menu berhasil diperbarui.'
        ];
    }


    return [
        'bg' => 'error',
        'pesan' => 'Menu gagal diperbarui. Harap coba lagi.'
    ];
}

function hapusMenu($d){
    global $conn;
    $id = (int) ($d['id'] ?? 0);
    if($id <= 0){
        return [
            'bg' => 'error',
            'pesan' => 'Data menu tidak valid.'
        ];
    }
    $data = query("
        SELECT foto
        FROM menu
        WHERE id_menu = $id
    ");
    if(mysqli_num_rows($data) == 0){
        return [
            'bg' => 'error',
            'pesan' => 'Data menu tidak ditemukan.'
        ];
    }
    $menu = mysqli_fetch_assoc($data);
    $foto = $menu['foto'] ?? '';
    $q = query("
        DELETE FROM menu
        WHERE id_menu = $id
    ");
    if(!$q){
        return [
            'bg' => 'error',
            'pesan' => 'Menu gagal dihapus. Harap coba lagi.'
        ];
    }
    if(!empty($foto)){

        $folder = 'public/images/';
        $fileFoto = $folder . $foto;

        if(file_exists($fileFoto)){
            unlink($fileFoto);
        }
    }
    return [
        'bg' => 'success',
        'pesan' => 'Menu berhasil dihapus.'
    ];
}

if (isset($_POST['aksi']) && $_POST['aksi'] === 'tambah') {
    $hasil = tambahmenu($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu");
    exit;
}
if (isset($_POST['aksi']) && $_POST['aksi'] === 'edit') {
    $hasil = editMenu($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu");
    exit;
}
if (isset($_POST['aksi']) && $_POST['aksi'] === 'hapus') {
    $hasil = hapusMenu($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu");
    exit;
}
$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);

$kategoripilih = $_GET['kategori'] ?? '';
$keyword = trim($_GET['keyword'] ?? '');

$halaman = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($halaman < 1) {
    $halaman = 1;
}
$perHalaman = 5;
$offset = ($halaman - 1) * $perHalaman;
$sql = "
    SELECT menu.*, kategori.nama_kategori
    FROM menu
    LEFT JOIN kategori
        ON menu.id_kategori = kategori.id_kategori
    WHERE 1=1
";
if ($kategoripilih !== '') {

    $kategoripilih = (int) $kategoripilih;

    $sql .= " AND menu.id_kategori = $kategoripilih";
}
if ($keyword !== '') {

    $keywordEscaped = mysqli_real_escape_string($conn, $keyword);

    $sql .= " AND (
        menu.nama LIKE '%$keywordEscaped%'
        OR menu.harga LIKE '%$keywordEscaped%'
    )";
}
$sql .= " ORDER BY menu.id_menu DESC";
$sqlTotal = "
    SELECT COUNT(*) AS total
    FROM menu
    WHERE 1=1
";
if ($kategoripilih !== '') {
    $sqlTotal .= " AND id_kategori = $kategoripilih";
}
if ($keyword !== '') {
    $sqlTotal .= " AND (
        nama LIKE '%$keywordEscaped%'
        OR harga LIKE '%$keywordEscaped%'
    )";
}
$resultTotal = query($sqlTotal);
$dataTotal = mysqli_fetch_assoc($resultTotal);
$totalData = (int) $dataTotal['total'];
$totalHalaman = max(1, ceil($totalData / $perHalaman));
if ($halaman > $totalHalaman) {

    $halaman = $totalHalaman;

    $offset = ($halaman - 1) * $perHalaman;
}
$sql .= " LIMIT $offset, $perHalaman";
$menu = query($sql);
$paginationMenu = [
    'halaman' => $halaman,
    'perHalaman' => $perHalaman,
    'totalData' => $totalData,
    'totalHalaman' => $totalHalaman
];
$layoutMode = $_GET['layoutMode'] ?? 'table';
$kategori = getKategori();
$pagination = $paginationMenu;
$halaman = $pagination['halaman'];
$totalHalaman = $pagination['totalHalaman'];

?>