<?php
class Auth
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    public function login($username, $password)
    {
        $stmt = $this->db->getPdo()->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return json_encode(['message' => 'Login successful']);
        }
        http_response_code(401);
        return json_encode(['error' => 'Invalid username or password']);
    }

    public function logout()
    {
        session_destroy();
        return json_encode(['message' => 'Logged out']);
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }
}
