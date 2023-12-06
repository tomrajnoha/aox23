<?php
    function quick_riplejs(string $text) {
        $new = $text;

        do {
            $old = $new;
            $new = preg_replace_callback(
                '/(zero|one|two|three|four|five|six|seven|eight|nine)/',
                function (array $matches): string {
                    if (count($matches) < 1) {
                        return '';
                    }
                    switch($matches[0]) {
                    case 'zero': return '0';
                    case 'one': return '1';
                    case 'two': return '2';
                    case 'three': return '3';
                    case 'four': return '4';
                    case 'five': return '5';
                    case 'six': return '6';
                    case 'seven': return '7';
                    case 'eight': return '8';
                    case 'nine': return '9';
                    }
                    return $matches[0];
                },
                $old,
                1
            );
        } while ($new !== $old);
        return $new;
    }

    function quick_sjelpir(string $text) {
        $new = strrev($text);

        do {
            $old = $new;
            $new = preg_replace_callback(
                '/(orez|eno|owt|eerht|ruof|evif|xis|neves|thgie|enin)/',
                function (array $matches): string {
                    if (count($matches) < 1) {
                        return '';
                    }
                    switch($matches[0]) {
                    case 'orez': return '0';
                    case 'eno': return '1';
                    case 'owt': return '2';
                    case 'eerht': return '3';
                    case 'ruof': return '4';
                    case 'evif': return '5';
                    case 'xis': return '6';
                    case 'neves': return '7';
                    case 'thgie': return '8';
                    case 'enin': return '9';
                    }
                    return $matches[0];
                },
                $old,
                1
            );
        } while ($new !== $old);
        return $new;
    }
