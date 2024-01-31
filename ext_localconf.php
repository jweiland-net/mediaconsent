<?php

declare(strict_types=1);

if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mediaconsent/Configuration/PageTS/PageTSConfig.tsconfig">'
);
