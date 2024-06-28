<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil data periksa berdasarkan ID
$sql = "SELECT * FROM periksa WHERE id='$id'";
$hasil = $conn->query($sql);

// Cek apakah data ditemukan
if ($hasil->num_rows > 0) {
    $row = $hasil->fetch_assoc();
    $idDokter = $row['id_dokter'];
    $idPasien = $row['id_pasien'];
    $tglPeriksa = $row['tgl_periksa'];
    $catatan = $row['catatan'];
    $obat = explode(',', $row['obat']); // Pecah string obat menjadi array
} else {
    echo "Data tidak ditemukan.";
    exit();
}

// Ambil data dokter
$dokterSql = "SELECT * FROM dokter";
$dokterResult = $conn->query($dokterSql);

// Ambil data pasien
$pasienSql = "SELECT * FROM pasien";
$pasienResult = $conn->query($pasienSql);

// Ambil data obat
$obatSql = "SELECT * FROM obat";
$obatResult = $conn->query($obatSql);
?>

<h5 class="card-title">Form Edit Periksa</h5>
<form action="periksaUpdate.php" class="row g-3" method="post">
    <div class="col-12">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>" readonly>
    </div>
    <!-- Input untuk dokter -->
    <div class="col-12">
        <label for="dokter" class="form-label">Dokter</label>
        <select class="form-select" id="dokter" name="dokter">
            <?php while ($dokterRow = $dokterResult->fetch_assoc()) : ?>
                <?php $selected = ($dokterRow['id'] == $idDokter) ? "selected" : ""; ?>
                <option value="<?= $dokterRow['id'] ?>" <?= $selected ?>><?= $dokterRow['nama'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <!-- Input untuk pasien -->
    <div class="col-12">
        <label for="pasien" class="form-label">Pasien</label>
        <select class="form-select" id="pasien" name="pasien">
            <?php while ($pasienRow = $pasienResult->fetch_assoc()) : ?>
                <?php $selected = ($pasienRow['id'] == $idPasien) ? "selected" : ""; ?>
                <option value="<?= $pasienRow['id'] ?>" <?= $selected ?>><?= $pasienRow['nama'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <!-- Input untuk tanggal periksa -->
    <div class="col-12">
        <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
        <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl" value="<?= $tglPeriksa; ?>">
    </div>
    <!-- Input untuk catatan -->
    <div class="col-12">
        <label for="catatan" class="form-label">Catatan</label>
        <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $catatan; ?>">
    </div>
    <!-- Input untuk obat -->
    <div class="col-12">
        <label for="obat" class="form-label">Obat</label>
        <select class="form-select" id="obat" name="obat[]" multiple>
            <?php while ($obatRow = $obatResult->fetch_assoc()) : ?>
                <?php $selected = in_array($obatRow['id'], $obat) ? "selected" : ""; ?>
                <option value="<?= $obatRow['id'] ?>" <?= $selected ?>><?= $obatRow['nama_obat'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Update">Update</button>
    </div>
</form>
