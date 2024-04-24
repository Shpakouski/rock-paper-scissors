<?php

namespace App;
require_once 'autoload.php';

class User implements IPlayer
{
    private const string ENTER_MOVE = 'Enter your move: ';
    private const string MOVE = 'Your move: ';
    private array $moveIndex;
    private string $pattern;

    public function __construct(
        private Menu $menu,
    )
    {
    }

    public function getMoveIndex(): int
    {
        return (int)$this->moveIndex[0];
    }

    public function createPattern(): void
    {
        $this->pattern = '/^[0-' . count($this->menu->getMenuMoves()) . '?]$/';
    }

    public function hasMove(): bool
    {
        return $this->moveIndex[0] !== Option::EXIT->value && $this->moveIndex[0] !== Option::HELP->value;
    }

    public function makeMove(): void
    {
        do {
            echo self::ENTER_MOVE;
        } while (!$this->moveIndex = preg_grep($this->pattern, [trim(fgets(STDIN))]));
        if ($this->moveIndex[0] === Option::EXIT->value) {
            return;
        }
        if ($this->moveIndex[0] === Option::HELP->value) {
            $this->menu->drawTable();
            return;
        }
        echo self::MOVE . $this->menu->getMenuMoves()[$this->getMoveIndex()] . "\n";
    }
}

