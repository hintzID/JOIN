
<?php require_once("header.php"); ?>

<center style="font-size:50px;"><b>Tambah Barang</b></center>

<div class="container col-6">
<form action="insert.php" method="post" enctype="multipart/form-data">
  <label for="kode_barang" class="form-label">Kode Barang:</label>
  <input type="text" id="kode_barang" name="kode_barang" class="form-control"><br>
  <label for="nama_barang">Nama Barang:</label>
  <input type="text" id="nama_barang" name="nama_barang" class="form-control"><br>
  <label for="gambar_barang">Gambar Barang:</label>
  <input type="file" id="gambar_barang" name="gambar_barang" class="form-control"><br>
  <label for="catatan_barang">Catatan Barang:</label>
  <textarea id="catatan_barang" name="catatan_barang" class="form-control"></textarea><br>
  <label for="id_kategori">Kategori:</label>
  <select id="id_kategori" name="id_kategori" class="form-control">
    <?php
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "tugas1");
    // Fetch the list of categories from the kategori_barang table
    $result = mysqli_query($conn, "SELECT id_kategori, nama_kategori FROM kategori_barang");
    while ($row = mysqli_fetch_array($result)) {
      echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
    }
    ?>
  </select><br>
  <input type="submit" value="Submit" name="submit">
</form>
  </div>

<?php require_once("footer.php"); ?>