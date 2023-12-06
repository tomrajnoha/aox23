<?php
    $file_content = file_get_contents(__DIR__ . '/input');
    $file_array = explode("\n", $file_content);

    $sum = 0;

    foreach($file_array as $file_line) {
        $game_id = 0;
        if (preg_match('/^Game (\d+)/', $file_line, $matches) === 1) {
            $game_id = intval($matches[1]);
        }

        $red = 0;
        if (preg_match_all('/(\d+) red/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $value = intval($one_match);
                if ($red === 0 || $value > $red) {
                    $red = $value;
                }
            }
        }

        $green = 0;
        if (preg_match_all('/(\d+) green/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $value = intval($one_match);
                if ($green === 0 || $value > $green) {
                    $green = $value;
                }
            }
        }

        $blue = 0;
        if (preg_match_all('/(\d+) blue/', $file_line, $matches) > 0) {
            foreach ($matches[1] as $one_match) {
                $value = intval($one_match);
                if ($blue === 0 || $value > $blue) {
                    $blue = $value;
                }
            }
        }

        $power = ($red*$green*$blue);
        printf('Game #%d: %d%s', $game_id, $power, PHP_EOL);
        $sum += $power;
    }

    echo $sum . PHP_EOL;