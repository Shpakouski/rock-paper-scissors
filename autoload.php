<?php
spl_autoload_register(function ($className) {
    $className = substr($className, strrpos($className, "\\") + 1);
    require_once "$className.php";
});