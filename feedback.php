<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - User Feedback</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">

  <style>
/* Center the form container */
.center-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: Arial, sans-serif;
}

/* Style the feedback form */
.feedback-form {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
    animation: fadeIn 0.5s ease-in-out;
}

.feedback-form h2 {
    font-size: 24px;
    color: #333333;
    margin-bottom: 20px;
}

.feedback-form label {
    display: block;
    text-align: left;
    margin: 10px 0 5px;
    font-size: 14px;
    color: #555555;
}

.feedback-form input[type="text"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #f9f9f9;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.feedback-form input[type="text"]:focus {
    border-color: #2986CC;
    outline: none;
    background-color: #ffffff;
}

.feedback-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #2986CC;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.feedback-form input[type="submit"]:hover {
    background-color: #2986CC;
}

/* Add animations for fade-in effect */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
</head>
<body>
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
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Admin</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="adminlogin.php">Login</a></li>
                  <li class="nav-item"><a class="nav-link" href="adminregister.php">Register</a></li>
                </ul>
              </li>
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

  <main class="site-main">
<body>
	<?php
	//call file to connect server eleave
	include ("headerfyp.php");
    ?>

    <?php
    //This query inserts a record in the mentalhealth table
    //has form been submited?
    if ($_SERVER['REQUEST_METHOD']=='POST')
    {
    	$error = array ();//initialize an error array

    	//check for a feedbackPassword
    	if (empty ($_POST ['studName']))
    	{
    		$error [] = 'You forgot to enter your name.';
    	}
    else
    {
    	$n = mysqli_real_escape_string ($connect,trim ($_POST ['studName']));
    }
    // check for a studName
    if (empty ($_POST ['studID']))
    {
    	$error [] = 'Your forgot to enter your ID.';
    }
    else
    {
    	$s = mysqli_real_escape_string ($connect, trim ($_POST ['studID']));
    }

    //Check for a fmessage
    if (empty ($_POST ['fmessage']))
    {
    	$error [] = 'Enter message.';
    }
    else
    {
        $m =mysqli_real_escape_string ($connect , trim ($_POST ['fmessage']));
    }

    //register the feedback in the database
    //make the query:
    $q ="INSERT INTO feedback (feedbackID, studName, studID, fmessage)
    VALUES ('','$n','$s','$m')";
    $result = @mysqli_query ($connect, $q);//run the query
    if ($result)//if it runs
    {
    	echo '<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; background-color: #f4f6f9; font-family: Arial, sans-serif; color: #333;">';
              echo '<h2 style="margin-bottom: 20px; font-size: 2em; color: #020b3d;">Thankyou for the feedback!</h2>';
              echo '<a href="index.html"><button style="padding: 12px 25px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">Back to Main Page</button></a>';
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
    }
    else
    {
    	//if it didn't run
    	//message
    	echo'<h1>System error<h1>';

    	//debugging message
    	echo '<p>'.mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
    }//end of it (result)
        mysqli_close($connect); //close the database connection_aborted
        exit();
    }//end of the main submit conditional
?>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
          <h1>Feedback Form</h1>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
    <div class="center-form-container">
    <div class="feedback-form">
        <form action="feedback.php" method="post">
            <label for="studName">Student Name:</label>
            <input type="text" id="studName" name="studName" size="30" maxlength="50" required
            value="<?php if (isset($_POST['studName'])) echo $_POST['studName']; ?>">

            <label for="stuID">ID Number</label>
            <input type="text" id="stuID" name="studID" size="30" maxlength="50" required
            value="<?php if (isset($_POST['studID'])) echo $_POST['studID']; ?>">

            <label for="subject">Subject</label>
            <input type="text" id="fmessage" name="fmessage" size="30" maxlength="250" required
            value="<?php if (isset($_POST['fmessage'])) echo $_POST['fmessage']; ?>">

            <input type="submit" value="Submit">
        </form>
    </div>
</div>

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
                                <li><a href="manual.html">User Manual</a></li>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | RahmahCenter<i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">nrfdzlh</a>
</p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>