<?php
error_reporting(0);
?>

<html>
<head>
<title>PHP File Upload example</title>
</head>
<body>

<form action="accept-file.php" enctype="multipart/form-data" method="post">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1"> <br/>


</form>
<?php
$filename = $_FILES['file']['name'];
$tempname = $_FILES["file"]["tmp_name"];
$folder = 'uploads/'.$filename;
move_uploaded_file($tempname,$folder);
if(is_uploaded_file($_FILES['file']['tmp_name'])){
  echo "File :". $_FILES['file']['name']."uploaded successfully.\n";
}
else {
  echo "error";
}
echo "<img src='$folder' height=200 width=300 />";
?>

</body>
</html>
