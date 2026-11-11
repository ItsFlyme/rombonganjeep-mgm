<?php
// Panggil koneksi database
include 'config.php';

// Cek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Ambil dan amankan nilai id untuk mencegah SQL Injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data berdasarkan kolom ID (sesuaikan nama kolom primary key jika berbeda, misal: id atau id_kunjungan)
    // Asumsi nama kolom primary key di tabel Anda adalah 'id'
    $query = "DELETE FROM kunjungan WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil terhapus, kembalikan ke halaman data admin
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'data.php';
              </script>";
    } else {
        // Jika gagal
        echo "<script>
                alert('Gagal menghapus data: " . mysqli_error($conn) . "');
                window.location.href = 'data.php';
              </script>";
    }
} else {
    // Jika tidak ada ID, kembalikan langsung ke halaman data
    header("Location: data.php");
    exit();
}
?>