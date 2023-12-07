<?php
    function hand_sort(array &$data): void
    {
        usort($data, function (mixed $a, mixed $b): int {
            $cards = [
                'J' => -1,
                '2' => 0,
                '3' => 1,
                '4' => 2,
                '5' => 3,
                '6' => 4,
                '7' => 5,
                '8' => 6,
                '9' => 7,
                'T' => 8,
                'Q' => 10,
                'K' => 11,
                'A' => 12,
            ];

            if ($a['hand'] < $b['hand']) {
                return 1;
            }
            if ($a['hand'] > $b['hand']) {
                return -1;
            }
            for ($i = 0; $i < 5; $i++) {
                if ($a['cards'][$i] === $b['cards'][$i]) {
                    continue;
                }
                $card_a = $cards[$a['cards'][$i]];
                $card_b = $cards[$b['cards'][$i]];

                return $card_a <=> $card_b;
            }
            return 0;
        });
    }