<?php

namespace App;
require_once "autoload.php";

class Game
{
    private array $moves;
    private Validator $validator;
    private Rules $rules;
    private Console_Table $consoleTable;
    private Menu $menu;
    private Computer $computer;
    private Secure $secure;
    private User $user;

    public function __construct(
        array $moves,
    )
    {
        $this->moves = array_slice($moves, 1);
        $this->validator = new Validator($this->moves);
        $this->rules = new Rules($this->moves);
        $this->consoleTable = new Console_Table();
        $this->menu = new Menu($this->moves, $this->rules, $this->consoleTable);
        $this->computer = new Computer($this->menu->getMenuMoves());
        $this->secure = new Secure();
        $this->user = new User($this->menu);
    }

    public function run(): void
    {
        if (!$this->validator->validate()) {
            $this->rules->defineRules();
            $this->computer->createMoveIndex();
            $this->computer->makeMove();
            $this->secure->setSecureKey();
            $this->secure->setHash();
            $this->secure->setHmac($this->computer);
            $this->secure->printHmac();
            $this->menu->displayMenu();
            $this->user->createPattern();
            $this->user->makeMove();
            if ($this->user->hasMove()) {
                $this->computer->printMove();
                $this->rules->determineWinner($this->computer->getMoveIndex(), $this->user->getMoveIndex());
                $this->secure->printHash();
            }
        } else {
            echo $this->validator->validate();
        }
    }

}

