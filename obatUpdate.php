<?php
include "koneksi.php";

$id = $_POST['id'];
$nama_obat = $_POST['newNamaObat'];
$kemasan = $_POST['newKemasan'];
$harga = $_POST['newHarga'];

$sql = "UPDATE obat SET nama_obat='$nama_obat', kemasan='$kemasan', harga='$harga' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    echo("<script>alert(Data tersimpan)</script>");
    header("Location: index.php?page=obat");
} else {
    $conn->close();
    echo "Gagal melakukan perubahan data: " . $conn->error;
}
?>
