<?php

/*
 * https://adventofcode.com/2021/day/1#part2
 *
 * Considering every single measurement isn't as useful as you expected: there's just too much noise in
 * the data. Instead, consider sums of a three-measurement sliding window.
 *
 * Your goal now is to count the number of times the sum of measurements in this sliding window increases
 * from the previous sum.
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$count = 0;

for ($i = 0; $i < count($lines); $i++) {
    // Extract a 3 long slice beginning with the current, then the next element
    $groupA = array_sum(array_slice($lines, $i, 3));
    $groupB = array_sum(array_slice($lines, $i + 1, 3));

    // Increment if groupB is higher.
    if ($groupA < $groupB) {
        $count++;
    }
}

echo $count . "\n";
