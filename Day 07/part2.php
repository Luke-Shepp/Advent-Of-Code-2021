<?php

/*
 * https://adventofcode.com/2021/day/7#part2
 *
 * As it turns out, crab submarine engines don't burn fuel at a constant rate. Instead, each change of 1 step in
 * horizontal position costs 1 more unit of fuel than the last: the first step costs 1, the second step costs 2,
 * the third step costs 3, and so on.
 *
 * Determine the horizontal position that the crabs can align to using the least fuel possible so they can make you an
 * escape route!
 *
 * How much fuel must they spend to align to that position?
 */

$input = file_get_contents('input.txt');
$numbers = explode(',', $input);

$mean = floor(mean($numbers));

$cost = 0;

foreach ($numbers as $number) {
    $distance = abs($number - $mean);

    // Sum all whole numbers under and including $distance.
    $cost += ($distance * ($distance - 1) / 2) + $distance;
}

echo "Answer: " . $cost . "\n";

function mean($list): float
{
    return array_sum($list) / count($list);
}
