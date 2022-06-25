<?php
include 'db.php';
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
if ($_SESSION['hakakses'] != "admin") {
	die("<b>Oops!</b> Access Failed.
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
$data1 = mysqli_query($conn, "SELECT admin_nama FROM admin");
$jumlah_data1 = mysqli_num_rows($data1);


$data2 = mysqli_query($conn, "SELECT produk_nama FROM produk");
$jumlah_data2 = mysqli_num_rows($data2);

$data3 = mysqli_query($conn, "SELECT produk_nama FROM produk");
$jumlah_data3 = mysqli_num_rows($data3);

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
    <link rel="stylesheet" href="style/dashboard.css">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Cupang Gati</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link " href="logout.php">Logout</a>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dasboard.php">
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
        <h1 class="h2">Dashboard</h1>

      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Produk</h5>
              <p class="card-text">Jumlah data produk adalah : <?php echo $jumlah_data2; ?> </p>
              <a href="dataProduk.php" class="btn btn-primary">Lihat Selengkapnya</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Kategori</h5>
              <p class="card-text">Jumlah data Kategori adalah : <?php echo $jumlah_data3; ?></p>
              <a href="dataKategori.php" class="btn btn-primary">Lihat Selengkapnya</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data User & Admin</h5>
              <p class="card-text">Jumlah data Usern & Admin adalah : <?php echo $jumlah_data1; ?></p>
              <a href="dataAdmin.php" class="btn btn-primary">Lihat Selengkapnya</a>
            </div>
          </div>
        </div><br><br>
        <h2 class="rwt" >Riwayat Produk Terbaru</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kategori</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Deskripsi</th>
              <th>Foto</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
                            include('db.php');

                            $batas = 5;
                            $halaman = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
                            $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                            $previous = $halaman - 1;
                            $next = $halaman + 1;
                            $data=mysqli_query($conn, "SELECT * FROM produk LEFT JOIN kategori USING(kategori_id) ");
                            $jumlah_data = mysqli_num_rows($data);
                            $total_halaman = ceil($jumlah_data / $batas);

    
                            $no=1;
                $produk=mysqli_query($conn, "SELECT * FROM produk LEFT JOIN kategori USING(kategori_id) ORDER BY produk_id ASC limit $halaman_awal, $batas");
                if(mysqli_num_rows($produk)>0){
                while($row=mysqli_fetch_array($produk)){
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++?></td>
                    <td class="text-center"><?php echo $row['kategori_nama'] ?></td>
                    <td class="text-center"><?php echo $row['produk_nama'] ?></td>
                    <td class="text-center">Rp. <?php echo number_format($row['produk_harga']) ?></td>
                    <td class="text-center"><?php echo $row['produk_deskripsi'] ?></td>
                    <td class="text-center"><a href="produk/<?php echo $row['produk_foto'] ?>" target="_blank"><img src="produk/<?php echo $row['produk_foto'] ?>" width="200px"></a></td>
                    <td class="text-center"><?php echo ($row['produk_status']==0)? 'Tidak Aktif':'Aktif'; ?></td>

                </tr>
                <?php
                }}
               ?>
          </tbody>
        </table>
      </div>
      </div>


    </main>

  </div>
</div>


   
  </body>
</html>
