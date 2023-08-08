<?php

class User
{
    private int $id;

    private string $name;

    private string $lastName;

    private string $email;

    public function __construct(int $id, string $name, string $lastName, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->$email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setLastName(string $lastName): void
    {
        $this->name = $lastName;
    }

    public function setEmail(string $lastEmail): void
    {
        $this->email = $lastEmail;
    }
}
