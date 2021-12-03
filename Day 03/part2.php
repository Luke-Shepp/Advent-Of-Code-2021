<?php

/*
 * https://adventofcode.com/2021/day/3#part2
 *
 * Next, you should verify the life support rating, which can be determined by multiplying the oxygen generator
 * rating by the CO2 scrubber rating.
 *
 * Before searching for either rating value, start with the full list of binary numbers from your diagnostic report
 * and consider just the first bit of those numbers. Then:
 *
 * - Keep only numbers selected by the bit criteria for the type of rating value for which you are searching.
 *   Discard numbers which do not match the bit criteria.
 * - If you only have one number left, stop; this is the rating value for which you are searching.
 * - Otherwise, repeat the process, considering the next bit to the right.
 *
 * The bit criteria depends on which type of rating value you want to find:
 * - To find oxygen generator rating, determine the most common value (0 or 1) in the current bit position, and keep
 *   only numbers with that bit in that position. If 0 and 1 are equally common, keep values with a 1 in the position
 *   being considered.
 * - To find CO2 scrubber rating, determine the least common value (0 or 1) in the current bit position, and keep only
 *   numbers with that bit in that position. If 0 and 1 are equally common, keep values with a 0 in the position being
 *   considered.
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

function isBitSet($binary, $bitNum)
{
    return (bindec($binary) & (1 << strlen($binary) - $bitNum)) !== 0;
}

function calculate($list, $mostCommon, $bitNum = 1)
{
    if (count($list) == 1) return array_pop($list);

    $cnts = [0, 0];
    foreach ($list as $binary) {
        isBitSet($binary, $bitNum) ? $cnts[1]++ : $cnts[0]++;
    }

    $filtered = array_filter($list, function ($binary) use ($bitNum, $cnts, $mostCommon) {
        if ($mostCommon) {
            return $cnts[0] > $cnts[1] ? !isBitSet($binary, $bitNum) : isBitSet($binary, $bitNum);
        } else {
            return $cnts[0] > $cnts[1] ? isBitSet($binary, $bitNum) : !isBitSet($binary, $bitNum);
        }
    });

    return calculate($filtered, $mostCommon, ++$bitNum);
}

$oxygenRating = calculate($lines, true);
$scrubberRating = calculate($lines, false);


echo 'Oxygen generator ratin: ' . $oxygenRating . ', ' . bindec($oxygenRating) . "\n";
echo 'CO2 scrubber rating: ' . $scrubberRating . ', ' . bindec($scrubberRating) . "\n";
echo "\n";
echo 'Answer: ' . (bindec($oxygenRating) * bindec($scrubberRating)) . "\n";

