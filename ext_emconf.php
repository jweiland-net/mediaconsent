<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Media Consent',
    'description' => 'Extension loads content only if the user agrees.',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Hoja Mustaffa Abdul Latheef',
    'author_company' => 'jweiland.net',
    'author_email' => 'projects@jweiland.net',
    'state' => 'stable',
    'version' => '3.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.3-13.4.99',
        ]
    ]
];
