<?php

class Board
{
    /** @var array */
    private array $rows = [];

    /** @var int|null */
    private ?int $lastMarked = null;

    /** @var string */
    private const MARKED = 'x';

    /** @var int */
    private const SIZE = 5;

    /**
     * @param string $input
     */
    public function __construct(string $input)
    {
        foreach (explode("\n", $input) as $x => $row) {
            foreach (preg_split('/\s+/', trim($row)) as $y => $number) {
                $this->rows[$x][$y] = $number;
            }
        }
    }

    /**
     * Create a new Board instance from a string representation
     *
     * @param string $input
     * @return static
     */
    public static function make(string $input): self
    {
        return new self($input);
    }

    /**
     * Mark a number if it exists on the board
     *
     * @param $number
     * @return bool
     */
    public function mark($number): bool
    {
        foreach ($this->rows as $x => $row) {
            foreach ($row as $y => $cell) {
                if ($cell === $number) {
                    $this->rows[$x][$y] = self::MARKED;
                    $this->lastMarked = $number;
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if the board is a winner
     *
     * @return bool
     */
    public function isWinner(): bool
    {
        // If any rows are fully marked
        foreach ($this->rows as $row) {
            if (array_unique($row) === [self::MARKED]) {
                return true;
            }
        }

        // If any cols are fully marked
        for ($i = 0; $i < self::SIZE; $i++) {
            if (array_unique(array_column($this->rows, $i)) === [self::MARKED]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Represent the board as a string
     *
     * @return string
     */
    public function __toString(): string
    {
        return implode("\n", array_map(fn ($x) => implode("\t", $x), $this->rows));
    }

    /**
     * Calculate the score of the board.
     *
     *  > The score of the winning board can now be calculated. Start by finding the sum of all unmarked
     *  > numbers on that board. Then, multiply that sum by the number that was just called when the board won.
     * @return int
     */
    public function score(): int
    {
        return array_sum(array_map('array_sum', $this->rows)) * $this->lastMarked;
    }
}
