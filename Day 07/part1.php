<?php

/*
 * https://adventofcode.com/2021/day/7
 *
 * Suddenly, a swarm of crabs (each in its own tiny submarine - it's too deep for them otherwise) zooms in to
 * rescue you! They seem to be preparing to blast a hole in the ocean floor; sensors indicate a massive
 * underground cave system just beyond where they're aiming!
 *
 * The crab submarines all need to be aligned before they'll have enough power to blast a large enough hole for your
 * submarine to get through. However, it doesn't look like they'll be aligned before the whale catches you!
 * Maybe you can help?
 *
 * There's one major catch - crab submarines can only move horizontally.
 *
 * You quickly make a list of the horizontal position of each crab (your puzzle input). Crab submarines have limited
 * fuel, so you need to find a way to make all of their horizontal positions match while requiring them to spend as
 * little fuel as possible
 *
 * Each change of 1 step in horizontal position of a single crab costs 1 fuel.
 *
 * Determine the horizontal position that the crabs can align to using the least fuel possible. How much fuel must
 * they spend to align to that position?
 */

$input = file_get_contents('input.txt');
$numbers = explode(',', $input);

$median = median($numbers);

$cost = 0;

foreach ($numbers as $number) {
    $cost += abs($number - $median);
}

echo "Answer: " . $cost . "\n";

function median($list): float
{
    sort($list);

    $middle = floor((count($list) - 1) / 2);

    if (count($list) % 2) {
        return $list[$middle];
    }

    return ($list[$middle] + $list[$middle + 1]) / 2;
}
