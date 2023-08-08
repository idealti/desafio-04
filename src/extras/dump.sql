CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_title VARCHAR(255) NOT NULL,
    task_description TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    status ENUM('pendente', 'concluida') NOT NULL
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

