<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rahmahcenter";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle "Add to Cart" POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $itemId = $_POST['item_id'];
    $itemName = $_POST['item_name'];
    $quantity = intval($_POST['quantity']);

    $checkQuery = "SELECT * FROM cart WHERE cartID = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE cart SET quantity = quantity + ? WHERE cartID = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $quantity, $itemId);
        $updateStmt->execute();
    } else {
        $insertQuery = "INSERT INTO cart (cartID, itemName, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("isi", $itemId, $itemName, $quantity);
        $insertStmt->execute();
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle "Delete Item" POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $itemId = $_POST['item_id'];

    $deleteQuery = "DELETE FROM cart WHERE cartID = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - Category 3</title>
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS to reduce card and image size */
        .card {
            width: 90%; /* Adjust the width as needed */
            margin: auto;
        }
        .card-img-top {
            max-height: 150px; /* Set maximum height for images */
            object-fit: contain;
        }
        .navbar {
    background-color: #343a40; /* Dark background */
}

.form-control {
    border-radius: 0.25rem;
}

.btn {
    border-radius: 0.25rem;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #f8f9fa;
    color: #343a40;
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

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
          <h1>Hygiene Products</h1>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="home.php"></a>
            <form class="form-inline ml-auto" action="search3.php" method="get">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Search items" aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </div>
            </form>
        </div>
    </nav>

<div class="container my-5">
    <div class="row">
        <?php
        $query = "SELECT * FROM hygiene";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($item = $result->fetch_assoc()) {
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $item['itemImage']; ?>" alt="<?php echo htmlspecialchars($item['itemName']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['itemName']); ?></h5>
                            <form method="post" action="">
                                <input type="hidden" name="item_id" value="<?php echo $item['itemID']; ?>">
                                <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($item['itemName']); ?>">
                                <label for="quantity_<?php echo $item['itemID']; ?>">Quantity:</label>
                                <input type="number" name="quantity" id="quantity_<?php echo $item['itemID']; ?>" value="0" min="0" max="3" class="form-control">
                                <button type="submit" name="add_to_cart" class="btn btn-primary mt-2">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No items found.</p>";
        }
        ?>
    </div>

    <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#cartModal">
        View Cart
    </button>
</div>

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cartQuery = "SELECT * FROM cart";
                    $cartResult = $conn->query($cartQuery);

                    if ($cartResult->num_rows > 0) {
                        while ($row = $cartResult->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['itemName']) . "</td>
                                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                                    <td>
                                        <form method='post' action='' class='d-inline'>
                                            <input type='hidden' name='item_id' value='" . $row['cartID'] . "'>
                                            <button type='submit' name='delete_item' class='btn btn-danger btn-sm'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Your cart is empty.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
