<?php

/*
 * https://adventofcode.com/2021/day/3
 *
 * The diagnostic report (your puzzle input) consists of a list of binary numbers which, when decoded properly,
 * can tell you many useful things about the conditions of the submarine. The first parameter to check is the
 * power consumption.
 *
 * You need to use the binary numbers in the diagnostic report to generate two new binary numbers
 * (called the gamma rate and the epsilon rate)
 *
 * Each bit in the gamma rate can be determined by finding the most common bit in the corresponding position
 * of all numbers in the diagnostic report
 *
 * The epsilon rate is calculated in a similar way; rather than use the most common bit, the least common bit
 * from each position is used.
 *
 * Use the binary numbers in your diagnostic report to calculate the gamma rate and epsilon rate, then multiply
 * them together. What is the power consumption of the submarine? (Be sure to represent your answer in decimal,
 * not binary.)
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$bitCounter = [];

foreach ($lines as $line) {
    for ($i = 0; $i < strlen($line); $i++) {
        // Check the bit at $i, shift `1` left $i times.
        // & (1_or_0 << n-1) where n is the bit to check, counting from the least significant.
        if (bindec($line) & (1 << $i)) {
            $bitCounter[$i][1] = ($bitCounter[$i][1] ?? 0) + 1;
        } else {
            $bitCounter[$i][0] = ($bitCounter[$i][0] ?? 0) + 1;
        }
    }
}

$gamma = '';
$epsilon = '';

foreach ($bitCounter as $position => $counts) {
    if ($counts[0] > $counts[1]) {
        $gamma .= 0;
        $epsilon .= 1;
    } else {
        $gamma .= 1;
        $epsilon .= 0;
    }
}

// Bitchecking above ran from least to most significant bits, so reverse the binary string
// to get back to the correct order.
$gamma = strrev($gamma);
$epsilon = strrev($epsilon);

echo 'Gamma: ' . $gamma . ', ' . bindec($gamma) . "\n";
echo 'Epsilon: ' . $epsilon . ', ' . bindec($epsilon) . "\n";
echo "\n";
echo 'Answer: ' . (bindec($gamma) * bindec($epsilon)) . "\n";
