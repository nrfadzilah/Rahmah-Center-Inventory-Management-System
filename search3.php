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
    header("Location: " . $_SERVER['PHP_SELF'] . "?search=" . urlencode($_GET['search']));
    exit();
}

// Fetch items for search results
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM hygiene WHERE itemName LIKE '%$searchQuery%' OR category LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT * FROM hygiene";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Hygiene</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #343a40; }
        .search-container { margin-top: 50px; text-align: center; }
        .search-box { max-width: 600px; margin: 0 auto; }
        .card { border: none; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .card-img-top { max-height: 180px; object-fit: contain; border-bottom: 1px solid #f0f0f0; }
        .card-body { text-align: center; }
        .btn-custom { background-color: #007bff; color: white; }
        .btn-custom:hover { background-color: #0056b3; }
        .no-results { font-size: 1.2rem; color: #dc3545; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="home.php">Rahmah Center</a>
            <form class="form-inline ms-auto search-box" action="search.php" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for items.." aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </div>
            </form>
        </div>
    </nav>

    <!-- Search Results Section -->
    <div class="container search-container">
        <h2 class="mb-4">Search Results</h2>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="row g-3">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($row['itemImage']); ?>" class="card-img-top" alt="Item Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['itemName']); ?></h5>
                                <p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                                <form method="post" action="">
                                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['itemID']); ?>">
                                    <input type="hidden" name="item_name" value="<?php echo htmlspecialchars($row['itemName']); ?>">
                                    <label for="quantity_<?php echo $row['itemID']; ?>">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity_<?php echo $row['itemID']; ?>" min="0" max="5" value="0" class="form-control mb-2">
                                    <button type="submit" name="add_to_cart" class="btn btn-custom">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-results">No hygiene found matching your search. Please try a different keyword.</p>
        <?php endif; ?>
    </div>

    <!-- Back Button -->
<div class="text-center">
        <a href="category3.php" class="back-button">Back to Categories</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
