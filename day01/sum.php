<?php
    require_once 'riplejs.php';
    require_once 'extract.php';

    function sam(string $text): int
    {
        // $content = quick_riplejs($text);
        $content = $text;
        $arr = explode("\n", $content);
        $sum = 0;
    
        foreach($arr as $line) {
            $line2 = quick_riplejs($line);
            $digit1 = ekstrakt($line2);
            $line3 = quick_sjelpir($line);
            $digit2 = ekstrakt($line3);
            $sum += $digit1*10+$digit2;
        }

        return $sum;
    }