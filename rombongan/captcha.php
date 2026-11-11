<?php
session_start();

// Membuat teks acak 5 karakter
$karakter = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$kode_captcha = '';
for ($i = 0; $i < 5; $i++) {
    $kode_captcha .= $karakter[rand(0, strlen($karakter) - 1)];
}

// Simpan kode ke session untuk divalidasi nanti
$_SESSION['captcha'] = $kode_captcha;

// Membuat gambar menggunakan GD Library PHP
$gambar = imagecreatetruecolor(120, 40);
$warna_bg = imagecolorallocate($gambar, 240, 240, 240);
$warna_teks = imagecolorallocate($gambar, 33, 37, 41);
$warna_garis = imagecolorallocate($gambar, 200, 200, 200);

imagefilledrectangle($gambar, 0, 0, 120, 40, $warna_bg);

// Menambahkan garis-garis acak sebagai pengaman agar tidak mudah dibaca bot
for ($i = 0; $i < 5; $i++) {
    imageline($gambar, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $warna_garis);
}

// Menulis teks captcha ke dalam gambar
imagestring($gambar, 5, 35, 12, $kode_captcha, $warna_teks);

// Output file sebagai gambar PNG
header('Content-Type: image/png');
imagepng($gambar);
imagedestroy($gambar);
?>