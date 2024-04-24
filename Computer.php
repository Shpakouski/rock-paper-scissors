<?php

namespace App;
require_once 'autoload.php';

class Computer implements IPlayer
{
    private const string MOVE_TXT = 'Computer move: ';
    private string $move;
    private int $moveIndex;

    public function __construct(
        private array $moves,
    )
    {
    }

    public function getMove(): string
    {
        return $this->move;
    }

    public function getMoveIndex(): int
    {
        return $this->moveIndex;
    }

    public function printMove(): void
    {
        echo self::MOVE_TXT . $this->move . "\n";
    }

    public function createMoveIndex(): void
    {
        $this->moveIndex = array_rand($this->moves);
    }

    public function makeMove(): void
    {
        $this->move = $this->moves[$this->moveIndex];
    }
}
