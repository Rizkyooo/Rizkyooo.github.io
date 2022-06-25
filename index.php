<?php
include 'db.php';
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
    <link rel="stylesheet" href="style/home.css">
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
                <input class="form-control me-2" type="search" name="search" placeholder="Cari Cupang disini..." aria-label="Cari">
                <button class="btn btn-outline-primary btn-light" type="submit" value="cari produk">Search</button>
            </form>
             <!-- akhir tombol pencarian -->
             <!-- awal fitur -->
            <div class="navbar-nav ms-auto">
              <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
              <a class="nav-link" href="#">Tentang</a>
              <a href="login.php" class="nav-link"><button class="btn btn-primary btn-sm" >Login</button></a>
            </div>
            <!-- akhir fitur -->
          </div>
        </div>
      </nav>
      <!-- akhir navbar -->

      <!-- awal carousel -->
      <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide mt-3 shadow-sm " data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded-2">
          <div class="carousel-item active">
            <img src="foto/cupang2f.jpg" class="d-block img-fluid" alt="...">
          </div>
          <div class="carousel-item">
            <img src="foto/cupang1f.jpg" class="d-block  img-fluid" alt="...">
          </div>
          <div class="carousel-item">
            <img src="foto/cupang4f.jpg" class="d-block  img-fluid" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
      <!-- akhir carousel -->

      <!-- awal kategori -->
      <div class="container mt-3 ">
        <div class="judul-kategori rounded-2 shadow-sm" style="background-color:#fff; padding: 5px 10px; text-align: center;" >
          <h5 style="margin-top:5px ;">KATEGORI</h5>
        </div >
          <div class="row text-center row-container shadow-sm mt-2 rounded-2">
                <?php
                $kategori=mysqli_query($conn, "SELECT * FROM kategori  ORDER BY kategori_id DESC");
                if(mysqli_num_rows($kategori)>0){
                    while($k=mysqli_fetch_array($kategori)){
                ?>   
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 shadow-sm ">
                  <div class="menu-kategori ">
                      <a href="produk.php?kat=<?php echo $k['kategori_id'] ?>"><img src="foto/kategori/redvampire.png" class="img-kategori mt-3"></a>
                      <p class="mt-2"><?php echo $k['kategori_nama'] ?></p>
                  </div>   
                  </div> 
                 
                  <?php }}else{ ?>
                    <p>kategori Tidak ada</p>
                    <?php } ?>  
            </div> 
        </div>
      </div>
      <!-- akhir kategori -->
      <!-- awal produk -->
      <div class="container mt-4">
        <div class="judul-produk rounded-2 shadow-sm" style="background-color:#fff; padding: 5px 10px; text-align: center;" >
          <h5 style="margin-top:5px ;">CUPANG TERBARU</h5>
        </div>
        <div class="row content-wrap">
        <?php 
        
        $produk=mysqli_query($conn, "SELECT * FROM produk   ORDER BY produk_id DESC LIMIT 8");
        if(mysqli_num_rows($produk)>0){
            while($p=mysqli_fetch_array($produk)){
        ?>
       
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-2 content">
            <div class="card text-center">
              <img src="produk/<?php echo $p['produk_foto'] ?>" class="card-img-top">
              <div class="card-body">
                <h6 class="card-title nama"> <?php echo substr($p['produk_nama'], 0,30)  ?></h6>
                <p class="card-text harga" ><strong>Rp. <?php echo number_format($p['produk_harga']) ?></strong></p>
                <p class="card-text" style="font-size:14px;">Tersedia <i class="fa-solid fa-check"></i></p>
                <a href="produkDetail.php?id=<?php echo $p['produk_id'] ?>" class="btn btn-primary  d-grid">Beli</a>
              </div>
            </div>
          </div>
          
          <?php }}else{?>
          <p>tidak ada produk</p>
          <?php } ?>
          </div>
        
      </div>
      <br><br><br><br><br><br><br><br><b>
      </b>
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
