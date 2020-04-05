<?php
require_once 'tokenizer.php';
require_once 'compiler.php';
$code = file_get_contents('code.alx');
//echo $code . PHP_EOL;
$offset = 0;
$token = getNextToken($code, $offset);
var_dump($token);
//$errorLine = 1;
while ($token !== false) {
    //$errorLine++;
    if ($token === 'end') {
        break;
    } elseif ($token === 'error') {
        break;
    }
    $token = getNextToken($code, $offset);
    var_dump($token);

}
//echo "error on line:" . $errorLine . PHP_EOL;


$program = compile();


function run($program)
{
    $variables = [

    ];
    foreach ($program as $index => $instruction) {

        if (gettype($instruction['value']) == "array") {
            if ($instruction['type'] === 'assign') {
                if ($instruction['value']['op'] === '*') {
                    $value = $instruction['value']['value1'] * $instruction['value']['value2'];
                    $variables[$instruction['var']] = $value;

                } elseif ($instruction['value']['op'] === '+') {
                    $value = $instruction['value']['value1'] + $instruction['value']['value2'];
                    $variables[$instruction['var']] = $value;
                } elseif ($instruction['value']['op'] === '-') {
                    $value = $instruction['value']['value1'] - $instruction['value']['value2'];
                    $variables[$instruction['var']] = $value;
                } elseif ($instruction['value']['op'] === '/') {
                    $value = $instruction['value']['value1'] / $instruction['value']['value2'];
                    $variables[$instruction['var']] = $value;
                }
            } else {
                echo "[ ERROR ]invalid instruction!" . PHP_EOL;
                exit();
            }

        } elseif ($instruction['type'] === 'assign') {
            $variables[$instruction['var']] = $instruction['value'];
        }

        if ($instruction['type'] === 'print') {
            echo $variables[$instruction['var']] . PHP_EOL;
        }




    }
}

run($program);