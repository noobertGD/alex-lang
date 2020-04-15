<?php

function getNextToken($code, &$offset)
{
    $code = substr($code, $offset);

    $pos = strpos($code, "\n");
    var_dump($pos);

    $tokens = [
        '/^\n+/' => 'enter',
        '/^\s*local /' => 'local',
        '/^\s*print\(/' => 'print',
        '/^\)/' => 'closeParentheses',
        '/^[a-zA-Z][a-zA-Z0-9]+/' => 'variable',
        '/^\s*=\s*/' => 'eq',
        '/^\s*[0-9]+[ ]*/' => 'number',
        '/^\s*\*|\+|\-|\/\s*/' => 'op',


    ];

    foreach ($tokens as $rx => $tokenName) {


        if (preg_match($rx, $code, $matches, PREG_OFFSET_CAPTURE, 0) === 1) {


            $offset += strlen($matches[0][0]);
            $matches[0][0] = trim($matches[0][0], "\t ");


            return [$tokenName, $matches[0][0]];
        }
    }

    if (strlen($code) === 0) {
        return ['end', 'end of code'];
    } else {
        return ['error',substr($code,0,$pos)];
    }


}

