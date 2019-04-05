<!DOCTYPE html>
<html>
<head>
  <title>mailbox api validation</title>
</head>
<body>
<?php
include("credentials.php");
if(isset($_POST['submit'])){
// set API Access Key
$access_key = $access_key;

// set email address
$email_address = $_POST['email'];
echo "Email id entered is : $email_address";
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
echo "<pre>";print_r($validationResult);echo "<pre>";

// Access and use your preferred validation result objects
if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
  # code...
  echo "valid email id";
}
else
echo "invalid email id";
;
print_r($validationResult['score']);
//print_r($validationResult['format_valid']);
//print_r($validationResult['smtp_check']);
}
?>

<form method="POST" action="">
  Email : <input type="text" name="email">
  <input type="submit" name="submit" value="submit">

</form>
</body>
</html>

