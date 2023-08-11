<?php

use TodoApp\Controller\{CompleteTask,
    DeleteTask,
    UpdateTaskForm,
    ListTasks,
    LoginForm,
    SaveTask,
    UpdateTask,
    UserLogin,
    UserLogout,
    UserPersistence,
    RegisterForm};

return [
    '/tasks' => ListTasks::class,
    '/login' => LoginForm::class,
    '/register' => RegisterForm::class,
    '/do-register-user' => UserPersistence::class,
    '/do-login' => UserLogin::class,
    '/logout' => UserLogout::class,
    '/do-register-task' => SaveTask::class,
    '/edit-task' => UpdateTaskForm::class,
    '/do-edit-task' => UpdateTask::class,
    '/do-delete-task' => DeleteTask::class,
    '/do-complete-task' => CompleteTask::class
];