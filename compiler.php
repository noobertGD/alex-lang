<?php
require_once "tokenizer.php";
function compile($code)
{
    $returnCode = [];
    $instructions = "";
    $offset = 0;




    $token = null;
    $tokenList = [];
    while ($token !== false) {

        $token = getNextToken($code, $offset);
        $tokenName = $token[0];
        $instructions = $instructions . "#" . $tokenName;


        $tokenList[] = $token[1];
        if ($tokenName === 'end') {
            break;
        } elseif ($tokenName == 'enter') {


            if (preg_match('/^#local#variable#eq(#number|#number#op#number)#enter$/', $instructions, $matches, PREG_OFFSET_CAPTURE, 0)) {

                if ($tokenList[4] == '+' || $tokenList[4] == '-' || $tokenList[4] == '*' || $tokenList[4] == '/') {
                    $returnCode[] = [
                        'type' => 'assign',
                        'var' => $tokenList[1],
                        'value' => [
                            'op' => $tokenList[4],
                            'value1' => $tokenList[3],
                            'value2' => $tokenList[5]
                        ]

                    ];
                } else {
                    $returnCode[] = [
                        'type' => 'assign',
                        'var' => $tokenList[1],
                        'value' => $tokenList[3],
                        //array if it is an operation
                    ];
                }

                $tokenList = [];

                $instructions = "";
            } elseif (preg_match('/^#print(#variable#|#number)closeParentheses#enter$/', $instructions, $matches, PREG_OFFSET_CAPTURE, 0)) {

                $instructions = "";
                $returnCode[] = [
                    'type' => 'print',
                    'var' => $tokenList[1]
                ];
                $tokenList = [];
            } else {
                echo "[ error ]compilation failed!" . PHP_EOL;
                exit();
            }
        } elseif ($tokenName === 'error') {
            echo "[ error ]syntax error!!" . PHP_EOL;
            exit();
        }



    }



    return $returnCode;


}