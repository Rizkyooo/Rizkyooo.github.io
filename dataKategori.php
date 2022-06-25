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
            <a class="nav-link" href="dasboard.php">
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
            <a class="nav-link active" aria-current="page" href="dataKategori.php">
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

    <!-- konten -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Kategori</h1>
      </div>
      <p><a class="btn btn-primary" href="tambahKategori.php">Tambah Data</a></p>
      <div class="col-md-12">
        <table class="table table-striped table-bordered table-sm" cellspacing="0";>
            <thead>
                <tr>
                    <th class="text-center"  width="60px">No</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center" width="160px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                $kategori=mysqli_query($conn, "SELECT * FROM kategori ORDER BY kategori_id DESC");
                if(mysqli_num_rows($kategori)>0){

                
                while($row=mysqli_fetch_array($kategori)){
                ?>
                <tr>
                    <td class="text-center"><?php echo $no++?></td>
                    <td class="text-center"><?php echo $row['kategori_nama'] ?></td>
                    <td class="text-center"><a class="btn btn-primary btn-sm" href="editKategori.php?id=<?php echo $row['kategori_id']?>">Edit</a>  <a class="btn btn-danger2 btn-sm" href="hapus.php?idk=<?php echo $row['kategori_id']?>" onclick="return confirm('Apakah anda Yakin?')" >Hapus</a></td>

                </tr>
                <?php
                }} else{ ?> 
                <tr><td colspan="3">tidak ada data</td></tr>
                <?php }
                ?>
                

                
            </tbody>
        </table>
      
      </div>
    </main>    
    <!-- konten akhir -->
  </div>
</div>


   
  </body>
</html>
