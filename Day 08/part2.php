<?php

/*
 * https://adventofcode.com/2021/day/8#part2
 *
 * Through a little deduction, you should now be able to determine the remaining digits.
 *
 * For each entry, determine all of the wire/segment connections and decode the four-digit output values.
 * What do you get if you add up all of the output values?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$digits = [
    0 => 'abcefg',
    1 => 'cf',
    2 => 'acdeg',
    3 => 'acdfg',
    4 => 'bcdf',
    5 => 'abdfg',
    6 => 'abdefg',
    7 => 'acf',
    8 => 'abcdefg',
    9 => 'abcdfg',
];

$answer = 0;

foreach ($lines as $line) {
    $parts = preg_split('/(\s|\|)+/', $line);
    $patterns = array_slice($parts, 0, 10);
    $outputs = array_slice($parts, 10, 4);

    $knownNumbers = [];
    $maps = [];

    // Based on the number of segments that make up the number, we know which numbers 1, 7, 4 and 8 are
    // because they have unique segment counts of 2, 3, 4, 7 respectively.
    foreach ($patterns as $pattern) {
        switch (strlen($pattern)) {
            case 2:
                $knownNumbers[1] = str_split($pattern);
                break;
            case 3:
                $knownNumbers[7] = str_split($pattern);
                break;
            case 4:
                $knownNumbers[4] = str_split($pattern);
                break;
            case 7:
                $knownNumbers[8] = str_split($pattern);
                break;
        }
    }

    // The top segment (a) can be found by getting the segment which is active in the number 7, but not 1
    $diff = array_diff($knownNumbers[7], $knownNumbers[1]);
    $maps['a'] = reset($diff);

    // Count all the times each segment is active in the input
    $counted = [];
    foreach ($patterns as $pattern) {
        $letters = str_split($pattern);
        foreach ($letters as $letter) {
            $counted[$letter] = ($counted[$letter] ?? 0) + 1;
        }
    }

    // Segments b, e and f have unique segment counts, so we can easily determine them
    $maps['b'] = array_search(6, $counted);
    $maps['e'] = array_search(4, $counted);
    $maps['f'] = array_search(9, $counted);

    // Segment c has the same count as segment a, however we already have a map for segment a
    // so can therefore deduce segment c
    foreach ($counted as $letter => $count) {
        if ($letter != $maps['a'] && $count == 8) {
            $maps['c'] = $letter;
        }
    }

    // We now have a map for all segments in number 4 except for segment d, so we can now foind that
    $diff = array_diff($knownNumbers[4], $maps);
    $maps['d'] = reset($diff);

    // The last segment to find is g, and as number 8 has all segments active we can diff our maps against
    // the segments active in number 8 to find this last segment.
    $diff = array_diff($knownNumbers[8], $maps);
    $maps['g'] = reset($diff);

    // Now, find the values of each output on the line
    $lineOutput = '';
    foreach ($outputs as $output) {
        // Convert the scrambled single output such as 'gfadec' to their mapped values
        $mapped = array_map(function ($char) use ($maps) {
            return array_search($char, $maps);
        }, str_split($output));

        // Sort the letters for comparison
        sort($mapped);

        // Find which number these segments relate to, and append it to the line output.
        $lineOutput .= array_search(implode($mapped), $digits);
    }

    // Add this lines output value to the running total.
    $answer += (int) $lineOutput;
}

echo "Sum: " . $answer . "\n";
