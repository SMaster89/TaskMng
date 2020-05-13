<?php
namespace App\controllers;

use App\components\Database;
use League\Plates\Engine;

class HomeController
{
    private $view;
    private $database;

    public function __construct(Engine $view, Database $database)
    {

        $this->view = $view;
        $this->database = $database;

    }

    public function index()
    {
        $myTasks = $this->database->all('tasks');

        echo $this->view->render('tasks', ['tasks' => $myTasks]);
    }

    public function show($id)
    {

        $myTask = $this->database->getOne('tasks', $id);

        echo $this->view->render('show', ['task' => $myTask]);
    }

    public function delete($id)
    {
        $this->database->delete('tasks', $id);

        header('Location: /tasks');
    }

    public function edit($id)
    {

        $myTask = $this->database->getOne('tasks', $id);

        echo $this->view->render('edit', ['task' => $myTask]);
    }

    public function update($id)
    {
        $this->database->update('tasks', $id, $_POST);

        header('Location: /tasks');
    }

    public function create()
    {

        // $select = $this->queryFactory->newSelect();
        // $select->cols(["*"])
        //     ->from("tasks");

        // $sth = $this->pdo->prepare($select->getStatement());
        // $sth->execute($select->getBindValues());
        // $myTask = $sth->fetch(PDO::FETCH_ASSOC);

        echo $this->view->render('create', ['task' => $myTask]);
    }

    public function store()
    {
        $this->database->store('tasks', $_POST);

        header('Location: /tasks');

    }

}
