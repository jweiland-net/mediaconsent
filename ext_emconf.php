<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Media Consent',
    'description' => 'Extension loads content only if the user agrees.',
    'category' => 'plugin',
    'author' => 'Stefan Froemken, Hoja Mustaffa Abdul Latheef',
    'author_company' => 'jweiland.net',
    'author_email' => 'projects@jweiland.net',
    'state' => 'stable',
    'version' => '2.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.8-12.4.99',
        ]
    ]
];
