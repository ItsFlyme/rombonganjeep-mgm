<?php
session_start();
include 'config.php';
date_default_timezone_set('Asia/Jakarta'); // Set zona waktu ke WIB

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Tangkap token dari Google reCAPTCHA
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $secret_key = '6LdMBhEuAAAAAL17DqOpafZh5wWyHZeZHWpLAOTQ'; 

    // Verifikasi cURL ke server Google
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret_key}&response={$recaptcha_response}");
    $captcha_success = json_decode($verify);

    if (!$captcha_success->success) {
        echo "<script>alert('Mohon centang kotak \"Saya bukan robot\" terlebih dahulu!'); window.history.back();</script>";
        exit();
    }

    // Tangkap & bersihkan data input dari form
    $nama_pemandu   = mysqli_real_escape_string($conn, $_POST['nama_pemandu']);
    $no_telpon      = mysqli_real_escape_string($conn, $_POST['no_telpon']);
    $nama_komunitas = mysqli_real_escape_string($conn, $_POST['nama_komunitas']);
    $alamat_asal    = mysqli_real_escape_string($conn, $_POST['alamat_asal']);
    $jumlah_peserta = intval($_POST['jumlah_peserta']);
    $tgl_kunjungan  = mysqli_real_escape_string($conn, $_POST['tgl_kunjungan']);
    $jam_kunjungan  = mysqli_real_escape_string($conn, $_POST['jam_kunjungan']);

    // Cek Hari Berdasarkan Tanggal yang Dipilih (0 = Minggu, 1 = Senin, 2 = Selasa, 3 = Rabu, 4 = Kamis, 5 = Jumat, 6 = Sabtu)
    $day_of_week = date('N', strtotime($tgl_kunjungan)); // 1 (Senin) sampai 7 (Minggu)

    // Validasi 1: Hari Senin Libur (1 = Senin)
    if ($day_of_week == 1) {
        echo "<script>alert('Mohon maaf, hari Senin libur dan tidak melayani kunjungan. Silakan pilih tanggal lain.'); window.history.back();</script>";
        exit();
    }

    // Tentukan batas jam maksimal berdasarkan hari
    // Jumat (hari ke-5) maksimal jam 14:00, selain itu maksimal jam 15:00
    $batas_jam_maksimal = ($day_of_week == 5) ? '14:00' : '15:00';

    // Validasi 2: Cek Jam Kunjungan di Server (08:00 - Batas Maksimal)
    if ($jam_kunjungan < '08:00' || $jam_kunjungan > $batas_jam_maksimal) {
        $pesan_jam = ($day_of_week == 5) ? '08:00 WIB sampai 14:00 WIB (Khusus Hari Jumat)' : '08:00 WIB sampai 15:00 WIB';
        echo "<script>alert('Jam kunjungan harus berada di antara pukul " . $pesan_jam . "!'); window.history.back();</script>";
        exit();
    }

    // Validasi 3: Cek jika memilih hari ini tapi waktu saat ini sudah melewati batas operasional
    $tanggal_hari_ini = date('Y-m-d');
    $jam_sekarang     = date('H:i');

    if ($tgl_kunjungan == $tanggal_hari_ini && $jam_sekarang > $batas_jam_maksimal) {
        echo "<script>alert('Pendaftaran untuk hari ini sudah ditutup karena telah melewati batas jam operasional. Silakan pilih tanggal kunjungan untuk hari berikutnya.'); window.location.href = 'index.php';</script>";
        exit();
    }

    // Generate nomor registrasi unik
    $no_registrasi = 'AJWLM-' . date('Ymd') . '-' . rand(1000, 9999);

    // Query simpan data ke database
    $sql = "INSERT INTO kunjungan (no_registrasi, nama_pemandu, no_telpon, nama_komunitas, alamat_asal, jumlah_peserta, tgl_kunjungan, jam_kunjungan) 
            VALUES ('$no_registrasi', '$nama_pemandu', '$no_telpon', '$nama_komunitas', '$alamat_asal', '$jumlah_peserta', '$tgl_kunjungan', '$jam_kunjungan')";

    if (mysqli_query($conn, $sql)) {
        $id_terakhir = mysqli_insert_id($conn);
        header("Location: struk.php?id=" . $id_terakhir);
        exit();
    } else {
        echo "Error Simpan Data: " . mysqli_error($conn);
    }
}
?>