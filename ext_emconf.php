<?php
// Extension icon designed by dDara from Flaticon.com
$EM_CONF[$_EXTKEY] = [
    'title' => 'Media Consent',
    'description' => 'Extension loads content only if the user agrees.',
    'category' => 'plugin',
    'author' => 'Christoph Roth',
    'author_company' => 'Evangelische Kirche von Westfalen',
    'author_email' => 'christoph.roth@ekvw.de',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '0.1.8',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-11.5.99',
        ]
    ]
];
