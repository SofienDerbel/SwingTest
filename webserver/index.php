<?php
header('Access-Control-Allow-Origin: *');  

require_once('connection.php');


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($uri[1] === 'user') {
    $controller = "user";
    switch ($uri[2]) {
        case 'login':
            $action = "login";
            break;
        case 'register':
            $action = 'register';
            break;
        case 'all':
            $action = "getAll";
            break;
        case 'find':
            $action = "find";
            break;
            case 'findOtherUsers':
                $action = "findOtherUsers";
            break;
        default:
            $action = "error";
            break;
    }

} elseif ($uri[1] === 'task') {
    $controller = "task";
    switch ($uri[2]) {
        case 'add':
            $action = "add";
            break;
        case 'all':
            $action = "getAll";
            break;
        case 'find':
            $action = "find";
            break;
        case 'affect':
            $action = "affect";
            break;
        default:
            $action = "error";
            $controller = "user";
            break;
    }
} else {
    $controller = "user";
    $action = "error";
}

function call($controller, $action)
{
    require_once('Controllers/' . $controller . 'Controller.php');

    switch ($controller) {
        case 'user':
            $controller = new userController();
            break;
        case 'task':
            $controller = new taskController();
            break;

    }

    $controller->{$action}();
}

call($controller, $action);

?>