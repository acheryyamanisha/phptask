<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .wrapper {
      text-align: center;
    }
    .btn-default {
      margin-left: 20px;
    }
    .bb {
      display: none;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <title></title>
</head>
<body>
  <div class="container div1">
    <?php

   //github api token
 include("github-creds.php");
$page = (isset($_GET['page'])) ? $_GET['page'] : 0;
 // We generate the url for curl
 $curl_url = "https://api.github.com/search/repositories?q=stars:%3E=10000&sort=stars&order=desc&per_page=".$per_page."&page=".($page+1)."&access_token=".$access_token;
 //echo $curl_url;
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

// now you could just foreach the repos and show them


/*echo $pages;*/
foreach(array_chunk($output,10,true) as $pages ) {

foreach($pages as $repo1)
{
    foreach($repo1 as $repo)
    {
      echo "<div class='wrapper'>";
     echo '<a class ="aaaa" href="' . $repo->html_url . '">' . $repo['name'] .'</a>'."  stars -> ".$repo['stargazers_count']."<button class='btn btn-default'>Click to see the repos</button>"."<br>";
     echo "<span class='bb'>".$repo['full_name']."</span>";
     echo "</div>";
     echo "<br>";
    }


}
}
//only first 1000 repo results are fetched(according to github developer (by default))
$total_pages = ceil(1000 / $per_page);
$prevpage = $page - 1;
$nextpage = $page + 1;

if ($page > 0)
{
   if($page < $total_pages -1)
   {
       $page_div = ' | ';

   }
   else
   {
       $page_div = '';
   }

   echo "<a href=\"?page={$prevpage}\">Prev</a>{$page_div}";
}

if ($nextpage < $total_pages)
{
 echo "<a href=\"?page={$nextpage}\">Next</a>";
}

?>
</div>

<script type="text/javascript">
   $(document).ready(function(){
     $(".wrapper button").click(function(){
        var name = $(this).siblings(".aaaa").text();
        var fullname  = $(this).siblings(".bb").text();
        $.ajax
      ({
      type: 'post',
      url: 'contributors.php?',
      data:
      {
        fullname:fullname

      },
      success: function (response)
      {
      window.open("contributors.php?fullname="+fullname);
        },
        failure: function(response){
          alert("failed");
        }
    });
    });
  });
  </script>
</body>
</html>
