<?php

require_once '../config/Database.php';

class User
{
    private $conn;
    private $table = 'tbl_users';

    // User properties
    public $id;
    public $username;
    public $password;
    public $email;

    // Constructor with DB
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' SET username = :username, password = :password, email = :email';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        if ($stmt->execute()) {
            return true;
        } else {
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE username = :username LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->email = $row['email'];
            return $row;
        }

        return null;
    }
    // COMING SOON
    // Update
    // Delete
}
