<?php

/*
 * https://adventofcode.com/2021/day/10
 *
 * The navigation subsystem syntax is made of several lines containing chunks. There are one or more chunks on each
 * line, and chunks contain zero or more other chunks. Adjacent chunks are not separated by any delimiter; if one
 * chunk stops, the next chunk (if any) can immediately start. Every chunk must open and close with one of four
 * legal pairs of matching characters:
 *
 * - If a chunk opens with (, it must close with ).
 * - If a chunk opens with [, it must close with ].
 * - If a chunk opens with {, it must close with }.
 * - If a chunk opens with <, it must close with >.
 *
 * So, () is a legal chunk that contains no other chunks, as is []. More complex but valid chunks include ([]),
 * {()()()}, <([{}])>, [<>({}){}[([])<>]], and even (((((((((()))))))))).
 *
 * Some lines are incomplete, but others are corrupted. Find and discard the corrupted lines first.
 *
 * To calculate the syntax error score for a line, take the first illegal character on the line and look it up in the following table:
 * - ): 3 points.
 * - ]: 57 points.
 * - }: 1197 points.
 * - >: 25137 points.
 *
 * Find the first illegal character in each corrupted line of the navigation subsystem. What is the total syntax
 * error score for those errors?
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$illegal = [];

$identitiers = [
    '(' => ')',
    '[' => ']',
    '<' => '>',
    '{' => '}'
];

$scores = [
    ')' => 3,
    ']' => 57,
    '}' => 1197,
    '>' => 25137
];

foreach ($lines as $line) {
    $openChunks = [];

    $chars = str_split($line);

    foreach ($chars as $char) {
        if (in_array($char, array_keys($identitiers))) {
            // opening a new chunk
            $openChunks[] = $char;
        } else {
            // closing a chunk
            $last = array_pop($openChunks);

            // check the last opened chunk uses the same identier that this char is trying to close
            if ($identitiers[$last] !== $char) {
                echo "$line - Expected $identitiers[$last], but found $char instead\n";
                $illegal[] = $char;
                break;
            }
        }
    }
}

$answer = 0;

foreach ($illegal as $char) {
    $answer += $scores[$char];
}

echo "\nAnswer: " . $answer . "\n";
