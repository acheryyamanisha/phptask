<?php
if ($_POST['submit']) {
  $name = $_POST['fullname'];
  echo "Hello $name";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>PHP Assignment</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
<form method='POST' action="<?php echo $_SERVER['PHP_SELF']; ?>">
  FIRST NAME : <input type="text" name="name" id ="fname"><br /><br />
  LAST NAME : <input type="text" name="name" id ="lname"><br /><br />
  FULL NAME : <input type="text" name="fullname" id ="fullname" readonly="readonly"><br /><br />
  <input type="submit" value="Submit the form" name="submit">
</form>


</script>


</body>
</html>
