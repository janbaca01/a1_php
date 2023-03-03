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

function makeFile($time, $delay) {
    if ($delay === 'Meškanie') {
        $time_json = json_encode(array('time' => $time->format('Y-m-d H:i:s'), 'delay' => $delay)) . PHP_EOL;
    } else {
        $time_json = json_encode(array('time' => $time->format('Y-m-d H:i:s'))) . PHP_EOL;
    }
    file_put_contents('current_time.json', $time_json, FILE_APPEND);    
    echo 'Tvoj príchod na hodinu bol uložený!';
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