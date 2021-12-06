<?php

/*
 * https://adventofcode.com/2021/day/6
 *
 * A massive school of glowing lanternfish swims past. They must spawn quickly to reach such large numbers - maybe
 * exponentially quickly? You should model their growth rate to be sure.
 *
 * Although you know nothing about this specific species of lanternfish, you make some guesses about their attributes.
 * Surely, each lanternfish creates a new lanternfish once every 7 days.
 *
 * However, this process isn't necessarily synchronized between every lanternfish - one lanternfish might have 2 days
 * left until it creates another lanternfish, while another might have 4. So, you can model each fish as a single number
 * that represents the number of days until it creates a new lanternfish.
 *
 * A lanternfish that creates a new fish resets its timer to 6, not 7 (because 0 is included as a valid timer value).
 * The new lanternfish starts with an internal timer of 8 and does not start counting down until the next day.
 *
 * Find a way to simulate lanternfish. How many lanternfish would there be after 80 days?
 */

$input = file_get_contents('input.txt');
$fish = array_map('intval', explode(',', $input));

for ($day = 0; $day < 80; $day++) {
    $born = 0;

    foreach ($fish as &$timer) {
        if ($timer === 0) {
            $born++;
            $timer = 6;
        } else {
            $timer--;
        }
    }

    for ($i = 0; $i < $born; $i++) {
        $fish[] = 8;
    }

    echo "Day " . ($day + 1) . ": " . count($fish) . " fish\n";
}
