<?php

require "Model/User.php";
class UserRepository
{
    private mysqli $mysqli;

    /**
     * @param mysqli $mysqli
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function store(User $user)
    {
        $sql = "INSERT INTO users(name, last_name, email, password) VALUES (?,?,?,?)";

        $name = $user->getName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("ssss", $name, $lastName, $email, $password);

        $statement->execute();
    }

    public function findByEmail(string $email): User
    {
        $sql = "SELECT * FROM users WHERE email = ?";

        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
                return new User(
                    $user['id'],
                    $user['name'],
                    $user['last_name'],
                    $user['email'],
                    $user['password'],
                    $user['token']
                );
        }

        return null;
    }

    public function updateToken(User $user, string $token)
    {
        $sql = "UPDATE users SET token = ? WHERE id = ?";

        $id = $user->getId();
        
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("si", $token, $id);

        $statement->execute();
    }

    public function findByToken(string $token)
    {
        $sql = "SELECT * FROM users WHERE token = ?";
        
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("s", $token);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
                return new User(
                    $user['id'],
                    $user['name'],
                    $user['last_name'],
                    $user['email'],
                    $user['password'],
                    $user['token']
                );
        }

        return null;
    }

    public function removeToken($token)
    {
        $sql = "UPDATE users SET token = NULL WHERE token = ?";
        $statement = $this->mysqli->prepare($sql);
        $statement->bind_param("s", $token);
        $statement->execute();
    }
}