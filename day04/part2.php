<?php
    $file_content = file_get_contents(__DIR__ . '/input');
    $file_content = preg_replace('/  +/', ' ', $file_content);
    $file_array = explode("\n", $file_content);

    $total = 0;
    $line_copies = [];
    foreach ($file_array as $line_no => $line) {
        $line_copies[$line_no] = 1;
    }
    foreach ($file_array as $line_no => $line) {
        $sep1 = explode(':', $line);
        $sep2 = explode('|', $sep1[1]);
        $winning = explode(' ', trim($sep2[0]));
        $actual = explode(' ', trim($sep2[1]));
        $happy = array_intersect($winning, $actual);
        if (count($happy) <= 0) {
            continue;
        }
        //echo "Line #{$line_no}:" . PHP_EOL;
        //echo json_encode(['winning' => $winning, 'actual' => $actual, 'intersect' => $happy, 'cnt' => count($happy)], JSON_PRETTY_PRINT) . PHP_EOL;
        for ($i = 1; $i <= count($happy); $i++) {
            $line_copies[$line_no+$i] += $line_copies[$line_no];
        }
    }
    echo json_encode($line_copies, JSON_PRETTY_PRINT) . PHP_EOL;
    foreach ($line_copies as $line_no => $oneline_copies) {
        $total += $oneline_copies;
    }

    echo $total . PHP_EOL;
