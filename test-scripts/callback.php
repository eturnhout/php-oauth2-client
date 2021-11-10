<?php declare(strict_types=1); ini_set('display_errors', '1');

require_once('../vendor/autoload.php');

use Evt\OAuth2Client\Client;
use Evt\OAuth2Client\Config\Google as GoogleConfig;

$clientId = '';
$clientSecret = '';
$redirectUri = '';
$scopes = [];

$config = new GoogleConfig(
    $clientId,
    $clientSecret,
    $redirectUri,
    $scopes
);

$client = new Client($config);

if ( ! empty($_GET['code'])) {
    $response = $client->retrieveToken($_GET['code']);

    echo '<pre>';
    print_r($response);
    exit;
}

header('Location: ' . $client->getLoginUri());
