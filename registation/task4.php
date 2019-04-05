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
  <title>phone number validation</title>
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
 <h5 id ="logout"> <a href="index.php" style="color: red;">go back to index page</a> </h5>
    <?php endif ?>
</div>
<form method="POST" action="task4.php">
  Phone Number : <input type="text" name="number">
  <input type="submit" name="submit" value="Submit">
</form>
<div class="pager">

<?php
if ($_POST['submit']) {
//echo $_POST['submit'];
    $mobile = $_POST["number"];
//echo "<br> The number submitted is $mobile <br>";
    $len = strlen($mobile);
//echo "Length of the number is $len <br>";
    switch ($len) {
    case '13':
        if (preg_match("/^([+][9][1])([6-9]{1})([0-9]{9})$/", $mobile)) {
            echo "<h3>$mobile is valid</h3>";
        } else {
            echo "not valid";
        }
        break;

    default:
        echo "<script>alert('Invalid Number');</script>";
        break;
    }
    $mobile = null;
}
?>
<?php
include('pager.php');
?>
</div>

</div>
</body>
</html>
