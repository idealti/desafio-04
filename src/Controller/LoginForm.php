<?php

namespace TodoApp\Controller;

use TodoApp\Helper\HtmlRendererTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginForm implements RequestControllerInterface
{
    use HtmlRendererTrait;
    public function handle(): void
    {
        $this->render('Login/login-form.php', [
            'title' => 'Login'
        ]);
    }
}