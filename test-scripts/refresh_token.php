<?php declare(strict_types=1); ini_set('display_errors', '1');

require_once('../vendor/autoload.php');

use Evt\OAuth2Client\Client;
use Evt\OAuth2Client\Config\Google as GoogleConfig;

$clientId = '';
$clientSecret = '';
$redirectUri = '';
$scopes = [];
$refreshToken = '';

$config = new GoogleConfig(
    $clientId,
    $clientSecret,
    $redirectUri,
    $scopes
);

$client = new Client($config);
$token = $client->retrieveNewToken($refreshToken);

echo '<pre>';
print_r($token);
exit;
