
<?php


require_once("header.php");

include_once("php/koneksi.php");



$batas   = 2;
$halaman = @$_GET['halaman'];
    if(empty($halaman)){
        $posisi  = 0;
        $halaman = 1;
    }
    else{
        $posisi  = ($halaman-1) * $batas;
    }

$no = $posisi+1;

$query = "SELECT index_barang.*, kategori_barang.nama_kategori as kategori 
FROM index_barang 
JOIN data_barang_kategori ON index_barang.id_barang = data_barang_kategori.id_barang 
JOIN kategori_barang ON data_barang_kategori.id_kategori = kategori_barang.id_kategori limit $posisi,$batas";

$barang2 = mysqli_query($koneksi, $query);

?>

<div class="container text-center">
     
     <br>
    <h1> Daftar Barang </h1>
     <br>

<table class="table table-striped container border">
  <thead>
    <tr>
      <th scope="col"> <h3>#No </th>
      <th scope="col"> <h3>Kode </th>
      <th scope="col"> <h3>Nama </th>
      <th scope="col"> <h3>Gambar </th>
      <th scope="col"> <h3>Kategori </th>
      <th scope="col"> <h3>#Catatan </th>
      <th scope="col"> <h3>#Aksi</h3> </th>

    </tr>
  </thead>
  <tbody>
    
  <form action="" method="post" class="form-inline">
  <div class="form-group container  col-4"> 
    <button type="submit" class="btn btn-success" name="submit" style="position:relative; left:250px; top: 36.9px;">cari</button>
    <input type="text" class="form-control" name="search" placeholder="Search">  
  </div>
</form>
<br>

<a href="tambah.php" class="btn btn-primary" style="float:left;">Tambah Barang</a>
     <br>
     <br>

<?php

if(isset($_POST['submit'])){
  $search = mysqli_real_escape_string($koneksi, $_POST['search']);
  $query2 = "SELECT index_barang.*, kategori_barang.nama_kategori as kategori
  FROM index_barang
  JOIN data_barang_kategori ON index_barang.id_barang = data_barang_kategori.id_barang
  JOIN kategori_barang ON data_barang_kategori.id_kategori = kategori_barang.id_kategori
  WHERE
  nama_barang LIKE '%$search%' OR
  kode_barang LIKE '%$search%' OR
  nama_kategori LIKE '%$search%' OR
  catatan_barang LIKE '%$search%'
  ";
  $b=1;
  $barang3 = mysqli_query($koneksi, $query2); 
  $num_rows = mysqli_num_rows($barang3);

  if ($_POST['search'] === '') {
      
       header("Location:http://localhost/IDBC/ust.Pur/tugas1/JOIN/index.php?halaman=1");

  } else {
      while ( $barang =  mysqli_fetch_array($barang3) ){
          echo "<tr>"; 
          echo "<td>".$b++."</td>";
          echo "<td>".$barang['kode_barang']."</td>";
          echo "<td>".$barang['nama_barang']."</td>";
          echo "<td>".'<img width="100" height="100" src="img/'.$barang['gambar_barang'].'">'.'</td>';
          echo "<td><h4><b>".$barang['kategori']."</b></h4></td>";
          echo "<td><i>".$barang['catatan_barang']."</i></td>";
          echo "<td><a class='btn col-6 btn-warning' style='text-decoration:none;' href='update.php?id_barang=$barang[id_barang]'>Edit</a> <br><br> <a  class='btn col-6 btn-danger' style='text-decoration:none;' href='hapus.php?id_barang=$barang[id_barang]'>Hapus</a> </td></tr>";
      } 
  } 
}else{

    while ( $barang =  mysqli_fetch_array($barang2) ){

    echo "<tr>"; 
    echo "<td>".$no++."</td>";
    echo "<td>".$barang['kode_barang']."</td>";
    echo "<td>".$barang['nama_barang']."</td>";
    echo "<td>".'<img width="100" height="100" src="img/'.$barang['gambar_barang'].'">'.'</td>';
    echo "<td><h4><b>".$barang['kategori']."</h4></b></td>";
    echo "<td><i>".$barang['catatan_barang']."</i></td>";
    echo "<td><a class='btn col-6 btn-warning' style='text-decoration:none;' href='update.php?id_barang=$barang[id_barang]'>Edit</a> <br><br> <a class='btn col-6 btn-danger' style='text-decoration:none;' href='hapus.php?id_barang=$barang[id_barang]'>Hapus</a> </td></tr>";
    
  }
} 

  ?>

  </tbody>
</table>
<?php

$query3     = mysqli_query($koneksi, "SELECT index_barang.*, kategori_barang.nama_kategori as kategori 
FROM index_barang 
JOIN data_barang_kategori ON index_barang.id_barang = data_barang_kategori.id_barang 
JOIN kategori_barang ON data_barang_kategori.id_kategori = kategori_barang.id_kategori");
$jmldata    = mysqli_num_rows($query3);
$jmlhalaman = ceil($jmldata/$batas);
?>
<div class="text-center">
        <ul class="pagination">
            <?php
            for($i=1;$i<=$jmlhalaman;$i++) {
                if ($i != $halaman) {
                    echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i'>$i</a></li>";
                } else {
                    echo "<li class='page-item active'><a class='page-link' href='index.php'>$i</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<?php require_once("footer.php"); ?>