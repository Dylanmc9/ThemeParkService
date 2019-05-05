<?php

// our URL as usual
$url = "https://touringplans.com/magic-kingdom/attractions.json";
$url1 = "http://api.openweathermap.org/data/2.5/weather?q=dublin&units=metric&appid=2da3dbc8ea6a0bcc5279a5671419581d";

// set up the HTTP request context
$opts = array(
  'http'=>array(
    'method'=>"GET",
    //header' => "Client-Key: 2da3dbc8ea6a0bcc5279a5671419581d"                 
  )
);
$context = stream_context_create($opts);

// make the request using the context
$json_data = file_get_contents($url, false, $context);

print $json_data;

?>