<?php

@include 'config.php';

// coding untuk tambah product
if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_toko = $_POST['p_toko'];
    $p_rate = $_POST['p_rate'];
    $p_jarak = $_POST['p_jarak'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;

    ($insert_query = mysqli_query(
        $conn,
        "INSERT INTO `products`(name, price, toko, rate, jarak, image) VALUES('$p_name', '$p_price', '$p_toko', '$p_rate', '$p_jarak', '$p_image')"
    )) or die('query failed');

    if ($insert_query) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'product add succesfully';
    } else {
        $message[] = 'could not add the product';
    }
};

// coding untuk delete product
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die
    ('query failed');
    if($delete_query){
        // header('location:admin.php');
        $message[] = 'product has been deleted';
    }else{
        // header('location:admin.php');
        $message[] = 'product could not be delete';
    };
};

//update product
if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_toko = $_POST['update_p_toko'];
    $update_p_rate = $_POST['update_p_rate'];
    $update_p_jarak = $_POST['update_p_jarak'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/'.$update_p_image;
 
    $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', toko = '$update_p_toko', rate = '$update_p_rate', jarak = '$update_p_jarak', image = '$update_p_image' WHERE id = '$update_p_id'");
 
    if($update_query){
       move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
       $message[] = 'product updated succesfully';
       header('location:admin.php');
    }else{
       $message[] = 'product could not be updated';
       header('location:admin.php');
    }
 
 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- costum css file -->
    <link rel="stylesheet" href="css/adminstyle.css"  type="text/css">

    <!-- font awesome and icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<?php include 'header.php'; ?>
<div class="container">

<section>
     <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
         <h3> tambah product </h3>
         <input type="text" name="p_name" placeholder="enter product name" class="box" required>
         <input type="number" name="p_price" min="0" placeholder="enter product price" class="box" required>
         <input type="text" name="p_toko" placeholder="enter product shope" class="box" required>
         <input type="text" name="p_rate" placeholder="enter product rate" class="box" required>
         <input type="text" name="p_jarak" placeholder="enter product distance" class="box" required>
         <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
         <input type="submit" value="add the product" name="add_product" class="btn">
        </form>
</section>


<section class="table">
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>products</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>shope</th>
                        <th>rate</th>
                        <th>jarak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                     $select_products = mysqli_query(
                         $conn,
                         'SELECT * FROM `products`'
                     );
                     if (mysqli_num_rows($select_products) > 0) {
                         while (
                             $row = mysqli_fetch_assoc($select_products)
                         ) { ?>


                    <tr>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" /></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>Rp.<?php echo $row['price']; ?>/-</td>
                        <td><i class="fa-solid fa-store"></i> <?php echo $row['toko']; ?></td>
                        <td><i class="fa-solid fa-star"></i></i> <?php echo $row['rate']; ?></td>
                        <td><i class="fa-regular fa-clock"></i> <?php echo $row['jarak']; ?>min</td>
                        <td> <button><a href="admin.php?edit=<?php echo $row['id']; ?>"> <i class="fas fa-edit"></i></a></button> <button><a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i></a></i></button> </td>
                    </tr>


                    <?php }
                     } else {
                         echo "<div class='empty'>no product added </div>";
                     };
                     ?>
                </tbody>
            </table>
        </div>
    </section>



<section class="edit-form-container">
    <?php
    
    if(isset($_GET['edit']));{
       $edit_id = $_GET['edit'];
       $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
       if(mysqli_num_rows($edit_query) > 0){
           while($fetch_edit = mysqli_fetch_assoc($edit_query)){

           
    ?>

        <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
            <input type="number" class="box" min="0" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
            
            <input type="text" class="box" required name="update_p_toko" value="<?php echo $fetch_edit['toko']; ?>">
            <input type="text" class="box" required name="update_p_rate" value="<?php echo $fetch_edit['rate']; ?>">
            <input type="text" class="box" required name="update_p_jarak" value="<?php echo $fetch_edit['jarak']; ?>"> 


            <input type="file" class="box"  required name="update_p_image" accept="image/png, image/jpg, image/jpeg">

            <input type="submit" value="update the prodcut" name="update_product" class="btn">
            <input type="reset" value="cancel" id="close-edit" class="option-btn">
            </form>

    <?php

           };
        };
        echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";

    };
    
    ?>
</section>

</div>



<!-- costum javascript link  -->
<script src="js/script.js" ></script>

</body>
</html>