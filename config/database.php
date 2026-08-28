<?php 
$conn = mysqli_connect(
    "localhost", 
    "root",
    "",
    "pw-pos"
);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>