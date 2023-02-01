<?php

require_once("header.php"); 

include_once("php/koneksi.php");

if(isset($_GET['id_barang'])){
  $id_barang = $_GET['id_barang'];
  $query = "SELECT * FROM index_barang WHERE id_barang = $id_barang";
  $barang = mysqli_query($koneksi, $query);
  $data_barang = mysqli_fetch_array($barang);
}

if(isset($_POST['update'])){
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $gambar_barang = $_FILES['gambar_barang'];
  $catatan_barang = $_POST['catatan_barang'];
  $id_kategori = $_POST['id_kategori'];

  $query = "UPDATE index_barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', gambar_barang = '$gambar_barang', catatan_barang = '$catatan_barang' WHERE id_barang = $id_barang";
  $update = mysqli_query($koneksi, $query);

  if($update){
    $query2 = "UPDATE data_barang_kategori SET id_kategori = $id_kategori WHERE id_barang = $id_barang";
    $update2 = mysqli_query($koneksi, $query2);
    if($update2){
      header("location:index.php");
    }
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Update Barang </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
  #fileInput {
    display: none;
  }

  .custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
  }
</style>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center"> Update Barang </h1>
      <br>
      <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
        <label for="kode_barang"> Kode Barang </label>
        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $data_barang['kode_barang'] ?>">
        </div>

        <div class="form-group">      
          <input type="hidden" class="form-control" id="id_barang" name="id_barang" value="<?= $data_barang['id_barang'] ?>">
        </div>

        <div class="form-group">
          <label for="nama_barang"> Nama Barang </label>
          <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $data_barang['nama_barang'] ?>">
        </div><br>
        
        <div class="form-group">
          <label for="gambar_barang"> Gambar Barang </label><br><br>
          <div><?='<img width="100" height="100" src="img/'.$data_barang['gambar_barang'].'">'?></div><br>
          <label for="fileInput" class="custom-file-upload border"><b class="btn bg-primary">PILIH GAMBAR</b>&nbsp&nbsp&nbsp<i class="btn btn-success disabled"><?= $data_barang['gambar_barang'] ?></i> &nbsp&nbsp <b>-></b> </label>
          <input type="file" class="form-control" id="fileInput" name="gambar_barang">
          <span id="fileName"  class="btn btn-danger disabled"><i></i></span>  
        </div>

    <div class="form-group">
    <label for="kategori_barang"> Kategori Barang </label>

    <?php 
$query_kategori_barang = "SELECT id_kategori, nama_kategori FROM kategori_barang";
$kategori_barang = mysqli_query($koneksi, $query_kategori_barang);
echo "<select name='kategori_barang' class='form-control'>";
while($kategori = mysqli_fetch_array($kategori_barang)){
    $selected = "";
    if(isset($data_barang) && array_key_exists('id_kategori', $data_barang) && $kategori['id_kategori'] == $data_barang['id_kategori']){
        $selected = "selected";
    }
    echo "<option value='$kategori[id_kategori]' $selected>$kategori[nama_kategori]</option>";
}
echo "</select>";
?>

</div>

        <div class="form-group">
          <label for="catatan_barang"> Catatan Barang </label>
          <textarea class="form-control" id="catatan_barang" name="catatan_barang" rows="3"><?= $data_barang['catatan_barang'] ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary"> Update </button>
        <a href="index.php" class="btn btn-secondary"> Kembali </a>
      </form>

<script>
  var fileInput = document.getElementById("fileInput");
  var fileName = document.getElementById("fileName");
  fileInput.addEventListener("change", function(){
    var file = fileInput.files[0];
    fileName.innerHTML = file.name;
  });
</script>

    </div>

<?php

if(isset($_POST['submit'])){
  $kode_barang = $_POST['kode_barang'];
  $nama_barang = $_POST['nama_barang'];
  $kategori_barang = $_POST['kategori_barang'];
  $catatan_barang = $_POST['catatan_barang'];
  $id_barang = $_POST['id_barang'];


      // Upload gambar
      $gambar_barang = $_FILES["gambar_barang"]["name"];
      $file_tmp = $_FILES["gambar_barang"]["tmp_name"];
      $folder = "img/";
      move_uploaded_file($file_tmp, $folder.$gambar_barang);

  $query = "UPDATE index_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', gambar_barang='$gambar_barang', catatan_barang='$catatan_barang' WHERE id_barang='$id_barang'";
  
  $query2 = "UPDATE data_barang_kategori SET id_kategori='$kategori_barang' WHERE id_barang='$id_barang'";

  $result = mysqli_query($koneksi, $query);
  $result2 = mysqli_query($koneksi, $query2);

  if($result && $result2){
    echo "<script>
    alert ('DATA BERHASIL DI-EDIT!');
    document.location.href = 'index.php';
         </script>";
  }else{
    echo "Data gagal diupdate";
  }
}

?>
<?php require_once("footer.php"); ?>

