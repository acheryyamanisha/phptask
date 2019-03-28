<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit Form Without Page Refresh</title>
<style>
* {
  margin:10px 0;
  outline: none;
  padding:0px;
  text-align:center;
  background: #191e21;
  color:#F8B068;
}

form {
  width: 470px;
  text-align: center;
  margin: 0 auto;
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
<h1 id="hello"></h1>
<h1>Submit Form Without Page Refresh</h1>
<div id="wrapper" style="border: 6px solid rgba(255,255,255,0.5); margin:40px auto; width:36%; padding:10px 45px 30px 20px">
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
 </body>
</html>
