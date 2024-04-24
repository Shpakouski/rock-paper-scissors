<?php

namespace App;
require_once 'autoload.php';

class Rules
{
    private const string WIN = "You win!\n";
    private const string LOSE = "You lose!\n";
    private const string DRAW = "Draw\n";
    private array $rules;

    public function __construct(
        private array $moves,
    )
    {
    }

    public function getMoves(): array
    {
        return $this->moves;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getMovesCount(): int
    {
        return count($this->moves);
    }

    public function getMidpoint(): int
    {
        return floor($this->getMovesCount() / 2);
    }

    public function defineRules(int $table = 0): array
    {
        for ($x = 1; $x <= $this->getMovesCount(); $x++) {
            for ($y = 1; $y <= $this->getMovesCount(); $y++) {
                $this->rules[$x][$y] = 0 <=> (($x - $y + $this->getMidpoint() + $this->getMovesCount()) % $this->getMovesCount() - $this->getMidpoint());
                $this->rules[$x][$y] = match (0 <=> (($x - $y + $this->getMidpoint() + $this->getMovesCount()) % $this->getMovesCount() - $this->getMidpoint())) {
                    1 => Result::WIN->value,
                    0 => Result::DRAW->value,
                    -1 => Result::LOSE->value,
                };
            }
            if ($table) {
                array_unshift($this->rules[$x], $this->moves[$x - 1]);
            }
        }
        return $this->rules;
    }

    public function determineWinner(int $pcMove, int $playerMove): void
    {
        if (!$pcMove || !$playerMove) return;
        echo match ($this->rules[$pcMove][$playerMove]) {
            Result::WIN->value => self::WIN,
            Result::DRAW->value => self::DRAW,
            Result::LOSE->value => self::LOSE,
        };
    }
}

