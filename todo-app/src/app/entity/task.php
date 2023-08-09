<?php

namespace App\entity;

use \App\db\database;
use \PDO;

class Task
{


    public $id;

    public $title;

    public $description;

    public $date;

    public $is_completed;

    public $user_id;

    public function create()
    {
        $this->date = date('Y-m-d');
        $obDatabase = new Database('tasks');

        $this->id  = $obDatabase->insert([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'is_completed' => $this->is_completed,
            'user_id' => $this->user_id
        ]);

        return true;
    }

    public function update($id)
    {
        return (new Database('tasks'))->update(
            'id = ' . $this->id,
            [
                'title' => $this->title,
                'description' => $this->description,
                'is_completed' => $this->is_completed
            ]
        );
    }

    public function delete()
    {
        return (new Database('tasks'))->delete('id =' . $this->id);
    }

    public static function getAll($where = null, $order = null)
    {
        return (new Database('tasks'))->select($where, $order)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getOne($id)
    {
        return (new Database('tasks'))->select('id = ' . $id)->fetchObject(self::class);
    }
}
