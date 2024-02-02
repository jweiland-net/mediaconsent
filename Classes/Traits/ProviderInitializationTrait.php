<?php

declare(strict_types=1);

namespace JWeiland\Mediaconsent\Traits;

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\Exception\MissingArrayPathException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Trait for initializing providers from configuration
 */
trait ProviderInitializationTrait
{
    private array $smcProviders;

    private function initProvidersFromConfiguration(array $processorConfiguration): void
    {
        try {
            $cnProviders = ArrayUtility::getValueByPath($processorConfiguration, 'cnProviders') ?? false;
            if ($cnProviders) {
                $this->smcProviders = GeneralUtility::trimExplode(',', $cnProviders, true);
            }
        } catch (MissingArrayPathException $exception) {
            throw new \InvalidArgumentException('Missing the cnProviders key in processor configuration');
        }
    }

    private function getSmcProvider(int $num): string
    {
        return $this->smcProviders[$num - 1] ?? '';
    }
}
