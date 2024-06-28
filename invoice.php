<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data periksa berdasarkan ID
$sql = "SELECT * FROM periksa WHERE id='$id'";
$hasil = $conn->query($sql);

if ($hasil->num_rows > 0) {
    $row = $hasil->fetch_assoc();
    $idDokter = $row['id_dokter'];
    $idPasien = $row['id_pasien'];
    $tglPeriksa = $row['tgl_periksa'];
    $catatan = $row['catatan'];
    $obatIds = explode(',', $row['obat']);
} else {
    echo "Data tidak ditemukan.";
    exit();
}

// Ambil data dokter
$dokterSql = "SELECT * FROM dokter WHERE id='$idDokter'";
$dokterResult = $conn->query($dokterSql);
$dokter = $dokterResult->fetch_assoc();

// Ambil data pasien
$pasienSql = "SELECT * FROM pasien WHERE id='$idPasien'";
$pasienResult = $conn->query($pasienSql);
$pasien = $pasienResult->fetch_assoc();

// Ambil data obat dan hitung subtotal
$obatSql = "SELECT * FROM obat WHERE id IN (" . implode(',', $obatIds) . ")";
$obatResult = $conn->query($obatSql);
$obatList = [];
$subtotalObat = 0;

while ($obatRow = $obatResult->fetch_assoc()) {
    $obatList[] = $obatRow;
    $subtotalObat += $obatRow['harga'];
}

// Misalkan jasa dokter adalah Rp 150.000,00 (bisa juga diambil dari tabel dokter jika ada kolom untuk itu)
$jasaDokter = 150000;

// Hitung total
$total = $jasaDokter + $subtotalObat;
?>

<div class="row justify-content-center">
    <div class="col-6 px-4 py-5">
        <h3 class="mb-5">Nota Pembayaran</h3>
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
                <p class="lh-sm">No. Periksa</p>
                <p class="lh-1 fw-bold">#<?= $id ?></p>
            </div>
            <div class="d-flex flex-column align-items-end">
                <p class="lh-sm">Tanggal Periksa</p>
                <p class="lh-1 fw-bold"><?= $tglPeriksa ?></p>
            </div>
        </div>
        <div class="text-secondary">
            <hr>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex flex-column">
                <p class="lh-sm">Pasien</p>
                <p class="lh-1 fw-bold"><?= $pasien['nama'] ?></p>
                <p class="lh-1"><?= $pasien['alamat'] ?></p>
                <p class="lh-1 text-primary"><?= $pasien['no_hp'] ?></p>
            </div>
            <div class="d-flex flex-column align-items-end">
                <p class="lh-sm">Dokter</p>
                <p class="lh-1 fw-bold"><?= $dokter['nama'] ?></p>
                <p class="lh-1"><?= $dokter['alamat'] ?></p>
                <p class="lh-1 text-primary"><?= $dokter['no_hp'] ?></p>
            </div>
        </div>
        <hr class="text-secondary p-0 m-0 mt-5">
        <table class="table mt-0 border-top-1">
        <thead>
            <tr>
                <th scope="col">Deskripsi</th>
                <th scope="col" class="text-end">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jasa Dokter</td>
                <td class="text-end">Rp <?= number_format($jasaDokter, 0, ',', '.') ?></td>
            </tr>
            <?php foreach ($obatList as $obat): ?>
            <tr>
                <td><?= $obat['nama_obat'] ?></td>
                <td class="text-end">Rp <?= number_format($obat['harga'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="mb-2 text-end text-secondary">Jasa Dokter: <span class="text-black">Rp <?= number_format($jasaDokter, 0, ',', '.') ?></span></p>
    <p class="p-0 m-0 text-end text-secondary">Subtotal Obat: <span class="text-black">Rp <?= number_format($subtotalObat, 0, ',', '.') ?></span></p>
    <p class="fs-5 fw-semibold text-end mt-4">Total: <span class="text-success">Rp <?= number_format($total, 0, ',', '.') ?></span></p>
    </div>
</div>
