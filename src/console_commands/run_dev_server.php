<?php

$port          = $argv[1] ?? null;
$rootDirectory = $argv[2] ?? null;

$script = "";
$script = $rootDirectory !== null
    ? "php -t {$rootDirectory} -S 0.0.0.0:{$port}"
    : "php -S 0.0.0.0:$port";


echo $script;
exec($script);
