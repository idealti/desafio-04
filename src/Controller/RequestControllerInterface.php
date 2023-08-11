<?php

namespace TodoApp\Controller;

interface RequestControllerInterface
{
    public function handle(): void;
}