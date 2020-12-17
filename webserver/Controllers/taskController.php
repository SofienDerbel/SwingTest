<?php

require_once "Models/Task.php";

class TaskController
{
    public function add()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod === "OPTIONS") {
            header("Access-Control-Allow-Origin:  http://localhost:8100");
            header("Access-Control-Allow-Methods: POST, GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            http_response_code(200);
            return;
        }
        elseif ($requestMethod === "POST"){
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data = (array) $data;
            $title = $data["title"];
            $subject = $data["subject"];
            $max = $data["max"];
            if (!$title){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Field title is required"]);
                return;
            }
            if (!$subject){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Field subject is required"]);
                return;
            }
            if (!$max){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Field max is required"]);
                return;
            }
            $task = new Task();
            $task->setTitle($title);
            $task->setSubject($subject);
            $task->setMax($max);
            $add = $task->addTask();
            if ($add) {
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($task->serialize());
                return;
            }
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode(["error" => "An unexpected error happened, please try again later."]);
            return;
        }
        
        else {
            $data = ["error" => "Request must be POST"];
            http_response_code(500);
            echo json_encode($data);
            exit();
        }
    }

    public function getAll()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if ($requestMethod === "OPTIONS") {
            header("Access-Control-Allow-Origin:  http://localhost:8100");
            header("Access-Control-Allow-Methods: POST, GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            http_response_code(200);
            return;
        }
        header('Content-Type: application/json');
        if ($requestMethod === "GET") {
           
            $req = task::getAll();
            if ($req) {
                http_response_code(200);
                echo json_encode($req);
                return;
            }
            http_response_code(404);
            echo json_encode(["error" => "No data can be found"]);
        }   
        else {
            $data = ["error" => "Request must be GET"];
            http_response_code(500);
            echo json_encode($data);
            return;
        }
    }

    public function find()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if ($requestMethod === "OPTIONS") {
            header("Access-Control-Allow-Origin:  http://localhost:8100");
            header("Access-Control-Allow-Methods: POST, GET");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            http_response_code(200);
            return;
        }
        header('Content-Type: application/json');
        if ($requestMethod === "GET") {
        header('Content-Type: application/json');
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        $id = $uri[3];
        if (is_numeric($id)) {
            $task = Task::find($id);
            echo json_encode($task);
            return;
            if ($task) {
                http_response_code(200);
                echo json_encode($task);
                return;
            } else {
                http_response_code(404);
                echo json_encode(["error" => "No task found"]);
                return;
            }
        }
        http_response_code(500);
        echo json_encode(["error" => "Please verify that you typed an integer"]);
        return;
    }
        else {
            $data = ["error" => "Request must be GET"];
            http_response_code(500);
            echo json_encode($data);
            return;
        }

    }

    public function affect()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        header("Access-Control-Allow-Origin:  http://localhost:8100");
        header("Access-Control-Allow-Methods: POST, GET");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        if ($requestMethod === "POST") {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $data = (array) $data;
            if (!$data)
            {
                header('Content-Type: application/json');
                $r = ["error" => "Rplease verify your data"];
                http_response_code(200);
                echo json_encode($r);
                return;
            }            
            $task_id = $data["task_id"];
            $user_id = $data["user_id"];
            $req = Task::affectUser($task_id, $user_id);
            if ($req){
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode($req);
                return;
            }else{
                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode(["error" => "Unexpected error occured, please try again later"]);
                return;
            }
        }  
        header('Content-Type: application/json');
        $data = ["error" => "Request must be POST"];
        http_response_code(200);
        echo json_encode($data);
        return;
    }


}