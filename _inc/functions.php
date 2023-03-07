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
 * @param string $day - dátum príchodu
 * @param string $current_time - čas príchodu
 * @param boolean $delay - indikátor meškania
 * @return string - text na základe úspešného/neúspešného zápisu do súboru
 */
function setTimeToFile($day, $current_time, $delay) {
    $arrival = [
        'arrival' => [
            [   
                'day' => $day,
                'time' => $current_time,
                'delay' => $delay ? 'Meškanie' : null
            ]
        ]
    ];
    
    if ($delay === '') {
        unset($arrival['arrival'][0]['delay']);
    }
    
    // načítanie existujúceho obsahu súboru (ak existuje)
    $current_data = [];
    if (file_exists('current_time.json')) {
        $current_data = json_decode(file_get_contents('current_time.json'), true);
    }
    
    // pridanie nového záznamu
    $current_data[] = $arrival['arrival'][0];
    
    // zápis do súboru
    $json_data = json_encode($current_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $result = file_put_contents("current_time.json", $json_data);
    // spúšťa sa ak sa nepodarí zápis do logu
    if ($result === false) {
        $message = 'Chyba pri zápise súboru!';
    } 
    // spúšťa sa ak sa podarí zápis do logu
    else {
        $message = 'Tvoj príchod na hodinu bol uložený!';
    }

    return $message;
}


/**
* Funkcia na získanie záznamov z JSON súboru a ich zobrazenie v tabuľke
*
*@return void - funkcia vypisuje HTML kód pre zobrazenie záznamov
*/
function getLogs() {
    $file = file_get_contents('current_time.json');
    $data = json_decode($file, true);

    
    if (!empty($data)) {
    echo '<table class="styled-table">';
    echo '<thead><tr><th>Dátum</th><th>Čas</th><th>Meškanie</th></tr></thead>';
    echo '<tbody>';
    foreach ($data as $arrive) {
        echo '<tr>';
        echo '<td>' . $arrive['day'] . '</td>';
        echo '<td>' . $arrive['time'] . '</td>';
        echo '<td>' . $arrive['delay'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    }  else {
        // Ak nemáme žiadne záznamy, vypíšeme chybu
        echo '<table class="styled-table">';
        echo '<thead><tr><th>Dátum</th><th>Čas</th><th>Meškanie</th></tr></thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>Nepodarilo sa získať záznamy.</td>';
        echo '</tr>';
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