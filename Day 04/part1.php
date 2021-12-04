<?php

/*
 * https://adventofcode.com/2021/day/4
 *
 * The submarine has a bingo subsystem to help passengers (currently, you and the giant squid) pass the time.
 * It automatically generates a random order in which to draw numbers and a random set of boards (your puzzle input).
 *
 * Bingo is played on a set of boards each consisting of a 5x5 grid of numbers. Numbers are chosen at random,
 * and the chosen number is marked on all boards on which it appears. (Numbers may not appear on all boards.)
 * If all numbers in any row or any column of a board are marked, that board wins. (Diagonals don't count.)
 *
 * The score of the winning board can now be calculated. Start by finding the sum of all unmarked numbers on that
 * board. Then, multiply that sum by the number that was just called when the board won to get the final score.
 *
 * To guarantee victory against the giant squid, figure out which board will win first.
 * What will your final score be if you choose that board?
 */

include('Board.php');

$input = file_get_contents('input.txt');
$sections = explode("\n\n", $input);

$numbers = explode(',', array_shift($sections));

/** @var Board[] $boards */
$boards = array_map(Closure::fromCallable([Board::class, 'make']), $sections);

foreach ($numbers as $number) {
    foreach ($boards as $i => $board) {
        if ($board->mark($number)) {
            if ($board->isWinner()) {
                echo 'WINNER, board: ' . $i . "\n";
                echo $board . "\n";
                echo 'Score: ' . $board->score() . "\n";
                die();
            }
        }
    }
}
