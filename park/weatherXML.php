<?php

// our URL as usual
$url = "https://samples.openweathermap.org/data/2.5/weather?q=London&mode=xml&appid=b6907d289e10d714a6e88b30761fae22";

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

$xml = simplexml_load_string($url);
print_r($xml);
?>