<?php

/*
 * https://adventofcode.com/2021/day/10#part2
 *
 * Now, discard the corrupted lines. The remaining lines are incomplete.
 *
 * Incomplete lines don't have any incorrect characters - instead, they're missing some closing characters at the
 * end of the line. To repair the navigation subsystem, you just need to figure out the sequence of closing characters
 * that complete all open chunks in the line.
 *
 * The score is determined by considering the completion string character-by-character. Start with a total score of 0.
 * Then, for each character, multiply the total score by 5 and then increase the total score by the point value
 * given for the character in the following table:
 *
 * - ): 1 point.
 * - ]: 2 points.
 * - }: 3 points.
 * - >: 4 points.
 *
 * the winner is found by sorting all of the scores and then taking the middle score. (There will always be an
 * odd number of scores to consider.)
 */

$input = file_get_contents('input.txt');
$lines = explode("\n", $input);

$identitiers = [
    '(' => ')',
    '[' => ']',
    '<' => '>',
    '{' => '}'
];

$scoreModifiers = [
    ')' => 1,
    ']' => 2,
    '}' => 3,
    '>' => 4
];

$scores = [];

foreach ($lines as $i => $line) {
    $score = 0;
    $openChunks = [];

    $chars = str_split($line);

    foreach ($chars as $char) {
        if (in_array($char, array_keys($identitiers))) {
            // opening a new chunk
            $openChunks[] = $char;
        } else {
            // closing a chunk
            $last = array_pop($openChunks);

            if ($identitiers[$last] !== $char) {
                // Corrupt chunk - skip.
                continue 2;
            }
        }
    }

    foreach (array_reverse($openChunks) as $char) {
        $score = ($score * 5) + $scoreModifiers[$identitiers[$char]];
    }

    $scores[] = $score;
}

sort($scores);

echo "Answer: " . $scores[floor(count($scores) / 2)] . "\n";
