<?php

namespace TodoApp\Model;

use DateTimeImmutable;

class Task
{
    public const STATUS_PENDING = 1;
    public const STATUS_COMPLETED = 2;
    public function __construct(
        private int               $id,
        private string            $title,
        private string            $description,
        private string            $created_at,
        private int               $status
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return date_format(date_create_immutable($this->created_at), 'd/m/Y H:i');
    }

    public function getStatus(): string
    {
        if ($this->status === self::STATUS_PENDING) {
            return 'Pendente';
        }

        return 'Concluído';
    }

}