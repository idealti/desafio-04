<?php

class UserRepository
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function store(User $user)
    {
        $sql = "INSERT INTO user(name, lastName, email) VALUES (?,?,?)";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $user->getName());
        $statement->bindValue(2, $user->getLastName());
        $statement->bindValue(3, $user->getEmail());

        $statement->execute();
    }
}
