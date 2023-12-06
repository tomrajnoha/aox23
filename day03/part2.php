<?php
    function find_gears(array $schema): array
    {
        $return = [];
        foreach ($schema as $line_no => $line) {
            $lastpos = 0;
            do {
                $pos = strpos($line, '*', $lastpos);
                if ($pos !== false) {
                    $lastpos = $pos+1;
                    $return[] = [
                        'row' => $line_no,
                        'col' => $pos,
                    ];
                }
            } while ($pos !== false);
        }
        return $return;
    }

    function is_numstr(string $str): bool
    {
        return in_array($str, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], true);
    }

    function discover_whole_num(array $schema, int $drow, int $dcol): string
    {
        $ret = $schema[$drow][$dcol];
        $tcol = $dcol;
        do {
            $tcol--;
            $bool = ($tcol >= 0 && is_numstr($schema[$drow][$tcol]));
            if ($bool) {
                $ret = $schema[$drow][$tcol] . $ret;
            }
        } while ($bool);
        $tcol = $dcol;
        do {
            $tcol++;
            $bool = ($tcol < strlen($schema[$drow]) && is_numstr($schema[$drow][$tcol]));
            if ($bool) {
                $ret .= $schema[$drow][$tcol];
            }
        } while ($bool);
        return $ret;
    }

    function find_parts_around(array $schema, array &$gears): int
    {
        $return = 0;
        foreach ($gears as &$gear) {
            $check = [
                [$gear['row']-1, $gear['col']-1],
                [$gear['row']-1, $gear['col']],
                [$gear['row']-1, $gear['col']+1],
                [$gear['row'], $gear['col']-1],
                [$gear['row'], $gear['col']+1],
                [$gear['row']+1, $gear['col']-1],
                [$gear['row']+1, $gear['col']],
                [$gear['row']+1, $gear['col']+1],
            ];
            $gear['parts'] = [];
            foreach ($check as $one_check) {
                $orow = $one_check[0];
                $ocol = $one_check[1];

                if ($orow < 0 || $orow >= count($schema)) {
                    continue;
                }
                if ($ocol < 0 || $ocol >= strlen($schema[$orow])) {
                    continue;
                }
                if (is_numstr($schema[$orow][$ocol]) !== true) {
                    continue;
                }
                $discovered = discover_whole_num($schema, $orow, $ocol);
                if (in_array($discovered, $gear['parts']) !== true) {
                    $gear['parts'][] = $discovered;
                }
            }
            $gear['parts'] = array_map(fn($v) => $v, array_unique($gear['parts']));
            if (count($gear['parts']) === 2) {
                if (($gear['parts'][1] ?? null) === null) {
                    echo json_encode($gear['parts']) . PHP_EOL;
                }
                $return += (intval($gear['parts'][0])*intval($gear['parts'][1]));
            }
        }
        return $return;
    }

    $schema_raw = file_get_contents(__DIR__ . '/input1');
    $schema_array = explode("\n", $schema_raw);

    $gears = find_gears($schema_array);
    $res = find_parts_around($schema_array, $gears);
    echo $res . PHP_EOL;