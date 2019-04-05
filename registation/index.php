<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">

<div class="header">
    <?php  if (isset($_SESSION['username'])) : ?>
    <h5 id ="logout"> <a href="index.php?logout='1'" style="color: red;">logout</a> </h5>
      <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
    <?php endif ?>
</div>
<div class="content">
    <!-- notification message -->
    <?php
    if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h5>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </h5>
      </div>
    <?php endif ?>

    <h2 id ="index"><strong>INDEX</strong></h2>

    <ul>
      <h4><li><a href="task1.php" title="task 1" target="_blank">Task 1 : Form with 3 text fields where third field is auto filled on filling of first two </a></li><h4>
      <h4><li><a href="accept-file.php" title="task 2" target="_blank">Task 2 : Accept image from a user , store on server and display it </a></li></h4>
      <h4><li><a href="task3.php" title="task 3" target="_blank">Task 3 : In a textbox accept subject|marks and display them in form of a table </a></li></h4>
      <h4><li><a href="task4.php" title="task 4" target="_blank">Task 4 : Validation of Indian Phone Number of 10 digits with country code</a></li></h4>
      <h4><li><a href="mailbox.php" title="task 5" target="_blank">Task 5 : Email Validation </a></li></h4>
      <h4><li><a href="task6b.php" title="task 6" target="_blank">Task 6 : Form Validation with above functionality and store result into database if all fields are filled with valid inputs and on submit save the form data into doc format </a></li></h4>
      <h4><li><a href="test.php" title="task 7" target="_blank">Task 7 : In a textbox input entered in JSON format and data is stored as gist in github using github API </a></li></h4>
      <h4><li><a href="repo.php" title="task 8" target="_blank">Task 8 : Using github API repo names with maximum stars in displayed and on click of a particular repo ,its corresponding contributors list is displayed </a></li></h4>
    </ul>

    <!-- logged in user information -->

</div>
</div>
</body>
</html>
