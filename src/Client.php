<?php declare(strict_types=1);

namespace Evt\OAuth2Client;

use Evt\OAuth2Client\Config\BaseConfig;
use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * Your app's configurations
     *
     * @var \Evt\OAuth2Client\Config\BaseConfig
     */
    protected $config;

    /**
     * Http client used to make requests
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    public function __construct(BaseConfig $config)
    {
        $this->setConfig($config);
        $this->httpClient = new HttpClient();
    }

    public function setConfig(BaseConfig $config) : self
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig() : BaseConfig
    {
        return $this->config;
    }

    /**
     * Get the login URI to redirect to
     */
    public function getLoginUri() : string
    {
        $config = $this->config;
        $uriFormat = $config->getAuthUri() . '?client_id=%1$s&redirect_uri=%2$s&response_type=code&scope=%3$s&access_type=offline&prompt=consent';
        $scopes = implode(' ', $config->getScopes());

        return sprintf(
            $uriFormat,
            $config->getClientId(),
            urlencode($config->getRedirectUri()),
            urlencode($scopes)
        );
    }

    /**
     * Retrieve an access token
     *
     * @param string $code The code recieved through the login proccess
     *
     * @return array The json decoded to an array
     */
    public function retrieveToken(string $code) : array
    {
        $config = $this->config;
        $scopes = implode(' ', $config->getScopes());
        $uri = $this->config->getTokenUri();
        $data = array(
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $config->getRedirectUri(),
            "scope" => $scopes,
            "client_id" => $config->getClientId(),
            "client_secret" => $config->getClientSecret(),
        );

        return $this->executePostRequest($uri, $data);
    }

    /**
     * Get a new access token
     *
     * @param string $refreshToken You must supply a valid refresh token
     *
     * @return array The json decoded to an array
     */
    public function retrieveNewToken(string $refreshToken) : array
    {
        $config = $this->getConfig();
        $uri = $config->getTokenUri();
        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => $config->getClientId(),
            'client_secret' => $config->getClientSecret(),
            'refresh_token' => $refreshToken,
        );

        return $this->executePostRequest($uri, $data);
    }

    /**
     * Make a post request passing the data as application/x-www-form-urlencoded
     *
     * @param string $uri
     * @param array $data
     *
     * @return array
     */
    protected function executePostRequest(string $uri, array $data) : array
    {
        $response = $this->httpClient->request('POST', $uri, [
            'form_params' => $data,
        ]);

        $responseData = \json_decode($response->getBody()->getContents(), true);

        if ( ! $responseData) {
            throw new \Exception('Got empty response');
        }

        return $responseData;
    }
}
