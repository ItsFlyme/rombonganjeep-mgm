<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Kunjungan AJWLM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tom Select CSS (Untuk fitur pencarian pada Select) -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .card {
            position: relative;
            background-color: rgba(255, 255, 255, 0.92) !important;
            border: 1px solid rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('maskot_anak.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 45% auto;
            opacity: 0.12;
            z-index: 0;
        }

        @media (max-width: 768px) {
            .card::before {
                background-size: 65% auto;
            }
        }

        .card-header, .card-body {
            position: relative;
            z-index: 1;
        }

        .card-header {
            background-color: rgba(33, 37, 41, 0.95) !important;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-white text-center py-4">
                        <img src="logomerapi.png" alt="Logo Museum Gunungapi Merapi" style="max-height: 70px;" class="mb-3 p-1 rounded">
                        <h3 class="mb-0">Registrasi Kunjungan AJWLM</h3>
                        <p class="text-white-50 small mb-0">Asosiasi Jeep Wisata Lereng Merapi</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="simpan.php" method="POST" id="formRegistrasi">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pemandu / Driver <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pemandu" class="form-control" placeholder="Jawaban Anda" required>
                            </div>

                            <!-- Input Nomor Telepon -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor WA Pemandu / Driver <span class="text-danger">*</span></label>
                                <input type="tel" name="no_telpon" class="form-control" placeholder="Contoh: 081234567890" pattern="[0-9]{9,13}" minlength="9" maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                <div class="form-text text-muted">Hanya angka, minimal 9 digit dan maksimal 13 digit</div>
                            </div>

                            <!-- Select Komunitas Jeep -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Komunitas Jeep <span class="text-danger">*</span></label>
                                <select id="select-komunitas" name="nama_komunitas" placeholder="Ketik atau pilih singkatan Komunitas Jeep..." required>
                                    <option value="">Pilih Komunitas Jeep</option>
                                    <option value="86 MJTC">86 MJTC</option>
                                    <option value="BAJA">BAJA</option>
                                    <option value="Bat">Bat</option>
                                    <option value="Bat2">Bat2</option>
                                    <option value="BELANTARA">BELANTARA</option>
                                    <option value="Elang">Elang</option>
                                    <option value="GAJ">GAJ</option>
                                    <option value="GLAGAHARJO">GLAGAHARJO</option>
                                    <option value="GOJIP">GOJIP</option>
                                    <option value="GRINATA">GRINATA</option>
                                    <option value="HLM BELANTARA">HLM BELANTARA</option>
                                    <option value="JAM">JAM</option>
                                    <option value="JMC">JMC</option>
                                    <option value="JMK">JMK</option>
                                    <option value="JMK 2">JMK 2</option>
                                    <option value="JMO">JMO</option>
                                    <option value="JTM">JTM</option>
                                    <option value="JWM">JWM</option>
                                    <option value="KA">KA</option>
                                    <option value="KAS1">KAS1</option>
                                    <option value="KAS2">KAS2</option>
                                    <option value="KLG">KLG</option>
                                    <option value="KLG2">KLG2</option>
                                    <option value="Klk">Klk</option>
                                    <option value="MERAPI JAYA">MERAPI JAYA</option>
                                    <option value="MGM">MGM</option>
                                    <option value="MGM2">MGM2</option>
                                    <option value="MJAK">MJAK</option>
                                    <option value="MJLC">MJLC</option>
                                    <option value="MLCC">MLCC</option>
                                    <option value="PM">PM</option>
                                    <option value="PMA">PMA</option>
                                    <option value="PU/Yoes">PU/Yoes</option>
                                    <option value="PUJANGGA">PUJANGGA</option>
                                    <option value="RBM">RBM</option>
                                    <option value="SMART">SMART</option>
                                    <option value="Tkk">Tkk</option>
                                    <option value="TLCM">TLCM</option>
                                    <option value="Tlogo Putri">Tlogo Putri</option>
                                    <option value="Tlogo2">Tlogo2</option>
                                    <option value="TRACK">TRACK</option>
                                    <option value="VALMOS">VALMOS</option>
                                </select>
                                <div class="form-text text-muted">Isi dengan nama singkatan komunitas</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Asal Tamu (Isi nama Kota) <span class="text-danger">*</span></label>
                                <input type="text" name="alamat_asal" class="form-control" placeholder="Jawaban Anda" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Jumlah Tamu <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah_peserta" class="form-control" placeholder="Jawaban Anda" min="1" required>
                            </div>

                            <!-- Input Tanggal & Jam Kedatangan -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_kunjungan" id="tglKunjungan" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Jam Kunjungan (WIB) <span class="text-danger">*</span></label>
                                    <input type="time" name="jam_kunjungan" class="form-control" min="08:00" max="15:00" required>
                                    <div id="infoJam" class="form-text text-muted">Jam operasional: 08.00 - 15.00 (Jumat: s.d 14.00, Senin: Libur)</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="g-recaptcha" data-sitekey="6LdMBhEuAAAAAPk_5YYopCUPIxY0xvvQYXgx3Kuk"></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div>
                                    <button type="submit" class="btn btn-dark px-4">Kirim</button>
                                    <button type="reset" class="btn btn-link text-muted text-decoration-none">Kosongkan formulir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Tom Select & Validasi Jadwal Baru -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        new TomSelect("#select-komunitas", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        const inputTanggal = document.getElementById('tglKunjungan');

        inputTanggal.addEventListener('change', function() {
            var selectedDateStr = this.value;
            if (!selectedDateStr) return;

            var parts = selectedDateStr.split('-');
            var selectedDateObj = new Date(parts[0], parts[1] - 1, parts[2]);
            var dayOfWeek = selectedDateObj.getDay(); // 0 = Minggu, 1 = Senin, dst.

            // Validasi Hari Senin Libur
            if (dayOfWeek === 1) {
                alert('Mohon maaf, hari SENIN libur (tidak ada kunjungan). Silakan pilih hari lain.');
                this.value = '';
                return;
            }

            // Validasi jam jika memilih tanggal hari ini
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            var currentDateFormatted = yyyy + '-' + mm + '-' + dd;

            if (selectedDateStr === currentDateFormatted) {
                var currentHour = today.getHours();
                var currentMinute = today.getMinutes();
                
                // Batas akhir tergantung hari
                var maxHour = (dayOfWeek === 5) ? 14 : 15; // Jumat jam 14:00, lainnya jam 15:00

                if (currentHour > maxHour || (currentHour === maxHour && currentMinute > 0)) {
                    var batasStr = (dayOfWeek === 5) ? '14.00 WIB' : '15.00 WIB';
                    alert('Pendaftaran untuk hari ini sudah ditutup (lewat jam ' + batasStr + '). Silakan pilih tanggal kunjungan untuk hari berikutnya.');
                    this.value = '';
                }
            }
        });
    </script>
</body>
</html>