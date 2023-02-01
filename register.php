
<?php

require_once ('php/koneksi_auth.php');

function registrasi($data) {
    global $koneksi_auth;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi_auth, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi_auth, $data["password2"]);

    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi_auth, "SELECT `username` FROM `registrasi` WHERE `username` = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
         alert ('username sudah terdaftar!');
              </script>";
            
              return false;
    }

    //cek konfirmasi password
    if( $password !== $password2) {
        echo "<script>
        alert ('konfirmasi password tidak sesuai!');
              </script>";

            return false;  
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //var_dump($password); die;

    //insert data ke database
    mysqli_query($koneksi_auth, "INSERT INTO registrasi VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($koneksi_auth);


 }

if(isset($_POST["register"])) {

  if (registrasi($_POST) > 0 ) {

     echo "<script>
        alert ('user baru berhasil ditambahkan!');
           </script>";

           header("Location: index.php");
           exit;

  } else {

     echo mysqli_error($koneksi_auth);
  }

}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-warning">
 <div  style="padding-top:150px;">  
<div class="container col-6 col-md-3 border bg-info"> 
<br>
<div class="container text-white border bg-primary">    
<center><b><h1>Form Registrasi</h1></b></center>
</div><br>
  <form class="text-center bg-primary bg-gradient bg-opacity-75" method="post">
    <br>
  <div class="form-group">
    <label for="username"><input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="username" name="username" required></label>  
  </div><br>
  <div class="form-group">
    <label for="password"><input type="password" class="form-control" id="password" placeholder="Password" name="password"></label>   
  </div><br>
  <div class="form-group">
    <label for="password2"><input type="password" class="form-control" id="password2" placeholder="Confirm Password" name="password2"></label>
  </div><br>
  <button type="submit" class="btn btn-primary border" name="register">Submit</button>
  <br><br>
</form><br>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>