<?php
    $file_content = file_get_contents(__DIR__ . '/input');
    $file_array = explode("\n", $file_content);

    $sum = 0;

    foreach($file_array as $file_line) {
        $game_id = 0;
        if (preg_match('/^Game (\d+)/', $file_line, $matches) === 1) {
            $game_id = intval($matches[1]);
        }

        $possible = true;

        if (preg_match_all('/(\d+) red/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $possible = $possible && (intval($one_match) <= 12);
                if ($possible !== true) {
                    break;
                }
            }
        }
        if ($possible !== true) {
            continue;
        }

        if (preg_match_all('/(\d+) green/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $possible = $possible && (intval($one_match) <= 13);
                if ($possible !== true) {
                    break;
                }
            }
        }
        if ($possible !== true) {
            continue;
        }

        if (preg_match_all('/(\d+) blue/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $possible = $possible && (intval($one_match) <= 14);
                if ($possible !== true) {
                    break;
                }
            }
        }
        if ($possible !== true) {
            continue;
        }

        $sum += $game_id;
    }

    echo $sum . PHP_EOL;