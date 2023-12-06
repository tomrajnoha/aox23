<?php
    function ekstrakt(string $line): int
    {
        $line_clean = preg_replace('/[^\d]/', '', $line);
        if (strlen($line_clean) < 1) {
            return 0;
        }
        // $num_str = $line_clean[0] . $line_clean[strlen($line_clean)-1];
        $num_str = $line_clean[0];
        $num = intval($num_str);
        // if ($num < 10 || $num > 99) {
        //     throw new Exception('Not a two digit number for "' . $line . '"');
        // }
        return $num;
    }
