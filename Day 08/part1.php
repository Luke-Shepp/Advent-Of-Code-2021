<?php

/*
 * https://adventofcode.com/2021/day/8
 *
 * As your submarine slowly makes its way through the cave system, you notice that the four-digit seven-segment
 * displays in your submarine are malfunctioning; they must have been damaged during the escape. You'll be in a
 * lot of trouble without them, so you'd better figure out what's wrong.
 *
 * Each digit of a seven-segment display is rendered by turning on or off any of seven segments named a through g.
 *
 * So, to render a 1, only segments c and f would be turned on; the rest would be off. To render a 7, only
 * segments a, c, and f would be turned on.
 *
 * The problem is that the signals which control the segments have been mixed up on each display. The submarine is
 * still trying to display numbers by producing output on signal wires a through g, but those wires are connected to
 * segments randomly. Worse, the wire/segment connections are mixed up separately for each four-digit display!
 * (All of the digits within a display use the same connections, though.)
 *
 * For now, focus on the easy digits. Because the digits 1, 4, 7, and 8 each use a unique number of segments,
 * you should be able to tell which combinations of signals correspond to those digits. Counting only digits in
 * the output values (the part after | on each line), in the above example, there are 26 instances of digits that
 * use a unique number of segments.
 *
 * In the output values, how many times do digits 1, 4, 7, or 8 appear?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$cnt = 0;

foreach ($lines as $line) {
    $parts = preg_split('/(\s|\|)+/', $line);
    $outputs = array_slice($parts, 10, 4);

    foreach ($outputs as $output) {
        if (in_array(strlen($output), [2, 3, 4, 7])) {
            $cnt++;
        }
    }
}

echo "Count: " . $cnt . "\n";
