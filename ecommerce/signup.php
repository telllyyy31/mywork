<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Box icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
      
    />
    <!-- alert link-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/styles.css" />
    
    
    <title>Sign Up</title>
  </head>
  <body>
    <!-- Navigation -->
    <div class="top-nav">
      <div class="container d-flex">
        <p>Order Online Or Call Us: (001) 2222-55555</p>
        <ul class="d-flex">
          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="index.php" class="logo"><h1>Dans</h1></a>

        <ul class="nav-list d-flex">
          <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="product.html" class="nav-link">Shop</a>
          </li>
          <li class="nav-item">
            <a href="#terms" class="nav-link">Terms</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">Contact</a>
          </li>
          <li class="icons d-flex">
            <a href="login.php" class="icon">
              <i class="bx bx-user"></i>
            </a>
            <div class="icon">
              <i class="bx bx-search"></i>
            </div>
            <div class="icon">
              <i class="bx bx-heart"></i>
              <span class="d-flex">0</span>
            </div>
            <a href="cart.html" class="icon">
              <i class="bx bx-cart"></i>
              <span class="d-flex">0</span>
            </a>
          </li>
        </ul>

        <div class="icons d-flex">
          <a href="login.php" class="icon">
            <i class="bx bx-user"></i>
          </a>
          <div class="icon">
            <i class="bx bx-search"></i>
          </div>
          <div class="icon">
            <i class="bx bx-heart"></i>
            <span class="d-flex">0</span>
          </div>
          <a href="cart.html" class="icon">
            <i class="bx bx-cart"></i>
            <span class="d-flex">0</span>
          </a>
        </div>

        <div class="hamburger">
          <i class="bx bx-menu-alt-left"></i>
        </div>
      </div>
    </div>
    <!-- Login -->
    <div class="container">
      <div class="login-form">
      <?php
      if(isset($_POST["submit"])){
        $fullName=$_POST["fullname"];
        $email=$_POST["email"];
        $password=$_POST["psw"];
        $passwordRepeat=$_POST["psw-repeat"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
          array_push($errors,"All field are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          array_push($errors, "Email is not valid");
        }
        if (strlen($password)<8) {
          array_push($errors, "Password must be at least 8 character long");
        }
        if ($password !== $passwordRepeat) {
          array_push($errors,"Password does not Match");
        }
        if (count($errors)>0) {
          foreach($errors as $errors) {
            echo "<div class='w3-panel w3-pale-red w3-border'>$errors</div>";
          }
        } else{
          require_once "database.php";
          $sql = "INSERT INTO users(full_name, email, password) VALUES( ?, ?, ? )";
          $stmt = mysqli_stmt_init($conn);
          $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
          if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt,"sss", $fullName,$email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='w3-panel w3-pale-green w3-borde'>You are successfully Register</div>";
          } else {
            die("Something went wrong");
          }
        }
      }
      ?>
        <form action="signup.php" method="post">
          <h1>Sign Up</h1>
          <p>Please fill in this form to create an account. or <a href="login.php">Login</a></p>
          <label for="name">Full Name</label>
          <input type="text" name="fullname" placeholder="Full Name"required/>
          <label for="email">Email</label>
          <input type="text" name="email" placeholder="Enter Email Address"required/>
          <label for="psw">Password</label>
          <input type="password" name="psw" placeholder="Enter Password" required/>
          <label for="psw-repeat">Repeat Password</label>
          <input type="password" name="psw-repeat" placeholder="Repeat Password"/>
          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom: 15px"/> Remember me
          </label>
          <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          <div class="buttons">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn" name="submit" >Sign Up</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="row">
        <div class="col d-flex">
          <h4>INFORMATION</h4>
          <a href="">About us</a>
          <a href="">Contact Us</a>
          <a href="">Term & Conditions</a>
          <a href="">Shipping Guide</a>
        </div>
        <div class="col d-flex">
          <h4>USEFUL LINK</h4>
          <a href="">Online Store</a>
          <a href="">Customer Services</a>
          <a href="">Promotion</a>
          <a href="">Top Brands</a>
        </div>
        <div class="col d-flex">
          <span><i class="bx bxl-facebook-square"></i></span>
          <span><i class="bx bxl-instagram-alt"></i></span>
          <span><i class="bx bxl-github"></i></span>
          <span><i class="bx bxl-twitter"></i></span>
          <span><i class="bx bxl-pinterest"></i></span>
        </div>
      </div>
    </footer>

    <!-- Custom Script -->
    <script src="./js/index.js"></script>
  </body>
</html>
