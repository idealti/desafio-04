# Projeto de Gerenciamento de Tarefas - README

Este é um projeto de gerenciamento de tarefas desenvolvido em PHP e MySQL, utilizando Docker para criação de ambientes de desenvolvimento. O projeto permite adicionar, listar e gerenciar tarefas, bem como realizar login e registro de usuários.

## Requisitos

Certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- Docker: [Instalação do Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalação do Docker Compose](https://docs.docker.com/compose/install/)

## Configuração

1. Clone este repositório para a sua máquina:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

2. Navegue até o diretório do projeto:

```bash
cd nome-do-diretorio
```

## Configuração do Apache

Dentro do diretório do projeto, crie um diretório chamado `apache-config`. Este diretório será usado para armazenar o arquivo de configuração do Apache.

1. Crie o diretório `apache-config`:

```bash
mkdir apache-config
```

2. Dentro do diretório recém-criado `apache-config`, crie um arquivo chamado `000-default.conf` com as configurações do site. Você pode usar o seguinte exemplo como base:

```apacheconf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    ErrorLog /var/log/apache2/error.log
    CustomLog /var/log/apache2/access.log combined
</VirtualHost>
```

Certifique-se de substituir `/var/www/html/public` pelo caminho correto até a pasta `public` do seu projeto.

3. Volte ao arquivo `docker-compose.yml` e adicione o volume que faz referência ao arquivo de configuração:

```yaml
version: '3'
services:
  web:
    image: php:apache
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
      - ./apache-config/000-default.conf:/etc/apache2/sites-available/000-default.conf
    depends_on:
      - db
  db:
    image: mariadb
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: todo_db
      MYSQL_USER: todo_db
      MYSQL_PASSWORD: 
    volumes:
      - todo-data:/var/lib/mysql
    ports:
      - "3306:3306"
volumes:
  todo-data:
```

Agora, ao executar o projeto, o Apache utilizará a configuração do arquivo `000-default.conf` para direcionar as solicitações para a pasta `public` do seu projeto.

## Executando o Projeto

1. Execute o Docker Compose para criar e iniciar os containers:

```bash
docker-compose up -d
```

2. Acesse a aplicação em seu navegador web através de `http://localhost:8080`.

## Banco de Dados

O banco de dados está configurado usando o Docker Compose, com as credenciais especificadas no arquivo `docker-compose.yml`. Tem um arquivo com o código de criação das tabelas no diretório `dump`.

## Validação de Formulário

A validação de formulário foi implementada no arquivo HTML utilizando JavaScript para garantir que os campos estejam preenchidos antes do envio.

## Contribuição

Sinta-se à vontade para contribuir com melhorias ou correções para este projeto. Abra uma issue para discutir novas funcionalidades ou problemas encontrados.

---

Lembre-se de substituir os placeholders como `seu-usuario`, `seu-repositorio`, `nome-do-diretorio` e outras informações pertinentes com os detalhes específicos do seu projeto.