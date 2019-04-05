<!doctype html>
<html>
<head></head>
<body>
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
</body>
</html>
