<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Mediaconsent\Tests\Unit\DataProcessing;

use JWeiland\Mediaconsent\DataProcessing\MediaConsentProcessor;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class MediaConsentProcessorTest extends UnitTestCase
{
    /**
     * @test
     */
    public function processReturnsProcessedDataWithWrapperActiveWhenMediaConsentItemIsSet(): void
    {
        // Mock dependencies
        $cObj = $this->createMock(ContentObjectRenderer::class);
        $cObj->expects(self::atLeastOnce())
            ->method('getRequest')
            ->willReturn($this->createMock(ServerRequestInterface::class));

        // Mock processed data
        $processedData = [
            'data' => [
                'mediaconsent_smcprovider' => 123,
            ],
        ];

        $processor = new MediaConsentProcessor();
        $result = $processor->process($cObj, [], ['cnProviders' => '', 'reloadPageType' => 123], $processedData);

        // Assertions
        self::assertEquals(1, $result['wrapperActive']);
        self::assertEquals(123, $result['reloadPageType']);
    }
}
