<?php
include 'config.php';

// Hapus seluruh isi tabel kunjungan
mysqli_query($conn, "TRUNCATE TABLE kunjungan");

// Alihkan kembali ke halaman data
header("Location: data.php");
exit();
?>