<?php declare(strict_types=1);

namespace Evt\OAuth2Client\Config;

class AbstractConfig
{
    /**
     * Your app's client id
     *
     * @var string
     */
    protected $clientId;

    /**
     * Your app's client secret
     *
     * @var string
     */
     protected $clientSecret;

    /**
     * The redirect uri
     *
     * @var string
     */
    protected $redirectUri;

    /**
     * The api scopes
     *
     * @var array
     */
    protected $scopes;

    /**
     * The uri for authorization
     *
     * @var string
     */
    protected $authUri;

    /**
     * The uri for requesting the tokens
     *
     * @var string
     */
    protected $tokenUri;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @param array  $scopes
     * @param string $authUri
     * @param string $tokenUri
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectUri, array $scopes, string $authUri, string $tokenUri)
    {
        $this->setClientId($clientId)
            ->setClientSecret($clientSecret)
            ->setRedirectUri($redirectUri)
            ->setScopes($scopes)
            ->setAuthUri($authUri)
            ->setTokenUri($tokenUri);
    }

    public function setClientId(string $clientId) : self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getClientId() : string
    {
        return $this->clientId;
    }

    public function setClientSecret(string $clientSecret) : self
    {
        $this->clientSecret = $clientSecret;

        return $this;
    }

    public function getClientSecret() : string
    {
        return $this->clientSecret;
    }

    public function setAuthUri(string $authUri) : self
    {
        $this->authUri = $authUri;

        return $this;
    }

    public function getAuthUri() : string
    {
        return $this->authUri;
    }

    public function setTokenUri(string $tokenUri) : self
    {
        $this->tokenUri = $tokenUri;

        return $this;
    }

    public function getTokenUri() : string
    {
        return $this->tokenUri;
    }

    public function setRedirectUri(string $redirectUri) : self
    {
        $this->redirectUri = $redirectUri;

        return $this;
    }

    public function getRedirectUri() : string
    {
        return $this->redirectUri;
    }

    public function setScopes(array $scopes)
    {
        $this->scopes = $scopes;

        return $this;
    }

    public function getScopes() : array
    {
        return $this->scopes;
    }
}
