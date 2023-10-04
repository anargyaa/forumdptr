<?php 

$conn = mysqli_connect('localhost', 'root', '', 'forum');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>