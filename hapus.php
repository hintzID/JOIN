<?php

include_once("php/koneksi.php");

// Mengambil id_barang dari query string
$id_barang = $_GET['id_barang'];

// Query untuk menghapus data dari tabel data_barang_kategori
$query1 = "DELETE FROM data_barang_kategori WHERE id_barang = '$id_barang'";

// Query untuk menghapus data dari tabel index_barang
$query2 = "DELETE FROM index_barang WHERE id_barang = '$id_barang'";

// Eksekusi query
mysqli_query($koneksi, $query1);
mysqli_query($koneksi, $query2);

// Redirect ke halaman index.php
    echo "<script>
    alert ('DATA BERHASIL DIHAPUS!');
    document.location.href = 'index.php';
         </script>";

?>
