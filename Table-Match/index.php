<?php

require 'simple_html_dom.php';

$yesterdayUrl = 'https://stad.yalla-shoot.io/matches-yesterday7/'; 
$todayUrl = 'https://stad.yalla-shoot.io/today-matches/';
$tomorrowUrl = 'https://stad.yalla-shoot.io/matches-tomorrow7/';


$yesterdayHtml = file_get_html($yesterdayUrl); 
$todayHtml = file_get_html($todayUrl); 
$tomorrowHtml = file_get_html($tomorrowUrl); 


$yesterdayMatches = $yesterdayHtml->find('.albaflex');
$todayMatches = $todayHtml->find('.albaflex'); 
$tomorrowMatches = $tomorrowHtml->find('.albaflex'); 


$yesterdayData = array(); 
$todayData = array();
$tomorrowData = array(); 


if (!empty($yesterdayMatches)) {
    foreach ($yesterdayMatches as $match) {
        $yesterdayData[] = $match->outertext; 
    }
}

if (!empty($todayMatches)) {
    foreach ($todayMatches as $match) {
        $todayData[] = $match->outertext; 
    }
}

if (!empty($tomorrowMatches)) {
    foreach ($tomorrowMatches as $match) {
        $tomorrowData[] = $match->outertext; 
    }
}



$jsonData = json_encode(array('yesterday' => $yesterdayData, 'today' => $todayData, 'tomorrow' => $tomorrowData), JSON_UNESCAPED_UNICODE); // تحويل المصفوفة إلى JSON مع تصحيح النص


header('Content-Type: application/json');

echo $jsonData; 


?>
