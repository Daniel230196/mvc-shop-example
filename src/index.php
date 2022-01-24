<?php

$test = ['test' => "ttttt", 'test2' => "fgfffffff"];

$test = array_map(function ($key, $value) {
    if ($value === 'ttttt') {

    }
    return $value;
}, $test);

var_dump($test);