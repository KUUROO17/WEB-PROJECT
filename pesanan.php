<?php 
@include 'config.php';

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PESANAN</title>

    <!-- costum css file -->
    <link rel="stylesheet" href="css/adminstyle.css"  type="text/css">
    <link rel="stylesheet" href="css/products.css"  type="text/css">

    <!-- font awesome and icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include 'title.php'; ?>

</head>
<body>
    
<?php include 'header.php'; ?>

    <h1 class="heading">pesanan yang di terima</h1>

    <div class="container">

    <?php
    
        $select_order = mysqli_query($conn, "SELECT * FROM `order` ");
        if(mysqli_num_rows($select_order) > 0){
        while($fetch_order = mysqli_fetch_assoc($select_order)){
    ?>

    
<section class="table">
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Method</th>
                        <th>Alamat</th>
                        <th>Pesanan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                     $select_order = mysqli_query(
                         $conn,
                         'SELECT * FROM `order`'
                     );
                     if (mysqli_num_rows($select_order) > 0) {
                         while (
                             $row = mysqli_fetch_assoc($select_order)
                         ) { ?>

                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['number']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['method']; ?></td>
                        <td><?php echo $row['addres']; ?></td>
                        <td><?php echo $row['total_products']; ?><hr></td>
                        <td><?php echo $row['total_price']; ?></td>
                       
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

    <?php 

        };
    };

    ?>

    </div>

</div>

<!-- costum javascript link  -->
<script src="js/script.js" ></script>

</body>
</html>