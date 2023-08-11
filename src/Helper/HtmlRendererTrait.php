<?php

namespace TodoApp\Helper;

trait HtmlRendererTrait
{
    public function render(string $templatePath, array $data): void
    {
        extract($data);
        ob_start();
        require __DIR__ . '/../View/' . $templatePath;
        $html = ob_get_clean();

        echo $html;
    }
}