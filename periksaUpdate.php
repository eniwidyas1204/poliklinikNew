<?php
include "koneksi.php";

// Ambil data dari formulir
$id_periksa = $_POST['id'];
$dokter = $_POST['dokter'];
$pasien = $_POST['pasien'];
$tgl = $_POST['tgl'];
$catatan = $_POST['catatan'];
$obat = implode(',', $_POST['obat']); // Gabungkan array obat menjadi string

// Perbarui data di database
$sql = "UPDATE periksa SET id_dokter='$dokter', id_pasien='$pasien', tgl_periksa='$tgl', catatan='$catatan', obat='$obat' WHERE id='$id_periksa'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    echo "<script>alert('Data tersimpan'); window.location.href = 'index.php?page=periksa';</script>";
} else {
    $conn->close();
    echo "<script>alert('Gagal melakukan perubahan data: " . $conn->error . "'); window.location.href = 'index.php?page=periksa';</script>";
}
?>
