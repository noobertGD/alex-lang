<?php

function getNextToken($code, &$offset)
{

    $code = substr($code, $offset);
    $tokens = [
        '/^\s*local /' => 'local',
        '/^\n+/' => 'enter',
        '/^\s*print\(/' => 'print',
        '/^\)/' => 'closeParentheses',
        '/^[a-zA-Z][a-zA-Z0-9]+/' => 'variable',
        '/^\s*=\s*/' => 'eq',
        '/^[0-9]+/' => 'number',
        '/^\s*\*\s*/' => 'multiplied',


    ];
    foreach ($tokens as $rx => $tokenName) {


        if (preg_match($rx,$code, $matches, PREG_OFFSET_CAPTURE, 0) === 1) {
            //var_dump($rx,$code);
            $offset += strlen($matches[0][0]);


            return $tokenName;
        }
    }

    if (strlen($code) === 0) {
        return 'end';
    } else {
        return 'error';
    }
    //var_dump($matches);

}

