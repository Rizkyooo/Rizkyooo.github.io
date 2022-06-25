<?php
session_start();
include 'db.php';
if($_SESSION['status_login'] != true){
    echo '<script>window.location="login.php"</script>';   
  }
  $query=mysqli_query($conn, "SELECT * FROM admin where admin_id= '".$_SESSION['id']."'");
$d=mysqli_fetch_object($query);
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Cupangers</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      .rwt{
        padding-top: 30px;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/dashboard.css">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Ikan Cupang</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " href="dasboard.php">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dataProduk.php">
              <span data-feather="file"></span>
              Data Produk
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dataKategori.php">
              <span data-feather="layers"></span>
              Kategori Produk
            </a>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profil.php">
              <span data-feather="layers"></span>
              Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dataAdmin.php">
              <span data-feather="users"></span>
              Data User
            </a>
          </li>
        </ul>

      </div>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>

      </div>
      <div class="col-md-12">
      <form action="" method="POST" >
                    <input type="text" name="nama" placeholder="Nama lengkap" class="input-control" value="<?php echo $d->admin_nama?>" required >
                    <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username?>" required >
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp?>" required >
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email?>" required >
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_alamat?>" required >
                    <input type="submit" name="submit" value="Ubah Profil" class="btn btn-primary text-form "  >  
                </form>
                <?php
                if(isset($_POST['submit'])){
                    $nama= ucwords($_POST['nama']) ;
                    $user=$_POST['user'];
                    $hp=$_POST['hp'];
                    $email=$_POST['email'];
                    $alamat=ucwords($_POST['alamat']);

                    $update=mysqli_query($conn, "UPDATE admin SET 
                                        admin_nama='".$nama."',
                                        username='".$user."',
                                        admin_telp='".$hp."',
                                        admin_email='".$email."',
                                        admin_alamat='".$alamat."'
                                        WHERE admin_id='".$d->admin_id."' ");
                    if($update){
                        echo'<script>alert("ubah data berhasil")</script>';
                        echo'<script>window.location="profil.php"</script>';
                    }else{
                        echo'gagal' .mysqli_error($conn);
                    }
                }
                ?>

                <form class="mt-5" action="" method="POST" >
                    <input type="password" name="pass1" placeholder="Password baru" class="input-control"  required >
                    <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" required >
                    <input type="submit" name="ubahPw" value="Ubah Password" class="btn btn-primary text-form "  >  
                </form>
                <?php
                if(isset($_POST['ubahPw'])){
                    $pass1=$_POST['pass1'];
                    $pass2=$_POST['pass2'];
                    if($pass2!=$pass1){
                        echo '<script>alert("password tidak sesuai")</script>';
                    }else{
                        $updatePass=mysqli_query($conn, "UPDATE admin SET 
                                        password='".MD5($pass1)."'
                                        WHERE admin_id='".$d->admin_id."' ");
                        if(updatePass){
                            echo'berhasil';
                            echo'<script>window.location="profil.php"</script>';

                        }else{
                            echo'gagal' .mysqli_error($conn);

                        }
                        
                    }

                }

                ?>
      </div>
    </main>    
  </div>
</div>   
<br><br><br>
  </body>
</html>
