<?php

/*
 * https://adventofcode.com/2021/day/4#part2
 *
 * Figure out which board will win last. Once it wins, what would its final score be?
 */

include('Board.php');

$input = file_get_contents('input.txt');
$sections = explode("\n\n", $input);

$numbers = explode(',', array_shift($sections));

/** @var Board[] $boards */
$boards = array_map(Closure::fromCallable([Board::class, 'make']), $sections);

$lastWinner = null;

foreach ($numbers as $number) {
    foreach ($boards as $i => $board) {
        if ($board->mark($number)) {
            // If this board has won, remove it from the set and track it as the latest winner
            if ($board->isWinner()) {
                unset($boards[$i]);
                $lastWinner = $board;
            }
        }
    }
}

echo 'Last winner: ' . "\n";
echo $lastWinner . "\n";
echo 'Score: ' . $lastWinner->score() . "\n";
