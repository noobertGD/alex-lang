<?php
require_once 'tokenizer.php';
$code = file_get_contents('code.alx');
//echo $code . PHP_EOL;
$offset = 0;
$token = getNextToken($code, $offset);
var_dump($token);
//$errorLine = 1;
while ($token !== false) {
    //$errorLine++;
    if ($token === 'end') {
        exit();
    } elseif ($token === 'error') {
        exit();
    }
    $token = getNextToken($code, $offset);
    var_dump($token);

}
//echo "error on line:" . $errorLine . PHP_EOL;
