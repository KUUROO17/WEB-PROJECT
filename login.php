<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/login.css" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"crossorigin="anonymous" />

    <title>PAG FOODY</title>
    <link
      rel="icon"
      href="images/atas.png"
      type="image/gif/png"
      style="width: 10px;"
    />
  </head>
  <body>

  <?php
  if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
  }
  ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-5">
          <div class="banner-card">
            <img class="gambar" src="images/sekian.png" />
            <div class="banner-text">
              <h5>Welcome!!</h5>
              <h1><b>PAG FOODY</b></h1>
              <h6>PERTA ARUN GAS FOOD DELIVERY</h6>
            </div>
          </div>
          <img class="gamba" src="images/logo.png" />
        </div>
        <div class="col-7">
          <div class="" style="position: absolute; top: 100px; left: 590px;">
                <div style="margin-left: 23px; margin-top: 17px;">
                  <h3 ><b>LOGIN</b></h3>
                  <h6>Please Sign in to continue</h6>
                </div>
                <div class="p-4">
                  <form action=""
                  method="post">
                    <div class="input-group mb-3" >
                      <span class="input-group-text bg-success" >
                        <i class="bi bi-envelope text-white"></i>
                      </span>
                      <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        required
                      />
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text bg-success">
                        <i class="bi bi-key-fill text-white"></i>
                      </span>
                      <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="password"
                        required
                      />
                    </div>
                    <div class="form-check mb-3"  >
                      <label class="form-check-label"> <input class="form-check-input"  type="checkbox"  value="" required/> I agree all statements in <a href="#" class="link-danger" >Terms of service </a></label>
                      <label class="form-check-label" for="invalidCheck"  >
                    </div>
                    <br />
                    <div class="d-grid col-12 mx-auto">
                    <input class="btn btn-success" type="submit" name="submit" style="border-radius: 50px;">
                        <span></span>
                      
                      </button>
                    </div>
                    <br />
                    <h6 class="text-center mt-3">
                      Belum punya akun ? silahkan
                      <a href="#">Daftar</a>
                    </h6>
                    <h6 class="text-center">------------ atau ------------</h6>
                    <div style="text-align: center;">
                      <a
                        href="#"
                        class="bi bi-google"
                        style="font-size: 2rem; color: rgb(168, 13, 13);"
                      ></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a
                        href="#"
                        class="bi bi-facebook"
                        style="font-size: 2rem; color: cornflowerblue;"
                      ></a>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script bsrc="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" ></script>

   
  </body>
</html>
