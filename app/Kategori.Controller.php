<?php



function cariKategori() {
    global $conn;
    $keyword = isset($_GET['keyword'])
        ? trim($_GET['keyword'])
        : '';
    $halaman = isset($_GET['page'])
        ? (int) $_GET['page']
        : 1;

    if ($halaman < 1) {
        $halaman = 1;
    }
    $perHalaman = 5;

    $offset = ($halaman - 1) * $perHalaman;
    $sql = "SELECT * FROM kategori";

    if (!empty($keyword)) {

        $keywordEscaped = mysqli_real_escape_string($conn, $keyword);

        $sql .= " WHERE nama_kategori LIKE '%$keywordEscaped%'";
    }
    $sql .= " ORDER BY id_kategori ASC";
    $sqlTotal = "SELECT COUNT(*) AS total FROM kategori";
    if (!empty($keyword)) {

        $sqlTotal .= " WHERE nama_kategori LIKE '%$keywordEscaped%'";
    }
    $resultTotal = query($sqlTotal);
    $dataTotal = mysqli_fetch_assoc($resultTotal);
    $totalData = (int) $dataTotal['total'];

    // INI YANG DITAMBAHKAN
    $totalHalaman = max(1, ceil($totalData / $perHalaman));
    if ($halaman > $totalHalaman) {
        $halaman = $totalHalaman;

        $offset = ($halaman - 1) * $perHalaman;
    }
    $sql .= " LIMIT $offset, $perHalaman";
    $result = query($sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    $GLOBALS['paginationKategori'] = [
        'halaman' => $halaman,
        'perHalaman' => $perHalaman,
        'totalData' => $totalData,
        'totalHalaman' => $totalHalaman
    ];
    return $rows;
}



function tambahKategori($d){

    global $conn;

    $n = trim($d['nama']);
    $n = mysqli_real_escape_string($conn, $n);

    $cek = query("
        SELECT id_kategori
        FROM kategori
        WHERE nama_kategori = '$n'
    ");

    if(mysqli_num_rows($cek) > 0){

        return [
            'bg' => 'info',
            'pesan' => 'Kategori sudah ada.'
        ];
    }

   
    $q = query("
        INSERT INTO kategori (nama_kategori)
        VALUES ('$n')
    ");

    if($q){

        return [
            'bg' => 'success',
            'pesan' => 'Kategori berhasil ditambahkan.'
        ];

    }

    return [
        'bg' => 'error',
        'pesan' => 'Kategori gagal ditambahkan. Harap coba lagi.'
    ];
}

function hapusKategori($id){

    global $conn;

    $id = (int) $id;

    
    $cek = query("
        SELECT id_kategori
        FROM kategori
        WHERE id_kategori = $id
    ");

    if(mysqli_num_rows($cek) == 0){

        return [
            
            'bg' => 'info',
    
            'pesan' => 'Kategori tidak ditemukan.'
        ];

    }
    $cekMenu = query("
        SELECT id_menu
        FROM menu
        WHERE id_kategori = $id
        LIMIT 1
    ");

    if(mysqli_num_rows($cekMenu) > 0){

        return [
           
            'bg' => 'info',
            'icon' => 'exclamation-triangle',
            'pesan' => 'Kategori tidak dapat dihapus karena masih ada menu yang menggunakan kategori tersebut.'
        ];

    }
    $q = query("
        DELETE FROM kategori
        WHERE id_kategori = $id
    ");

    if($q){

        return [
           
            'bg' => 'success',
  
            'pesan' => 'Kategori berhasil dihapus.'
        ];

    }

    return [
        'bg' => 'danger',
        'icon' => 'exclamation-triangle',
        'pesan' => 'Kategori gagal dihapus. Harap coba lagi.'
    ];
}




function editKategori($d){ 

    global $conn;

    $id = (int) $d['id'];
    $n = trim($d['nama']);
    $n = mysqli_real_escape_string($conn, $n);

    $cek = query("
        SELECT id_kategori 
        FROM kategori 
        WHERE nama_kategori = '$n'
        AND id_kategori != $id
    ");

    if(mysqli_num_rows($cek) > 0){ 

        return [ 
            'status' => false, 
            'bg' => 'info', 
            'icon' => 'info-circle', 
            'pesan' => 'Nama kategori tersebut sudah digunakan.'         
        ]; 

    } 

    $q = mysqli_query($conn, "
        UPDATE kategori 
        SET nama_kategori = '$n' 
        WHERE id_kategori = $id
    ");

    if($q){ 

        return [ 
            'status' => true, 
            'bg' => 'success', 
            'icon' => 'check-circle', 
            'pesan' => 'Kategori berhasil diperbarui.' 
        ]; 

    } 

    return [ 
        'status' => false, 
        'bg' => 'danger', 
        'icon' => 'exclamation-triangle',
        'pesan' => 'Kategori gagal diperbarui. Harap coba lagi.' 
    ]; 
}


if (isset($_POST['aksi']) && $_POST['aksi'] === 'tambah') {
    $hasil = tambahKategori($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu/kategori");
    exit;
}
if (isset($_POST['aksi']) && $_POST['aksi'] === 'edit') {
    $hasil = editKategori($_POST);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu/kategori");
    exit;
}
if (isset($_POST['aksi']) && $_POST['aksi'] === 'hapus') {
    $hasil = hapusKategori($_POST['id']);
    $_SESSION['toast'] = $hasil;
    header("Location: ?route=menu/kategori");
    exit;
}
$hasil = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : ''; 
$kategori = cariKategori();
$pagination = $paginationKategori;
$halaman = $pagination['halaman'];
$totalHalaman = $pagination['totalHalaman'];

?>