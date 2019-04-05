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

if ($_POST['submit']) {
    $name = $_POST['fullname'];
    echo "<h1>Hello $name</h1>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP Assignment</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#fname, #lname").keyup(function(){
    var str = "";
    var k=" ";
     $('#fname, #lname').each(function() {
           str += $(this).val()+k;
       });
       $('#fullname').val(str);

  });
});
</script>
</head>
<body>
  <div class="container">>
  <div class="header">
    <?php  if (isset($_SESSION['username'])) : ?>
    <h5 id ="logout"> <a href="index.php?logout='1'" style="color: red;">logout</a> </h5>
      <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
 <h5 id ="logout"> <a href="index.php" style="color: red;">go back to index page</a> </h5>
    <?php endif ?>
</div>
<form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
  FIRST NAME : <input type="text" name="name" id ="fname"><br /><br />
  LAST NAME : <input type="text" name="name" id ="lname"><br /><br />
  FULL NAME : <input type="text" name="fullname" id ="fullname" readonly="readonly"><br /><br />
  <input type="submit" value="Submit the form" name="submit">
</form>

<div class="pager">
<?php
include('pager.php');
?>
</div>
</div>
</body>
</html>
