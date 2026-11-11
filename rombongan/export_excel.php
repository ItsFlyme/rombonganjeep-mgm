<?php
include 'config.php';

// Header file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment5; filename=Rekap_Kunjungan_AJWLM_" . date('Y-m-d') . ".xls");
?>
<h3>Rekap Data Kunjungan AJWLM</h3>
<table border="1">
    <thead>
        <tr style="background-color: #ddd;">
            <th>No</th>
            <th>No. Registrasi</th>
            <th>Nama Pemandu</th>
            <th>No. WA</th>
            <th>Komunitas Jeep</th>
            <th>Alamat Asal</th>
            <th>Jumlah Peserta</th>
            <th>Tanggal Kunjungan</th>
            <th>Jam Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $result = mysqli_query($conn, "SELECT * FROM kunjungan ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['no_registrasi']; ?></td>
            <td><?php echo $row['nama_pemandu']; ?></td>
            <td><?php echo $row['no_telpon']; ?></td>
            <td><?php echo $row['nama_komunitas']; ?></td>
            <td><?php echo $row['alamat_asal']; ?></td>
            <td><?php echo $row['jumlah_peserta']; ?></td>
            <td><?php echo $row['tgl_kunjungan']; ?></td>
            <td><?php echo $row['jam_kunjungan']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>