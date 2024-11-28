<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - Listed Feedback</title>
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
  <div class="center-content">
    <h2>Feedback from Users</h2>
    <?php
    // Include the database connection file
    include("headerfyp.php");

    // Query to fetch feedback data
    $q = "SELECT feedbackID, studName, studID, fmessage FROM feedback ORDER BY feedbackID";
    $result = @mysqli_query($connect, $q);

    if ($result) {
      // Table header
      echo '<table>
              <thead>
                <tr>
                  <th>Feedback ID</th>
                  <th>Student Name</th>
                  <th>Student ID</th>
                  <th>Feedback</th>
                </tr>
              </thead>
              <tbody>';

      // Table rows
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>
                <td>' . $row['feedbackID'] . '</td>
                <td>' . $row['studName'] . '</td>
                <td>' . $row['studID'] . '</td>
                <td>' . $row['fmessage'] . '</td>
              </tr>';
      }

      echo '</tbody>
            </table>';
      echo '<h4>Back to Admin Editing Page</h4>';
      echo '<a href="adminEdit.php"><button>Click Here</button></a>';

      // Free up resources
      mysqli_free_result($result);
    } else {
      // Error message
      echo '<p class="error">The current user data could not be retrieved. Please try again later.</p>';
    }

    // Close the database connection
    mysqli_close($connect);
    ?>
  </div>
</body>
</html>
