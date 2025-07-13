<?php 
$conn = new mysqli("localhost", "root", "", "spk-bulutangkis-ahpsaw");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
?>