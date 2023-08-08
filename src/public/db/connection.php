<?php

// Carregar as variáveis de ambiente do arquivo .env
$env = parse_ini_file('.env');

// Obter as informações de conexão a partir das variáveis de ambiente
$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$database = $env['DB_NAME'];

// Criar a conexão com o MySQL utilizando o mysqli
$conn = new mysqli($host, $user, $pass, $database);

// Verificar se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Configuração adicional da conexão (opcional)
// $conn->set_charset("utf8mb4"); // Definir o conjunto de caracteres para UTF-8
