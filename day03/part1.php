<?php
    function find_numbers(array $schema): array
    {
        $return = [];
        foreach ($schema as $line_no => $line) {
            $flag = false;
            $tmp = [];
            for ($i = 0; $i < strlen($line); $i++) {
                if (in_array($line[$i], ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], true)) {
                    if ($flag === false) {
                        $flag = true;
                        $tmp = [
                            'row' => $line_no,
                            'col' => $i,
                            'str' => '',
                            'len' => 0,
                            'num' => 0,
                        ];
                    }
                    $tmp['str'] .= $line[$i];
                    continue;
                }
                if ($flag === true) {
                    $tmp['len'] = strlen($tmp['str']);
                    $tmp['num'] = intval($tmp['str']);
                    $return[] = $tmp;
                    $tmp = [];
                    $flag = false;
                }
            }
        }

        if ($flag === true) {
            $tmp['len'] = strlen($tmp['str']);
            $tmp['num'] = intval($tmp['str']);
            $return[] = $tmp;
            $tmp = [];
            $flag = false;
        }

        return $return;
    }

    function chars_around(int $row, int $col, int $len, array $schema): string
    {
        $result = '';

        //up
        if ($row > 0) {
            $result .= substr($schema[$row-1], $col, $len);
        }
        //up left
        if ($row > 0 && $col > 0) {
            $result .= substr($schema[$row-1], $col-1, 1);
        }
        //up right
        if ($row > 0 && ($col+$len) < strlen($schema[$row-1])) {
            $result .= substr($schema[$row-1], $col+$len, 1);
        }
        //down
        if ($row < (count($schema)-1)) {
            $result .= substr($schema[$row+1], $col, $len);
        }
        //down left
        if ($row < (count($schema)-1) && $col > 0) {
            $result .= substr($schema[$row+1], $col-1, 1);
        }
        //down right
        if ($row < (count($schema)-1) && ($col+$len) < strlen($schema[$row+1])) {
            $result .= substr($schema[$row+1], $col+$len, 1);
        }
        //left
        if ($col > 0) {
            $result .= substr($schema[$row], $col-1, 1);
        }
        //right
        if (($col+$len) < strlen($schema[$row])) {
            $result .= substr($schema[$row], $col+$len, 1);
        }

        return $result;
    }

    function scan_parts(array $schema, array &$numbers): void
    {
        foreach ($numbers as &$number) {
            $number['rnd'] = str_replace('.', '', chars_around($number['row'], $number['col'], $number['len'], $schema));
        }
    }

    function sum_parts(array $schema, array $numbers): int
    {
        $result = 0;
        foreach ($numbers as $number) {
            if (strlen($number['rnd']) > 0) {
                $result += $number['num'];
            }
        }
        return $result;
    }

    // $schema_raw = file_get_contents(__DIR__ . '/test_input_1');
    // $schema_raw = file_get_contents(__DIR__ . '/test_input_2');
    $schema_raw = file_get_contents(__DIR__ . '/input1');
    $schema_array = explode("\n", $schema_raw);
    $hehehe = find_numbers($schema_array);
    scan_parts($schema_array, $hehehe);
    file_put_contents(__DIR__ . '/numbers.json', json_encode($hehehe, JSON_PRETTY_PRINT));
    $hahaha = sum_parts($schema_array, $hehehe);
    echo $hahaha . PHP_EOL;
