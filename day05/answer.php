<?php
    $files = scandir(__DIR__);
    $contents = [];
    foreach ($files as $file) {
        if (str_starts_with($file, 'output_') !== true) {
            continue;
        }
        $file_content = file_get_contents(__DIR__ . '/' . $file);
        $contents[] = trim($file_content);
    }

    sort($contents);

    echo json_encode($contents, JSON_PRETTY_PRINT) . PHP_EOL;
    echo $contents[0] . PHP_EOL;
