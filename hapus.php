<?php
include 'db.php';

if(isset($_GET['idk'])){
    $delete=mysqli_query($conn, "DELETE FROM kategori WHERE kategori_id= '".$_GET['idk']."' ");
    echo '<script>window.location="dataKategori.php"</script>';
}
if(isset($_GET['idp'])){
    $produk=mysqli_query($conn, "SELECT produk_foto FROM produk WHERE produk_id='".$_GET['idp']."' ");
    $p=mysqli_fetch_object($produk);
    unlink('./produk/' .$p->produk_foto); 
    $delete=mysqli_query($conn, "DELETE FROM produk WHERE produk_id= '".$_GET['idp']."' ");
    echo '<script>window.location="dataProduk.php"</script>';
}
if(isset($_GET['ida'])){
    $delete=mysqli_query($conn, "DELETE FROM admin WHERE admin_id= '".$_GET['ida']."' ");
    echo '<script>window.location="dataAdmin.php"</script>';
}
?>