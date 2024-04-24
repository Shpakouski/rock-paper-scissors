<?php

namespace App;
require_once 'autoload.php';

class Validator
{
    private const int MIN_ARGS = 3;
    private const string INCORRECT_NUM_ARGS = "Incorrect number of arguments. Please enter 3 or more odd number of moves. Example: rock paper scissors.";
    private const string EVEN_ARGS = "Even number of arguments. Please enter 3 or more odd number of moves. Example: rock paper scissors.";
    private const string REPEATED_ARGS = "Repeated arguments. Please enter distinct move names. Example: rock paper scissors.";

    public function __construct(
        private array $moves,
    )
    {
    }

    public function getMoves(): ?array
    {
        return $this->moves;
    }

    public function getMovesCount(): ?int
    {
        return count($this->moves);
    }

    private function isCorrectNumArgs(): bool
    {
        return $this->getMovesCount() >= self::MIN_ARGS;
    }

    private function isOdd(): bool
    {
        return $this->getMovesCount() % 2;
    }

    private function isRepeated(): bool
    {
        return $this->getMovesCount() !== count(array_unique($this->getMoves()));
    }

    public function validate(): bool|string
    {
        if (!$this->isCorrectNumArgs()) {
            return self::INCORRECT_NUM_ARGS;
        } elseif (!$this->isOdd()) {
            return self::EVEN_ARGS;
        } elseif ($this->isRepeated()) {
            return self::REPEATED_ARGS;
        }
        return false;
    }
}
