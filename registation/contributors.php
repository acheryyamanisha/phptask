<?php
//github api token
 include("github-creds.php");
 //fetching fullname for api call to get contributors
$fullname=$_GET['fullname'];
 // We generate the url for curl
 $curl_url = "https://api.github.com/repos/". $fullname."/contributors?per_page=100&access_token=".$access_token;
// We make the actuall curl initialization
 $ch = curl_init($curl_url);

if (curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) &&  curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:PHP')))
  //echo "<script>alert('if block working')</script>";

 // We execute the curl
 $output = curl_exec($ch);

 // And we make sure we close the curl
 curl_close($ch);

 // Then we decode the output and we could do whatever we want with it
 $output = json_decode($output,true);
 //print_r($output);



// now you could just foreach the repos and show them
   echo "Contributors are : <br>";
   foreach ($output as $repo ) {
     echo $repo['login']."<br>";

   }

?>
