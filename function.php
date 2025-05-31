<?php
session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "inventory");

// Tambah barang
if (isset($_POST['addnewbarang'])) {
    $kodebarang = $_POST['kodebarang'];
    $namabarang = $_POST['namabarang'];
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];


    $addtotable = mysqli_query($conn, "INSERT INTO stock (kodebarang, namabarang, satuan, stock, harga, lokasi, tahun) VALUES ('$kodebarang','$namabarang','$satuan','$stock','$harga','$lokasi', '$tahun')");
    if($addtotable){
        header('location:index.php');
    } else {
        echo 'Gagal menambah barang';
    }
}


// menambah barang masuk
if(isset($_POST['addbarangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $kodebarang = $_POST['kodebarang'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    // ambil stock sekarang dari tabel stock
    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstock = $stocksekarang + $qty;

    // insert ke tabel masuk
    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, penerima, keterangan, qty, kodebarang) VALUES('$barangnya', '$penerima', '$keterangan', '$qty', '$kodebarang')");

    // update stock di tabel stock
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstock' WHERE idbarang='$barangnya'");

    if($addtomasuk && $updatestockmasuk){
        header('Location: masuk.php');
    } else {
        echo 'Gagal memasukkan barang';
        header('Location: masuk.php');
    }
}

// menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $kodebarang = $_POST['kodebarang'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    // Ambil stock sekarang
    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatanya['stock'];

    // Kurangi stock
    if($stocksekarang >= $qty){
        $kurangistock = $stocksekarang - $qty;

        // Tambah ke tabel keluar & update stock
        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, keterangan, qty, kodebarang) 
            VALUES ('$barangnya', '$penerima', '$keterangan', '$qty', '$kodebarang')");
        $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$kurangistock' WHERE idbarang='$barangnya'");

        if($addtokeluar && $updatestock){
            header('location:keluar.php');
        } else {
            echo 'Gagal menambah barang keluar';
            header('location:keluar.php');
        }
        } else {
            echo "Stok tidak mencukupi!";
            header('location:keluar.php');
        }
}



// Edit barang table stock
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $kodebarang = $_POST['kodebarang'];
    $namabarang = $_POST['namabarang'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $lokasi = $_POST['lokasi'];
    $tahun = $_POST['tahun'];

    $update = mysqli_query($conn, "UPDATE stock SET kodebarang='$kodebarang', namabarang='$namabarang', satuan='$satuan', harga='$harga', lokasi='$lokasi', tahun='$tahun' WHERE idbarang='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal update barang';
    }
}

// Hapus barang stock
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];
    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal hapus barang';
    }
}


// Mengubah barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb']; // ID barang
    $idm = $_POST['idm']; // ID barang masuk
    $kodebarang = $_POST['kodebarang'];
    $namabarang = $_POST['namabarang'];
    $qty = $_POST['qty']; // qty baru
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];

    // Ambil stok sekarang dari tabel stock
    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    // Ambil qty lama dari tabel masuk
    $qtylama = mysqli_query($conn, "SELECT * FROM masuk WHERE idmasuk='$idm'");
    $datalama = mysqli_fetch_array($qtylama);
    $qtyskrg = $datalama['qty'];

    if ($qty > $qtyskrg) {
        // Jika qty baru lebih besar → tambahkan ke stok
        $selisih = $qty - $qtyskrg;
        $newstock = $stockskrg + $selisih;
    } else {
        // Jika qty baru lebih kecil → kurangi dari stok
        $selisih = $qtyskrg - $qty;
        $newstock = $stockskrg - $selisih;
    }

    // Update stok di tabel stock
    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$newstock' WHERE idbarang='$idb'");
    // Update data di tabel masuk
    $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', penerima='$penerima', keterangan='$keterangan' WHERE idmasuk='$idm'");

    if ($updatestock && $updatenya) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='masuk.php';</script>";
    } else {
        echo "<script>alert('Gagal update data');</script>";
    }
}

// menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "SELECT * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "UPDATE stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        echo "<script>alert('Data berhasil dihapus'); window.location.href='masuk.php';</script>";
    }else{
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}


// Mengubah barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $keterangan = $_POST['keterangan'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtylama = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idk'");
    $datalama = mysqli_fetch_array($qtylama);
    $qtyskrg = $datalama['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $newstock = $stockskrg - $selisih;
    } else {
        $selisih = $qtyskrg - $qty;
        $newstock = $stockskrg + $selisih;
    }

    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$newstock' WHERE idbarang='$idb'");
    $updatekeluar = mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$penerima', keterangan='$keterangan' WHERE idkeluar='$idk'");

    if ($updatestock && $updatekeluar) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='keluar.php';</script>";
    } else {
        echo "<script>alert('Gagal update data');</script>";
    }
}


// Menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    // Tambahkan kembali stok
    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];
    $newstock = $stockskrg + $qty;

    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$newstock' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");

    if ($updatestock && $hapusdata) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='keluar.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}



?>