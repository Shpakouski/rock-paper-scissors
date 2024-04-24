<?php

namespace App;
require_once "autoload.php";

$game = new Game($argv);
$game->run();