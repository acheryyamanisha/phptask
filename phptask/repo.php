<?php
//github api token
 include("github-creds.php");

 // We generate the url for curl
 $curl_url = "https://api.github.com/search/repositories?q=stars:%3E=10000&sort=stars&order=desc&access_token=".$access_token;
// We make the actuall curl initialization
 $ch = curl_init($curl_url);

if (curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) &&  curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:PHP')))
  echo "<script>alert('if block working')</script>";

 // We execute the curl
 $output = curl_exec($ch);

 // And we make sure we close the curl
 curl_close($ch);

 // Then we decode the output and we could do whatever we want with it
 $output = json_decode($output,true);

// now you could just foreach the repos and show them
   foreach ($output['items'] as $repo ) {
     echo '<a href="' . $repo->html_url . '">'. $repo['name'] .'</a>'."  stars -> ".$repo['stargazers_count']."<br>";
   }
?>
