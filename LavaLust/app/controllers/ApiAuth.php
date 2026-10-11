
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuth extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('api');
        $this->call->model('Account_model');
    }

    // POST /api/login
    public function login()
    {
        $this->api->require_method('POST');

        $data = $this->api->body();

        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if ($username === '' || $password === '') {
            $this->api->respond_error(
                'Username and password are required.',
                400
            );
            return;
        }

        $account = $this->Account_model
            ->get_account_by_username($username);

        if (!$account) {
            $this->api->respond_error(
                'Invalid username or password.',
                401
            );
            return;
        }

        $storedPassword = is_object($account)
            ? $account->password
            : $account['password'];

        // Verify hashed passwords, with temporary support for
        // existing plaintext passwords.
        $validPassword = password_verify($password, $storedPassword);

        if (!$validPassword && hash_equals($storedPassword, $password)) {
            $validPassword = true;

            // Convert a legacy plaintext password to a secure hash.
            $this->Account_model->update_password(
                is_object($account) ? $account->id : $account['id'],
                password_hash($password, PASSWORD_DEFAULT)
            );
        }

        if (!$validPassword) {
            $this->api->respond_error(
                'Invalid username or password.',
                401
            );
            return;
        }

        $accountId = (int) (
            is_object($account) ? $account->id : $account['id']
        );

        // Only the admin account receives full CRUD permissions.
        $role = ($username === 'admin') ? 'admin' : 'user';

        $tokens = $this->api->issue_tokens([
            'id' => $accountId,
            'role' => $role,
            'scopes' => ($role === 'admin')
                ? ['read', 'write', 'delete']
                : ['read']
        ]);

        $this->api->respond([
            'message' => 'Login successful.',
            'access_token' => $tokens['access_token'],
            'refresh_token' => $tokens['refresh_token'],
            'expires_in' => $tokens['expires_in'],
            'token_type' => $tokens['token_type']
        ], 200);
    }
}
