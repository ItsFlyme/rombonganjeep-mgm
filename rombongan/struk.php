<?php
session_start();
include 'config.php';

// Pastikan ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM kunjungan WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data kunjungan tidak ditemukan!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Bukti Kunjungan - AJWLM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .struk-card { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        @media print {
            .no-print { display: none; }
            body { background: #fff; }
            .struk-card { box-shadow: none; margin: 0; width: 100%; max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="struk-card p-4 border">
            <div class="text-center border-bottom pb-3 mb-3">
                <img src="logomerapi1.png" alt="Logo" style="max-height: 50px;" class="mb-2">
                <h4 class="fw-bold mb-0">BUKTI REGISTRASI</h4>
                <p class="text-muted small mb-0">Asosiasi Jeep Wisata Lereng Merapi</p>
            </div>

            <div class="mb-3">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="fw-bold text-muted" width="45%">No. Registrasi</td>
                        <td>: <span class="fw-bold text-primary"><?php echo htmlspecialchars($data['no_registrasi']); ?></span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Nama Pemandu / Driver</td>
                        <td>: <?php echo htmlspecialchars($data['nama_pemandu']); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Nomor WA Pemandu / Driver</td>
                        <td>: <?php echo htmlspecialchars($data['no_telpon']); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Komunitas Jeep</td>
                        <td>: <?php echo htmlspecialchars($data['nama_komunitas']); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Alamat Asal Tamu</td>
                        <td>: <?php echo htmlspecialchars($data['alamat_asal']); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Jumlah Tamu</td>
                        <td>: <?php echo htmlspecialchars($data['jumlah_peserta']); ?> Orang</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Tanggal Kunjungan</td>
                        <td>: <span class="fw-bold"><?php echo date('d-m-Y', strtotime($data['tgl_kunjungan'])); ?></span></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-muted">Jam Kunjungan</td>
                        <td>: <span class="fw-bold"><?php echo date('H:i', strtotime($data['jam_kunjungan'])); ?> WIB</span></td>
                    </tr>
                    <?php if (!empty($data['created_at'])) { ?>
                    <tr>
                        <td class="fw-bold text-muted">Waktu Pengisian Form</td>
                        <td>: <?php echo date('d-m-Y H:i', strtotime($data['created_at'])); ?> WIB</td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="alert alert-success text-center small py-2 mb-3">
                Registrasi Berhasil! Tunjukkan bukti ini kepada petugas loket.
            </div>

            <div class="d-grid gap-2 no-print">
                <button onclick="window.print()" class="btn btn-dark">🖨️ Cetak / Simpan Struk</button>
                <a href="index.php" class="btn btn-outline-secondary">Kembali ke Formulir</a>
            </div>
        </div>
    </div>
</body>
</html>