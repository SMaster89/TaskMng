<?php
namespace App\models;


class QueryBuilder
{
    public $manager;

    public function __construct(ImageManager $manager)
    {
        $this->manager = $manager;
    }

    public function all()
    {
        // return [];
        return "метод all() класс QueryBuilder";
    }
}
