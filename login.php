<?php


require_once ('php/koneksi_auth.php');

function login($data) {
    global $koneksi_auth;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($koneksi_auth, $data["password"]);

    // cek username ada di database atau tidak
    $result = mysqli_query($koneksi_auth, "SELECT * FROM `registrasi` WHERE `username` = '$username'");

    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["username"] = $row["username"];
            return true;
        }
    }

    return false;
}

if(isset($_POST["login"])) {

    if (login($_POST)) {
      echo "<script>
      alert ('SELAMAT DATANG');
      document.location.href = 'index.php';
           </script>";
    } else {
        echo "<script>
            alert ('username atau password salah!');
              </script>";
             
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
<center><b><h1>Form Login</h1></b></center>
</div><br>
  <form class="text-center bg-primary bg-gradient bg-opacity-75" method="post">
    <br>
  <div class="form-group">
    <label for="username"><input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="username" name="username"></label>  
  </div><br>
  <div class="form-group">
    <label for="password"><input type="password" class="form-control" id="password" placeholder="Password" name="password"></label>   
  </div><br>
  <button type="submit" class="btn btn-primary border" name="login">Submit</button>
  <br><br>
<div style="margin-top:30px; position:relative; bottom:25px;" class="">
  <center class="btn btn-danger disabled">Belum punya akun? <a class="btn btn-primary" href="">DAFTAR LEWAT ADMIN!!!</a></center>
</div>
</form><br>
</div>
</body>
</html>