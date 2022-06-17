<?php 
@include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];


if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = 1;

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');


  if(mysqli_num_rows($select_cart) > 0){
    $message[] ='product already added to cart';
  }else{
    // $insert_product = mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', ' $product_price', '$product_image', '$product_quantity')");
    // $message[] ='product added to cart succesfully!!';

    $insert_product =mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
    $message[] = 'product added to cart!';

  }
}



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
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' .
                $message .
                '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    }; 
?>

<?php include 'sidebar.php'; ?>

<section class="home-section">

<?php include 'headerproducts.php'; ?>

<div class="container">
    <section class="products">
        
    <div class="box-container">

    <?php
    
        $select_products = mysqli_query($conn, "SELECT * FROM `products`");
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
    ?>


        <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <p>Rp<?php echo $fetch_product['price']; ?>/-</p>
            <p class="makan"><i class='bx bx-restaurant'></i><?php echo $fetch_product['toko']; ?></p>
            <span class="row">
                <span class="col-sm-6">
                <p class="rate"><i class='bx bxs-star' id="bintang"></i><b><?php echo $fetch_product['rate']; ?></b>(77)</p>
                </span>
                <span class="col-sm-6">
                    <p class="jalan"><i class='bx bxs-car'></i><?php echo $fetch_product['jarak']; ?></p>
                </span>
            </span>            
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_toko" value="<?php echo $fetch_product['toko']; ?>">
            <input type="hidden" name="product_rate" value="<?php echo $fetch_product['rate']; ?>">
            <input type="hidden" name="product_jarak" value="<?php echo $fetch_product['jarak']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            
            <div class="input-icons">
            <i class="fa-solid fa-cart-shopping"></i>
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
        </div>

         </div>
        </form>


        <?php
            };
        };
        
        ?>
    </div>
    
    </section>

</div>
</section>

<!-- costum javascript link  -->
<script src="js/script.js" ></script>

</body>
</html>