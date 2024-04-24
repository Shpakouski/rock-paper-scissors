<?php

namespace App;
require_once 'autoload.php';

class Menu
{
    private const string TABLE_HEADER = 'v PC\USER >';

    public function __construct(
        private array         $moves,
        private Rules         $rules,
        private Console_Table $consoleTable,
    )
    {
    }

    public function getMoves(): array
    {
        return $this->moves;
    }

    public function getMenuMoves(): array
    {
        array_unshift($this->moves, null);
        unset($this->moves[0]);
        return $this->moves;
    }

    public function drawTable(): void
    {
        array_unshift($this->moves, self::TABLE_HEADER);
        $this->consoleTable->setHeaders(
            $this->moves,
        );
        $this->rules->defineRules(1);
        for ($i = 1; $i <= count($this->rules->getRules()); $i++) {
            $this->consoleTable->addRow($this->rules->getRules()[$i]);
        }
        echo $this->consoleTable->getTable();
        unset($this->moves[0]);
    }

    public function displayMenu(): void
    {
        echo "Available moves: \n";
        foreach ($this->getMenuMoves() as $key => $value) {
            echo $key . ' - ' . $value . "\n";
        }
        echo Option::MENU_EXIT->value . "\n";
        echo Option::MENU_HELP->value . "\n";
    }
}
