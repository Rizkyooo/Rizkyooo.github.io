<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="../project/style/login.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
      <img src="../project/logins.png" class="foto" alt="">
        <form class="form-container"  method="POST" >
            <h5 class="judul">Masuk</h5>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-labe text-form">Username</label>
              <input type="text" class="form-control ph" name="user" placeholder="Masukkan Username">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label text-form">Password</label>
              <input type="password" class="form-control ph" name="pass" placeholder="Gunakan password yang kuat">
            </div>
            
            <div class="d-grid">
            <button type="submit" name="submit" value="Login" class="btn btn-primary text-form mt-2">Masuk</button>
            </div>
            <div>
               <span class="text-form"> Belum punya akun? </span><a href="register.php" class="text-form">Daftar</a>
            </div>
          </form>
          <?php
            if(isset($_POST['submit'])){
              session_start();
              include 'db.php';

              $user= mysqli_real_escape_string($conn, $_POST['user']);
              $pass=mysqli_real_escape_string($conn, $_POST['pass']);
              $cek= mysqli_query($conn,"SELECT*FROM admin Where username = '".$user."' AND password = '".($pass)."'");
              if(mysqli_num_rows($cek) >0){
                $d=mysqli_fetch_object($cek);
                $_SESSION['status_login']=true;
                $_SESSION['a_global']=$d;
                $_SESSION['id']=$d->admin_id;
                if($d->hakakses=="admin"){
 

                  $_SESSION['username'] = $user;
                  $_SESSION['hakakses'] = "admin";
              
                  header("location:dasboard.php");
               
              
                }else if($d->hakakses=="pelanggan"){
              
                  $_SESSION['username'] = $user;
                  $_SESSION['hakakses'] = "pelanggan";
              
                  header("location:userHomepage.php");
               
               
                }else{
               
                }	
                echo '<script>window.location.href="dasboard.php"</script>';
              }else{
                echo '<script>alert("username atau password salah!")</script>' ;
              }
            }
            ?>
    </div>
    
</body>
</html>