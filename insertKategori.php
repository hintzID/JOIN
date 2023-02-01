<?php require_once("header.php"); 

include_once("php/koneksi.php");
// Check if the form has been submitted

if (isset($_POST['submit'])) {
    // Get the form data
    $nama_kategori = $_POST['nama_kategori'];
    $catatan_kategori = $_POST['catatan_kategori'];

    // Insert the data into the index_barang table
    $query = "INSERT INTO kategori_barang (nama_kategori, jumlah_barang_per_kategori) VALUES ( '$nama_kategori', '$catatan_kategori')";
    mysqli_query($koneksi, $query);
  
    if(mysqli_affected_rows($koneksi) > 0) {           
      echo "<script>
      alert ('DATA BERHASIL DI-TAMBAH!');
      document.location.href = 'stok.php';
           </script>";
  } else {
      echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
  }
  
      }


?>

<center style="font-size:50px;"><b>Kategori</b></center>

<div class="container col-6">
<form action="" method="post">

  <label for="nama_kategori" class="form-label">Tulis Kategori Baru</label>
  <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"><br>

  <label for="catatan_kategori" class="form-label">Catatan</label>
  <input type="text" id="catatan_kategori" name="catatan_kategori" class="form-control"><br>

  <input type="submit" value="Submit" name="submit">
</form>
</div>

<?php require_once("footer.php"); ?>