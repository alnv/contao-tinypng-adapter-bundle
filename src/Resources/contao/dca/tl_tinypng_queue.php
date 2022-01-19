<?php

$GLOBALS['TL_DCA']['tl_tinypng_queue'] = [
    'config' => [
        'dataContainer' => 'Table',
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'uuid' => 'index'
            ]
        ]
    ],
    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'autoincrement' => true, 'notnull' => true, 'unsigned' => true]
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'default' => 0]
        ],
        'uuid' => [
            'sql' => 'blob NULL'
        ],
        'compressed' => [
            'sql' => "char(1) NOT NULL default ''"
        ]
    ]
];