<?php
include 'koneksi.php';

if(isset($_SESSION['username'])) {
    if(isset($_POST['submit'])) {
        $nama_obat = $_POST['nama_obat'];
        $kemasan = $_POST['kemasan'];
        $harga = $_POST['harga'];
        
        $sql = "INSERT INTO obat (nama_obat, kemasan, harga) VALUES ('$nama_obat', '$kemasan', '$harga')";
        $hasil = $conn->query($sql);
        
        if($hasil) {
            echo "<script>alert(Data berhasil ditambahkan.)";
            header("Location: index.php?page=obat");
            exit();
        } else {
            echo "Terjadi kesalahan. Data pasien gagal ditambahkan.";
        }
    }
     
    if(isset($_POST['hapus'])) {
        $id_pasien = $_POST['id_obat'];
        
        $deleteSql = "DELETE FROM obat WHERE id = $id_obat";
        $delete = $conn->query($deleteSql);
        
        header("Location: index.php?page=obat");
        exit();
    }
    ?>

    <form action="" method="POST">
    <div class="mb-3">
        <label for="nama" class="form-label fw-bold">Nama Obat</label>
        <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama Obat">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label fw-bold">Kemasan</label>
        <input type="text" class="form-control" id="kemasan" name="kemasan" placeholder="Kemasan">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label fw-bold">Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga">
    </div>
    <button class="btn btn-primary px-5 rounded-pill" type="submit" name="submit">Simpan</button>
    </form>

    <?php

    $showSql = "SELECT * FROM obat";
    $showHasil = $conn->query($showSql);
    if($showHasil->num_rows > 0){
        $no = 1;
        ?>
        <table class="table mt-3">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Kemasan</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $showHasil->fetch_assoc()){
        ?>
            <tr>
            <th scope="row"><?php echo $no ?></th>
            <td><?php echo $row['nama_obat']?></td>
            <td><?php echo $row['kemasan']?></td>
            <td><?php echo $row['harga']?></td>
            <td>
                <a href="index.php?page=obatEdit&id=<?php echo $row["id"]?>" class="btn btn-success btn-sm rounded-pill px-3">Ubah</a>
                <form action="" method="POST" style="display: inline-block">
                    <input type="hidden" name="id_pasien" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3" name="hapus">Hapus</button>
                </form>
            </td>
            </tr>
        <?php
        $no++;
        }
        ?>
        </tbody>
        </table>
    <?php
    } else {
        echo "Tidak Ada Data";
    }
} else {
    header("location: index.php?page=loginUser");
}
?>
