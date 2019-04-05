<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
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
    <h2>Login Here</h2>
  </div>
       <form action="login.php" method="post">
        <?php include('error.php'); ?>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="user" type="text" class="form-control" name="username" placeholder="Enter your username here">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="password" type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default" name="login_user">LOGIN</button>
          <p id="link">Not yet a member? <a href="register.php">Sign up</a>
          </p>
      </form>
  </div>
</body>
</html>
