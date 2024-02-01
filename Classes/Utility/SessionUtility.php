<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/mediaconsent.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Mediaconsent\Utility;

use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class SessionUtility
{
    private const FE_USER_ATTRIBUTE = 'frontend.user';

    public static function getFrontendSessionData(ServerRequestInterface $request, string $key): mixed
    {
        return self::getFrontendUserAuthentication($request)->getSessionData($key);
    }

    public static function setFrontendSessionData(ServerRequestInterface $request, string $key, array $data): void
    {
        $userSession = self::getFrontendUserAuthentication($request)->getSession();
        $userSession->set($key, $data);
        self::storeFrontendSessionData($request);
    }

    protected static function getFrontendUserAuthentication(ServerRequestInterface $request): ?FrontendUserAuthentication
    {
        $authUser = $request->getAttribute(self::FE_USER_ATTRIBUTE);
        return $authUser instanceof FrontendUserAuthentication ? $authUser : null;
    }

    protected static function storeFrontendSessionData(ServerRequestInterface $request): void
    {
        self::getFrontendUserAuthentication($request)->storeSessionData();
    }

    protected static function getFrontendCookieNameFromGlobalConfiguration(): string
    {
        $configCookieName = trim($GLOBALS['TYPO3_CONF_VARS']['FE']['cookieName'] ?? '');

        if ($configCookieName === '') {
            return 'fe_typo_user';
        }
        return $configCookieName;
    }
}
