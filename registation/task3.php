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
  <title>Task 3</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style >
    table {
      width:100%;
      font-size: 25px;
    }
    td,th {
      width:50%;
    }
    caption {
      border : 1px solid;
    }
  </style>
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
   <h3>Enter the marks of different subjects in this format : Subject|Marks and one subject in one line. </h3>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <textarea cols="40" rows="10" name="subject">
</textarea>
<br>
<input type="submit" name="submit" value="Submit">

</form>
<?php
if (isset($_POST['submit'])) {
    $suggestion = nl2br($_POST['subject']);

    $array_data = explode(PHP_EOL, $suggestion);
    $final_data = array();
    echo "<br><br>";
    echo "<table border=1><h3>MARKSHEETS</h3><tr>
  <th>subject</th><th>marks</th></tr></table>";
    foreach ($array_data as $data) {
        $format_data = explode('|', $data);
        $final_data[trim($format_data[0])] = trim($format_data[1]);
        echo "<table border=1><tr><td>$format_data[0]</td><td>$format_data[1]</td></tr></table>";
    }
}
?>
<div class="pager">
<?php
include('pager.php');
?>
</div>
</div>
</body>
</html>
