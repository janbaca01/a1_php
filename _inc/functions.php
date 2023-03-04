<?php
/**
 * Asset
 * 
 * Create absolute URL asset file
 * 
 * @param $path
 * @param string $base
 * @return string
 */
function vendor ( $path, $base = BASE_URL.'/_inc/vendor/')
{
    $path = trim( $path, '/' );
    return filter_var( $base.$path, FILTER_SANITIZE_URL );
}

/**
 * *Vytvára JSON súbor s časom príchodu a ak sa jedná o meškanie
 * doplní do poľa "deley"
 *
 * @param DateTime $time - čas príchodu
 * @param boolean $delay - indikátor meškania
 * @return string - text na základe úspešného/neúspešného zápisu do súboru
 */
function setTimeToFile($time, $delay) {

    // $deley sa overuje mimo funkcie posiela sa ako parameter do vnútra funkcie
    if ($delay == true) {
        $time_json = json_encode([
            'time'  => $time->format('Y-m-d H:i:s'),
            'delay' => 'Meškanie'
        ]) .PHP_EOL;
        $message = 'Tvoj príchod na hodinu bol uložený! Ale meškáš.';
    } else {
        $time_json = json_encode([
            'time'  => $time->format('Y-m-d H:i:s')
        ]) .PHP_EOL;
        $message = 'Tvoj príchod na hodinu bol uložený! Prišiel si načas.';
    }
    
    // zápis do súboru
    $result = file_put_contents('current_time.json', $time_json, FILE_APPEND);

    // spúšťa sa ak sa nepodarí zápis do logu
    if ($result === false) {
        $message = 'Chyba pri zápise súboru!';
    }
    
    return $message;
}



function getLogs() {
    $file = 'current_time.json';
    // Získa obsah súboru
    $file_contents = file_get_contents($file);

    // Dekóduje JSON na asoc. pole
    $data = json_decode($file_contents, true);

    // Ak sa podarilo dekódovať JSON súbor, pokračuje výpisom záznamov
    if ($data !== null) {
        // Prechádza cez všetky záznamy v poli $data
        foreach ($data as $entry) {
            // Skontroluje, či existuje index 'time' v poli $entry
            if (isset($entry['time'])) {
                // Vypíše čas
                echo 'Čas: ' . $entry['time'] . '<br>';
            }

            // Skontroluje, či existuje index 'delay' v poli $entry
            if (isset($entry['delay'])) {
                // Vypíše meškanie
                echo 'Meškanie: ' . $entry['delay'] . '<br>';
            }

            // Vypíše oddelovač
            echo '--------------------------<br>';
        }
    } else {
        // Ak sa nepodarilo dekódovať JSON súbor, vypíše chybu
        echo 'Nepodarilo sa získať záznamy.<br>';
    }
}







// sprav logovac prichodov studentov
// - sprav zakladny php skript, ktory vypise ahoj
// - vypis aktualny datum a cas naformatovany
// - ukladaj aktualny datum a cas do suboru (ak uz v subore existuje datum a cas, novy cas sa pripise), kazdy zaznam daj na novy riadok
// - getuj obsah log suboru a vypis ho
// - sprav tie veci co tu su cez funkcie ktore budu pomenovavat co sa robi, napriklad na ziskanie dat zo suboru nazves funkciu getLogs()
// - ak prisiel student po 8:00, tak dopis do logu za cas dopis  string "meskanie"
// - sprav premennu v ktorej vyhodnotis ci nastalo meskanie a tuto premennu posileaj ako parameter do funkcie ktora zapisuje logy do suboru
// - ak pride student medzi 20-24, tak vyhod chybu cez die, ze nemoze sa dany prichod zapisat