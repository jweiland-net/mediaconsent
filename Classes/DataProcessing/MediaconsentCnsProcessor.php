<?php

namespace JWeiland\Mediaconsent\DataProcessing;

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * Class for data processing for the content element Mediaconsent Cns
 */
class MediaconsentCnsProcessor implements DataProcessorInterface
{
    private $smcProviders = [];

    /**
     * Process data for the content element Mediaconsent Cns
     * Data of the content element is already in $processedData['data']!
     *
     * @param ContentObjectRenderer $cObj The data of the content element or page
     * @param array                 $contentObjectConfiguration The configuration of Content Object
     * @param array                 $processorConfiguration The configuration of this processor
     * @param array                 $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
     *
     * @return array the processed data as key/value store
     */
    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        $this->initProviders($processorConfiguration['cnProviders']);

        // read allowed content sources from session
        $allowedSources = $GLOBALS['TSFE']->fe_user->getKey(
            'ses',
            'allowFromSource'
        );
        if (!is_array($allowedSources)) {
            $allowedSources = [];
        }

        $smcProviderNum = $processedData['data']['mediaconsent_smcprovider'];

        // do this only if a content element uid is arriving in mediaconsent_item:
        // because this also means user has clicked to allow the content
        if ((int)GeneralUtility::_GET('mediaconsent_item') > 0) {
            // check if content provider exists in session, save if not
            if (!in_array($smcProviderNum, $allowedSources)) {
                array_push($allowedSources, $smcProviderNum);
                $GLOBALS['TSFE']->fe_user->setKey(
                    'ses',
                    'allowFromSource',
                    $allowedSources
                );
            }
        }

        if (in_array($smcProviderNum, $allowedSources)) {
            $processedData['wrapperActive'] = 0;
        } else {
            $processedData['wrapperActive'] = 1;
        }

        $processedData['reloadPageType'] = $processorConfiguration['reloadPageType'];
        $processedData['smcProvider'] = $this->getSmcProvider($smcProviderNum);

        return $processedData;
    }

    private function initProviders($smcProvidersString): void
    {
        $this->smcProviders = explode(',', $smcProvidersString);
    }

    private function getSmcProvider($num): string
    {
        return $this->smcProviders[$num - 1] ?? '';
    }
}
