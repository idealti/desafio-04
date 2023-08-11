<?php

namespace TodoApp\Controller;

use TodoApp\Infrastructure\DB\ConnectionCreator;
use TodoApp\Helper\{FlashMessageTrait, HtmlRendererTrait};

class UserPersistence implements RequestControllerInterface
{
    use HtmlRendererTrait;
    use FlashMessageTrait;

    public function handle(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $password = password_hash($password, PASSWORD_ARGON2I);

        if (!($_POST['email'] === $email) || !filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $this->showMessage('danger', 'É necessário informar um email válido.');
            header('Location: /register');
            exit();
        }

        $connection = (new ConnectionCreator())->createConnection();
        $statement = $connection->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $statement->bind_param('sss', $name, $email, $password);
        $statement->execute();

        $this->showMessage('success', 'Cadastro realizado com sucesso! Faça login para continuar.');
        http_response_code(201);
        header('Location: /login');
        exit();
    }
}