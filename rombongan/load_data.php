<?php
include 'config.php';

$no = 1;
$result = mysqli_query($conn, "SELECT * FROM kunjungan ORDER BY id DESC");

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tgl = (!empty($row['tgl_kunjungan']) && $row['tgl_kunjungan'] != '0000-00-00') ? date('d/m/Y', strtotime($row['tgl_kunjungan'])) : '-';
        $jam = (!empty($row['jam_kunjungan'])) ? date('H:i', strtotime($row['jam_kunjungan'])) : '-';
?>
<tr>
    <td class="text-center"><?php echo $no++; ?></td>
    <td><code><?php echo htmlspecialchars($row['no_registrasi']); ?></code></td>
    <td><?php echo htmlspecialchars($row['nama_pemandu']); ?></td>
    <td><?php echo htmlspecialchars($row['no_telpon']); ?></td>
    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($row['nama_komunitas']); ?></span></td>
    <td><?php echo htmlspecialchars($row['alamat_asal']); ?></td>
    <td class="text-center"><?php echo htmlspecialchars($row['jumlah_peserta']); ?> Orang</td>
    <td>
        📅 <?php echo $tgl; ?><br>
        ⏰ <?php echo $jam; ?> WIB
    </td>
    <td class="text-center no-print">
        <div class="btn-group btn-group-sm" role="group">
            <a href="struk.php?id=<?php echo $row['id']; ?>" class="btn btn-info text-white" target="_blank">Lihat Struk</a>
            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </div>
    </td>
</tr>
<?php 
    }
} else {
    echo '<tr><td colspan="9" class="text-center text-muted py-4">Belum ada data kunjungan yang tercatat.</td></tr>';
}
?>