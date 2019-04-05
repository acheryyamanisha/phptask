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
  <title>mailbox api validation</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<?php
include("credentials.php");
if(isset($_POST['submit'])){
// set API Access Key
$access_key = $access_key;

// set email address
$email_address = $_POST['email'];
echo "<h3>Email id entered is : $email_address</h3>";
echo "<br>";
echo "<br>";
// Initialize CURL:
$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email_address.'');
//echo $ch;
//print_r($ch);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$validationResult = json_decode($json, true);
/*echo "<pre>";print_r($validationResult);echo "<pre>";*/

// Access and use your preferred validation result objects
if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
  # code...
  echo "<h3>Valid email id</h3>";
}
else
echo "<h3>invalid email id</h3>";
;
//print_r($validationResult['score']);
//print_r($validationResult['format_valid']);
//print_r($validationResult['smtp_check']);
}
?>

<form method="POST" action="">
  Email : <input type="text" name="email">
  <input type="submit" name="submit" value="submit">

</form>
<div class="pager">
<?php
include('pager.php');
?>
</div>
</div>
</body>
</html>

