<?php
 
 
   $API_Key ='AIzaSyAUKxVCzlPiZg0ajs5NBRRx2EYemeH8rLQ';
    $API_Url ='https://www.googleapis.com/youtube/v3/';
    $channeid = 'UCJBQ_vxi_9N4Dr1Z64mfVtQ';
    $params = array(

        'part' =>'snippet,contentDetails,statistics',
        'id' => $channeid,
        'key' => $API_Key,
    );

$url =$API_Url.'channels?'.http_build_query($params);
 
$channelDetails = json_decode(file_get_contents($url),true);

$title = $channelDetails['items'][0]['snippet']['title'];
$thumb = $channelDetails['items'][0]['snippet']['thumbnails']['medium']['url'];
$subs = $channelDetails['items'][0]['statistics']['subscriberCount'];
$views = $channelDetails['items'][0]['statistics']['viewCount'];
$video = $channelDetails['items'][0]['statistics']['videoCount'];

$params = array(
    'part' => 'snippet,contentDetails',
    'playlistId' => $channelDetails['items'][0]['contentDetails']['relatedPlaylists']
    ['uploads'],
    'key' => $API_Key,
    'maxResults' => 500
);

$url =$API_Url.'playlistItems?'.http_build_query($params);
$playlistDetails = json_decode(file_get_contents($url),true);

$data = $playlistDetails['items'];


 
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Turacoz</title>
  </head>
  <body>
    
  <section class="container py-5 text-center">
    <div class="row mb-5" >
      <div class="col-6 mx-auto">
    <h1 class="mb-5"> YouTube Data</h1>
   
        </div>
    </div>


  <table class="table table-bordered" >
    <tr>
        <th> Channel Logo </th>
        <th> Channel Name </th>
        <th> Channel Subscribers </th>
        <th> Channel Views </th>
        <th> Channel Videos </th>
    </tr>
    <tr>
        <td><img src="<?php echo isset($thumb)? $thumb: ''?>" height="100px" alt=""> </td>
        <td><?php echo isset($title)? $title: ''?> </td>
        <td><?php echo isset($subs)? $subs: ''?> </td>
        <td><?php echo isset($views)? $views: ''?> </td> 
        <td><?php echo isset($video)? $video: ''?> </td>
    </tr>
  </table>
</section>

<section class="container" >
    <div class="row">
        <?php for($i=0;$i<count($data) ;$i++){
        
           // $id = $video ['contentDetails']['videoId'];?>
            <div class="col-4 mb-4">
         <iframe   width="380" height="315" 
src="https://www.youtube.com/embed/<?php echo trim($data[$i]["contentDetails"]["videoId"]); ?>?controls=0" 
allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture " allowfullscreen >
                </iframe>
            </div>
       <?php } ?>
    </div>
    </div>
</section>

  </body>
</html>