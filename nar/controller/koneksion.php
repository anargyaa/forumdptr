<?php 

$conn = mysqli_connect('localhost', 'root', '', 'diskusi');
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>