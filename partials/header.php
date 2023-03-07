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
            <div class="col-7 headline">
                <h1>
                    <?php echo 'Ahoj, študent'?>
                </h1>
            </div>
            <div class="col-5">
                <!-- výpis času -->
                <div class="row">
                    <p>Dnes je <?php echo $day = $time->format('l, j. M, Y') ?></p><br>
                    <p>Aktuálny čas je <?php echo  $current_time = $time->format('H:i:s') ?></p><br>

                    <!-- overenie času príchodu -->
                    <p>
                        <?php
                        // spúšťa sa funkcia die, dalej nepokračuje len sa vráti hláška príchode mimo možnosti uloženia logu
                        if ($current_time > '20:00:00' && $current_time < '23:59:59') {
                            $message = 'Je po 20:00, nie je možné zapísať príchod!';
                            die($message);
                        } 
                        // neskorý príchod posiela sa ako parameter do funkcie
                        elseif ($current_time > '08:00:00') {
                            $delay = true;
                        } 
                        // príchod načas, posiela sa ako parameter do funkcie
                        else {
                            $delay = false;
                        }

                        // messages z vnútra funkcie na základe zápisu/neúspešného zápisu, prípadného meškania/príchodu načas
                        $message = setTimeToFile($day, $current_time, $delay);
                        echo $message;
                        ?>
                    </p>
                </div>
            </div>
        </header>

        <!-- end header -->