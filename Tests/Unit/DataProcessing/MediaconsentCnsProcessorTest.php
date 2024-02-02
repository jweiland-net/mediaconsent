<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Mediaconsent\Tests\Unit\DataProcessing;

use PHPUnit\Framework\TestCase;
use JWeiland\Mediaconsent\DataProcessing\MediaconsentCnsProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;


class MediaconsentCnsProcessorTest extends TestCase
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
            ->willReturn($this->createMock(\Psr\Http\Message\ServerRequestInterface::class));

        // Mock processed data
        $processedData = [
            'data' => [
                'mediaconsent_smcprovider' => 123,
            ],
        ];

        $processor = new MediaconsentCnsProcessor();
        $result = $processor->process($cObj, [], ['reloadPageType' => 123], $processedData);

        // Assertions
        $this->assertEquals(1, $result['wrapperActive']);
        $this->assertEquals(123, $result['reloadPageType']);
    }
}
