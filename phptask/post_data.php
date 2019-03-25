<?php
$servername = "localhost";
$username = "root";
$password = "innoraft6995";
$dbname = "tasksix";

$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['user_fname']) && isset($_POST['user_email']) && isset($_POST['user_message']))
{
  $fname=$_POST['user_fname'];
  $lname=$_POST['user_lname'];
  $fullname=$_POST['user_fullname'];
  $number=$_POST['user_number'];
  $email=$_POST['user_email'];
  $message=$_POST['user_message'];

     $insert = "INSERT INTO employee_details (Firstname,Lastname,Fullname,phone_number,Email)
VALUES ('$fname','$lname','$fullname','$number','$email')";


    $conn->query($insert);
  $array_data = explode(PHP_EOL, $message);
  /*print_r($array_data);
   echo "<table border=1><caption>MARKSHEETS</caption><tr>
   <th>subject</th><th>marks</th></tr></table>";*/
  foreach ($array_data as $key => $data) {
    $format_data = explode('|',$data);
    //echo $format_data;
    $final_data[trim($format_data[0])] = trim($format_data[1]);
    echo "<table border=1><tr><td>$format_data[0]</td><td>$format_data[1]</td></tr></table>";
    $sql = "INSERT INTO marks VALUES ('$fullname','$format_data[0]','$format_data[1]')";
    $conn->query($sql);
}
}

?>

<!-- <?php

/*if(isset($_POST['submit'])){

header("Content-type: application/vnd.ms-word");

# replace Wordfile.doc with whatever you want the filename to default to

header("Content-Disposition: attachment;Filename=Wordfile.doc");

header("Pragma: no-cache");

header("Expires: 0");

$current_date = date('d-m-Y');
$heading = $_POST['fname'];

$content = $_POST['lname'];

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='right'>Report Date: current date is : $current_date</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> heading is : $heading</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'>$content</div>";;*/

//}

?> -->
