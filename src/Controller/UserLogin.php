<?php

namespace TodoApp\Controller;

use TodoApp\Helper\FlashMessageTrait;
use TodoApp\Infrastructure\DB\ConnectionCreator;

class UserLogin implements RequestControllerInterface
{
    use FlashMessageTrait;

    public function handle(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        if (!($_POST['email'] === $email) || !filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
            $this->showMessage('danger', 'É necessário informar um email válido.');
            header('Location: /login');
            exit();
        }

        $connection = (new ConnectionCreator())->createConnection();
        $statement = $connection->prepare("SELECT * FROM user WHERE email = ?");
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if (!$result || !password_verify($password, $result['password'])) {
            $this->showMessage('danger', 'Email ou senha inválidos.');
            header('Location: /login');
            exit();
        }

        $_SESSION['logged'] = true;
        $_SESSION['user'] = $result['id'];

        header('Location: /tasks');
        exit();
    }
}