<?php
namespace App\models;

//тут ненада подключать через use(пространство имен)
//так как КвериБилдер и ИмэйджМанагер находятся
//в одном пространстве имен - namespace App\models;
// use App\models\ImageManager;

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
