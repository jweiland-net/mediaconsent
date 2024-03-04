<?php

declare(strict_types=1);

namespace JWeiland\Mediaconsent\DataProcessing;

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use JWeiland\Mediaconsent\Traits\ProviderInitializationTrait;
use JWeiland\Mediaconsent\Utility\SessionUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class for data processing for the content element Mediaconsent Cns
 */
class MediaConsentProcessor implements MediaConsentProcessorInterface
{
    use ProviderInitializationTrait;

    private const MEDIA_CONSENT_PROVIDER = 'mediaconsent_smcprovider';
    private const MEDIA_CONSENT_ITEM = 'mediaconsent_item';
    private const NO_CONSENT = 0;
    private const SESSION_IDENTIFIER = 'allowFromSource';

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        // initialize providers from configuration
        $this->initProvidersFromConfiguration($processorConfiguration);

        // read allowed content sources from session
        $allowedSources = $this->getMediaConsentAllowedSourcesFromSession($cObj);
        $smcProviderNum = (int)$processedData['data'][self::MEDIA_CONSENT_PROVIDER];

        $this->handleMediaConsentItem($cObj, $smcProviderNum, $allowedSources);

        $processedData['wrapperActive'] = in_array($smcProviderNum, $allowedSources, true) ? 0 : 1;
        $processedData['reloadPageType'] = $processorConfiguration['reloadPageType'];
        $processedData['smcProvider'] = $this->getSmcProvider($smcProviderNum);

        return $processedData;
    }

    private function handleMediaConsentItem(ContentObjectRenderer $cObj, int $smcProviderNum, array &$allowedSources): void
    {
        // do this only if a content element uid is arriving in mediaconsent_item,
        // because this also means user has clicked to allow the content
        if ($this->getMediaConsentItemSetInRequest($cObj) && !in_array($smcProviderNum, $allowedSources, true)) {
            // check if content provider exists in session, save if not
            $allowedSources[] = $smcProviderNum;
            $this->setMediaConsentAllowedSourcesToSession($cObj, $allowedSources);
        }
    }

    private function getMediaConsentAllowedSourcesFromSession(ContentObjectRenderer $cObj): array
    {
        $allowedSources = SessionUtility::getFrontendSessionData($cObj->getRequest(), self::SESSION_IDENTIFIER);

        return is_array($allowedSources) ? $allowedSources : [];
    }

    private function setMediaConsentAllowedSourcesToSession(ContentObjectRenderer $cObj, array $data): void
    {
        SessionUtility::setFrontendSessionData($cObj->getRequest(), self::SESSION_IDENTIFIER, $data);
    }

    private function getMediaConsentItemSetInRequest(ContentObjectRenderer $cObj): int
    {
        $mediaConsentItem = $this->getQueryParamFromContentObjectRenderer($cObj, self::MEDIA_CONSENT_ITEM);

        return $mediaConsentItem ? (int)$mediaConsentItem : self::NO_CONSENT;
    }

    private function getQueryParamFromContentObjectRenderer(ContentObjectRenderer $cObj, string $paramName)
    {
        $request = $cObj->getRequest();
        $queryParameters = $request->getQueryParams();

        return $queryParameters[$paramName] ?? null;
    }
}
