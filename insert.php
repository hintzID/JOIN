<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "tugas1");

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $catatan_barang = $_POST['catatan_barang'];
  $id_kategori = $_POST['id_kategori'];

    // Upload gambar
    $gambar_barang = $_FILES["gambar_barang"]["name"];
    $file_tmp = $_FILES["gambar_barang"]["tmp_name"];
    $folder = "img/";
    move_uploaded_file($file_tmp, $folder.$gambar_barang);

  // Insert the data into the index_barang table
  $query = "INSERT INTO index_barang (kode_barang, nama_barang, gambar_barang, catatan_barang) VALUES ('$kode_barang', '$nama_barang', '$gambar_barang', '$catatan_barang')";
  mysqli_query($conn, $query);

  // Get the ID of the last inserted record
  $id_barang = mysqli_insert_id($conn);

  // Insert the data into the data_barang_kategori table
  $query = "INSERT INTO data_barang_kategori (id_barang, id_kategori) VALUES ('$id_barang', '$id_kategori')";
  mysqli_query($conn, $query);

  if(mysqli_affected_rows($conn) > 0) {           
    echo "<script>
    alert ('DATA BERHASIL DI-TAMBAH!');
    document.location.href = 'index.php';
         </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

    }

    
?>
