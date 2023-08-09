<?php

namespace App\entity;

use \App\db\database;

class User{

    public $id;

    public $name;

    public $email;

    public $password;

    public function create(){
        $obDatabase = new Database('users');
        $this->id  = $obDatabase->insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
        
        return true;
    }

    public static function login($email, $password){
        return (new Database('users'))->select("email = '$email' AND password = '$password'")->fetchObject(self::class);
    }
}