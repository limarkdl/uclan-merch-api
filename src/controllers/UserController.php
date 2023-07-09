<?php

require_once '../models/User.php';

class UserController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getAllUsers()
    {
        $result = $this->user->read();
        $num = $result->rowCount();

        if ($num > 0) {
            $users_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
                return $user;
            }
        }
        return null;
    }

    // COMING SOON
    // Update
    // Delete
}
