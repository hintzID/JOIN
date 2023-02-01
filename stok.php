
<?php

include_once("php/koneksi.php");

require_once("header.php");



$query = "SELECT kategori_barang.nama_kategori, COALESCE(COUNT(index_barang.id_barang), 0) AS jumlah_barang, kategori_barang.catatan_kategori
FROM kategori_barang
LEFT JOIN data_barang_kategori ON kategori_barang.id_kategori = data_barang_kategori.id_kategori
LEFT JOIN index_barang ON data_barang_kategori.id_barang = index_barang.id_barang
GROUP BY kategori_barang.nama_kategori;
";

$barang2 = mysqli_query($koneksi,$query);

?>

<div class="container text-center">
     
     <br>
    <h1>Stok Per Kategori</h1>
     <br>


     <br>
     <br>

<table class="table table-striped container border">
  <thead>
    <tr>
      <th scope="col"> #No </th>
      <th scope="col"> Kategori <a href="insertKategori.php" class="btn btn-success bg-opacity-40 btn-sm"><b>+</b></a></th>
      <th scope="col"> Stok </th>
      <th scope="col"> #Catatan </th>
    </tr>
  </thead>
  <tbody>
 
  <?php    
  
  $i = 1 ; 
  while ( $barang =  mysqli_fetch_array($barang2) ){
    
    echo "<tr>"; 
    echo "<td>".$i++."</td>";
    echo "<td>".$barang['nama_kategori']."</td>";
    echo "<td>".$barang['jumlah_barang']."</td>";
    echo "<td>"."<i>".$barang['catatan_kategori']."</i>"."</td>";   
  } 
  ?>

  </tbody>
</table>
</div>

<? require_once("header.php");?>