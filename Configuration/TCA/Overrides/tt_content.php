<?php

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Adds the content element to the "Type" dropdown
ExtensionManagementUtility::addPlugin(
    [
        'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:mediaconsent_cns.wizard.title',
        'mediaconsent_cns',
        'EXT:mediaconsent/Resources/Public/Icons/Extension.svg',
    ],
    'CType',
    'mediaconsent',
);

// Configure additional field mediaconsent_smcprovider in tt_content
$tempColumns = [
    'mediaconsent_smcprovider' => [
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                0 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.0',
                    'value' => '1',
                ],
                1 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.1',
                    'value' => '2',
                ],
                2 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.2',
                    'value' => '3',
                ],
                3 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.3',
                    'value' => '4',
                ],
                4 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.4',
                    'value' => '5',
                ],
                5 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.5',
                    'value' => '6',
                ],
                6 => [
                    'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider.I.6',
                    'value' => '7',
                ],
            ],
        ],
        'exclude' => '1',
        'label' => 'LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider',
    ],
];

ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['mediaconsent_cns'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        mediaconsent_smcprovider;LLL:EXT:mediaconsent/Resources/Private/Language/locallang.xlf:tt_content.mediaconsent_smcprovider,
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext.ALT.html_formlabel,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => false,
                'format' => 'html',
                'renderType' => 't3editor',
                'wrap' => 'off',
            ],
        ],
    ],
];
