<!DOCTYPE html>
<html>
<head>
  <title>Email Validation</title>
  <style>
.error {
  color: red;
}
.correct {
  color: green;
}
</style>
</head>
<body>

  <?php
$emailErr = $emailCorr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  }
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
    else {
      $emailCorr = "Valid Email ID is Entered";
    }
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2> Email ID Validation</h2>
<p><span class="error">* invalid email</span></p>
<p><span class="correct">* valid email</span></p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Enter Your Valid Email : <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error"><?php echo $emailErr;?></span>
   <span class=correct><?php echo $emailCorr;?></span>
  <br /><br />
  <input type="submit" value="SUBMIT">
</form>

<?php
  echo $email;
?>
</body>
</html>
