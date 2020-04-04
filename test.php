<?php

function test($x) {
    $x=5;
    return [$x, $x+1];
}


$a = 1;
var_dump($a);
var_dump(test($a));
var_dump($a);

