<?php

/*
 * https://adventofcode.com/2021/day/1
 *
 * On a small screen, the sonar sweep report (your puzzle input) appears: each line is a measurement of the sea
 * floor depth as the sweep looks further and further away from the submarine.
 *
 * The first order of business is to figure out how quickly the depth increases, just so you know what you're
 * dealing with - you never know if the keys will get carried into deeper water by an ocean current or a fish
 * or something.
 *
 * To do this, count the number of times a depth measurement increases from the previous measurement.
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$count = 0;

for ($i = 1; $i < count($lines); $i++) {
    if ($lines[$i-1] < $lines[$i]) {
        $count++;
    }
}

echo $count . "\n";
