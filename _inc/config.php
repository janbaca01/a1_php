<?php 
date_default_timezone_set('Europe/Bratislava');


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