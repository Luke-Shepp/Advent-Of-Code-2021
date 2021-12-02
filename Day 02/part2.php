<?php

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$position = [
    'horizontal' => 0,
    'depth' => 0,
    'aim' => 0,
];

foreach ($lines as $line) {
    [$direction, $value] = explode(' ', $line);

    switch ($direction) {
        case 'forward':
            $position['horizontal'] += $value;
            $position['depth'] += $position['aim'] * $value;
            break;
        case 'up':
            $position['aim'] -= $value;
            break;
        case 'down':
            $position['aim'] += $value;
            break;
    }
}

echo $position['horizontal'] * $position['depth'] . "\n";
