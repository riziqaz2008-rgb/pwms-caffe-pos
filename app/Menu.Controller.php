<?php
$menu = query("SELECT w.*, k.nama_kategori
FROM menu w
LEFT JOIN kategori k ON w.id_kategori = k.id_kategori
WHERE 1=1");

function getKategori()
{
    $sql = "SELECT * FROM kategori ORDER BY nama_kategori ASC";

    $result = query($sql);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
?>