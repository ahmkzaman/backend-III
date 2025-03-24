<?php
interface AuthenticationProvider
{
    public function authenticate(string $identifier, string $credential): bool;
    public function getUserDetails(string $identifier): ?array;
}
class LocalDatabseProvider implements AuthenticationProvider
{
    private $dbConnection;
    public function __construct(DatabaseConnection $db)
    {
        $this->dbConnection = $db;
    }
    public function authenticate(string $identifier, string $credential): bool
    {
        $user = $this->dbConnection->fetchUserByUsername($identifier);
        if ($user && password_verify($credential, $user['password'])) {
            return true;
        }
        return false;
    }
    public function getUserDetails(string $identifier): ?array
    {
        return $this->dbConnection->fetchUserByUsername($identifier);
    }
}
class DatabseConnection
{
    public function fetchUserByUsername()
    {
        return ['id' => 1, 'username' => $username, 'password' => password_hash('12345', PASSWORD_DEFAULT)];
    }
}
class OAuthProvider implements AuthenticationProvider
{
    private $oauthClient;
    public function __construct(OAuthClient $client)
    {
        $this->oauthClient = $client;
    }
    public function authenticate(string $identifier, string $credential): bool
    {
        return $this->oauthClient->verifyToken($identifier);
    }
    public function getUserDetails(string $identifier): ?array
    {
        return $this->oauthClient->getUserDetails($identifier);
    }
}

class OAuthClient
{
    public function verifyToken(string $token): bool
    {
        return !empty($token);
    }
    public function fetchUserDetails(string $token): ?array
    {
        return ['id' => 2, 'username' => 'oauth_user', 'email' => 'user@example.com'];
    }
}
class AuthenticationService
{
    private $provider;
    public function __construct(AuthenticationProvider $provider)
    {
        $this->provider = $provider;
    }
    public function authenticate(string $identifier, string $credential): bool
    {
        if ($this->provider->authenticate($identifier, $credential)) {
            return true;
        }
        return false;
    }
    public function getUser(string $identifier): ?array
    {
        return $this->provider->getUserDetails($identifier);
    }
    public function setProvider(AuthenticationProvider $provider)
    {
        $this->provider = $provider;
    }
}

//usage
$db = new DatabaseConnection();
$localProvider = new LocalDatabseProvider($db);
$authService = new AuthenticationService($localProvider);

$username = 'user123';
$password = 'password123';
if ($authService->login($username, $password)) {
    $user = $authService->getUser($username);
    echo "Loggen in: " . $user['username'] . "\n";
} else {
    echo "Authentication failed.\n";
}
$oauthClient = new OAuthClient();
$oauthProvider = new OAuthProvider($oauthClient);
$authService->setProvider($oauthProvider);

$token = 'oauth_token';
if ($authService->login($token, '')) {
    $user = $authService->getUser($token);
    echo "Logged in via OAuth " . $user['username'] . "\n";
} else {
    echo "OAuth Authentication failed\n";
}
//SAML support
class SAMLProvider implements AuthenticationProvider
{
    private $samlClient;
    public function __construct(SAMLClient $client)
    {
        $this->samlClient = $client;
    }
    public function authenticate(string $identifier, string $credential): bool
    {
        return $this->samlClient->validateAssertion($identifier);
    }
    public function getUserDetails(string $identifier): ?array
    {
        return $this->samlClient->getUserInfo($identifier);
    }
}
