<?php declare(strict_types=1);

namespace Evt\OAuth2Client\Config;

class Google extends AbstractConfig
{
    const AUTH_URI = 'https://accounts.google.com/o/oauth2/auth';
    const TOKEN_URI = 'https://accounts.google.com/o/oauth2/token';

    public function __construct(string $clientId, string $clientSecret, string $redirectUri, array $scopes)
    {
        parent::__construct($clientId, $clientSecret, $redirectUri, $scopes, self::AUTH_URI, self::TOKEN_URI);
    }
}
