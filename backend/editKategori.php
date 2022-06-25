<?php

ob_start();
session_start();
include 'db.php';
if($_SESSION['username'] != true){
    echo '<script>window.location="login.php"</script>';   
  }
  if ($_SESSION['hakakses'] != "admin") {
    die("<b>Oops!</b> Access Failed.
      <button type='button' onclick=location.href='./'>Back</button>");
  }
  $kategori=mysqli_query($conn, "SELECT * FROM kategori WHERE kategori_id = '".$_GET['id']."' ");
  if(mysqli_num_rows($kategori)==0){
    echo '<script>window.location="dataKategori.php"</script>';
  }
  $k=mysqli_fetch_object($kategori);
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Cupang Gati</title>

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
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Cupang Gati</a>
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
            <a class="nav-link active" aria-current="page" href="dasboard1.php">
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
            <a class="nav-link" href="profil.php">
              <span data-feather="layers"></span>
              Profil
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Data User
            </a>
          </li>
        </ul>

      </div>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kategori</h1>

      </div>
      <div class="col-md-12">
      <form action="" method="POST" >
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->kategori_nama ?>" required >
                    <input type="submit" name="submit" value="Tambah Kategori" class="btn btn-primary text-form "  >

                </form>
                <?php
                  if(isset($_POST['submit'])){
                    $nama=ucwords($_POST['nama']);

                    $update=mysqli_query($conn, "UPDATE kategori SET kategori_nama= '".$nama."' 
                                         WHERE kategori_id='".$k->kategori_id."' ");

                    if($update){
                        echo '<script>alert("Edit Kategori Berhasil")</script>';
                        echo '<script>window.location="dataKategori.php"</script>';

                    }else{
                        echo 'gagal'.mysqli_error($conn);
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
