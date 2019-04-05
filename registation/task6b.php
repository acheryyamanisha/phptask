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
<title>Submit Form Without Page Refresh</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
* {
  margin:10px 0;
  outline: none;
  padding:0px;
  text-align:center;
  color:#ff7b03;
}

form {
  background: #191e21;
  width: 470px;
  text-align: center;
  margin: 0 auto;
}

#wrapper {
      border: 6px solid rgb(25, 30, 33);
    margin: 50px auto;
    width: 40%;
    padding: 20px 0 50px 0;
}

#wrapper input,#wrapper textarea {
  border: 2px solid #F5EEA2;
  width: 100%;
  margin-top: 1em;
  font-weight: 300;
  font-size: 16px;
  border-radius: 6px;
  padding:12px;
}

textarea {
  margin-bottom: 1em;
  height: 125px; }

   table {
      width:100%;
    }
    td,th {
      width:50%;
    }
    caption {
      border : 1px solid;
    }
    .msg , .msgs {
      display: none;
    }
    .error , .errornum {
      color: #FF4F68;
    }
    .correct , .correctnum {
      color: #6CE890;
    }

#submit {  color: white;   background-color: rgba(3,201,169,.8);  cursor: pointer; font-size:24px !important; }
#status, #status1 {text-align:center; font-size:24px; margin-top:20px; font-weight:bold}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
 function post()
{
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var fullname = document.getElementById("fullname").value;
  var number = document.getElementById("number").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;
  if(fname && lname && fullname && number && email && message)
  {
    $.ajax
    ({
      type: 'post',
      url: 'post_data.php',
      data:
      {
        user_fname:fname,
        user_lname:lname,
        user_fullname:fullname,
        user_number:number,
		    user_email:email,
		    user_message:message

      },
      success: function (response)
      {
        if(response == 1) {
	         document.getElementById("status").innerHTML="Form Submitted Successfully";
           alert("Download the form");
           window.open("export1.php?email="+email+"&lname="+lname+"&fname="+fname+"&fullname="+fullname+"&number="+number+"&message="+message);

          }
        if(response == 2) {
            document.getElementById("status1").innerHTML="Email Validation failed";
            alert('not submitted');
          }

        if(response == 3) {
            document.getElementById("status1").innerHTML="phone number Validation failed";
            alert('not submitted');
          }
          if(response == 0) {
            document.getElementById("status1").innerHTML="phone number and email Validation failed";
          }
      }
    });
    document.getElementById("hello").innerHTML="Hello  "+fullname;
  }
  return false;
}

</script>
<script type="text/javascript">
      $(document).ready(function(){
      $("#fname, #lname").keyup(function(){
        var str = "";
        var k=" ";
        $('#fname, #lname').each(function() {
          str += $(this).val()+k;
        });
      $('#fullname').val(str);
    });

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

$('input[name="number"]').blur(function () {
    var num = $(this).val();
var regex = /^([+][9][1])([6-9]{1})([0-9]{9})$/;
if (regex.test(num)) {
    $('.msgs').hide();
    $('.correctnum').show();
     $("#submit").removeAttr("disabled");
} else {
    $('.msgs').hide();
    $('.errornum').show();
     $("#submit").attr("disabled",true);
}
});
});

</script>
</head>
<body>
    <div class="header">
    <?php  if (isset($_SESSION['username'])) : ?>
    <h5 id ="logout"> <a href="index.php?logout='1'" style="color: red;">logout</a> </h5>
      <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
 <h5 id ="logout"> <a href="index.php" style="color: red;">go back to index page</a> </h5>
    <?php endif ?>
</div>
<h1 id="hello"></h1>
<h1>Submit Form Without Page Refresh</h1>
<div id="wrapper" style="border: 6px solid black; margin:50px auto; width:40%; padding:10px 0 40 10px">
<form method='POST' action="" onsubmit="return post();">
  First Name  <input type="text" id="fname" name="fname" class="input-box">

	Last Name  <input type="text" id="lname" name="lname"class="input-box">

  Full Name  <input type="text" id="fullname" name="fullname" readonly="readonly" class="input-box">

  Phone Number  <span class="msgs correctnum"> * Valid Number</span><span class="msgs errornum"> * Invalid Number</span><input type="text" name="number" id="number" class="input-box">

  Enter Your Valid Email  <span class="msg correct"> * Valid Email ID</span><span class="msg error"> * Invalid Email ID</span><input type="text" name="email" id="email" class="input-box">

	Comment <textarea id="message" name="subject"></textarea>

	<input type="submit" id="submit" value="Submit" name="submit">
</form>
<p id="status"></p>
<p id="status1"></p>
</div>
<div class="pager">
<?php
include('pager.php');
?>
</div>
 </body>
</html>
