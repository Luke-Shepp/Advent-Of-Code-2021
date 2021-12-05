<?php

/*
 * https://adventofcode.com/2021/day/5#part2
 *
 * Unfortunately, considering only horizontal and vertical lines doesn't give you the full picture; you need to
 * also consider diagonal lines.
 *
 * You still need to determine the number of points where at least two lines overlap.
 *
 * Consider all of the lines. At how many points do at least two lines overlap?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$points = [];

foreach ($lines as $line) {
    $start = microtime(true);
    // Extract each point
    $matches = [];
    preg_match('/^([0-9]+)\,([0-9]+)\ \-\>\ ([0-9]+)\,([0-9]+)$/', $line, $matches);
    [, $x1, $y1, $x2, $y2] = $matches;

    $x = $x1;
    $y = $y1;

    for ($i = 0; $i <= max(abs($x2 - $x1), abs($y2 - $y1)); $i++) {
        // Move diagonally, which way depends which coord value is higher
        $points[$x . ',' . $y] = ($points[$x . ',' . $y] ?? 0) + 1;
        $x += $x2 <=> $x1;
        $y += $y2 <=> $y1;
    }
}

// Count the number of "crossovers"
echo "Answer: " . count(array_filter($points, fn ($point) => $point > 1)) . "\n";
