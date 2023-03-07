<?php 
date_default_timezone_set('Europe/Bratislava');

//$simulatedTime sa používa len pre testovanie
//$simulatedTime = new DateTime();
//$simulatedTime->setTimestamp(strtotime("2023-01-01 07:10:00"));
//$time = $simulatedTime;
// do premennej $time sa ukladá akutálny čas, podľa časovej zony nastavenej v config.php
$time = new DateTime();


// show all errors
ini_set('displeay_startup_errors', 'On');
ini_set('display_errors', 'On');
error_reporting(-1);

// require stuff
require_once 'vendor/autoload.php';

// constants & settings
define( 'BASE_URL', '/kurzy/openlab_akademia/a1_php' );

// global functions
require_once 'functions.php';