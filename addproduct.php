<?php
// Connect to the database
$connect = new mysqli("localhost", "root", "", "rahmahcenter");

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validate item name
    if (empty($_POST['itemName'])) {
        $errors[] = 'Please enter the item name.';
    } else {
        $itemName = trim($_POST['itemName']);
    }

    // Validate category
    if (empty($_POST['category'])) {
        $errors[] = 'Please select a category.';
    } else {
        $category = $_POST['category'];
    }

    // Validate quantity
    if (empty($_POST['quantity']) || $_POST['quantity'] <= 0) {
        $errors[] = 'Please enter a valid quantity.';
    } else {
        $quantity = (int)$_POST['quantity'];
    }

    // Validate and handle file upload
    if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['itemImage']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['itemImage']['tmp_name'], $targetFilePath)) {
                $itemImage = $targetFilePath;
            } else {
                $errors[] = 'Failed to upload the image.';
            }
        } else {
            $errors[] = 'Only JPG, JPEG, PNG, and GIF formats are allowed.';
        }
    } else {
        $errors[] = 'Please upload an image.';
    }

    // Insert data if no errors
    if (empty($errors)) {
        // Map category to table name
        $tableMapping = [
            'Preserved Food' => 'items',
            'Perishable Food' => 'products',
            'Hygiene Products' => 'hygiene'
        ];

        if (array_key_exists($category, $tableMapping)) {
            $tableName = $tableMapping[$category];

            // Insert data into the correct table
            $stmt = $connect->prepare("INSERT INTO $tableName (itemName, category, quantity, itemImage) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $itemName, $category, $quantity, $itemImage);

            if ($stmt->execute()) {
                echo "<div class='success-message'>Item successfully added to <strong>" . htmlspecialchars($tableName) . "</strong>!</div>";

                // Redirect to the appropriate category page
                switch ($category) {
                    case 'Preserved Food':
                        header("Location: itemListed.php");
                        break;
                    case 'Perishable Food':
                        header("Location: itemList2.php");
                        break;
                    case 'Hygiene Products':
                        header("Location: itemList3.php");
                        break;
                    default:
                        header("Location: itemListed.php");
                }
                exit;
            } else {
                echo "<div class='error-message'>Error: Could not add the item. Please try again later.</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='error-message'>Invalid category selected.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error-message'>" . htmlspecialchars($error) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Rahmah Center</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Product</h2>
        <form action="addproduct.php" method="post" enctype="multipart/form-data">
            <label for="itemName">Item Name</label>
            <input type="text" id="itemName" name="itemName" required>

            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="">-- Select a Category --</option>
                <option value="Preserved Food">Preserved Food</option>
                <option value="Perishable Food">Perishable Food</option>
                <option value="Hygiene Products">Hygiene Products</option>
            </select>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <label for="itemImage">Upload Image</label>
            <input type="file" id="itemImage" name="itemImage" accept="image/*" required>

            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>
