<?php

namespace TodoApp\Controller;

class UserLogout implements RequestControllerInterface
{

    public function handle(): void
    {
        session_destroy();

        header('Location: /login');
        exit();
    }
}