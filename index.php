<?php

require_once('class/OpenWeather.php');
require_once('class/CityMapper.php');
require_once('class/DisplayContent.php');


$weather = new OpenWeather('43cebb6f101584f15a47a1581d009ee7');
$forecast = $weather->getForecast('saclay,fr', '5');
$today = $weather->getToday('saclay, fr');


$cityMapper = new cityMapper('ab74fda8f137038566a7bb1253b533de');
$travel = $cityMapper->getTimeBetweenTwoPoints('Gare de Vauboyen', '48.7591376,2.1897711', 'Massy-Palaiseau RER, Massy', '48.7252492,2.2584772');

if(is_null($today) || is_null($forecast) || is_null($travel)) {
    echo 'L\'API d\'OpenWeather ou de CityMapper ne réponds pas :( Revenez plus tard !';
    return '';
}


$inputData = [
    'pageInfo' => [
            'title' => 'JD API',
            'h1page' => 'Bonjour Jonathan,',
    ],
    'openWeather' => [
            'today' => $today,
            'forecast' => $forecast,
    ],
    'cityMapper' => [
            'travel' => $travel
    ]

];

$displayContent = new DisplayContent($inputData);
$data = $displayContent->getData();


require_once('page/template.php');
?>
