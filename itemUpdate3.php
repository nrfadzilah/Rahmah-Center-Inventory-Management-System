<html>
<head>
    <title>Rahmah Center System</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

h2 {
    text-align: center;
    margin: 20px 0;
    color: #444;
}

form {
    width: 80%;
    max-width: 400px;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 40px auto;
}

form p {
    margin-bottom: 15px;
}

form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="tel"],
form input[type="email"],
form input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

form input[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    font-size: 1.2rem;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}

form input[type="submit"]:hover {
    background-color: #218838;
}

.error {
    color: red;
    font-size: 0.9rem;
    margin-top: 10px;
}

.success {
    color: green;
    font-size: 0.9rem;
    margin-top: 10px;
}

.container {
    padding: 20px;
}

footer {
    text-align: center;
    padding: 10px 0;
    background-color: #333;
    color: #fff;
    position: fixed;
    bottom: 0;
    width: 100%;
}

footer a {
    color: #fff;
    text-decoration: underline;
}

footer a:hover {
    color: #28a745;
    text-decoration: none;
}

    </style>
</head>
<body>
    <?php
    // Call file to connect server
    include("headerfyp.php");
    ?>
     <div class="center-content">
     <h2>Update Item in List</h2>

    <?php
    // Include database connection file
    include("headerfyp.php");

    // Check if item ID is provided and is numeric
    if ((isset($_GET['id']) && is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } elseif ((isset($_POST['id']) && is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = array(); // Initialize an error array

        // Validate itemName
        if (empty($_POST['itemName'])) {
            $error[] = 'You forgot to enter the item name.';
        } else {
            $itemName = mysqli_real_escape_string($connect, trim($_POST['itemName']));
        }

        // Validate category
        if (empty($_POST['category'])) {
            $error[] = 'You forgot to enter the item category.';
        } else {
            $category = mysqli_real_escape_string($connect, trim($_POST['category']));
        }

        // Validate quantity
        if (empty($_POST['quantity'])) {
            $error[] = 'You forgot to enter the item quantity.';
        } else {
            $quantity = mysqli_real_escape_string($connect, trim($_POST['quantity']));
        }

        // Handle image upload
        if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] == 0) {
            $targetDir = "uploads/";
            $fileName = basename($_FILES["itemImage"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Check if the uploads directory exists, create if not
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Allowed file formats
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileType, $allowedTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $targetFilePath)) {
                    $itemImage = $targetFilePath; // Set file path for database update
                } else {
                    $error[] = "File upload failed.";
                }
            } else {
                $error[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            // If no new file uploaded, retain the existing image
            $q = "SELECT itemImage FROM hygiene WHERE itemID = $id";
            $result = mysqli_query($connect, $q);
            if ($result && mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $itemImage = $row['itemImage']; // Keep the existing image
            } else {
                $error[] = "Failed to retrieve the existing image.";
            }
        }

        // If no errors occurred
        if (empty($error)) {
            $q = "SELECT itemID FROM hygiene WHERE itemName = '$itemName' AND itemID != $id";
            $result = mysqli_query($connect, $q);

            if (mysqli_num_rows($result) == 0) {
                // Update the database
                $q = "UPDATE hygiene 
                      SET itemName = '$itemName', 
                          category = '$category', 
                          quantity = '$quantity', 
                          itemImage = '$itemImage' 
                      WHERE itemID = '$id' LIMIT 1";

                $result = mysqli_query($connect, $q);

                if (mysqli_affected_rows($connect) == 1) {
                    echo '<script>alert("The item has been updated."); window.location.href="itemList3.php";</script>';
                    exit();
                } else {
                    echo '<p class="error">The item has not been updated due to a system error.</p>';
                    echo '<p>' . mysqli_error($connect) . '<br/> Query: ' . $q . '</p>';
                }
            } else {
                echo '<p class="error">The item name has already been registered.</p>';
            }
        } else {
            echo '<p class="error">The following error(s) occurred:<br>';
            foreach ($error as $msg) {
                echo "- $msg <br>";
            }
            echo '</p><p>Please try again.</p>';
        }
    }

    // Fetch item information
    $q = "SELECT itemName, category, quantity, itemImage FROM hygiene WHERE itemID = $id";
    $result = mysqli_query($connect, $q);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Generate the form
        echo '<form action="itemUpdate3.php" method="post" enctype="multipart/form-data">
                <p><label class="label" for="itemName">Item Name*:</label>
                <input type="text" id="itemName" name="itemName" size="30" maxlength="50" value="' . $row['itemName'] . '"></p>
        
                <p><br><label class="label" for="category">Category*:</label>
                <input type="text" id="category" name="category" size="30" maxlength="50" value="' . $row['category'] . '"></p>
        
                <p><br><label class="label" for="quantity">Quantity*:</label>
                <input type="number" id="quantity" name="quantity" size="10" maxlength="10" value="' . $row['quantity'] . '"></p>

                <p><br><label class="label" for="itemImage">Item Image*:</label>
                <input type="file" id="itemImage" name="itemImage"></p>
                <p>Current Image: <img src="' . $row['itemImage'] . '" alt="Item Image" width="100"></p>
        
                <br><p><input id="submit" type="submit" name="submit" value="Update"></p>
                <br><input type="hidden" name="id" value="' . $id . '"/>
              </form>';
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
</body>
</html>
