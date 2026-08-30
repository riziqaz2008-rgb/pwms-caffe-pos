<?php 
$conn = mysqli_connect(
    "localhost", 
    "root",
    "",
    "pw_pos"
);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>