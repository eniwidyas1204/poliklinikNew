<?php
    include 'koneksi.php';
    $id=$_GET['id'];
    
    $sql="select * from obat where id='$id'";
    $hasil=$conn->query($sql);

    while($row=$hasil->fetch_assoc()){
        $nama_obat=$row['nama_obat'];
        $kemasan=$row['kemasan'];
        $harga=$row['harga'];
    }
?>

<h5 class="card-title">Form Edit Obat</h5>
<form action="obatUpdate.php" class="row g-3" method="post" enctype="multipart/form-data">
    <div class="col-12">
        <label for="id" class="form-label">ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?=$id;?>" readonly>
    </div>
    <div class="col-12">
        <label for="tnama" class="form-label">Nama Obat</label>
        <input type="text" class="form-control" id="tnama" name="newNamaObat" value="<?=$nama_obat;?>">
    </div>
    <div class="col-12">
        <label for="talamat" class="form-label">Kemasan</label>
        <input type="text" class="form-control" id="talamat" name="newKemasan" value="<?=$kemasan;?>">
    </div>
    <div class="col-12">
        <label for="tHp" class="form-label">Harga</label>
        <input type="text" class="form-control" id="tHp" name="newHarga" value="<?=$harga;?>">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary" value="Update">Update</button>
    </div>
</form>