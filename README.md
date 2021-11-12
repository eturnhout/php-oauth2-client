# php-oauth2-client
Created this to get started with services that require oauth2 authentication as I keep rewriting the same stuff every year or so

## Examples
### Retrieve the access token (GOOGLE)

<pre>
use Evt\OAuth2Client\Client;
use Evt\OAuth2Client\Config\Google as GoogleConfig;

$config = new GoogleConfig(
    YOUR_CLIENT_ID,
    YOUR_CLIENT_SECRET,
    YOUR_REDIRECT_URI,
    [YOUR_APP_SCOPES]
);

$client = new Client($config);

// This block is for when the user is redirected to YOUR_REDIRECT_URI, so place it where appropriate
if ( ! empty($_GET['code'])) {
    $response = $client->retrieveToken($_GET['code']);

    print_r($response);
    exit;
}

header('Location: ' . $client->getLoginUri());
</pre>

### Retrieve a new token
<pre>
use Evt\OAuth2Client\Client;
use Evt\OAuth2Client\Config\Google as GoogleConfig;

$config = new GoogleConfig(
    YOUR_CLIENT_ID,
    YOUR_CLIENT_SECRET,
    YOUR_REDIRECT_URI,
    [YOUR_APP_SCOPES]
);
$client = new Client($config);
$token = $client->retrieveNewToken(VALID_REFRESH_TOKEN);

print_r($token);
</pre>
