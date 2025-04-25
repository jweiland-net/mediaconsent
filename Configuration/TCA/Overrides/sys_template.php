<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Add an entry in the static template list found in sys_templates for static TS
ExtensionManagementUtility::addStaticFile(
   'mediaconsent',
   'Configuration/TypoScript',
   'Media Consent Content'
);
