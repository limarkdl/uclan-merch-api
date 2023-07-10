<?php

require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getAllUsers()
    {
        if (!isset($_SESSION['user'])) {
            echo json_encode(array('message' => 'Not logged in'));
            return;
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            echo json_encode(array('message' => 'Insufficient permissions'));
            return;
        }

        $result = $this->user->read();
        $num = $result->rowCount();

        if ($num > 0) {
            $users_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                unset($row['password']);
                array_push($users_arr, $row);
            }
            echo json_encode($users_arr);
        } else {
            echo json_encode(
                array('message' => 'No Users Found')
            );
        }
    }

    public function createUser($data)
    {
        $this->user->username = $data['username'];
        $existingUser = $this->user->getUserByUsername($data['username']);

        if ($existingUser) {
            throw new Exception('Username is already taken');
        }

        $this->user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $this->user->email = strip_tags($data['email']);

        if ($this->user->create()) {
            echo json_encode(array('message' => 'User Created'));
        } else {
            echo json_encode(array('message' => 'User Not Created'));
        }
    }

    public function loginUser($userData)
    {
        $user = $this->user->getUserByUsername($userData['username']);

        if ($user) {
            if (password_verify($userData['password'], $user['password'])) {
                unset($user['password']);

                $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
                $httponly = true;

                session_set_cookie_params(0, '/', '', $secure, $httponly);

                session_start();

                session_regenerate_id(true);

                $_SESSION['user'] = $user;

                echo json_encode(array('message' => 'Successfully logged in', 'user' => $user));
            } else {
                echo json_encode(array('message' => 'Incorrect username / password'));
            }
        } else {
            echo json_encode(array('message' => 'Incorrect username / password'));
        }
    }

    // Logout
    public function logoutUser()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        return ['logoutMessage' => 'Successfully logged out'];
    }

// Delete
    public function deleteUser($username, $password)
    {
        $user = $this->user->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            if ($this->user->deleteUser($user['id'])) {
                $response['deleteMessage'] = 'User deleted successfully';
                $logoutResponse = $this->logoutUser();
                $response = array_merge($response, $logoutResponse);
            } else {
                $response['deleteMessage'] = 'Something went wrong while trying to delete the user';
            }
        } else {
            $response['deleteMessage'] = 'Incorrect password';
        }

        echo json_encode($response);
    }

}
