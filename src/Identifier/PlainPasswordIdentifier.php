<?php
declare(strict_types=1);

namespace App\Identifier;

use Authentication\Identifier\AbstractIdentifier;
use Cake\Http\Client;

/**
 * PlainPasswordIdentifier
 *
 * Identifies authentication credentials using a remote API.
 */
class PlainPasswordIdentifier extends AbstractIdentifier
{
    /**
     * Default configuration.
     * - `fields`: The fields to use to identify a user by:
     *   - `username`: The username field.
     *   - `password`: The password field.
     * - `apiUrl`: The URL of the remote API.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'fields' => [
            'username' => 'username',
            'password' => 'password',
        ],
        'apiUrl' => 'https://ds-portal.net/cms_api/ds_user_auth.php', // API URL to validate credentials.
    ];

    /**
     * Identify a user using the provided credentials.
     *
     * @param array $credentials The authentication credentials.
     * @return array|null The user identity or null if not authenticated.
     */
    public function identify(array $credentials): ?array
    {
        $fields = $this->getConfig('fields');
        
        $apiUrl = $this->getConfig('apiUrl');
      
        if (empty($credentials[$fields['username']]) || empty($credentials[$fields['password']])) {
            return null;
        }

        $username = $credentials[$fields['username']];
        $password = $credentials[$fields['password']];
        
        // Make a remote API call to validate credentials
        $http = new Client();
        $response = $http->get($apiUrl, [
            'username' => $username,
            'password' => $password,
        ]);
        

        if (!$response->isOk()) {
            return null;
        }
        $data = json_decode($response->getStringBody(), true);
      
        // Interpret API response
        if ($data === 0 || $data === 1 || !isset($data['retire_flg']) || $data['retire_flg'] !== '0') {
            return null; 
        }
    

        // Assume the API returns user information as a JSON object if valid.
        return is_array($data) ? $data : null;
    }
}
