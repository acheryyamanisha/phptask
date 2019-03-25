<?php

if(isset($_POST['submit'])){
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=Task7.doc");
header("Pragma: no-cache");

header("Expires: 0");

$current_date = date('d-m-Y');
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$fullname = $_POST['fullname'];
$number = $_POST['number'];
$email = $_POST['email'];
$text = $_POST['subject'];

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> First Name is : $fname</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> Last Name is : $lname</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> Full Name is : $fullname</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> Mobile Number is : $number</div>";;
echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> Email Id is : $email</div>";

echo "<div style='font-size: 1em; line-height: 1.6em; color: #4E6CA3; padding:10px;' align='left'> Comment is : $text</div>";
}
?>
