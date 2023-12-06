<?php
    $file_content = file_get_contents(__DIR__ . '/input');
    $file_content = preg_replace('/  +/', ' ', $file_content);
    $file_array = explode("\n", $file_content);

    $total = 0;
    foreach ($file_array as $line) {
        $sep1 = explode(':', $line);
        $sep2 = explode('|', $sep1[1]);
        $winning = explode(' ', trim($sep2[0]));
        $actual = explode(' ', trim($sep2[1]));
        $happy = array_intersect($winning, $actual);
        if (count($happy) <= 0) {
            continue;
        }
        $score = pow(2, count($happy)-1);
        $total += $score;
    }

    echo $total . PHP_EOL;