<!DOCTYPE html>
<html>
<head>
  <title>Task 3</title>
  <style >
    table {
      width:100%;
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
   <p>Enter the marks of different subjects in this format : Subject|Marks and one subject in one line. </p>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <textarea cols="40" rows="10" name="subject">
</textarea>
<br>
<input type="submit" name="submit" value="Submit">

</form>



<?php
if (isset($_POST['submit'])){
  $suggestion = nl2br($_POST['subject']);

  $array_data = explode(PHP_EOL, $suggestion);
$final_data = array();
echo "<br><br>";
echo "<table border=1><caption>MARKSHEETS</caption><tr>
  <th>subject</th><th>marks</th></tr></table>";
foreach ($array_data as $data){
    $format_data = explode('|',$data);
    $final_data[trim($format_data[0])] = trim($format_data[1]);
    echo "<table border=1><tr><td>$format_data[0]</td><td>$format_data[1]</td></tr></table>";
}
}
?>

</body>
</html>
