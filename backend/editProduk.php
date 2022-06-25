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
  $produk=mysqli_query($conn, "SELECT * FROM produk where produk_id= '".$_GET['id']."'");
  if(mysqli_num_rows($produk)==0){
    echo '<script>window.location="dataProduk.php"</script>';
  }
  $p=mysqli_fetch_object($produk);
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
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
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
        <h1 class="h2">Edit Produk</h1>

      </div>
      <div class="col-md-12">
      <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" id="" class="input-control" required>
                        <option value="">Pilih Kategori</option>
                        <?php
                        $kategori=mysqli_query($conn, "SELECT *FROM kategori ORDER BY kategori_id DESC" );
                        while($r=mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['kategori_id']?>" <?php echo ($r['kategori_id']==$p->kategori_id)? 'selected': ''; ?>><?php echo $r['kategori_nama']?></option>
                        <?php } ?>
                        
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk"  value="<?php echo $p->produk_nama ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->produk_harga ?>" required>
                    <img src="produk/<?php echo $p->produk_foto ?>" width="400px" alt="">
                    <input type="hidden" name="foto" value="<?php echo $p->produk_foto ?>">
                    <input type="file" name="gambar" class="input-control" >
                    
                    <textarea name="deskripsi" id="" cols="30" rows="10" class="input-control" placeholder="Deskripsi Cupang" value="<?php echo $p->produk_deskripsi ?>"></textarea> <br>
                    <select name="status" id="" class="input-control">
                        <option class="mt-2" value="">Pilih Status</option>
                        <option value="1" <?php echo ($p->produk_status==1)? 'selected': ''; ?> >Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>

                    <input type="submit" name="submit" value="Edit Produk" class="btn btn-primary text-form "  >
                    

                </form>
                <?php
                  if(isset($_POST['submit'])){

                   //menampung inputan dari form
                   $kategori=$_POST['kategori'];
                   $nama=$_POST['nama'];
                   $harga=$_POST['harga'];
                   $deskripsi=$_POST['deskripsi'];
                   $status=$_POST['status'];
                   $foto=$_POST['foto'];

                    //menampung inputan berupa file
                    $fileName=$_FILES['gambar']['name'];
                    $tmp_name=$_FILES['gambar']['tmp_name'];
                   

                    if($fileName!=''){
                        $type1=explode('.', $fileName);
                        $type2=$type1[1];
                        $newname='produk'.time().'.'.$type2;
                        $tipe_diizinkan=array('jpg','jpeg','png','gif');
                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert("Format file tidak diizinkan")</script>';
                        }else{
                            unlink('./produk/'. $foto);
                            move_uploaded_file($tmp_name,'./produk/'.$newname);
                            $namagambar=$newname;
                        }
                        

                    }else{
                        $namagambar=$foto;
                        
                    }
                    $update=mysqli_query($conn, "UPDATE produk SET
                                        kategori_id='".$kategori."',
                                        produk_nama='".$nama."',
                                        produk_harga='".$harga."',
                                        produk_deskripsi='".$deskripsi."',
                                        produk_foto='".$namagambar."',
                                        produk_status='".$status."'
                                        WHERE produk_id='".$p->produk_id."'");

                                        if($update){
                                            echo '<script>alert("Berhasil Ubah Produk")</script>';
                                            echo '<script>window.location="dataProduk.php"</script>';
                                        }else{
                                            echo 'gagal'.mysqli_error($conn);
                                        }
                  }
                
                ?>

               
      </div>
    </main>    
  </div>
</div>   
<script>
                        CKEDITOR.replace('deskripsi');
                </script>
<br><br><br>
  </body>
</html>
