<!DOCTYPE html>
<html>
<head>
  <title>phone number validation</title>
</head>
<body>
<form method="POST" action="/phptask/task4.php">
  <input type="text" name="number">
  <input type="submit" name="submit" value="Submit">
</form>

<?php
if ($_POST['submit']) {
echo $_POST['submit'];
$mobile = $_POST["number"];
echo "<br> The number submitted is $mobile <br>";
$len = strlen($mobile);
echo "Length of the number is $len <br>";
switch ($len) {
  case '10':
    if (preg_match("/^[789]{1}\d{9}$/",$mobile)) {
      echo "$mobile is valid";
    }
    else {
      echo "not valid";
    }
    break;
  case '13':
    if (preg_match("/^([+][9][1])([6-9]{1})([0-9]{9})$/",$mobile)) {
      echo "$mobile is valid";
    }
    else {
      echo "not valid";
    }
    break;

  default:
    echo "not valid";
    break;
}
$mobile = null;
}
?>
</body>
</html>
