<?php
$kategori = query("SELECT * FROM kategori ORDER BY id_kategori ASC");

function cariKategori() {

    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    global $conn;

    $sql = "SELECT * FROM kategori";

    if (!empty($keyword)) {

        $keywordEscaped = mysqli_real_escape_string($conn, $keyword);

        $sql .= " WHERE nama_kategori LIKE '%$keywordEscaped%'";
    }

    $sql .= " ORDER BY id_kategori ASC";

    $result = query($sql);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function tambahKategori($d){

    global $conn;

    $n = trim($d['namaKategori']);
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
       
        'bg' => 'danger',
       
        'pesan' => 'Kategori gagal ditambahkan. Harap coba lagi.'
    ];
}


function hapusKategori($id){

    $id = (int) $id;

    $cek = query("
        SELECT * FROM kategori 
        WHERE id_kategori = '$id'
    ");

    if(mysqli_num_rows($cek) == 0){

        return [
            'status' => false,
            'bg' => 'info',
            'icon' => 'info-circle',
            'pesan' => 'Kategori tidak ditemukan.'
        ];

    }

    $q = query("
        DELETE FROM kategori 
        WHERE id_kategori = '$id'
    ");

    if($q){

        return [
            'status' => true,
            'bg' => 'success',
            'icon' => 'check-circle',
            'pesan' => 'Kategori berhasil dihapus.'
        ];

    }

    return [
        'status' => false,
        'bg' => 'danger',
        'icon' => 'exclamation-triangle',
        'pesan' => 'Kategori gagal dihapus. Harap coba lagi.'
    ];
}


function editKategori($d){ 

    global $conn;

    $id = (int) $d['id_kategori'];

    $n = trim($d['namaKategori']);
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
?>