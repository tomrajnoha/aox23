<?php
    require_once 'read_input.php';
    require_once 'hand_sort.php';
    require_once 'hand_sum.php';

    $data = read_input('input');
    hand_sort($data);
    $sum = hand_sum($data);

    echo $sum . PHP_EOL;
    // echo json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL;
