<?php
//contains all the required credentials in this file
include("credentials.php");
$servername = $servername;
$username = $username;
$password = $password;
$dbname = $dbname;

$conn = new mysqli($servername, $username, $password, $dbname);
  $fname=$_POST['user_fname'];
  $lname=$_POST['user_lname'];
  $fullname=$_POST['user_fullname'];
  $number=$_POST['user_number'];
  $email=$_POST['user_email'];
  $message=$_POST['user_message'];

$emailBool = $numberBool = false;
//$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
/*fwrite($myfile, $fname);
fwrite($myfile, $lname);
fwrite($myfile, $fullname);
fwrite($myfile, $number);
fwrite($myfile, $email);*/
//fwrite($myfile, $message);

/*$txt = 'empty';
$txt1 = 'invalid';
$correct = "$number is valid";
$error = "$mobile is not valid";
$errornull = "Not valid";*/
$access_key = $access_key;

// set email address
$email_address = $email;
/*echo "Email id entered is : $email_address";
echo "<br>";*/
// Initialize CURL:
$ch = curl_init('http://apilayer.net/api/check?access_key='.$access_key.'&email='.$email.'');
//echo $ch;
//print_r($ch);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$validationResult = json_decode($json, true);
//echo "<pre>";print_r($validationResult);echo "<pre>";

// Access and use your preferred validation result objects
if ($validationResult['format_valid'] && $validationResult['smtp_check']) {
  # code...
  //echo "valid email id";
  $emailBool = true;
}
  /*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      //fwrite($myfile,$txt1);
    }*/
    else {
      //fwrite($myfile,$email);
      $emailBool = false;
    }

    $len = strlen($number);
switch ($len) {
  case '13':
    if (preg_match("/^([+][9][1])([6-9]{1})([0-9]{9})$/",$number)) {
      //fwrite($myfile,$correct);
      $numberBool = true;
    }
    else {
      //fwrite($myfile,$error);
      $numberBool = false;
    }
    break;
}
//fclose($myfile);

if($numberBool && $emailBool) {

$response=1;
$insert = "INSERT INTO employee_details (Firstname,Lastname,Fullname,phone_number,Email)
VALUES ('$fname','$lname','$fullname','$number','$email')";
$conn->query($insert);
 $array_data = explode(PHP_EOL, $message);
  foreach ($array_data as $key => $data) {
    $format_data = explode('|',$data);
    $final_data[trim($format_data[0])] = trim($format_data[1]);
    $sql = "INSERT INTO marks VALUES ('$fullname','$format_data[0]','$format_data[1]')";
    $conn->query($sql);
  }

echo (json_encode($response));
}
        elseif ($numberBool && !$emailBool) {
          $response=2;
          echo (json_encode($response));
        }


        elseif (!$numberBool && $emailBool) {
          $response=3;
          echo (json_encode($response));
        }

        else {
          $response=0;
          echo (json_encode($response));
        }

?>

