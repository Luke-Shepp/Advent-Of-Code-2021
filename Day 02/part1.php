<?php

/*
 * https://adventofcode.com/2021/day/2
 *
 * It seems like the submarine can take a series of commands like forward 1, down 2, or up 3:
 * - forward X increases the horizontal position by X units.
 * - down X increases the depth by X units.
 * - up X decreases the depth by X units.
 *
 * Calculate the horizontal position and depth you would have after following the planned course.
 * What do you get if you multiply your final horizontal position by your final depth?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$position = [
    'horizontal' => 0,
    'depth' => 0,
];

foreach ($lines as $line) {
    [$direction, $value] = explode(' ', $line);

    switch ($direction) {
        case 'forward':
            $position['horizontal'] += $value;
            break;
        case 'up':
            $position['depth'] -= $value;
            break;
        case 'down':
            $position['depth'] += $value;
            break;
    }
}

echo array_product($position) . "\n";
