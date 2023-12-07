<?php
    function read_input(string $input): array
    {
        $return = [
            'seeds' => [],
            'maps' => [
                0 => [],
                1 => [],
                2 => [],
                3 => [],
                4 => [],
                5 => [],
                6 => [],
            ]
        ];

        $map_labels = [
            'seed-to-soil map:',
            'soil-to-fertilizer map:',
            'fertilizer-to-water map:',
            'water-to-light map:',
            'light-to-temperature map:',
            'temperature-to-humidity map:',
            'humidity-to-location map:',
        ];

        $array = explode("\n", $input);
        $map_pointer = null;
        foreach ($array as $line_no => $line) {
            if ($line_no === 0) {
                $seed_data = array_map('intval', explode(' ', trim(str_replace('seeds: ', '', $line))));
                $seed_data_idx = 0;
                while ($seed_data_idx < count($seed_data)) {
                    $return['seeds'][] = [$seed_data[$seed_data_idx], $seed_data[$seed_data_idx] + $seed_data[$seed_data_idx+1]-1];
                    $seed_data_idx += 2;
                }
                continue;
            }

            if (in_array($line, $map_labels, true) === true) {
                $map_pointer = array_search($line, $map_labels, true);
                continue;
            }

            if ($map_pointer === null) {
                continue;
            }

            if (strlen(trim($line)) === 0) {
                continue;
            }

            $exp_line = explode(' ', trim($line));
            $dest_start = intval($exp_line[0]);
            $src_start = intval($exp_line[1]);
            $len = intval($exp_line[2]);
            $return['maps'][$map_pointer][] = [
                'source' => [$src_start, $src_start+$len-1],
                'dest' => [$dest_start, $dest_start+$len-1],
            ];
        }

        return $return;
    }