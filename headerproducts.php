<?php

@include 'config.php';

if(isset($_POST['search'])){
  $searchq = $_POST['search'];
  $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
  $output = '';

  $query = mysqli_query("SELECT * FROM products WHERE name LIKE '%$searchq%' ") or die ("could not search");
  $count = mysql_num_rows($query);
  if($count == 0){
    $output = 'there was no search results!';
  }else{
    while ($row = mysql_fetch_array($query)){
          $fname = $row['name'];
          $id = $row['id'];

          $output .= '<div>'.$fname.'</div>';
    }
  }

}
?>


<header class="header1">
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <div class="box1">
              <div class="search-box">
                <form action="" method="post">
                <input type="text" name="search" placeholder="Type here" autocomplete="off"/>
                <label for="check" class="icon">
                  <button type="submit" ><i class="fas fa-search"></i>
</button>
                  </label>
                </form>
              </div>
            </div>

            <?php
            
            $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id' ") or die ('query failed') ;
            $row_count = mysqli_num_rows($select_rows);

            ?>

            <a href="cart.php" class="cart">  <i class="bx bxs-shopping-bag"></i> <span><?php echo $row_count; ?></span> </a>


          
          </div>
        </nav>
      </header>