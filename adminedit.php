<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rahmah Center - Admin Edit</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>
<style>
  /* Button container styles */
  .center-container {
      max-width: 800px;
      margin: 60px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .center-heading h2 {
      font-size: 2rem;
      color: #007bff;
      margin-bottom: 20px;
      font-weight: bold;
    }

    /* Button Styles */
    .button {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    .button a {
      text-decoration: none;
      color: #fff;
    }

    button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 12px 24px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 1.1rem;
      width: 100%;
      max-width: 300px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }
</style>
</head>
<body>

<?php
//call file to connect server eleave
include("headerfyp.php");
?>

<?php
//This query inserts a record in the mentalhealth table
//has form been submited?
if ($_SERVER['REQUEST_METHOD']=='POST')
{
  $error = array ();//initialize an error array

$result = @mysqli_query ($connect);//run the query
if ($result)//if it runs
{
  echo '<h1>thank you</h1>';
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

<div class="center-container">
  <div class="center-heading">
    <h2>Admin Edit Page</h2>
  </div>
  <div class="button">
    <button><a href="addproduct.php">Add new item in list</a></button>
    <button><a href="itemListed.php">Edit Preserved Foods</a></button>
    <button><a href="itemList2.php">Edit Perishable Foods</a></button>
    <button><a href="itemList3.php">Edit Hygiene Products</a></button>
    <button><a href="feedbacklist.php">View feedback from users</a></button>
    <button><a href="logout.html">Log out</a></button>
  </div>
</div>
</body>
</html>