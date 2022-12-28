<?php
session_start();
if(isset($_SESSION["cart"]))
{
  $i=count($_SESSION["cart"]);
} else
{
  $_SESSION["cart"]=array();
  $i=count($_SESSION["cart"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>AB</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <link href="../css/responsive.css" rel="stylesheet" />
  <link href="../css/style.css" rel="stylesheet" />
  <style>
      .error {
    color: red;
}
      </style>
</head>

<body>
  <div class="hero_area">
    <div class="brand_box">
      <a class="navbar-brand" href="../index.php">
        <span style="color:black;">
          IFruits
        </span>
      </a>
    </div>
    <section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide ">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="img-box">
              <img src="../images/slider-img.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <section class="nav_section">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">About and Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Log In</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="cart.php">Shopping cart (<?php echo $i; ?>)</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>
  <?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      $email = $pass = $pass1 = $fname = $lname = "";
      $emailErr = $passErr = $pass1Err = $fnameErr = $lnameErr="";
      $j=0;
      if($_SESSION["user"]=="")
      {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["fname"])) {
            $fnameErr = "First name is necessary!";
          } else {
            $fname = test_input($_POST["fname"]);
          }
          if (empty($_POST["lname"])) {
            $lnameErr = "Last name is necessary!";
          } else {
            $lname = test_input($_POST["lname"]);
          }
          if (empty($_POST["email"])) {
            $emailErr = "Email is necessary!";
          } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Wrong email format!";
            }
          }
          if (empty($_POST["pass"])) {
            $passErr = "Password is necessary!";
          } else {
            $pass = test_input($_POST["pass"]);
            $uppercase = preg_match('@[A-Z]@', $pass);
            $lowercase = preg_match('@[a-z]@', $pass);
            $number    = preg_match('@[0-9]@', $pass);
            if(!$uppercase || !$lowercase || !$number) {
                $passErr="Password must contain at least one number and one uppercase letter!";
            }
        }
        if(empty($_POST["pass1"])) {
            $pass1Err = "Password do not match!";
        } else
        {
            $pass1=test_input($_POST["pass1"]);
            if($pass!=$pass1)
            {
                $pass1Err="Password do not match!";
            }
        }
        if($pass1Err == "" && $emailErr == "" && $passErr=="" && $fnameErr=="" && $lnameErr=="")
        {
          include "../database/konekcija na bazu.php";
          $stmt = $conn->prepare("INSERT INTO korisnik (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)");
              $stmt->bind_param("ssss", $fname, $lname, $email, $pass);
              $stmt->execute();
              $stmt->close();
              $conn->close();
              echo '<br><h2 class="text-center">Successfull registration!</h2>';
              $_SESSION["user"]=$email;
            }
        }
      } else
      {
        if ($_SERVER["REQUEST_METHOD"] == "POST") { 
          $_SESSION["user"]="";
        }
      } 
    ?>
  <section class="contact_section layout_padding">
    <?php
         if(isset($_SESSION["user"]))
         {
           if($_SESSION["user"]=="")
           {
            echo '<div class="layout_padding2-top">
            <div class="col-lg-8 offset-lg-2 col-md-5 offset-md-1">
            <div class="heading_container">
          <hr>
          <h2>
            Log In
          </h2>
        </div>
            <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
            <div class="contact_form-container">
            <div>
                <div>
                    <input type="text" name="fname" placeholder="First Name" value="'.$fname.'"/>
                    <span class="error">' . $fnameErr .'</span> 
                </div>
                <div>
                    <input type="text" name="lname" placeholder="Last Name" value="'.$lname.'"/>
                    <span class="error">' . $lnameErr .'</span> 
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email" value="'.$email.'"/>
                    <span class="error">' . $emailErr .'</span> 
                </div>
                <div>
                    <input type="password" placeholder="Password" name="pass" value="'. $pass.'"/>
                    <span class="error">' . $passErr .'</span> 
                </div>
                <div>
                    <input type="password" placeholder="Confirm password" name="pass1" value="'. $pass1.'"/>
                    <span class="error">' . $pass1Err .'</span> 
                </div>
                <div>
                <button type="submit">
                    Register
                </button>
                </div>
            </div>
            </div>
        </form>
        </div>
        </div>';
           } else
           {
            echo '<h2 class="text-center"> You are already Logged In! </h2>';
            echo '<div class="contact_form-container">
            <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
            <div class="text-center">
            <button type="submit">
                    Log out
                </button>
                </div>
            </form>
            </div>';
           }
        } else
        {
            $_SESSION["user"]="";
            echo '<div class="layout_padding2-top">
            <div class="col-lg-8 offset-lg-2 col-md-5 offset-md-1">
            <div class="heading_container">
          <hr>
          <h2>
            Register
          </h2>
        </div>
            <form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">
            <div class="contact_form-container">
            <div>
                <div>
                    <input type="text" name="fname" placeholder="First Name" value="'.$fname.'"/>
                </div>
                <div>
                    <input type="text" name="lname" placeholder="Last Name" value="'.$lname.'"/>
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email" value="'.$email.'"/>
                </div>
                <div>
                    <input type="password" placeholder="Password" name="pass" value="'. $pass.'"/>
                </div>
                <div>
                    <input type="password" placeholder="Confirm password" name="pass1" value="'. $pass1.'"/>
                </div>
                <div>
                <button type="submit">
                    Register
                </button>
                </div>
            </div>
            </div>
        </form>
        </div>
        </div>';
        }
    ?>
    </section>
  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_logo">
        <h2>
          IFruits
        </h2>
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="https://www.google.com/maps/place/Kraljevo/@43.7233797,20.6527942,13z/data=!3m1!4b1!4m5!3m4!1s0x475700c799ce8c71:0x9e935f21a083e94a!8m2!3d43.723849!4d20.6872532">
              <img src="../images/location.png" alt="">
              <span>
                Kraljevo
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="tel:012334567890">
              <img src="../images/call.png" alt="">
              <span>
                Call : +012334567890
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="mailto:bascarevic.andrija22@gmail.com">
              <img src="../images/mail.png" alt="">
              <span>
                bascarevic.andrija22@gmail.com
              </span>
            </a>
          </div>
        </div>
      </div>
        <div class="col-md-4">
          <div class="info_social">
            <div>
              <a href="https://www.facebook.com">
                <img src="../images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="https://twitter.com/">
                <img src="../images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="https://www.instagram.com">
                <img src="../images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container-fluid footer_section">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By
      <a href="../index.php">IFruits</a>
    </p>
  </section>
  </body>
</html>