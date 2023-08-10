<?php

class Task
{
    private ?int $id;

    private string $taskName;

    private ?string $status;

    private DateTime $completionDate;

    private string $description;

    private DateTime $creationDate;

    private int $userId;

    public function __construct(?int $id, string $taskName, ?string $status, DateTime $completionDate, string $description, int $userId, DateTime $creationDate)
    {
        $this->id = $id;
        $this->taskName = $taskName;
        $this->status = $status;
        $this->completionDate = $completionDate;
        $this->description = $description;
        $this->userId = $userId;
        $this->creationDate = $creationDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    public function getTaskName(): string
    {
        return $this->taskName;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCompletionDate(): DateTime
    {
        return $this->completionDate;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setTaskName(string $taskName): void
    {
        $this->taskName = $taskName;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setCompletionDate(string $completionDate): void
    {
        $this->completionDate = new DateTime($completionDate);
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }
}