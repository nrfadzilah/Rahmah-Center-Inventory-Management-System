<html>
    <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - Admin Login</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/style.css">
  <style>
    .welcome-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    text-align: center;
    background-color: #f9f9f9;
}

.welcome-text {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.edit-button {
    padding: 12px 24px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.edit-button:hover {
    background-color: #0056b3;
}

  </style>
    </head>
    <body>
    <?php
// Call file to connect server eleave
include("headerfyp.php");

// This section processes submission from the login form
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate the admin ID
    if (!empty($_POST['adminName'])) {
        $n = mysqli_real_escape_string($connect, $_POST['adminName']);
    } else {
        $n = FALSE;
        echo '<p class="error">You forgot to enter your ID.</p>';
    }

    // Validate the admin password
    if (!empty($_POST['adminPassword'])) {
        $p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
    } else {
        $p = FALSE;
        echo '<p class="error">You forgot to enter your password.</p>';
    }

    // If no problems
    if ($n && $p) {
        // Retrieve admin information based on admin ID
        $q = "SELECT adminPassword, adminName, adminNumber, adminEmail FROM admin WHERE (adminName='$n' AND adminPassword='$p')";
        
        // Run the query and assign it to the variable $result
        $result = mysqli_query($connect, $q);

        // Check if query execution is successful
        if (!$result) {
          echo '<p class="error" style="color: red; text-align: center;">Query execution failed: ' . mysqli_error($connect) . '</p>';
      } else {
          // If one database row (record) matches the input
          if (mysqli_num_rows($result) == 1) {
              // Start the session, fetch the record, and store values
              session_start();
              $_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);

              // Success message with styling improvements
              echo '<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background-color: #f4f6f9; font-family: Arial, sans-serif; color: #333;">';
              echo '<h2 style="margin-bottom: 20px; font-size: 2em; color: #020b3d;">Welcome to Rahmah Center Admin Page</h2>';
              echo '<a href="adminEdit.php"><button style="padding: 12px 25px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Admin Edit</button></a>';
              echo '</div>';

              echo '<script>
                      const button = document.querySelector("button");
                      button.addEventListener("mouseover", () => {
                          button.style.backgroundColor = "#0056b3";
                      });
                      button.addEventListener("mouseout", () => {
                          button.style.backgroundColor = "#007bff";
                      });
                    </script>';

              exit();
          } else {
              // Error message for incorrect credentials
              echo '<p class="error" style="color: red; text-align: center;">The admin ID and password entered do not match our records.</p>';
          }
        }
    }
    mysqli_close($connect);
}
?>
 <!--================ Start Header Menu Area =================-->
 <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.html"><img src="rahmah.jpeg" width= "130px" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li> 
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Items</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="category1.php">Preserved Foods</a></li>
                  <li class="nav-item"><a class="nav-link" href="category2.php">Perishable Foods</a></li>
                  <li class="nav-item"><a class="nav-link" href="category3.php">Hygiene Products</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
              
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">User</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="faqs.html">FAQs</a></li>
                  <li class="nav-item"><a class="nav-link" href="manual.html">User Manual</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="adminlogin.php">Admin</a></li>

            </ul>
            <div>
              <a class="navbar-brand logo_h" href="index.html"><img src="fcom_logo.png" width= "160" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            </div>
          <div>
            <a class="navbar-brand logo_h" href="index.html"><img src="uptm_logo.png" width= "150" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          </button>
          </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================ End Header Menu Area =================-->

  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Admin Log In</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Log In</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
  <form action ="adminlogin.php" method ="post">
    
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>LOG IN TO ACCESS ADMIN INTERFACE</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="#/" id="contactForm" >
							<div class="col-md-12 form-group">
                            <label for ="adminName"> Admin Name:</label>
                            <input type ="text" class="form-control" id ="adminName" name="adminName" size ="4" maxlength ="15"
                            value ="<?php if (isset($_POST['adminName'])) echo $_POST['adminName'];?>">
                        </div>
							<div class="col-md-12 form-group">
                            <label for ="adminPassword"> Password:</label>
                            <input type ="password" class="form-control" id ="adminPassword" name="adminPassword" size ="15" maxlength ="60"
            pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title ="Must contain at least one number and
            one uppercase adn lowercase letter, and at least 8 or more characters" required
            value ="<?php if (isset($_POST['adminPassword'])) echo $_POST['adminPassword'];?>">
        </div>
        
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Log In</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->


  <!--================ Start footer Area  =================-->	
	<footer>
		<div class="footer-area">
				<div class="row section_gap">
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
              <li><a href="index.html">Home</a></li>
								<li><a href="category1.php">Items</a></li>
                                <li><a href="about.html">About Us</a></li>
								<li><a href="feedback.php">Feedback</a></li>
                                <li><a href="faqs.html">FAQs</a></li>
								<li><a href="adminlogin.php">Admin</a></li>
							</ul>
						</div>
					</div>
          
					<div class="offset-lg-1 col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>UNIVERSITI POLY-TECH MALAYSIA,<br>
                  Jalan 6/91, Taman Shamelin Perkasa,<br>
                  56100 Cheras, Kuala Lumpur</p>
	
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
									General Line: +603 9206 9700<br>
									Admin: +601 7504 7030
								</p>
	
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
									rahmahcenter@uptm.edu.my
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | RahmahCenter<i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">nrfdzlh</a></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->


  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>