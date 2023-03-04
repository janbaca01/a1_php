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
                    <?php echo 'Ahoj, študent'?>
                </h1>

                <p>
                    <?php echo getLogs(); ?>
                </p>


            </div>
            <div class="col-3">
                <p>
                    <?php
                        //$simulatedTime sa používa len pre testovanie
                        $simulatedTime = new DateTime();
                        $simulatedTime->setTimestamp(strtotime("2023-01-01 17:10:00"));
                        $time = $simulatedTime;
                        //$time = new DateTime();

                        // do premennej $time sa ukladá akutálny čas, podľa časovej zony nastavenej v config.php
                        //$time = new DateTime();

                        //formátovenie času pre výpis na stránke
                        $formatted_day = $time->format('l, j. M, Y');
                        $formatted_time = $time->format('H:i:s');
                        
                        // výpis času
                        echo 'Dnes je ' . $formatted_day;
                        echo '<br>';
                        echo 'Aktuálny čas je ' . $formatted_time . '.';
                        echo '<br><br>';

                        // overenie času príchodu
                        // spúšťa sa funkcia die, dalej nepokračuje len sa vráti hláška príchode mimo možnosti uloženia logu
                        if ($time->format('H:i:s') > '20:00:00' && $time->format('H:i:s') < '23:59:59') {
                            $message = 'Je po 20:00, nie je možné zapísať príchod!';
                            die($message);
                        } 
                        // neskorý príchod posiela sa ako parameter do funkcie
                        elseif ($time->format('H:i:s') > '08:00:00') {
                            $delay = true;
                        } 
                        // príchod načas, posiela sa ako parameter do funkcie
                        else {
                            $delay = false;
                        }

                        // messages z vnútra funkcie na základe zápisu/neúspešného zápisu, prípadného meškania/príchodu načas
                        $message = setTimeToFile($time, $delay);
                        echo $message;
                    ?>
                </p>
            </div>
        </header>

        <!-- end header -->