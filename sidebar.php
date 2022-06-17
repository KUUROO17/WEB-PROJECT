<?php

@include 'config.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
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

    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <!-- bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="css/sidebar.css"  type="text/css">
 

    <?php
    if(isset($message)){
      foreach( (array) $message as $message){
          echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
      }
    }
    ?>

    <div class="sidebar">
      <div class="logo-details">
        <i class="bx bxs-bowl-hot icon"></i>
        <div class="logo_name">PAG FOODY</div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <ul class="nav-list">
        <li>
          <a href="home.php">
            <i class="bx bx-home"></i>
            <span class="links_name">HOME</span>
          </a>
          <span class="tooltips">HOME</span>
        </li>
        <li>
          <a href="products.php">
            <i class="bx bxs-category-alt"></i>
            <span class="links_name">Explore</span>
          </a>
          <span class="tooltips">Explore</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bxs-heart"></i>
            <span class="links_name">Favorite</span>
          </a>
          <span class="tooltips">Favorite</span>
        </li>
        <li>
          <a href="cart.php">
            <i class="bx bxs-store-alt"></i>
            <span class="links_name">Order</span>
          </a>
          <span class="tooltips">Order</span>
        </li>
        <li>
          <a href="checkout.php">
          <i class="fa-solid fa-sack-dollar"></i>
          <span class="links_name">Checkout</span>
          </a>
          <span class="tooltips">Checkout</span>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Setting</span>
          </a>
          <span class="tooltips">Setting</span>
        </li>
        <li class="profile">
          <div class="profile-details">

        <?php
            $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_user) > 0){
              $fetch_user = mysqli_fetch_assoc($select_user);
            };
        ?>

            <!--<img src="profile.jpg" alt="profileImg">-->
            <div class="name_job">
              <div class="name"><?php echo $fetch_user['name']; ?></div>
              <div class="job"><?php echo $fetch_user['email']; ?></div>
            </div>
          </div>
          <a href="sidebar.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');" > <i class="bx bx-log-out" id="log_out"></i></a>
        </li>
      </ul>
    </div>

   

    <!-- java script-->
    <script>
      let sidebar = document.querySelector('.sidebar')
      let closeBtn = document.querySelector('#btn')
      let searchBtn = document.querySelector('.bx-search')

      closeBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open')
        menuBtnChange() //calling the function(optional)
      })

      searchBtn.addEventListener('click', () => {
        // Sidebar open when you click on the search iocn
        sidebar.classList.toggle('open')
        menuBtnChange() //calling the function(optional)
      })

      // following are the code to change sidebar button(optional)
      function menuBtnChange() {
        if (sidebar.classList.contains('open')) {
          closeBtn.classList.replace('bx-menu', 'bx-menu-alt-right') //replacing the iocns class
        } else {
          closeBtn.classList.replace('bx-menu-alt-right', 'bx-menu') //replacing the iocns class
        }
      }
    </script>

