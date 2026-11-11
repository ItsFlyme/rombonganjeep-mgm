<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data Kunjungan - Admin AJWLM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        @media print { .no-print { display: none !important; } }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0">Rekap Data Kunjungan AJWLM</h2>
                <p class="text-muted small">Asosiasi Jeep Wisata Lereng Merapi</p>
            </div>
            <div class="col-md-6 text-md-end no-print">
                <a href="export_excel.php" class="btn btn-success mb-2">📥 Cetak Excel</a>
                <a href="hapus_semua.php" class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus SELURUH data?')">🗑️ Hapus Semua</a>
                <a href="logout.php" class="btn btn-dark mb-2" onclick="return confirm('Apakah Anda yakin ingin keluar?')">🚪 Logout</a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>No. Registrasi</th>
                                <th>Nama Pemandu</th>
                                <th>No. WA</th>
                                <th>Komunitas</th>
                                <th>Asal Kota</th>
                                <th>Peserta</th>
                                <th>Jadwal Kunjungan</th>
                                <th class="no-print">Aksi</th>
                            </tr>
                        </thead>
                        <!-- ID tabel disiapkan untuk di-update via AJAX -->
                        <tbody id="tabel-kunjungan">
                            <?php include 'load_data.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX Polling (Otomatis memperbarui tabel tiap 3 detik tanpa refresh) -->
    <script>
        function loadTabelData() {
            fetch('load_data.php')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('tabel-kunjungan').innerHTML = html;
                })
                .catch(error => console.error('Error loading data:', error));
        }

        // Jalankan pemeriksaan data otomatis setiap 3000 milidetik (3 detik)
        setInterval(loadTabelData, 3000);
    </script>
</body>
</html>