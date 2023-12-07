<?php
    function read_input(string $file): array {
        $return = [];

        $file_content = file_get_contents(__DIR__ . '/' . $file);
        $file_array = explode("\n", $file_content);
        $times = explode(" ", trim(preg_replace('/  +/', ' ', str_replace('Time:', '', $file_array[0]))));
        $distances = explode(" ", trim(preg_replace('/  +/', ' ', str_replace('Distance:', '', $file_array[1]))));

        foreach ($times as $key => $one_times) {
            $return[] = ['time' => intval($one_times), 'distance' => intval($distances[$key])];
        }

        return $return;
    }