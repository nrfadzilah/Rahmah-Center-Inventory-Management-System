<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rahmah Center - Delete Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background: #ffffff;
            padding: 30px 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        form {
            margin-top: 20px;
        }

        input[type="submit"] {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #submit-no {
            background-color: #dc3545;
        }

        #submit-no:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php
    include("headerfyp.php");
    ?>
    <div class="container">
        <h2>Delete Item in the List</h2>

        <?php
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = $_GET['id'];
        } else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
            $id = $_POST['id'];
        } else {
            echo '<p class="error">This page has been accessed in error.</p>';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['sure'] == 'Yes') {
                $q = "DELETE FROM hygiene WHERE itemID = $id LIMIT 1";
                $result = @mysqli_query($connect, $q);

                if (mysqli_affected_rows($connect) == 1) {
                    echo '<script>alert("The item has been deleted");
                    window.location.href="itemList3.php";</script>';
                } else {
                    echo '<p class="error"> The record could not be deleted.<br>
                    Probably because it does not exist or due to system error.</p>';

                    echo '<p>' . mysqli_error($connect) . '<br/>Query:' . $q . '</p>';
                }
            } else {
                echo '<script>alert("The item has NOT been deleted");
                window.location.href="itemList3.php";</script>';
            }
        } else {
            $q = "SELECT itemName FROM hygiene WHERE itemID = $id";
            $result = @mysqli_query($connect, $q);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                echo '<p>Are you sure you want to delete the item <strong>' . htmlspecialchars($row[0]) . '</strong>?</p>';
                echo '<form action="itemDelete3.php" method="post">
                <input type="submit" name="sure" value="Yes">
                <input id="submit-no" type="submit" name="sure" value="No">
                <input type="hidden" name="id" value="' . $id . '">
                </form>';
            } else {
                echo '<p class="error">This page has been accessed in error.</p>';
                echo '<p>&nbsp;</p>';
            }
        }
        mysqli_close($connect);
        ?>
    </div>
</body>
</html>