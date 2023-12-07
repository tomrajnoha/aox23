<?php
    /**
     * 1 = Five of a kind
     * 2 = Four of a kind
     * 3 = Full house
     * 4 = Three of a kind
     * 5 = Two pair
     * 6 = One pair
     * 7 = High card
     */
    function hand(string $hand): int
    {
        $jokers = 0;
        $cards = [
            '2' => 0,
            '3' => 0,
            '4' => 0,
            '5' => 0,
            '6' => 0,
            '7' => 0,
            '8' => 0,
            '9' => 0,
            'T' => 0,
//            'J' => 0,
            'Q' => 0,
            'K' => 0,
            'A' => 0,
        ];
        for ($i = 0; $i < strlen($hand); $i++) {
            if ($hand[$i] === 'J') {
                $jokers++;
                continue;
            }
            $cards[$hand[$i]]++;
        }
        $cards2 = array_filter($cards, function($v) { return $v > 0; });
        rsort($cards2);
        if (count($cards2) === 0) {
            return 1;
        }
        $cards2[0] += $jokers;

        // Five of a kind (AAAAA)
        if (count($cards2) === 1) {
            return 1;
        }
        // Four of a kind (AAAAB)
        if (count($cards2) === 2 && $cards2[0] === 4) {
            return 2;
        }
        // Full house (AAABB)
        if (count($cards2) === 2 && $cards2[0] === 3) {
            return 3;
        }
        // Three of a kind (AAABC)
        if (count($cards2) === 3 && $cards2[0] === 3) {
            return 4;
        }
        // Two pair (AABBC)
        if (count($cards2) === 3 && $cards2[0] === 2 && $cards2[1] === 2) {
            return 5;
        }
        // One pair (AABCD)
        if (count($cards2) === 4 && $cards2[0] === 2) {
            return 6;
        }
        // High card (ABCDE)
        if (count($cards2) === 5) {
            return 7;
        }
   
        throw new Exception('This is weird.');
        // return 0;
    }