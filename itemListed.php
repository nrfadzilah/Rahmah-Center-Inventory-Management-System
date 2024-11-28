<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - Listed Item</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Centering the content */
    .center-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
      text-align: center;
    }

    table {
      width: 85%;
      border-collapse: collapse;
      margin: 20px auto;
      background-color: lightblue;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      text-align: center;
      padding: 12px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #69c1e8;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tr:hover {
      background-color: #e1f5fe;
    }

    button {
      background-color: #69c1e8;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
    }

    button:hover {
      background-color: #2a9df4;
    }
  </style>
</head>

<body>
    <?php
    //call file to connect server eleave
    include("headerfyp.php");
    ?>
    <div class="center-content">
    <h2>List of Preserved Foods</h2>

    <?php
    //make the query
    $q = "SELECT itemID, itemName, category, quantity, itemImage FROM items ORDER BY itemID";

    //run the query and assign it to the variable $result
    $result = @mysqli_query ($connect, $q);

    if ($result)
    {
        //table heading
        echo '<table border = "2">
        <tr>
        <td align="center"><strong>ID</strong></td>
        <td align="center"><strong>ITEM NAME</strong></td>
        <td align="center"><strong>CATEGORY</strong></td>
        <td align="center"><strong>QUANTITY</strong></td>
        <td align="center"><strong>ITEM IMAGE</strong></td>
        <td align="center"><strong>UPDATE</strong></td>
        <td align="center"><strong>DELETE</strong></td>
        </tr>';

        // Fetch and print all the records
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  echo '<tr>
      <td>' . $row['itemID'] . '</td>
      <td>' . $row['itemName'] . '</td>
      <td>' . $row['category'] . '</td>
      <td>' . $row['quantity'] . '</td>
      <td>
          <img src="' . $row['itemImage'] . '" alt="Item Image" style="width: 100px; height: auto;">
      </td>
      <td align="center"><a href="itemUpdate.php?id=' . $row['itemID'] . '">Update</a></td>
      <td align="center"><a href="itemDelete.php?id=' . $row['itemID'] . '">Delete</a></td>
  </tr>';
}
        //close the table
        echo '</table>';
        echo '<div style="display: flex; flex-direction: column; align-items: center; height: 100vh; text-align: center;">';
        echo '<h4>Back to Admin Editing Page</h4>';
        echo '<a href="adminEdit.php"><button>Click Here</button></a>';
        //free up the resources
        mysqli_free_result ($result);
        //if failed to run
    }
    else
    {
        //error message
        echo'<p class="error"> The current user could not be retrieved.
        We apologize for any inconvenience.</p>';

        //debugging message
        echo '<p>'.mysqli_error ($connect).'<br></br>Query:'.$q.'</p>';
    }//end of if($result)
    //close the database connection
    mysqli_close($connect);
    ?>
    </div>
    </div>
    </body>
    </html>