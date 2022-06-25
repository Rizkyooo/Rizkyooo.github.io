<?php
ob_start();
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
if ($_SESSION['hakakses'] != "pelanggan") {
	die("<b>Oops!</b> Access Failed.
		<button type='button' onclick=location.href='./'>Back</button>");
}
error_reporting(0);
include 'db.php';


$produk =mysqli_query($conn, "SELECT * FROM produk WHERE produk_id='".$_GET['id']."' " );
$p=mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupang Gati</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style/singleProduk.css">
</head>
<body>
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="js/loadMore.js"></script>
    <!-- awal navbar -->
    <nav style="background-color:rgb(8, 84, 151)" class="navbar navbar-expand-lg navbar-dark ">
        <div  class="container">
            <a class="navbar-brand" href="#">
                <img src="../project/logo.png" alt="" width="100" height="90" class="d-inline-block me-2" >
                Cupang <strong>Gati</strong>
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <!-- awal tombol pencarian -->
              <form class="d-flex ms-auto my-4 my-lg-0" action="produk.php">
                <input class="form-control me-2" type="search" name="search" placeholder="Cari Cupang disini..." aria-label="Cari" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <button class="btn btn-outline-primary btn-light" type="submit" value="cari produk">Search</button>
            </form>
             <!-- akhir tombol pencarian -->
             <!-- awal fitur -->
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" aria-current="page" href="#">Beranda</a>
              <a class="nav-link" href="#">Tentang</a>
              <a href="logout.php" class="nav-link"><button class="btn btn-primary" >Logout</button></a>
            </div>
            <!-- akhir fitur -->
          </div>
        </div>
      </nav>
      <!-- akhir navbar -->


    <!-- awal produk -->
    <div class="container mt-4">
        <div class="row row-produk">
            <div class="col-lg-5 image">
                <figure class="figure">
                    <img src="produk/<?php echo $p->produk_foto ?>" class="figure-img img-fluid rounded">
                  </figure>
            </div>
            <div class="col-lg-7"><h4><?php echo $p->produk_nama ?></h4>
                <div class="garis-nama"></div>
                <h3 class="harga">Rp. <?php echo number_format($p->produk_harga)  ?></h3>
                <p class="card-text mt-2" style="font-size:17px;"><h6>Deskripsi: </h6><?php echo $p->produk_deskripsi ?></p>
                <p class="card-text" style="font-size:17px;">Tersedia <i class="fa-solid fa-check"></i></p>
                <div class="btn-produk pesanWA">
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=+6287837842701>&text=Hai, saya ingin beli cupang" class="btn btn-success text-white col-lg-12 mt-3">Pesan Sekarang<img src="../project/foto/sosmed/wa.png" alt="" style="width:20px ;" class="ms-2 "></a>
                </div>
                <div class="btn-produk kembali">
                    <a  href="userHomepage.php" class="btn btn-secondary text-white col-lg-12 mt-2">Kembali</a>
                </div>
            </div>
            
        </div>
        
    </div>

    <!-- akhir produk -->
      <!-- awal footer -->
      <footer class=" bg-dark p-5 mt-5">
        <div class="container">
          <div class="row mt-2">
            <div class="col md-6 text-md-start text-center pt-2 pb-2">
              <a href="#"><img src="../project/logo.png" alt="" style="width:60px ;"></a>
              <span class="ps-1" style="color: white;">Copyright @2022 | Created with <i class="fa-solid fa-heart  text-danger"></i> by Anak Halal</span>
            </div>
            <div class="col md-6 text-md-end text-center pt-2 pb-2">
              <a href="#"><img src="../project/foto/sosmed/facebook.png" alt="" style="width:30px ;" class="ms-2 icon-sosmed"></a>
              <a href="#"><img src="../project/foto/sosmed/instagram.png" alt="" style="width:30px ;" class="ms-2 icon-sosmed"></a>
              <a href="#"><img src="../project/foto/sosmed/wa.png" alt="" style="width:30px ;" class="ms-2 icon-sosmed"></a>
            </div>
          </div>
        </div>
      </footer>
      <!-- akhir footer -->
</body>
</html>
