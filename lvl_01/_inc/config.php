<?php

// show all errors
//ini_set('displeay_startup_errors', 'On');
//ini_set('display_errors', 'On');
//error_reporting(-1);

//$simulatedTime sa používa len pre testovanie
//$simulatedTime = new DateTime();
//$simulatedTime->setTimestamp(strtotime("2023-01-01 20:10:00"));
//$time = $simulatedTime;

// require stuff
require_once 'vendor/autoload.php';

// global functions
require_once 'functions.php';

// constants & settings
define( 'BASE_URL', '/kurzy/openlab_akademia/a1_php' );

date_default_timezone_set('Europe/Bratislava');

// do premennej $time sa ukladá akutálny čas, podľa časovej zony 'Europe/Bratislava'
$time = new DateTime();

// naformátovany deň
$day = $time->format('l, j. M, Y');

// naformátovany čas
$current_time = $time->format('H:i:s');

// meškanie, posiela sa ako parameter do funkcie
if ($current_time > '08:00:00') {
    $delay = true;
} 
// príchod načas, posiela sa ako parameter do funkcie
else {
    $delay = false;
}

// premenná pre výpis správy z funkcie
$message = 'Ups! Dáta sa nepodarilo získať.';