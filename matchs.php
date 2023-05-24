<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");
error_reporting(0);
ini_set('display_errors', 0);

$data = array(
'date' => str_replace('-','/',$_GET['data']),
'js_date' => 'Wed Nov 16 2022 00:00:00 GMT+0200 (Eastern European Standard Time)',
'is_ajax_request' => 'true',
'timezoneOffset' => $_GET['timezone']
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
));
$context  = stream_context_create($options);
$result = file_get_contents('https://www.yalla-sport.com/matches/ajax_cached_matches.php', false, $context);
if ($result === FALSE) { /* Handle error */ }

$data=['Matchs'=>str_replace(array('https://www.yalla-sport.com/matches','<a','/a>','class="current-scores"'),
array('','<div','/div>','class="current-scores" data-start="'.$_GET['data'].'T" data-end="'.$_GET['data'].'T"'),json_decode($result)->content),'data'=>$_GET['data'],'timezone'=>$_GET['timezone']];
print_r(json_encode($data));

  
?>