<?php
    require_once 'read_input.php';

    $races = read_input('input');

    $cnts = 1;
    foreach ($races as $race) {
        $counts = 0;
        $half = intval(floor($race['time']/2));
        for ($i = 0; $i <= intval(floor($race['time']/2)); $i++) {
            $dist = ($race['time']-$i)*$i;
            if ($dist <= $race['distance']) {
                continue;
            }
            $counts = ($half - $i + 1) * 2;
            break;
        }
        if ($race['time'] % 2 === 0) {
            $counts -= 1;
        }

        $cnts *= $counts;
    }

    echo $cnts . PHP_EOL;
