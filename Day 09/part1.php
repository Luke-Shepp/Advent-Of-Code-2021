<?php

$input = file_get_contents('input.txt');
$rows = array_map('str_split', explode("\n", $input));

$lows = [];

for ($i = 0; $i < count($rows); $i++) {
    for ($x = 0; $x < count($rows[$i]); $x++) {
        if ($rows[$i][$x] < ($rows[$i-1][$x] ?? 10)
         && $rows[$i][$x] < ($rows[$i+1][$x] ?? 10)
         && $rows[$i][$x] < ($rows[$i][$x-1] ?? 10)
         && $rows[$i][$x] < ($rows[$i][$x+1] ?? 10)
        ) {
            $lows[] = $rows[$i][$x];
        }
    }
}

echo "Answer: " . array_sum(array_map(fn ($n) => $n + 1, $lows)) . "\n";
