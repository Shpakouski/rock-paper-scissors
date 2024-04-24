<?php

namespace App;

enum Option: string
{
    case EXIT = '0';
    case MENU_EXIT = '0 - exit';
    case HELP = '?';
    case MENU_HELP = '? - help';
}
