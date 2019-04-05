<!DOCTYPE html>
<html>
<head>
  <title>task 6</title>
  <style type="text/css">
    body {
    background: #a0ab3291;
    }
    table {
      width:100%;
    }
    td,th {
      width:50%;
    }
    caption {
      border : 1px solid;
    }
    .error {
      color: red;
    }
    .correct {
      color: green;
    }
  </style>

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
  <?php
  if (isset($_POST['submit'])) {
  $name = $_POST['fullname'];
  echo "<h1>Hello $name</h1>";
}
//contains all the required credentials in this file
include("credentials.php");
$servername = $servername;
$username = $username;
$password = $password;
$dbname = $dbname;

  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER['REQUEST_METHOD']=="POST"){
//to fetch data from html form
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fullname = $_POST['fullname'];
$number = $_POST['number'];
$email = $_POST['email'];
$text = $_POST['subject'];
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    //email validation
$emailErr = $emailCorr = $error = $correct = "";

if (isset($_POST['submit'])) {

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
//mobile
$mobile = $_POST["number"];
$len = strlen($mobile);
switch ($len) {
  case '13':
    if (preg_match("/^([+][9][1])([6-9]{1})([0-9]{9})$/",$mobile)) {
      $correct = "$mobile is valid";
    }
    else {
      $error = "$mobile is not valid";
    }
    break;

  default:
    $errornull = "Not valid";
    break;
}



//inserting data into database
$insert = "INSERT INTO employee_details (First_name,Last_name,Fullname,Phone_number,email)
VALUES ('$fname','$lname','$fullname','$number','$email')";



if ($conn->query($insert) === TRUE) {
    echo "New record created successfully";
}

//textbox fetching data into table
  //$suggestion = preg_replace('/\s/', '', nl2br($_POST['subject']));
  //echo $_POST['subject'];
  // $array_data = preg_split('/\n/', $suggestion);
  // echo $suggestion;
  // print_r($array_data);
  // $final_data = array();
  $array_data = explode(PHP_EOL, $_POST['subject']);
  //print_r($array_data);
   echo "<table border=1><caption>MARKSHEETS</caption><tr>
   <th>subject</th><th>marks</th></tr></table>";
  foreach ($array_data as $key => $data) {
    $format_data = explode('|',$data);
    //echo $format_data;
    $final_data[trim($format_data[0])] = trim($format_data[1]);
    echo "<table border=1><tr><td>$format_data[0]</td><td>$format_data[1]</td></tr></table>";
    $sql = "INSERT INTO marks VALUES ('$fullname','$format_data[0]','$format_data[1]')";
    $conn->query($sql);
    //echo $sql;
    //if ($conn->query($sql) === TRUE) {
      //echo "New record created successfully";
    //}
  }
}
?>
  <h1>Fill the details in the form</h1>
<form id="myForm" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
  First Name : <input type="text" id="fname" name="fname" placeholder="John" value="<?php echo $fname;?>"><br><br>
  Last Name : <input type="text" id="lname" name="lname" placeholder="Davis" value="<?php echo $lname;?>"><br><br>
  Full Name : <input type="text" id="fullname" name="fullname" readonly="readonly" placeholder="cannot be modified by user" value="<?php echo $fullname;?>"><br><br>
  Phone Number : <input type="text" name="number" value="<?php echo $mobile;?>" placeholder="add country code first"><span class=correct><?php echo $correct;?></span><span class="error"><?php echo $error;?></span><span class="error"><?php echo $errornull;?></span>
 <br><br>
  Enter Your Valid Email : <input type="text" name="email" value="<?php echo $email;?>" placeholder="abc@xyz.pqr" >
   <span class="error"><?php echo $emailErr;?></span>
   <span class=correct><?php echo $emailCorr;?></span>
  <br /><br />
  Comment : <textarea cols="40" rows="10" name="subject" placeholder="Enter the marks of different subjects in this format : Subject|Marks and one subject in one line." value="<?php echo $_POST['subject'];?>">
</textarea>
<br><br>
  <input id="sub" type="submit" name="submit" value="SUBMIT">
</form>
<span id="result"></span>
</body>
</html>
