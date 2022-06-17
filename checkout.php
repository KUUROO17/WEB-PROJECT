<?php
@include 'config.php'; 

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['order_btn'])){

 
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $addres = $_POST['addres'];
  
 
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart`  WHERE user_id = '$user_id'");
    $price_total = 0;
    if(mysqli_num_rows($cart_query) > 0){
       while($product_item = mysqli_fetch_assoc($cart_query)){
          $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
          $product_price = number_format($product_item['price'] * $product_item['quantity']);
          $price_total += ((int)$product_item['price'] * (int)$product_item['quantity']);

       };
    };
 
    $total_product = implode(', ',$product_name);
    $detail_query = mysqli_query($conn, "INSERT INTO `order` (name, number, email, method, addres, total_products, total_price) VALUES('$name','$number','$email','$method','$addres','$total_product','$price_total')") or die('query failed');
 
    if($cart_query && $detail_query){
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
           <h3>thank you for shopping!</h3>
           <div class='order-detail'>
              <span>".$total_product."</span>
              <span class='total'> total : Rp".$price_total."/-  </span>
           </div>
           <div class='customer-details'>
              <p> your name : <span>".$name."</span> </p>
              <p> your number : <span>".$number."</span> </p>
              <p> your email : <span>".$email."</span> </p>
              <p> your address : <span>".$addres."</span> </p>
              <p> your payment mode : <span>".$method."</span> </p>
              <p>(*pay when product arrives*)</p>
           </div>
              <a href='products.php' class='btn'>continue shopping</a>
           </div>
        </div>
        ";
     }
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

        <!-- costum css file -->
        <link rel="stylesheet" href="css/adminstyle.css"  type="text/css">
        <link rel="stylesheet" href="css/products.css"  type="text/css">
        <link rel="stylesheet" href="css/checkout.css"  type="text/css">



<!-- font awesome and icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php include 'title.php'; ?>

</head>
<body>
   
<?php include 'sidebar.php'; ?>

<section class="home-section">

<?php include 'headerproducts.php'; ?>

<div class="container">

<section class="checkout-form">

  <h1 class="heading">complete your order </h1>

  <form action="" method="post">

  <div class="display-order">
    <?php 
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE  user_id = '$user_id'");
    $total = 0;
    $grand_total = 0; 
    if(mysqli_num_rows($select_cart) > 0){
        while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
        $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
        $grand_total += ((int)$fetch_cart['price'] * (int)$fetch_cart['quantity']);
    ?>
    <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
    <?php 
            }
            }else{
                echo "<div class='display-order'><span>your cart is empty!!!</span></div>";
        }
    ?>
    <span class="grand-total"> total belanjaan :  Rp.<?= $grand_total; ?>-/</span>
    </div>

<div class="flex">
    <div class="inputBox">
        <span>your name</span>
        <input type="text" placeholder="enter your name" name="name" required>
    </div>
    <div class="inputBox">
        <span>your number</span>
        <input type="number" placeholder="enter your number" name="number" required>
    </div>
    <div class="inputBox">
        <span>your email</span>
        <input type="email" placeholder="enter your email" name="email" required>
    </div>
    <div class="inputBox">
        <span>payment method</span>
        <select name="method">
            <option value="cash on delivery" selected>cash on delivery</option>
            <option value="credit cart">credit cart</option>
            <option value="paypal">paypal</option>
        </select>
    </div>
    <div class="inputBox">
        <span>addres line 3</span>
        <input type="text" placeholder="e.g. flat no." name="addres" required>
    </div>

</div>

<input type="submit" value="order now" name="order_btn" class="btn">
</form>

</section>
</div>


</section>

<!-- costum javascript link  -->
<script src="js/script.js" ></script>

</body>
</html>