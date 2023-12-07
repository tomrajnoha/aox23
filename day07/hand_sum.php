<?php
    function hand_sum(array $data): int
    {
        $sum = 0;
        foreach ($data as $key => $one_data) {
            $sum += ($key+1)*intval($one_data['bid']);
        }
        return $sum;
    }