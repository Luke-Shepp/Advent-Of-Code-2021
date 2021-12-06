<?php

/*
 * https://adventofcode.com/2021/day/6#part2
 *
 * Suppose the lanternfish live forever and have unlimited food and space. Would they take over the entire ocean?
 *
 * How many lanternfish would there be after 256 days?
 */

$input = file_get_contents('input.txt');
$fish = array_map('intval', explode(',', $input));

/*
 * Changed tack here. Instead of keep every single timer, as in part 1, group them all by their timer value which
 * drastically recuces array values and memory usage.
 *
 * php part2.php  0.05s user 0.02s system 68% cpu 0.099 total
 * ^^ Much better!
 */

$timers = [0, 0, 0, 0, 0, 0, 0, 0, 0];

foreach ($fish as $timer) {
    $timers[$timer]++;
}

echo "Day " . 0 . ": " . implode(',', $timers) . "\n";

for ($day = 0; $day < 256; $day++) {
    // Take 1 day from each timer value, which is just a left shift of the array.
    // the value knocked off the start is the number of fish that will be due.
    $born = array_shift($timers);

    // Newly born get a timer of 8
    $timers[8] = $born;

    // Newly given birth get a timer of 6
    $timers[6] += $born;

    echo "Day " . ($day + 1) . ": " . implode(',', $timers) . "\n";
}

echo "Answer: " . array_sum($timers) . "\n";
