<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Mediaconsent\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use JWeiland\Mediaconsent\Utility\SessionUtility;
use TYPO3\CMS\Core\Session\UserSession;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class SessionUtilityTest extends TestCase
{
    /**
     * @test
     */
    public function getFrontendSessionDataReturnsNullIfFrontendUserAuthenticationIsNull(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->expects(self::atLeastOnce())
            ->method('getAttribute')
            ->willReturn(null);

        $this->assertNull(SessionUtility::getFrontendSessionData($request, 'allowFromSource'));
    }

    /**
     * @test
     */
    public function setFrontendSessionDataDoesNotSetDataIfFrontendUserAuthenticationIsNull(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $request->expects(self::atLeastOnce())
            ->method('getAttribute')
            ->willReturn(null);

        SessionUtility::setFrontendSessionData($request, 'allowFromSource', []);

        // Ensure that setAttribute method is not called when authentication is null
        $this->assertNull(SessionUtility::getFrontendSessionData($request, 'allowFromSource'));
    }

    /**
     * @test
     */
    public function setFrontendSessionDataSetsDataIfFrontendUserAuthenticationIsNotNull(): void
    {
        $request = $this->createMock(ServerRequestInterface::class);
        $frontendUserAuthentication = $this->createMock(FrontendUserAuthentication::class);
        $session = $this->createMock(UserSession::class);

        $request->expects(self::atLeastOnce())
            ->method('getAttribute')
            ->with('frontend.user')
            ->willReturn($frontendUserAuthentication);

        $frontendUserAuthentication->expects(self::atLeastOnce())
            ->method('getSession')
            ->willReturn($session);

        $testData = ['testData' => 10];
        $session->expects(self::atLeastOnce())
            ->method('set')
            ->with('allowFromSource', $testData);

        $frontendUserAuthentication->expects(self::atLeastOnce())
            ->method('storeSessionData');

        SessionUtility::setFrontendSessionData($request, 'allowFromSource', $testData);
        $this->assertSame($session, $frontendUserAuthentication->getSession());
    }

    /**
     * @test
     */
    public function getFrontendCookieNameFromGlobalConfigurationReturnsDefaultIfConfigCookieNameIsEmpty(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['cookieName'] = '';

        $this->assertEquals('fe_typo_user', SessionUtility::getFrontendCookieNameFromGlobalConfiguration());
    }

    /**
     * @test
     */
    public function getFrontendCookieNameFromGlobalConfigurationReturnsConfigCookieNameIfNotEmpty(): void
    {
        $GLOBALS['TYPO3_CONF_VARS']['FE']['cookieName'] = 'my_cookie_name';

        $this->assertEquals('my_cookie_name', SessionUtility::getFrontendCookieNameFromGlobalConfiguration());
    }
}
