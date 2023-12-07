<?php
    function run_maps(array $data): void//: int
    {
        $loc = 0;
        //$seedgrp = 0;

        // foreach ($data['seeds'] as $seed_data) {
        //     echo date('c') . " - seed group #{$seedgrp}" . PHP_EOL;
        //     $seedgrp++;
        for ($seed = $data['seeds'][0][0]; $seed <= $data['seeds'][0][1]; $seed++) {
            //echo "Seed {$seed}";
            $src = $seed;
            foreach ($data['maps'] as $map) {
                // $newsrc = $src;
                foreach ($map as $mapping) {
                    if ($src >= $mapping['source'][0] && $src <= $mapping['source'][1]) {
                        $src = $mapping['dest'][0] + ($src-$mapping['source'][0]);
                        break;
                    }
                }

                //echo " => {$src}";
            }
            //echo PHP_EOL;
            if ($loc === 0 || $src < $loc) {
                $loc = $src;
            }
        }
        // }

        file_put_contents(__DIR__ . '/output_' . $data['seeds'][0][0] . '.json', json_encode($loc));
        // return $loc;
    }
