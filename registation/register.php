<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration page</title>
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
    <h2>Register Here</h2>
  </div>
       <form action="register.php" method="post">
        <?php include('error.php'); ?>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="user" type="text" class="form-control" name="username" placeholder="Enter your name here" value="<?php echo $username;?>">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input id="email" type="text" class="form-control" name="email" placeholder="Email ID" value="<?php echo $email;?>"><span class="msg error"> * Invalid Email ID</span>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password" type="password" class="form-control" name="password_1" placeholder="Password">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password" type="password" class="form-control" name="password_2" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-default" name="reg_user" id="submit">Register</button>
          <p id="link">Already a member? <a href="login.php">Sign in</a>
          </p>
      </form>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
            $('input[name="email"]').blur(function () {
    var email1 = $(this).val();
var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
if (re.test(email1)) {
    $('.msg').hide();
    $('.correct').show();
    $("#submit").removeAttr("disabled");
} else {
    $('.msg').hide();
    $('.error').show();
    $("#submit").attr("disabled",true);
}
 });
    });
  </script>
</body>
</html>
