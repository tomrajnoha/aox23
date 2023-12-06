<?php
    require_once 'sum.php';

    $content = file_get_contents(__DIR__ . '/input');
    echo sam($content) . PHP_EOL;
