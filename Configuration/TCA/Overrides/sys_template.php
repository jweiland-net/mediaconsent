<?php

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add an entry in the static template list found in sys_templates for static TS
ExtensionManagementUtility::addStaticFile(
    'mediaconsent',
    'Configuration/TypoScript',
    'Media Consent Content',
);
