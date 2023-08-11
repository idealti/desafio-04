<?php

namespace TodoApp\Controller;

use TodoApp\Helper\HtmlRendererTrait;

class RegisterForm implements RequestControllerInterface
{
    use HtmlRendererTrait;

    public function handle(): void
    {
        $this->render('Register/register-form.php', [
            'title' => 'Registrar'
        ]);
    }
}