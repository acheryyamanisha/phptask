<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!doctype html>
<html>
<head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
      <div class="header">
    <?php  if (isset($_SESSION['username'])) : ?>
    <h5 id ="logout"> <a href="index.php?logout='1'" style="color: red;">logout</a> </h5>
      <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
 <h5 id ="logout"> <a href="index.php" style="color: red;">go back to index page</a> </h5>
    <?php endif ?>
</div>
<?php
if (isset($_POST['button']))
{
    $code = $_POST['code'];
include "github-creds.php"; // sets $access_token
ini_set('user_agent', "PHP"); // github requires this
$api = 'https://api.github.com';
$url = $api . '/gists'; // no user info because we're sending auth
// prepare the body data
$data = json_encode(array(
    'description' => 'Fetching the Textarea Values',
    'public' => 'true',
    'files' => array(
        'gist.txt' => array(
            'content' => $code
        )
    )
));
// set up the request context
$options = ["http" => [
    "method" => "POST",
    "header" => ["Authorization: token " . $access_token,
        "Content-Type: application/json"],
    "content" => $data
    ]];
$context = stream_context_create($options);
// make the request
$response = file_get_contents($url, false, $context);


}

?>
<form action="" method="post">
Code:
<textarea name="code" cols="25" rows="10"/> </textarea>
<input type="submit" name="button"/>
</form>
<div class="pager">
<?php
include('pager.php');
?>
</div>
</div>
</body>
</html>
