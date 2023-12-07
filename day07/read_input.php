<?php
    require 'hand.php';
    function read_input(string $file): array
    {
        $return = [];
        $file_content = file_get_contents(__DIR__ . '/' . $file);
        $file_array = explode("\n", $file_content);

        foreach ($file_array as $line) {
            $line_data = explode(" ", $line);
            $hand = hand($line_data[0]);
            $return[] = [
                'cards' => $line_data[0],
                'bid' => $line_data[1],
                'hand' => $hand,
            ];
        }

        return $return;
    }