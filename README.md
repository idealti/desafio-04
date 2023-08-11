# Desafio Ideal Tecnologia - TODO App

## Objetivo: Criar um sistema simples de gerenciamento de tarefas (To-Do List) usando PHP, HTML, CSS, MySQL e Docker Compose.

## Alterações

- **Criação de um .env**: Separação das informações sensíveis para acesso ao banco de dados para o Docker

- **Nome dos containers no docker-compose.yml**: Coloquei essa identificação para facilitar a manipulação dos containers pela linha de comando, como executar comandos, verificar logs, etc.

- **Configurações adicionais para o Docker:** Criei uma pasta `docker/` na raíz do projeto para colocar arquivos de configuração do Apache para o redirecionamento das requisições, o dump do banco de dados e um arquivo de configuração para o X-Debug.

  - Para habilitar essas configurações, precisei criar um Dockerfile para executar essas instruções mais específicas

  - Criei um dump inicial do banco de dados e espelhei ele para o diretório `docker-entrypoint-initdb.d/`. Desse modo, o container executa o script SQL sempre que é criado.

- **Composer**: Foi necessária a criação do arquivo `composer.json` para o autoload das classes.

- **Conexão com banco de dados**: O arquivo de conexão foi transformado em uma classe, pois optei por seguir uma abordagem orientada a objetos.

## Como executar o projeto

- Instale as dependências do Composer (autoload): 

```
composer install
```

- Altere o arquivo `.env.example` para `.env` e preencha as informações de acesso banco da forma como desejar (devem ser as mesmas credenciais da classe `ConnectionCreator.php`).

- Faça o build do container do servidor web:

```
docker compose build web
```

- Suba todos os containers da aplicação:

```
docker compose up -d
```

A aplicação deve estar disponível em `localhost:8888`.

## ✨ Dica:

Você pode utilizar o usuário de testes já existente ou criar seu próprio.

```
Login: andre@hire.me
Senha: 123
```