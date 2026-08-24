<?php 
$conn = mysqli_connect(
    "localhost", 
    "root",
    "",
    "kedaiku_db"
);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>