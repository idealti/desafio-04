<h1 align="center">
    ✅ TO DO
</h1>
<p align="center">🚀 TO DO - monitore suas tarefas de um jeito fácil</p>


### ✅ Features

- [x] Cria usuário.
- [x] Login do usuário.
- [x] Autenticação do usuário
- [x] Criação de tarefas
- [x] Exibição da lista de tarefas
- [x] Edição da tarefa
- [x] Exclusão de uma tarefa
- [x] Marcação de tarefa como concluída
- [x] Filtro por status e por data de criação da tarefa

### Observações: 
- Foi preciso alterar algumas partes do Docker para poder rodar corretamente o projeto.

### 🎲 Rodando o projeto
<p align="center">Foi realizado o deploy na Vercel, mas com o endpoint voltado para "http://localhost:8000" pois é a porta que a Api tá configurada para rodar.</p>

```bash
# Clone este repositório
$ git clone <git@github.com:monafmenezes/desafio-04.git>

# Acesse a pasta do projeto no terminal
$ cd desafio-04

# Acesse a pasta todo
$ cd todo

# Instale as dependências
$ composer install

# Execute o docker
$ docker compose up -d

# Acesse o bash do banco de dados e instale o mysql

$ apt-get update && apt-get install -y default-mysql-client

# Acesse o bash do app e rode o comando abaixo para criar o banco e as tabelas

$ php connection.php

# O servidor inciará na porta:8000 - acesse <http://localhost:8000>
```

### 🛠 Tecnologias

As principais ferramentas foram usadas na construção do projeto:

- [Bootstrap](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [PHP](https://www.php.net/)

### ✅ Autor
<img style="border-radius: 50%;" src="https://github.com/monafmenezes.png" width="100px;" alt=""/>

Feito por Monalisa Menezes, entre em contato!
<div>
<a href = "mailto:psimonafmenezes@gmail.com"><img src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white" target="_blank"></a>
    <a href="https://www.linkedin.com/in/monalisafmenezes" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a> 
    <a href="https://twitter.com/monafmenezes" target="_blank"><img src="https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white" target="_blank"></a> 
 </div>
