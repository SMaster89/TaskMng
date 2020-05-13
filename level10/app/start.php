<?php
use Aura\SqlQuery\QueryFactory;
// use DI\Container;
use DI\ContainerBuilder;
use League\Plates\Engine;

//Создадим наш построитель контейнеров с помощью
//компонента DI\ContainerBuilder
$containerBuilder = new containerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function () {
        return new Engine('../app/views');
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
    //Автоподключение к БД через ПДО
    PDO::class => function () {
        return new PDO("mysql:host=localhost;dbname=marlin", "root", "");
    },
]);

$container = $containerBuilder->build();

//FRONT CONTROLLER
//--
//---ИСПОЛЬЗУЕМ КОМПОНЕНТ РОУТЕР ИЗ КОМПОЗЕРА--//
//--
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // $homeContr = new App\controllers\HomeController();
    $r->addRoute('GET', '/tasks/create', ["App\controllers\HomeController", "create"]);
    $r->addRoute('GET', '/tasks', ["App\controllers\HomeController", "index"]);
    $r->addRoute('GET', '/tasks/{id}', ["App\controllers\HomeController", "show"]);
    $r->addRoute('GET', '/tasks/{id}/delete', ["App\controllers\HomeController", "delete"]);
    $r->addRoute('GET', '/tasks/{id}/edit', ["App\controllers\HomeController", "edit"]);
    $r->addRoute('POST', '/tasks/{id}/update', ["App\controllers\HomeController", "update"]);
    $r->addRoute('POST', '/tasks/store', ["App\controllers\HomeController", "store"]);

    // {id} must be a number (\d+)
    // $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // // The /{title} suffix is optional
    // $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump("404 | ERROR");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump("405 Method Not Allowed");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        // $container = new Container();
        //---ПОДКЛЮЧИЛИ НОВЫЙ КОМПОНЕНТ DI И ИСПОЛЬЗУЕМ---//
        // $container = new DI/Container();
        // $container->call($handler, $vars);
        $container->call($handler, $vars);
        // var_dump($handler, $vars);die;
        break;
}

//роут работает в связке с диспатчером который
//мы и подключили $container = new DI\Container();
