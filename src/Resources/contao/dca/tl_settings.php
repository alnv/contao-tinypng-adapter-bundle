<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{tinypng_legend},tinypngApiKey';

$GLOBALS['TL_DCA']['tl_settings']['fields']['tinypngApiKey'] = [
    'inputType' => 'text',
    'eval' => [
        'maxlength' => 128,
        'tl_class' => 'w50'
    ]
];