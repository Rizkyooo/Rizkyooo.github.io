<?php
include 'db.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/register.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
      <img src="../project/logins.png" class="foto" alt="">
        <form class="form-container"  method="POST" >
            <h5 class="judul">Daftar</h5>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">Nama</label>
              <input type="text" class="form-control ph" name="nama" placeholder="Masukkan Nama">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">Username</label>
              <input type="text" class="form-control ph" name="user" placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">No Telpon</label>
              <input type="text" class="form-control ph" name="hp" placeholder="Masukkan No HP">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">Email</label>
              <input type="text" class="form-control ph" name="email" placeholder="Masukkan Email">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">Alamat</label>
              <input type="text" class="form-control ph" name="alamat" placeholder="Masukkan Alamat">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label text-form">Password</label>
              <input type="password" class="form-control ph" name="pass" placeholder="Gunakan password yang kuat">
            </div>
            <div class="d-grid">
            <button type="submit" name="submit" value="Daftar" class="btn btn-primary text-form mt-3">Daftar</button>
            </div>
            <div>
               <span class="text-form"> Sudah punya akun? </span><a href="login.php" class="text-form">Masuk</a>
            </div>
          </form>
          <?php
                  if(isset($_POST['submit'])){
                    $nama=ucwords($_POST['nama']);
                    $user=ucwords($_POST['user']);
                    $hp=$_POST['hp'];
                    $email=$_POST['email'];
                    $alamat=$_POST['alamat'];
                    $pass=$_POST['pass'];
                    $hakakases = $_POST["hakakses"];
                    $insert=mysqli_query($conn,"INSERT INTO admin VALUES(
                                            null,
                                            '".$nama."',
                                            '".$user."',
                                            '".$pass."',
                                            '".$hp."',
                                            '".$email."',
                                            '".$alamat."',
                                            '".pelanggan."'

                        )");

                    if($insert){
                        echo '<script>alert("Berhasil buat akun")</script>';
                        echo '<script>window.location="index.php"</script>';

                    }else{
                        echo 'gagal'.mysqli_error($conn);
                    }

                  }
                
                ?>
    </div>
    
</body>
</html>