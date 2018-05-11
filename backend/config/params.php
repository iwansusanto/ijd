<?php
return [
    'adminEmail' => 'iwandevapps@gmail.com',
    'maskInputOptions' => [
            'prefix' => 'Rp. ',
            'alias' => 'numeric',
            'digits' => 0,
            'radixPoint' => ',',
            'groupSeparator' => '.',
            'allowMinus'    =>  false,
            'autoGroup' => true,
            'autoUnmask' => true,
            'unmaskAsNumber' => true,
    ],
    'saveOptions'   =>  [
        'type' => 'hidden', 
        'class' => 'kv-saved',
        'readonly' => true, 
        'tabindex' => 1000
    ],
    'dispOptions'   =>  [
        'class' => 'form-control kv-monospace'
    ],
    'saveCont'  =>  [
        'class' => 'kv-saved-cont'
    ]
];
