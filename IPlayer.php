<?php

namespace App;

interface IPlayer
{
    public function getMoveIndex();

    public function makeMove();
}