<?php

function compile() {
    //todo: implement compiler
    return [
        [
            'type' => 'assign',
            'var' => 'bla',
            'value' => 5,
        ],
        [
            'type' => 'assign',
            'var' => 'blabla',
            'value' => [

                'op' => '+',
                'value1' => 5,
                'value2' => 2
            ]
        ],
        [
            'type' => 'print',
            'var' => 'blabla'
        ]

    ];
}