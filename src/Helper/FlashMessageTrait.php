<?php

namespace TodoApp\Helper;

trait FlashMessageTrait
{
    public function showMessage(string $type, string $message): void
    {
        $_SESSION['messageType'] = $type;
        $_SESSION['message'] = $message;
    }
}