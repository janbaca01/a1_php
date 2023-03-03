<?php require_once './_inc/config.php' ?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <!-- StyleSheets -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="<?= vendor('twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= vendor('twbs/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <title>Príchody študentov</title>
</head>

<body>
    <div id='app' class="container">
        <!-- start header -->

        <header class="row">
            <div class="col-9">
                <h1>
                    <? echo 'Ahoj, študent'?>
                </h1>
            </div>
            <div class="col-3">
                <p>
                    <?php
                        date_default_timezone_set('Europe/Bratislava');

                        $simulatedTime = new DateTime();
                        $simulatedTime->setTimestamp(strtotime("2023-01-01 19:00:00"));
                        $time = $simulatedTime;
                        //$time = new DateTime();
                        
                        $formatted_day = $time->format('l, j. M, Y');
                        $formatted_time = $time->format('H:i:s');
                        
                        if ($time->format('H:i:s') > '20:00:00' && $time->format('H:i:s') < '23:59:59') {
                            die('Je po 20:00, nie je možné zapísať príchod!');
                        } elseif ($time->format('H:i:s') > '08:00:00') {
                            $delay = 'Meškanie';
                        } else {
                            $delay = '';
                        }
                        
                        echo 'Dnes je ' . $formatted_day;
                        echo '<br>';
                        echo 'Aktuálny čas je ' . $formatted_time . '.';
                        echo '<br>';
                        makeFile($time, $delay);
                    ?>
                </p>
            </div>
        </header>

        <!-- end header -->