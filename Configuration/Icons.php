<?php

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx_mediaconsent_cns' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:mediaconsent/Resources/Public/Icons/Extension.svg',
    ],
];
