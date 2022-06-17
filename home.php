<?php

@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:pertama.html');
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
 };
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- costum css file -->
    <link rel="stylesheet" href="css/adminstyle.css"  type="text/css">
    <link rel="stylesheet" href="css/products.css"  type="text/css">
    <!-- font awesome and icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php include 'title.php'; ?>

</head>
<body>
    

<?php
  if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
  }
  ?>


<?php include 'sidebar.php'; ?>

<section class="home-section">

<?php include 'headerproducts.php'; ?>

<?php include 'carausel.php'; ?>

</section>

<!-- costum javascript link  -->
<script src="js/script.js" ></script>

</body>
</html>