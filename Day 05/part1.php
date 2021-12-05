<?php

/*
 * https://adventofcode.com/2021/day/5
 *
 * You come across a field of hydrothermal vents on the ocean floor! These vents constantly produce large, opaque
 * clouds, so it would be best to avoid them if possible. They tend to form in lines; the submarine helpfully produces
 * a list of nearby lines of vents (your puzzle input) for you to review.
 *
 * Each line of vents is given as a line segment in the format x1,y1 -> x2,y2 where x1,y1 are the coordinates of
 * one end the line segment and x2,y2 are the coordinates of the other end. These line segments include the
 * points at both ends.
 *
 * For now, only consider horizontal and vertical lines
 *
 * To avoid the most dangerous areas, you need to determine the number of points where at least two lines overlap.
 *
 * Consider only horizontal and vertical lines. At how many points do at least two lines overlap?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$points = [];

foreach ($lines as $line) {
    // Extract each point
    $matches = [];
    preg_match('/^([0-9]+)\,([0-9]+)\ \-\>\ ([0-9]+)\,([0-9]+)$/', $line, $matches);
    [, $x1, $y1, $x2, $y2] = $matches;

    // "For now, only consider horizontal and vertical lines"
    if ($x1 !== $x2 && $y1 !== $y2) {
        continue;
    }

    // Build all points between (and including) the 2 line ends
    foreach (range($x1, $x2) as $x) {
        foreach (range($y1, $y2) as $y) {
            $points[$x . ',' . $y] = ($points[$x . ',' . $y] ?? 0) + 1;
        }
    }
}

// Count the number of "crossovers"
echo "Answer: " . count(array_filter($points, fn ($point) => $point > 1)) . "\n";
