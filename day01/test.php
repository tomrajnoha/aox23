<?php
    require_once 'riplejs.php';
    require_once 'extract.php';
    require_once 'sum.php';

    $testsRiplejs = [
        'two1nine' => '219',
        'eightwothree' => '8wo3',
        'abcone2threexyz' => 'abc123xyz',
        'xtwone3four' => 'x2ne34',
        '4nineeightseven2' => '49872',
        'zoneight234' => 'z1ight234',
        '7pqrstsixteen' => '7pqrst6teen',
        'oneightwoneeighthreeight' => '1igh2ne8hre8',
    ];

    $testsEkstrakt = [
        '219' => 29,
        '8wo3' => 83,
        'abc123xyz' => 13,
        'x2ne34' => 24,
        '49872' => 42,
        'z1ight234' => 14,
        '7pqrst6teen' => 76,
        '1igh2ne8hre8' => 18,
    ];

    $testsSam = [
        'two1nine
        eightwothree
        abcone2threexyz
        xtwone3four
        4nineeightseven2
        zoneight234
        7pqrstsixteen' => 281,
    ];

    foreach ($testsRiplejs as $in => $expected) {
        $actual = quick_riplejs($in);
        if ($actual !== $expected) {
            printf(
                'Riplejs test failed!%1$sInput: "%2$s"%1$sExpected: "%3$s"%1$sActual: "%4$s"%1$s',
                PHP_EOL,
                $in,
                $expected,
                $actual
            );
            exit;
        }
    }

    foreach ($testsEkstrakt as $in => $expected) {
        $actual = ekstrakt($in);
        if ($actual !== $expected) {
            printf(
                'Ekstrakt test failed!%1$sInput: "%2$s"%1$sExpected: "%3$d"%1$sActual: "%4$d"%1$s',
                PHP_EOL,
                $in,
                $expected,
                $actual
            );
            exit;
        }
    }

    foreach ($testsSam as $in => $expected) {
        $actual = sam($in);
        if ($actual !== $expected) {
            printf(
                'Sam test failed!%1$sInput: "%2$s"%1$sExpected: "%3$d"%1$sActual: "%4$d"%1$s',
                PHP_EOL,
                $in,
                $expected,
                $actual
            );
            exit;
        }
    }

    echo 'All tests passed.' . PHP_EOL;
